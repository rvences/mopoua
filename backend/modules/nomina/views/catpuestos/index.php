<?php
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\nomina\models\search\CatpuestosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catálogo de Puestos';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="grid-index">
            <?=GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => require(__DIR__.'/_columns.php'),
                'toolbar'=> [
                    ['content'=>
                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                            ['role'=>'modal-remote','title'=> 'Nuevo Puesto','class'=>'btn btn-default']).
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                            ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                        '{toggleData}'.
                        '{export}'
                    ],
                ],
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panel' => [
                    'type' => 'primary',
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Catálogo de Puestos',
                    'before'=>'<em>* Ajusta el tamaño de las columnas como una hoja de cálculo, moviendo las esquinas.</em>',

                ]
            ])?>
    </div>