<?php
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
            return $model->userRealizo->nombrecompleto;

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
