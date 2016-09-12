<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\mrp\models\search\InsumoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insumo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Nuevo Insumo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php
    $gridColumns = [

        [
            // Lista la cantidad de columnas
            'class'=>'kartik\grid\SerialColumn',
            'width'=>'25px', // 'width'=>'1%',
        ],

        [
            'class' => 'kartik\grid\ActionColumn',
            //'template' => '{view} &nbsp;&nbsp; {update} &nbsp;&nbsp; {delete}',
            'template' => '{update} &nbsp;&nbsp; {delete}',
            'width'=>'25px',
        ],

        // Volviendo Colapsable
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'value' => function () {
                return GridView::ROW_COLLAPSED;
            },
            'expandOneOnly' =>true,
            'detail' => function ($modelo) {
                $searchModel = new \backend\modules\mrp\models\search\PresentacionSearch();
                $searchModel->insumo_id = $modelo->id;
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                return Yii::$app->controller->renderPartial('_presentacion-details', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            },
        ],

        [
            'attribute' => 'clavepresupuestal',
            'width'=>'140px', // 'width'=>'7%',
            'value'=>function ($model) {
                return $model->clavepresupuestal->clavepresupuestal;
            },
        ],

        // Haciendo el campo de Cuenta editable
        [
            'attribute'=>'insumo_generico',
            'label' => 'Insumo Genérico',
            'width'=>'140px', // 'width'=>'7%',
        ],

        [
            'attribute' => 'unidad_id',
            'width'=>'140px', // 'width'=>'7%',
            'value'=>function ($model) {
                return $model->unidad->descripcion;
            },
        ],



    ];

?>
    <?= GridView::widget([
        'export' => false,
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'columns' => $gridColumns,
        'responsive'=>true,
        'pjax' => true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],



        'hover'=>true
    ]); ?>


    <?php /*
    <p>
        <?= Html::a('Create Insumo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clavepresupuestal_id',
            'insumo_generico',
            'unidad_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
 */ ?>
</div>
