<?php

namespace backend\modules\caja\controllers;

use backend\modules\caja\models\Conteonotas;
use backend\modules\caja\models\Conteodiario;
use backend\models\Model;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\Response;
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











        $modelArqueo = new Arqueo;
        $modelsConteonotas = [new Conteonotas];
        if ($modelArqueo->load(Yii::$app->request->post())) {

            $modelsConteonotas = Model::createMultiple(Conteonotas::className());
            Model::loadMultiple($modelsConteonotas, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsConteonotas),
                    ActiveForm::validate($modelArqueo)
                );
            }

            // validate all models
            $valid = $modelArqueo->validate();
            $valid = Model::validateMultiple($modelsConteonotas) && $valid;

            // Obteniendo los datos del conteo diario
            $conteo = Conteodiario::findOne(['username' => Yii::$app->user->identity->username, 'arqueo_id' => null]);

            $modelArqueo->montoapertura = $conteo->montoapertura;
            $modelArqueo->montocierre = $conteo->montocierre;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {

                    if ($flag = $modelArqueo->save(false)) {
                        $total = 0;
                        foreach ($modelsConteonotas as $modelConteonotas) {
                            // Total en notas
                            $total += $modelConteonotas->cantidad;
                            $modelConteonotas->tipo = 'EGRESO';
                            $modelConteonotas->arqueo_id = $modelArqueo->id;
                            if (! ($flag = $modelConteonotas->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        // Actualizando Arqueo
                        $modelArqueo->montoegreso = $total;
                        $modelArqueo->save();
                        //$model = $this->findModel($id);


                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelArqueo->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelArqueo' => $modelArqueo,
            'modelsConteonotas' => (empty($modelsConteonotas)) ? [new Conteonotas] : $modelsConteonotas
        ]);





















        /*
        $model = new Arqueo();




        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post()) ) {
            $conteo = Conteodiario::findOne(['username' => Yii::$app->user->identity->username, 'arqueo_id' => null]);

            $model->montoapertura = $conteo->montoapertura;
            $model->montocierre = $conteo->montocierre;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
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
}
