<?php

use yii\helpers\Html;
use kartik\growl;

/* @var $searchModel backend\modules\caja\models\search\ConteonotasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $modelingresoegreso \backend\modules\caja\models\Tipoingresoegreso */

$this->title = 'Catálogo de Movimientos para la Caja';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoingresoegreso-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Este catálogo debe de contener todos los tipos de ingresis y egresos que no sean nombres de proveedores;
        <br>Se pueden considerar proveedores exclusivamente de Servicios ( agua, luz, telefono, etc)</p>

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
            'attribute' => 'tipo',
            //'filterInputOptions'=>['placeholder'=>'Filtrar por ...'],

            'editableOptions' => function () {
                return [
                    'asPopover' =>false,
                    'options' => [
                        'style'=>'width:400px',
                    ]
                ];
            },
            'value'=>function ($model) {
                return $model->tipo;

            },
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'descripcion',
            //'filterInputOptions'=>['placeholder'=>'Filtrar por ...'],

            'editableOptions' => function () {
                return [
                    'asPopover' =>false,
                    'options' => [
                        'style'=>'width:400px',
                    ]
                ];
            },
            'value'=>function ($model) {
                return $model->descripcion;

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
            'model' => $modelingresoegreso,
        ]) ?>
    </div>
</div>














<?php
/*
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\caja\models\search\TipoingresoegresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/*
$this->title = 'Tipoingresoegresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoingresoegreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipoingresoegreso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tipo',
            'descripcion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
*/?>