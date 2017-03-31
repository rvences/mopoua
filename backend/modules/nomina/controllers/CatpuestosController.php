<?php

namespace backend\modules\nomina\controllers;

use Yii;
use backend\modules\nomina\models\Catpuestos;
use backend\modules\nomina\models\search\CatpuestosSearch;
//use backend\modules\nomina\models\Nompercepciondeduccion;
use backend\modules\nomina\models\Nompercepciondeduccion;
use backend\modules\mrp\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * CatpuestosController implements the CRUD actions for Catpuestos model.
 */
class CatpuestosController extends Controller
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
     * Lists all Catpuestos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatpuestosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catpuestos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {

        $id = (isset($_POST['expandRowKey'])) ? $_POST['expandRowKey'] : $_GET['id'];
        $model = $this->findModel($id);
        return $this->renderPartial('/nompercepciondeduccion/index', [
            'dataProvider' => new ActiveDataProvider(['query' => $model->getNompercepciondeduccions(),]),
        ]);

        /*
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        */
    }

    /**
     * Creates a new Catpuestos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Catpuestos();
        $modelstipopd = [new Nompercepciondeduccion()];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelstipopd = Model::createMultiple(Nompercepciondeduccion::className());
            Model::loadMultiple($modelstipopd, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelstipopd) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelstipopd as $modeltipopd) {
                            $modeltipopd->puesto_id = $model->id;
                            if (! ($flag = $modeltipopd->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }


            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelstipopd' =>( empty($modelstipopd)) ? [new Nompercepciondeduccion()] : $modelstipopd

            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Catpuestos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelstipopd = $model->nompercepciondeduccions;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelstipopd, 'id', 'id');
            $modelstipopd = Model::createMultiple(Nompercepciondeduccion::className(), $modelstipopd);
            Model::loadMultiple($modelstipopd, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelstipopd, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelstipopd) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Nompercepciondeduccion::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelstipopd as $modeltipopd) {
                            $modeltipopd->puesto_id = $model->id;
                            if (! ($flag = $modeltipopd->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                        //return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelstipopd' => (empty($modelstipopd)) ? [new Nompercepciondeduccion()] : $modelstipopd
            ]);
        }
        return $this->redirect(['index']);
        /*
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Deletes an existing Catpuestos model.
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
     * Finds the Catpuestos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catpuestos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catpuestos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
