<?php
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\modules\productividad\models\Prodcatalogos;

/**
 * Created by PhpStorm.
 * User: rvences
 * Date: 11/06/17
 * Time: 10:31 PM
 */

return [



    [
        'attribute' => 'tarea',
    ],
    [
        'attribute' => 'resultado',
    ],
    [
        //'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'user_realizo_id',
        //'filterInputOptions'=>['placeholder'=>'Filtrar por ...'],
        'value'=>function ($model) {
            return $model->userRealizo->username;

        },
    ],
    [
        'attribute' => 'tipoactividad_id',
        'value' => function ($model) {
            return $model->tipoactividad->descripcion;
        }
    ],

    [
        'attribute' => 'modified',
        'format' => ['date', 'php:D d M Y'],
    ],
    [
        'attribute' => 'fecha_limite',
        'format' => ['date', 'php:D d M Y'],
    ],

];
