<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'de',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hasta',
    ],
    //[
        //'class'=>'\kartik\grid\DataColumn',
        //'attribute'=>'total_dias',
    //],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    //[
        //'class'=>'\kartik\grid\DataColumn',
        //'attribute'=>'created_by',
    //],
    //[
        //'class'=>'\kartik\grid\DataColumn',
        //'attribute'=>'updated_by',
    //],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'fecha_pago',
     ],
     [
         'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
         'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\TemporalidadPago::find()->asArray()->orderBy('temporalidad')->all(), 'id', 'temporalidad'),
         'filterInputOptions' => ['placeholder' => 'Temporalidad pago'],
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'temporalidad_pago_id',
         'value' => function ($model) {
            return $model->temporalidadPago->temporalidad;
         }
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'estado_proceso',
        'value' => function($model) {
            return $model->getEstados($model->estado_proceso);
        }
    ],
    [

        'class' => 'kartik\grid\ActionColumn',
        'template' => '{update}',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Actualizar', 'data-toggle'=>'tooltip'],
    ],

];   