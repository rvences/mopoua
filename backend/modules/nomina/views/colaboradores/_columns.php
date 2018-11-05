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
    //[
        //'class'=>'\kartik\grid\DataColumn',
        //'attribute'=>'clave',
    //],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'bcolaborador_nombre',
    ],
    //[
        //'class'=>'\kartik\grid\DataColumn',
        //'attribute'=>'rfc',
    //],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'curp',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nss',
    // ],
    [
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,

        'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\Catpuestos::find()->select(['id', 'puesto'])->asArray()->orderBy('puesto')->all(), 'id', 'puesto'),
        'filterInputOptions' => ['placeholder' => 'Puesto'],
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'puesto_id',
        'value' => 'puesto.puesto',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fingreso',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fbaja',
    // ],
     [
         'filterType' => \kartik\grid\GridView::FILTER_SELECT2,

         'filter' => array(1 => 'Activo', 0 => 'Inactivo'),
         'filterInputOptions' => ['placeholder' => 'Estado'],
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'activo',
         'value' => function ($model) {
            if ($model->activo == 1) {
                return 'Activo';
            } else { return 'Inactivo'; }
         }

     ],

     [
         'filterType' => \kartik\grid\GridView::FILTER_SELECT2,

         'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\TemporalidadPago::find()->asArray()->orderBy('temporalidad')->all(), 'id', 'temporalidad'),
         'filterInputOptions' => ['placeholder' => 'Temporalidad'],
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'temporalidad_pago_id',
         'value' => 'temporalidadPago.temporalidad'
     ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   