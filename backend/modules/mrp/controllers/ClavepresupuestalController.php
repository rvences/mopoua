<?php

namespace backend\modules\mrp\controllers;

use Yii;
use backend\modules\mrp\models\Clavepresupuestal;
use backend\modules\mrp\models\search\ClavepresupuestalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClavepresupuestalController implements the CRUD actions for Clavepresupuestal model.
 */
class ClavepresupuestalController extends Controller
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
     * Lists all Clavepresupuestal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelclave = new Clavepresupuestal();

        if ($modelclave->load(Yii::$app->request->post()) && $modelclave->save()) {
            \Yii::$app->getSession()->setFlash('crear', $modelclave->clavepresupuestal);
            return $this->redirect(['index']);
        }


        $searchModel = new ClavepresupuestalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_POST['hasEditable'])) {

            $id = Yii::$app->request->post('editableKey');

            $modelo = $this->findModel($id);
            // Usando el formato de respuesta de Yii  para codificar la salida como JSON
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $actual = current($_POST['Clavepresupuestal']);
            $post['Clavepresupuestal'] = $_POST['Clavepresupuestal'][$_POST['editableIndex']];

            if ($modelo->load($post)) {
                $modelo->save();
                $output = '';
                if (isset($actual['clavepresupuestal'])) {
                    $output = Yii::$app->formatter->asText($modelo->clavepresupuestal);
                }
                if (isset($actual['descripcion'])) {
                    $output = Yii::$app->formatter->asText($modelo->descripcion);
                }

                return['output'=>$output, 'message'=>''];
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelclave' => $modelclave,
        ]);
    }

    /**
     * Deletes an existing Clavepresupuestal model.
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
     * Finds the Clavepresupuestal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clavepresupuestal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clavepresupuestal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
