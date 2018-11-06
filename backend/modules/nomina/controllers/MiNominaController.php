<?php

namespace backend\modules\nomina\controllers;

use backend\modules\nomina\models\FechasPago;
use backend\modules\nomina\models\NominaGlosa;
use Yii;
use backend\modules\nomina\models\Nomina;
use backend\modules\nomina\models\search\NominaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MiNominaController implements the CRUD actions for Nomina model.
 */
class MiNominaController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Nomina models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Nomina();

        $colaborador = Yii::$app->user->identity->colaborador_id;

        if ($model->load(Yii::$app->request->post())) {
            $nominaGlosa = NominaGlosa::find()
                ->where(['fechas_pago_id' => $model->fecha_pago_id])
                ->andWhere(['colaborador_id' => $colaborador])
                ->asArray()->all();

            $nomina = Nomina::find()
                ->where(['fecha_pago_id' => $model->fecha_pago_id])
                ->andWhere(['colaborador_id' => $colaborador])
                ->asArray()->one();

            return $this->render('index', [
                'model' => $model,
                'nomina' => $nomina,
                'nominaGlosa' => $nominaGlosa
             ]);

        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
        /*
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/





        /*

        $model = new FechasPago();







        //print_r($valor);


/*
        $dato = Nomina::find()->where(['colaborador_id' => 12])->all();



        $subQuery = BaseFollower::find()->select('id');
        $query = BaseTwitter::find()->where(['not in', 'id', $subQuery]);
        $models = $query->all();


*/

/*
        $searchModel = new NominaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'valor' => $valor,

        ]);
*/
    }

    /**
     * Displays a single Nomina model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Nomina model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nomina();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Nomina model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Nomina model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Nomina model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nomina the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nomina::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
