<?php

use yii\helpers\Html;
use kartik\growl;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\nomina\models\search\FechasPagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calendario de Pagos de Personal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fechas-pago-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (Yii::$app->session->getFlash('crear')) {
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
            'attribute' => 'Del día',
            'value'=>function ($model) {
                return $model->de;
            },
        ],
        [
            'attribute' => 'Hasta el día',
            'value'=>function ($model) {
                return $model->hasta;
            },
        ],
        [
            'attribute' => 'Días en el periodo',
            'value'=>function ($model) {
                return $model->total_dias;
            },
        ],
        [
            'attribute' => 'Pagada el día',
            'value'=>function ($model) {
                return ( $model->fecha_pago ? $model->fecha_pago : 'Sin Procesar');
            },
        ],

        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{procesar}',
            'width'=>'25px',

            'buttons' => [
                'procesar' => function ($url, $model) {
                    return  Html::a('Procesar Nómina', ['procesar', 'id' => 4], ['class' => 'profile-link']) ;
                }
            ],


        ],

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
            'modelfp' => $modelfp,
        ]) ?>

    </div>







</div>
