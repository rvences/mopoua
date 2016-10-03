<?php

namespace backend\modules\caja\controllers;

use backend\models\Model;
use backend\modules\caja\models\Conteodiario;
use backend\modules\caja\models\Conteonotas;
use backend\modules\caja\models\Tipoingresoegreso;
use Yii;
use backend\modules\caja\models\Arqueo;
use backend\modules\caja\models\search\ArqueoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;

/**
 * ArqueoController implements the CRUD actions for Arqueo model.
 */
class ArqueoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Arqueo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArqueoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Arqueo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Arqueo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // Comprobando que se haya echo el conteodiario antes de iniciar el arqueo
        $conteofinalizado = Conteodiario::find()->select(['id'])->where(['is not', 'montoapertura', null])
            ->andWhere(['is not', 'montocierre', null])->andWhere(['is', 'arqueo_id', null])->exists();
        if (!$conteofinalizado) {
            Yii::$app->getSession()->addFlash('warning', 'Realiza la apertura y cierre primero');
            return Yii::$app->getResponse()->redirect(array('caja/conteodiario/index'));
        }


        // En caso de que el arqueo ya se haya realizado hacer esto
        $arqueo_cerrado_id = Arqueo::find()->select(['id'])->where(['username' => Yii::$app->user->identity->username, 'cerrado' => 0])->one();
        if ($arqueo_cerrado_id) { return $this->redirect(['view', 'id' => $arqueo_cerrado_id->id ]); }
            //echo $apertura->createCommand()->sql;
            //echo $apertura->createCommand()->getRawSql();
        $model = new Arqueo;
        $modelsNotas = [new Conteonotas];
        $ingresoegreso = Tipoingresoegreso::find()->all();

        if ($model->load(Yii::$app->request->post()) ) {

            $modelsNotas = Model::createMultiple(Conteonotas::className());
            Model::loadMultiple($modelsNotas, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsNotas) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsNotas as $modelNotas) {
                            $modelNotas->arqueo_id = $model->id;
                            if (!($flag = $modelNotas->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        // Obteniendo la info de la apertura
                        $apertura = Conteodiario::find()->select(['montoapertura', 'montocierre'])->where(['arqueo_id' => null, 'username'=> Yii::$app->user->identity->username ])->one();
                        // Cantidad que se conto de dinero con que se aperturo la caja
                        $model->efectivoapertura = $apertura->montoapertura;
                        // Cantidad que se conto de dinero con el que se cerro la caja
                        $model->efectivocierre = $apertura->montocierre;
                        // Ventas en efectivo reportadas por el SoftRestaurant -- Efectivo Real - Lo que dice la máquina que vendió
                        $model->efectivosistema =        Conteonotas::find()->select(['cantidad'])->where(['arqueo_id'=> $model->id, 'tipo' => 'INGRESO EFECTIVO'])->asArray()->sum('cantidad');
                        // Compras realizadas con Tarjeta de Debido o Credito
                        $model->dineroelectronico =      Conteonotas::find()->select(['cantidad'])->where(['arqueo_id'=> $model->id, 'tipo' => 'INGRESO ELECTRONICO'])->asArray()->sum('cantidad');
                        // Dinero que se deposito de forma adicional ( de compras u otra cosa que se retiro y no se deposito nuevamente )
                        $model->efectivoadeudoanterior = Conteonotas::find()->select(['cantidad'])->where(['arqueo_id'=> $model->id, 'tipo' => 'INGRESO ADEUDOS ANTERIORES'])->asArray()->sum('cantidad');
                        // Dinero que deposita la empresa para agregar flujo de efectivo ( Cuando se queda sin dinero o cambio la caja)
                        $model->depositoempresa =        Conteonotas::find()->select(['cantidad'])->where(['arqueo_id'=> $model->id, 'tipo' => 'INGRESO EMPRESA'])->asArray()->sum('cantidad');
                        // Dinero que se retira de la caja por exceso de efectivo por seguridad
                        $model->retiroempresa =          Conteonotas::find()->select(['cantidad'])->where(['arqueo_id'=> $model->id, 'tipo' => 'RETIRO EMPRESA'])->asArray()->sum('cantidad');
                        // Compras realizadas con dinero de la caja
                        $model->egresocompras =          Conteonotas::find()->select(['cantidad'])->where(['arqueo_id'=> $model->id, 'tipo' => 'EGRESO COMPRA'])->asArray()->sum('cantidad');
                        // Pagos de servicios con dinero de la caja
                        $model->egresocomprasservicio =  Conteonotas::find()->select(['cantidad'])->where(['arqueo_id'=> $model->id, 'tipo' => 'EGRESO SERVICIO'])->asArray()->sum('cantidad');

                        // Efectivo que debe de existir en la caja; debe ser igual a lo que reporto el SoftRestaurant
                        $model->efectivofisico =    $model->efectivoapertura + $model->efectivosistema + $model->depositoempresa + $model->efectivoadeudoanterior +
                                                    $model->depositoempresa - $model->egresocompras - $model->egresocomprasservicio - $model->retiroempresa;
                        $adeudoanterior = 		 Arqueo::find()->select(['adeudoactual'])->where(['username'=> Yii::$app->user->identity->username , 'cerrado' => true])->orderBy(['id' => SORT_ASC])->one();
                        // Cuanto quedo a deber el cajero el día anterior
                        $model->adeudoanterior = (empty($adeudoanterior->adeudoactual)) ? 0 : $adeudoanterior->adeudoactual;
                        // Dinero que quedo a deber el cajero
                        $model->adeudoactual =      	 $model->efectivocierre - $model->efectivofisico + $model->adeudoanterior -  $model->efectivoadeudoanterior;

                        // Cuanto se vendio en el turno
                        $model->ventaturno =         	 $model->efectivosistema + $model->dineroelectronico;
                        // Cuando se gasto en el turno
                        $model->egresoturno =        	 $model->egresocompras + $model->egresocomprasservicio;
                        // Nuevas claves temporales
                        $model->clave1 = Arqueo::getClave(5);
                        $model->clave2 = Arqueo::getClave(6);
                        $model->save(false);
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsNotas' => (empty($modelsNotas)) ? [new Conteonotas()] : $modelsNotas,
            'ingresoegreso' => $ingresoegreso,
        ]);
    }

    /**
     * Updates an existing Arqueo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Arqueo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Arqueo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Arqueo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Arqueo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCerrar($id) {

        $model = $this->findModel($id);

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $model->cerrado = true;
            $flag = $model->save(false);
            if ($flag) {
                Conteodiario::updateAll(['arqueo_id' => $model->id], ['username'=> Yii::$app->user->identity->username, 'arqueo_id' => null]);
                $transaction->commit();
                return $this->render('cerrar', [
                    'model' => $this->findModel($id),
                ]);
            }

        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }
}
