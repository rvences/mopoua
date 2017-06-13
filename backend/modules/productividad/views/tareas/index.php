<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;


use kartik\growl;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\productividad\models\search\TareasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tareas';
$this->params['breadcrumbs'][] = $this->title;
?>

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


<div class="tareas-index">

    <div class="row">
        <p class="col-sm-6"><?= Html::a('Nueva Tarea', ['create'], ['class' => 'btn btn-success']) ?></p>





        <p class="col-sm-2"><?= Html::a('Hoy', ['index'], ['class' => 'btn btn-warning']) ?></p>
        <p class="col-sm-2"><?= Html::a('Ult. 24 hrs', ['index', 'historia' => '24hrs'], ['class' => 'btn btn-warning']) ?></p>
        <p class="col-sm-2"><?= Html::a('Semana Pasada', ['index', 'historia' => 'semana'], ['class' => 'btn btn-warning']) ?></p>

    </div>

        <?php

        if (isset($_GET['historia']) ) {
            echo \kartik\grid\GridView::widget([
                'export' => false,
                'dataProvider'=>$dataProvider,
                'filterModel'=>$searchModel,
                'columns'=> require(__DIR__.'/_columns2.php'),

                'rowOptions' => function ($model){
                    if ($model->fecha_limite < $model->modified ) {
                        return ['class' => 'atrasado'];
                    } else {
                        return [ ];
                    }
                },
            ]);

        } else {
            echo \kartik\grid\GridView::widget([
                'export' => false,
                'dataProvider'=>$dataProvider,
                'filterModel'=>$searchModel,
                'columns'=> require(__DIR__.'/_columns.php'),

                'rowOptions' => function ($model){
                    if ($model->fecha_limite < date('Y-m-d', time()) ) {
                        return ['class' => 'atrasado'];
                    } else {
                        return [ ];
                    }
                },
            ]);

        }



        ?>




<?php
/*
$content2 = 'crayola';
$content3 = 'como estas';
$content4 = 'dsfgdfg';
$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-home"></i> Home',
        'content'=>$content1,
        'active'=>true
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> Profile',
        'content'=>$content2,

    ],
    [
        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
        'items'=>[
            [
                'label'=>'Option 1',
                'encode'=>false,
                'content'=>$content3,
            ],
            [
                'label'=>'Option 2',
                'encode'=>false,
                'content'=>$content4,
            ],
        ],
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-king"></i> Disabled',
        'headerOptions' => ['class'=>'disabled']
    ],
];


use kartik\tabs\TabsX;

// Left
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_LEFT,
    'encodeLabels'=>false
]);
*/