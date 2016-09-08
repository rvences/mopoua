<?php

namespace backend\modules\mrp\controllers;

use Yii;
use backend\modules\mrp\models\Tipoproveedores;
use backend\modules\mrp\models\search\TipoproveedoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipoproveedoresController implements the CRUD actions for Tipoproveedores model.
 */
class TipoproveedoresController extends Controller
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
     * Lists all Tipoproveedores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelproveedor = new Tipoproveedores();

        if ($modelproveedor->load(Yii::$app->request->post()) && $modelproveedor->save()) {
            \Yii::$app->getSession()->setFlash('crear', $modelproveedor->tipoproveedor);
            return $this->redirect(['index']);
        }


        $searchModel = new TipoproveedoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_POST['hasEditable'])) {

            $id = Yii::$app->request->post('editableKey');

            $modelo = $this->findModel($id);
            // Usando el formato de respuesta de Yii  para codificar la salida como JSON
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $actual = current($_POST['Tipoproveedores']);
            $post['Tipoproveedores'] = $_POST['Tipoproveedores'][$_POST['editableIndex']];

            if ($modelo->load($post)) {
                $modelo->save();
                $output = '';
                if (isset($actual['tipoproveedor'])) {
                    $output = Yii::$app->formatter->asText($modelo->tipoproveedor);
                }

                return['output'=>$output, 'message'=>''];
            }
        }



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelproveedor' => $modelproveedor,
        ]);
    }

    /**
     * Deletes an existing Tipoproveedores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        \Yii::$app->getSession()->setFlash('borrar', $this->findModel($id)->tipoproveedor);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tipoproveedores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tipoproveedores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tipoproveedores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
