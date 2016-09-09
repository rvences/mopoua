<?php

namespace backend\modules\mrp\controllers;

use Yii;
use backend\modules\mrp\models\Unidadmedida;
use backend\modules\mrp\models\search\UnidadmedidaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UnidadmedidaController implements the CRUD actions for Unidadmedida model.
 */
class UnidadmedidaController extends Controller
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
     * Lists all Unidadmedida models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelunidad = new Unidadmedida();
        if ($modelunidad->load(Yii::$app->request->post()) && $modelunidad->save()) {
            \Yii::$app->getSession()->setFlash('crear', $modelunidad->descripcion);
            return $this->redirect(['index']);
        }

        $searchModel = new UnidadmedidaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_POST['hasEditable'])) {

            $id = Yii::$app->request->post('editableKey');

            $modelo = $this->findModel($id);
            // Usando el formato de respuesta de Yii  para codificar la salida como JSON
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $actual = current($_POST['Unidadmedida']);
            $post['Unidadmedida'] = $_POST['Unidadmedida'][$_POST['editableIndex']];

            if ($modelo->load($post)) {
                $modelo->save();
                $output = '';
                if (isset($actual['unidad'])) {
                    $output = Yii::$app->formatter->asText($modelo->unidad);
                }
                if (isset($actual['descripcion'])) {
                    $output = Yii::$app->formatter->asText($modelo->descripcion);
                }
                if (isset($actual['tipo_unidad'])) {
                    $output = Yii::$app->formatter->asText($modelo->tipo_unidad);
                }

                return['output'=>$output, 'message'=>''];
            }
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelunidad' => $modelunidad,
        ]);
    }

    /**
     * Deletes an existing Unidadmedida model.
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
     * Finds the Unidadmedida model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Unidadmedida the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Unidadmedida::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
