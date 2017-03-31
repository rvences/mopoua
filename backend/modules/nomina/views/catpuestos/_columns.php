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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'puesto',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tipo_colaborador',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'plazas',
    ],

    [
        'class'=>'\kartik\grid\ExpandRowColumn',
        'attribute'=>'id',
        'value'=>function () {
            return kartik\grid\GridView::ROW_COLLAPSED;
        },
        'detailUrl'=>Url::to(['/nomina/catpuestos/view'])
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        //'template' => '{view} &nbsp;&nbsp; {update} &nbsp;&nbsp; {delete}',
        'template' => '{update} &nbsp;&nbsp; {delete}',
        'width'=>'25px',
    ],
];