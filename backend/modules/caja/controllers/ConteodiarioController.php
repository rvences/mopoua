<?php

namespace backend\modules\caja\controllers;

use Yii;
use backend\modules\caja\models\Conteodiario;
//use backend\modules\caja\models\search\ConteodiarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConteodiarioController implements the CRUD actions for Conteodiario model.
 */
class ConteodiarioController extends Controller
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

    public function actionIndex()
    {
        $monedas = array('moneda1'=>'0.10', 'moneda2'=>'0.20', 'moneda3'=>'0.50', 'moneda4'=>'1', 'moneda5'=>'2', 'moneda6'=>'5', 'moneda7'=>'10', 'moneda8'=>'20',
            'moneda9'=>'50', 'moneda10'=>'100', 'moneda11'=>'20', 'moneda12'=>'50', 'moneda13'=>'100', 'moneda14'=>'200', 'moneda15'=>'500', 'moneda16'=>'1000'

        );
        // Verifica que Modelo mostrar, el de apertura o el de cierre

        $model = Conteodiario::findOne(['username'=> Yii::$app->user->identity->username, 'arqueo_id' => null]);
        if ($model) {
            if ( ($model->load(Yii::$app->request->post()) && $model->save()) || $model->montocierre ) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('cierre', [
                    'model' => $model,
                    'monedas' => $monedas,
                ]);
            }
        } else {
            $model = new Conteodiario();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('apertura', [
                    'model' => $model,
                    'monedas' => $monedas,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Conteodiario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Conteodiario();

        $monedas = array('moneda1'=>'0.10', 'moneda2'=>'0.20', 'moneda3'=>'0.50', 'moneda4'=>'1', 'moneda5'=>'2', 'moneda6'=>'5', 'moneda7'=>'10', 'moneda8'=>'20',
                        'moneda9'=>'50', 'moneda10'=>'100', 'moneda11'=>'20', 'moneda12'=>'50', 'moneda13'=>'100', 'moneda14'=>'200', 'moneda15'=>'500', 'moneda16'=>'1000'

        );

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Agregando el usuario que hizo la apertura
            //$model->username = Yii::$app->user->identity->username ;



            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'monedas' => $monedas,
            ]);
        }
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
