<?php

namespace backend\modules\nomina\controllers;

use Yii;
use backend\modules\nomina\models\Cattipopd;
use backend\modules\nomina\models\search\CattipopdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CattipopdController implements the CRUD actions for Cattipopd model.
 */
class CattipopdController extends Controller
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
     * Lists all Cattipopd models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelpd = new Cattipopd();
        if ($modelpd->load(Yii::$app->request->post()) && $modelpd->save()) {
            \Yii::$app->getSession()->setFlash('crear', $modelpd->descripcion);
            return $this->redirect(['index']);
        }

        $searchModel = new CattipopdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_POST['hasEditable'])) {

            $id = Yii::$app->request->post('editableKey');

            $modelo = $this->findModel($id);
            // Usando el formato de respuesta de Yii  para codificar la salida como JSON
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $actual = current($_POST['Cattipopd']);
            $post['Cattipopd'] = $_POST['Cattipopd'][$_POST['editableIndex']];

            if ($modelo->load($post)) {
                $modelo->save();
                $output = '';
                if (isset($actual['clave'])) {
                    $output = Yii::$app->formatter->asText($modelo->clave);
                }
                if (isset($actual['concepto'])) {
                    $output = Yii::$app->formatter->asText($modelo->concepto);
                }
                if (isset($actual['tipo'])) {
                    $output = Yii::$app->formatter->asText($modelo->tipo);
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
            'modelpd' => $modelpd,
        ]);
    }

    /**
     * Deletes an existing Cattipopd model.
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
     * Finds the Cattipopd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cattipopd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cattipopd::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
