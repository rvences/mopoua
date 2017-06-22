<?php
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use backend\modules\productividad\models\Prodcatalogos;

/**
 * Created by PhpStorm.
 * User: rvences
 * Date: 11/06/17
 * Time: 10:31 PM
 */

return [
    [

        'width'=>'25px',
        'label' => 'Acciones',
        'content' => function ($model) {
            $val = '';
            // Si ya se realizo NO se puede modificar ni borrar
            if ( $model->estado_id != Prodcatalogos::getEstadoFinalizado()){

                // Si yo lo cree, lo puedo borrar
                if ($model->user_solicita_id == Yii::$app->user->identity->colaborador_id) {
                    $val .= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], ['data-method'=> 'post']) . ' &nbsp;&nbsp; ';
                } else { $val .= ' &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; ' ;}

                // Si yo lo cree o lo tengo asignado lo puedo modificar
                if ( ($model->asignado_id == Yii::$app->user->identity->colaborador_id) || ($model->user_solicita_id == Yii::$app->user->identity->colaborador_id) ){
                    $val .= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id]) . ' &nbsp;&nbsp; ';
                } else { $val .= ' &nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;' ;}
            }
            return $val;
        }],

    [
        'attribute' => 'tipoactividad_id',

        'value' => function ($model) {
            return $model->tipoactividad->descripcion;
        },

        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Prodcatalogos::getTipoactividadActivo(), 'id', 'descripcion'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Actividad'],

    ],
    [
        'attribute' => 'tarea',
    ],

    [
        /*
        'value'=>function ($model) {
            return $model->estado0->descripcion;
        },*/
        'editableOptions' => function () {
            return [
                'asPopover' =>false,
            ];
        },
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'resultado',
    ],
    [
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=> \backend\modules\mrp\models\Unidadmedida::arreglotipounidad() ,
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Unidad'],

        'attribute' => 'fecha_limite',
        'format' => ['date', 'php:D d M Y'],
    ],
    [
        //'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'asignado_id',
        //'filterInputOptions'=>['placeholder'=>'Filtrar por ...'],
        'value'=>function ($model) {
            return $model->asignado->nombrecompleto;

        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(\backend\modules\nomina\models\Colaboradores::listUserActive(), 'id', 'nombrecompleto'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Responsable'],

    ],

];
