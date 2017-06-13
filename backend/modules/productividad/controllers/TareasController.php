<?php

namespace backend\modules\productividad\controllers;

use backend\modules\productividad\models\Prodcatalogos;
use Yii;
use backend\modules\productividad\models\Tareas;
use backend\modules\productividad\models\search\TareasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TareasController implements the CRUD actions for Tareas model.
 */
class TareasController extends Controller
{
    public $identificador;
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
     * Lists all Tareas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TareasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_GET['historia'])) {
            switch ($_GET['historia']) {
                case 'semana':
                    $dataProvider->query->where('modified > ' . date('Y-m-d', strtotime('-7 day')));
                    $dataProvider->query->where('estado_id =' . Prodcatalogos::getEstadoFinalizado());
                    break;
                case '24hrs':
                    $dataProvider->query->where('modified > ' . date('Y-m-d', strtotime('-1 day')));
                    $dataProvider->query->where('estado_id =' . Prodcatalogos::getEstadoFinalizado());
                    break;
                default:
                    $dataProvider->query->where('estado_id <> ' . Prodcatalogos::getEstadoFinalizado());

                break;

            }

        } else {
            $dataProvider->query->where('estado_id <> ' . Prodcatalogos::getEstadoFinalizado());
        }

//        $dataProvider->query->where('estado <> ' . Prodcatalogos::getEstadoFinalizado());

        if (isset($_POST['hasEditable'])) {

            $id = Yii::$app->request->post('editableKey');

            $modelo = $this->findModel($id);
            // Usando el formato de respuesta de Yii  para codificar la salida como JSON
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $actual = current($_POST['Tareas']);
            $post['Tareas'] = $_POST['Tareas'][$_POST['editableIndex']];

            if ($modelo->load($post)) {
                $modelo->save();
                $output = '';
                if (isset($actual['estado'])) {
                    $output = Yii::$app->formatter->asText($modelo->estado);
                }

                return['output'=>$output, 'message'=>''];
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'identificador' => '',
        ]);
    }

    /**
     * Displays a single Tareas model.
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
     * Creates a new Tareas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tareas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);

//            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tareas model.
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
     * Deletes an existing Tareas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        \Yii::$app->getSession()->setFlash('borrar', $this->findModel($id)->tarea);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tareas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tareas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tareas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
