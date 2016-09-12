<?php

//use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="contactos-index">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            /* Agregar imagen
             'label'=>'Image',
	            'format'=>'raw',
	            'value' => function($data){
	                $url = "http://127.0.0.1/yii2/logo.png";
	                return Html::img($url,['alt'=>'yii']);
	            }
             */
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=> 'insumo',
                'contentOptions' => ['width'=>'200px'],
            ],
            [
                'attribute'=> 'marca',
                'contentOptions' => ['width'=>'200px'],
            ],
            [
                'attribute'=> 'presentacion',
                'contentOptions' => ['width'=>'200px'],
            ],

            /*

        // Haciendo el campo de Sector editable
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'sector_id',
            'width'=>'100px', // 'width'=>'5%',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->sector->sector;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>\yii\helpers\ArrayHelper::map(\backend\models\Sector::find()->asArray()->orderBy('sector')->all(), 'sectorid', 'sector'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Sector'],

            'editableOptions' => function ($model, $key, $index, $widget) {
                return [
                    'formOptions'=>['action'=>Url::to(['cuentas/change','id'=>$model->cuentasid])],
                    'header' => 'Sector',
                    'size' => 'md',     // http://demos.krajee.com/popover-x#settings
                    'inputType' => \kartik\editable\Editable::INPUT_SELECT2, // http://demos.krajee.com/editable
                    'options' => [
                        // Obtiene la lista completa de las cuentas
                        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Sector::find()->all(), 'sectorid', 'sector'),
                    ]
                ];
            }
        ],
            */
            [
                'attribute' => 'presentacionunidad_id',
                'value'=>function ($model) {
                    return $model->presentacionunidad->unidad;

                },
                /*
                'attribute'=> 'presentacionunidad_id',
                'label' => 'Unidad',
                'contentOptions' => ['width'=>'200px'],*/

            ],
            [
                'attribute'=> 'equivalencia',
                'contentOptions' => ['width'=>'200px'],
            ],
            [
                'attribute'=> 'equivalenciasunidad_id',
                'value'=>function ($model) {
                    return $model->equivalenciasunidad->unidad;

                },
            ],






        ],
    ]); ?>

</div>
