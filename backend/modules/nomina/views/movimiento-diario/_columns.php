<?php
use yii\helpers\Url;
use yii\db\Expression;

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

        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\Colaboradores::find()
            ->select(['colaboradores.id',
                        'bcolaborador' =>  new Expression('CONCAT_WS(" ", nombre, apaterno, amaterno)')])

            ->asArray()->orderBy('bcolaborador')->all(), 'id', 'bcolaborador'),
        'filterInputOptions' => ['placeholder' => 'Nombre'],
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'colaborador_id',
        'value' => function ($model) {
            return $model->colaborador->nombre . ' ' . $model->colaborador->apaterno . ' ' . $model->colaborador->amaterno;
        }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'movimiento_fecha',
    ],


    [
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\CatMovimientosNomina::find()->asArray()->orderBy('movimiento')->all(), 'id', 'movimiento'),
        'filterInputOptions' => ['placeholder' => 'Movimiento'],
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'movimiento_nomina_id',
        'value' => function ($model) {
            return $model->movimientoNomina->movimiento;
        }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'movimiento_nomina_info',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'monto',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'aplicado_en_nomina',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nomina_glosa_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
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