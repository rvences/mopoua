<?php

namespace backend\modules\mrp\controllers;

use backend\modules\mrp\models\Presentacion;
use Yii;
use backend\modules\mrp\models\Insumo;
use backend\modules\mrp\models\Model;
use backend\modules\mrp\models\search\InsumoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

/**
 * InsumoController implements the CRUD actions for Insumo model.
 */
class InsumoController extends Controller
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
     * Lists all Insumo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsumoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Insumo model.
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
     * Creates a new Insumo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Insumo();
        $modelsPresentacion = [new Presentacion()];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelsPresentacion = Model::createMultiple(Presentacion::className());
            Model::loadMultiple($modelsPresentacion, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPresentacion) && $valid;

            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPresentacion as $modelPresentacion) {
                            $modelPresentacion->insumo_id = $model->id;
                            if (! ($flag = $modelPresentacion->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsPresentacion' => (empty($modelsPresentacion)) ? [new Presentacion()] : $modelsPresentacion
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Insumo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsPresentacion = $model->presentacions;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelsPresentacion, 'id', 'id');
            $modelsPresentacion = Model::createMultiple(Presentacion::className(), $modelsPresentacion);
            Model::loadMultiple($modelsPresentacion, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPresentacion, 'id', 'id')));


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPresentacion) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Presentacion::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPresentacion as $modelPresentacion) {
                            $modelPresentacion->insumo_id = $model->id;
                            if (! ($flag = $modelPresentacion->save(false))) {
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
                'modelsPresentacion' => (empty($modelsPresentacion)) ? [new Presentacion()] : $modelsPresentacion
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Insumo model.
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
     * Finds the Insumo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Insumo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Insumo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
