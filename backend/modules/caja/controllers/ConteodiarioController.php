<?php

namespace backend\modules\caja\controllers;

//use backend\modules\mrp\models\Proveedores;
use Yii;
use backend\modules\caja\models\Conteodiario;
use backend\modules\caja\models\Arqueo;
//use backend\modules\caja\models\search\ConteodiarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConteodiarioController implements the CRUD actions for Conteodiario model.
 */
class ConteodiarioController extends Controller
{

    public $monedas = array('moneda1'=>'0.10', 'moneda2'=>'0.20', 'moneda3'=>'0.50', 'moneda4'=>'1', 'moneda5'=>'2', 'moneda6'=>'5', 'moneda7'=>'10', 'moneda8'=>'20',
        'moneda9'=>'50', 'moneda10'=>'100', 'moneda11'=>'20', 'moneda12'=>'50', 'moneda13'=>'100', 'moneda14'=>'200', 'moneda15'=>'500', 'moneda16'=>'1000'

    );

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

    public function actionIndex()
    {
        $model = Conteodiario::findOne(['username'=> Yii::$app->user->identity->username, 'arqueo_id' => null]);
        if ($model) {
            if ( ($model->load(Yii::$app->request->post()) && $model->save()) || $model->montocierre ) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('cierre', [
                    'model' => $model,
                    'monedas' => $this->monedas,
                ]);
            }
        } else {
            $model = new Conteodiario();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $arqueo_anterior = Arqueo::find()->select(['clave1', 'clave2', 'usercontinua'])->orderBy(['id' => SORT_DESC])->one();

                    //$arqueo_anterior = Arqueo::find()->select(['clave1', 'clave2', 'usercontinua'])->orderBy(['id' => SORT_DESC]);
                    //echo $arqueo_anterior->createCommand()->getRawSql();
                if ($arqueo_anterior->usercontinua == Yii::$app->user->identity->username) {
                    Yii::$app->getSession()->addFlash('warning', 'Tus claves temporales de acceso son:<br> Cajero: ' .
                        $arqueo_anterior->clave1 . ' Caja: ' . $arqueo_anterior->clave2 );
                }

                return $this->render('apertura', [
                    'model' => $model,
                    'monedas' => $this->monedas,
                ]);
            }
        }
    }

    /**
     * Displays a single Conteodiario model.
     * @param integer $id
     * @return mixed
     */


    public function actionView($id)
    {
        $model = Conteodiario::findOne($id);
        // Obteniendo el cierre del turno anterior para validar la diferencia entre los usuarios
        if ($model->montoapertura && is_null($model->montocierre) ) {
            $arqueo_anterior = Arqueo::find()->select(['username', 'efectivocierre'])->orderBy(['id' => SORT_DESC])->one();
            if ($arqueo_anterior->efectivocierre != $model->montoapertura) {
                Yii::$app->getSession()->addFlash('danger', 'Contacta a tu superior, existe una diferencia entre tu apertura y el cierre anterior ' . $model->username .
                    ' por un monto de :$ ' . abs($model->montoapertura - $arqueo_anterior->efectivocierre) );
            }
        }

        return $this->render('view', [
            'model' => $model,
            'monedas' => $this->monedas,
        ]);
    }

    /**
     * Deletes an existing Conteodiario model.
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
     * Finds the Conteodiario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Conteodiario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Conteodiario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
