<?php

use yii\helpers\Html;
use kartik\growl;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\nomina\models\search\CattipopdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catálogo de Percepciones y Deducciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cattipopd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
            'attribute' => 'clave',

            'value'=>function ($model) {
                return $model->clave;

            },
        ],

        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'tipo',
            'width'=>'12em',
            'value'=>function ($model) {
                return $model->tipo;
            },

            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=> \backend\modules\nomina\models\Cattipopd::gettipopd() ,
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Tipo'],
            'editableOptions' => function () {
                return [
                    'size' => 'md',
                    'inputType' => \kartik\editable\Editable::INPUT_SELECT2,
                    'options' => [
                        'data' => \backend\modules\nomina\models\Cattipopd::gettipopd() ,
                    ],
                ];
            }
        ],

        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'descripcion',
            'editableOptions' => function () {
                return [
                    'asPopover' =>false,
                    'options' => [
                        'style'=>'width:200px',
                    ]
                ];
            },
            'value'=>function ($model) {
                return $model->descripcion;

            },
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'concepto',
            'editableOptions' => function () {
                return [
                    'asPopover' =>false,
                    'options' => [
                        'style'=>'width:200px',
                    ]
                ];
            },
            'value'=>function ($model) {
                return $model->concepto;

            },
        ],
/*


        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'tipo_unidad',
            'width'=>'12em',
            'value'=>function ($model) {
                return $model->tipo_unidad;
            },

            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=> \backend\modules\mrp\models\Unidadmedida::arreglotipounidad() ,
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Unidad'],
            'editableOptions' => function () {
                return [
                    'size' => 'md',
                    'inputType' => \kartik\editable\Editable::INPUT_SELECT2,
                    'options' => [
                        'data' => \backend\modules\mrp\models\Unidadmedida::arreglotipounidad() ,
                    ],
                ];
            }
        ],*/
    ];


    echo \kartik\grid\GridView::widget([
        'export' => false,
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns
    ]);
    ?>

    <div class="cattipopd-create">
        <?= $this->render('_form', [
            'modelpd' => $modelpd,
        ]) ?>

    </div>

</div>
