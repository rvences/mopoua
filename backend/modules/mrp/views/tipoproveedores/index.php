<?php

use yii\helpers\Html;
use kartik\growl;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\mrp\models\search\TipoproveedoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $modelproveedor backend\modules\mrp\models\Tipoproveedores */

$this->title = 'Catálogo de Tipo de Proveedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoproveedores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Este catálogo debe de contener todos los tipos de proveedores que se pueden tener sean para un mismo o diferente tipo de insumo;
        <br>NO importa si el insumo es inventariable o No.
        <br>Solo se consideran proveedores de productos NO de Servicios ( se excluye luz, telefono, etc)</p>

    <?php if (Yii::$app->session->getFlash('borrar')) {
        echo growl\Growl::widget([
            'type' => growl\Growl::TYPE_DANGER,
            'title' => 'Registro Eliminado',
            'icon' => 'glyphicon glyphicon-remove-sign',
            'body' => 'Se elimino correctamente ' . Yii::$app->session->getFlash('borrar'),
            'showSeparator' => true,
            'delay' => 0,
            'pluginOptions' => [
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ]
        ]);
    } else if (Yii::$app->session->getFlash('crear')) {
        echo growl\Growl::widget([
            'type' => growl\Growl::TYPE_SUCCESS,
            'title' => 'Registro Creado',
            'icon' => 'glyphicon glyphicon-ok-sign',
            'body' => 'Se agrego correctamente ' . Yii::$app->session->getFlash('crear'),
            'showSeparator' => true,
            'delay' => 0,
            'pluginOptions' => [
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ]
        ]);
    } ?>
    <?php
    $gridColumns = [
        [
            'width'=>'25px', // 'width'=>'1%',
            'class'=>'kartik\grid\SerialColumn',
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{delete}',
            'width'=>'25px',
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'tipoproveedor',
            'filterInputOptions'=>['placeholder'=>'Tipo de Proveedor'],

            'editableOptions' => function () {
                return [
                    'asPopover' =>false,
                    'options' => [
                        'style'=>'width:400px',
                    ]
                ];
            },
            'value'=>function ($model) {
                return $model->tipoproveedor;

            },
        ],
    ];

    echo \kartik\grid\GridView::widget([
        'export' => false,
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns
    ]);
    ?>

    <div class="tipoproveedores-create">

        <?= $this->render('_form', [
            'model' => $modelproveedor,
        ]) ?>
    </div>
</div>
