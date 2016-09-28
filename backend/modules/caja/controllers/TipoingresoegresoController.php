<?php

namespace backend\modules\caja\controllers;

use Yii;
use backend\modules\caja\models\Tipoingresoegreso;
use backend\modules\caja\models\search\TipoingresoegresoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipoingresoegresoController implements the CRUD actions for Tipoingresoegreso model.
 */
class TipoingresoegresoController extends Controller
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
     * Lists all Tipoingresoegreso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelingresoegreso = new Tipoingresoegreso();

        if ($modelingresoegreso->load(Yii::$app->request->post()) && $modelingresoegreso->save()) {
            \Yii::$app->getSession()->setFlash('crear', $modelingresoegreso->descripcion);
            return $this->redirect(['index']);
        }


        $searchModel = new TipoingresoegresoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_POST['hasEditable'])) {

            $id = Yii::$app->request->post('editableKey');

            $modelo = $this->findModel($id);
            // Usando el formato de respuesta de Yii  para codificar la salida como JSON
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $actual = current($_POST['Tipoingresoegreso']);
            $post['Tipoingresoegreso'] = $_POST['Tipoingresoegreso'][$_POST['editableIndex']];

            if ($modelo->load($post)) {
                $modelo->save();
                $output = '';
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
            'modelingresoegreso' => $modelingresoegreso,
        ]);















        /*
        $searchModel = new TipoingresoegresoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        */
    }

    /**
     * Displays a single Tipoingresoegreso model.
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
     * Creates a new Tipoingresoegreso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tipoingresoegreso();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tipoingresoegreso model.
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
     * Deletes an existing Tipoingresoegreso model.
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
     * Finds the Tipoingresoegreso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tipoingresoegreso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tipoingresoegreso::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
