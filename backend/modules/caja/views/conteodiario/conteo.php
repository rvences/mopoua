<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $monedas */
/* @var $model backend\modules\caja\models\Conteodiario */

$this->title = 'Conteo Efectivo Rápido';
$this->params['breadcrumbs'][] = ['label' => 'Apertura', 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conteodiario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //print_r($model->getErrors());

    $this->registerJs("
$(function(){
    var M1  = $('#conteodiario-inal1');   var M1V  = 0.1;
    var M2  = $('#conteodiario-inal2');   var M2V  = 0.2;
    var M3  = $('#conteodiario-inal3');   var M3V  = 0.5;
    var M4  = $('#conteodiario-inal4');   var M4V  = 1;
    var M5  = $('#conteodiario-inal5');   var M5V  = 2;
    var M6  = $('#conteodiario-inal6');   var M6V  = 5;
    var M7  = $('#conteodiario-inal7');   var M7V  = 10;
    var M8  = $('#conteodiario-inal8');   var M8V  = 20;
    var M9  = $('#conteodiario-inal9');   var M9V  = 50;
    var M10 = $('#conteodiario-inal10');  var M10V = 100;
    var M11 = $('#conteodiario-inal11');  var M11V = 20;
    var M12 = $('#conteodiario-inal12');  var M12V = 50;
    var M13 = $('#conteodiario-inal13');  var M13V = 100;
    var M14 = $('#conteodiario-inal14');  var M14V = 200;
    var M15 = $('#conteodiario-inal15');  var M15V = 500;
    var M16 = $('#conteodiario-inal16');  var M16V = 1000;
    
    $('.calc').change(function(e) {
        suma = ( parseInt(M1.val(),10) || 0 ) * M1V + ( parseInt(M2.val(),10) || 0 ) * M2V + ( parseInt(M3.val(),10) || 0 ) * M3V 
             + ( parseInt(M4.val(),10) || 0 ) * M4V + ( parseInt(M5.val(),10) || 0 ) * M5V + ( parseInt(M6.val(),10) || 0 ) * M6V
             + ( parseInt(M7.val(),10) || 0 ) * M7V + ( parseInt(M8.val(),10) || 0 ) * M8V + ( parseInt(M9.val(),10) || 0 ) * M9V
             + ( parseInt(M10.val(),10) || 0 ) * M10V + ( parseInt(M11.val(),10) || 0 ) * M11V + ( parseInt(M12.val(),10) || 0 ) * M12V
             + ( parseInt(M13.val(),10) || 0 ) * M13V + ( parseInt(M14.val(),10) || 0 ) * M14V + ( parseInt(M15.val(),10) || 0 ) * M15V
             + ( parseInt(M16.val(),10) || 0 ) * M16V
        ;
    
    
       $('#conteodiario-montoapertura').val(suma);
    
    })
    

})
  

");
    ?>
    <div class="clavepresupuestal-form fondo">

        <?php $form = ActiveForm::begin([
                'type'=>ActiveForm::TYPE_HORIZONTAL,
            ]
        ); ?>



        <div class="col-sm-6">
            <div class="row">
                <?= Html::activeLabel($model, 'Conteodiario', [ 'label'=>'Monedas',  'class'=>'col-sm-1 control-label']); ?>
            </div>

            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda3']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal3',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 50 cents', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda4']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal4',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 1', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda5']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal5',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 2', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda6']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal6',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 5', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda7']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal7',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 10', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda8']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal8',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 20', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda9']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal9',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 50', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda10']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal10',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 100', 'class'=> 'calc']); ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="row">
                <?= Html::activeLabel($model, 'Conteodiario', [ 'label'=>'Billetes',  'class'=>'col-sm-1 control-label']); ?>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda11']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal11',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 20', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda12']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal12',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 50', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda13']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal13',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 100', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda14']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal14',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 200', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda15']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal15',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 500', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda16']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'inal16',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 1000', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    Total en Pesos
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'montoapertura',['showLabels'=>false])->textInput(['readonly' => true]); ?>
                </div>
            </div>


        </div>




        <?php ActiveForm::end(); ?>

    </div>

</div>



