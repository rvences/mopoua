<?php

use yii\helpers\Html;
use kartik\growl;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\mrp\models\search\ClavepresupuestalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $modelclave backend\modules\mrp\models\Clavepresupuestal */

$this->title = 'Catálogo de Claves Presupuestales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clavepresupuestal-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'attribute' => 'clavepresupuestal',
            //'filterInputOptions'=>['placeholder'=>'Filtrar por clave'],
            'value'=>function ($model) {
                return $model->clavepresupuestal;
            },
            'editableOptions' => function () {
                return [
                    'asPopover' =>false,
                    'options' => [
                        'style'=>'width:250px',
                    ]
                ];
            },
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'descripcion',
            'value'=>function ($model) {
                return $model->descripcion;
            },
            'editableOptions' => function () {
                return [
                    'size' => 'md',     // http://demos.krajee.com/popover-x#settings
                    'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA, // http://demos.krajee.com/editable
                    'asPopover' =>false,
                    'options' => [
                        'style'=>'width:400px',
                    ]

                ];
            }
        ],
    ];

    echo \kartik\grid\GridView::widget([
        'export' => false,
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns
    ]);
    ?>

</div>


<div class="clavepresupuestal-create">

    <?= $this->render('_form', [
        'modelclave' => $modelclave,
    ]) ?>
</div>

