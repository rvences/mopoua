<?php

use yii\helpers\Html;
use yii\web\View;
use kartik\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $monedas */
/* @var $model backend\modules\caja\models\Conteodiario */

$this->title = 'Conteo de Efectivo para el Cierre';
$this->params['breadcrumbs'][] = ['label' => 'Cierre', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conteodiario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //print_r($model->getErrors());

    $this->registerJs("
$(function(){
    var M1  = $('#conteodiario-cnal1');   var M1V  = 0.1;
    var M2  = $('#conteodiario-cnal2');   var M2V  = 0.2;
    var M3  = $('#conteodiario-cnal3');   var M3V  = 0.5;
    var M4  = $('#conteodiario-cnal4');   var M4V  = 1;
    var M5  = $('#conteodiario-cnal5');   var M5V  = 2;
    var M6  = $('#conteodiario-cnal6');   var M6V  = 5;
    var M7  = $('#conteodiario-cnal7');   var M7V  = 10;
    var M8  = $('#conteodiario-cnal8');   var M8V  = 20;
    var M9  = $('#conteodiario-cnal9');   var M9V  = 50;
    var M10 = $('#conteodiario-cnal10');  var M10V = 100;
    var M11 = $('#conteodiario-cnal11');  var M11V = 20;
    var M12 = $('#conteodiario-cnal12');  var M12V = 50;
    var M13 = $('#conteodiario-cnal13');  var M13V = 100;
    var M14 = $('#conteodiario-cnal14');  var M14V = 200;
    var M15 = $('#conteodiario-cnal15');  var M15V = 500;
    var M16 = $('#conteodiario-cnal16');  var M16V = 1000;
    
    $('.calc').change(function(e) {
        suma = ( parseInt(M1.val(),10) || 0 ) * M1V + ( parseInt(M2.val(),10) || 0 ) * M2V + ( parseInt(M3.val(),10) || 0 ) * M3V 
             + ( parseInt(M4.val(),10) || 0 ) * M4V + ( parseInt(M5.val(),10) || 0 ) * M5V + ( parseInt(M6.val(),10) || 0 ) * M6V
             + ( parseInt(M7.val(),10) || 0 ) * M7V + ( parseInt(M8.val(),10) || 0 ) * M8V + ( parseInt(M9.val(),10) || 0 ) * M9V
             + ( parseInt(M10.val(),10) || 0 ) * M10V + ( parseInt(M11.val(),10) || 0 ) * M11V + ( parseInt(M12.val(),10) || 0 ) * M12V
             + ( parseInt(M13.val(),10) || 0 ) * M13V + ( parseInt(M14.val(),10) || 0 ) * M14V + ( parseInt(M15.val(),10) || 0 ) * M15V
             + ( parseInt(M16.val(),10) || 0 ) * M16V
        ;
    
    
       $('#conteodiario-montocierre').val(suma);
    
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
                    $ <?=$monedas['moneda1']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal1',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 10 cents', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda2']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal2',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 20 cents', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda3']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal3',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 50 cents', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda4']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal4',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 1', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda5']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal5',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 2', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda6']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal6',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 5', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda7']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal7',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 10', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda8']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal8',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 20', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda9']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal9',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 50', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda10']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal10',['showLabels'=>false])->textInput(['placeholder'=>'Monedas de 100', 'class'=> 'calc']); ?>
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
                    <?= $form->field($model, 'cnal11',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 20', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda12']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal12',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 50', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda13']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal13',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 100', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda14']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal14',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 200', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda15']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal15',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 500', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    $ <?=$monedas['moneda16']; ?> =
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'cnal16',['showLabels'=>false])->textInput(['placeholder'=>'Billetes de 1000', 'class'=> 'calc']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    Total en Pesos
                </div>
                <div class="col-xs-7">
                    <?= $form->field($model, 'montocierre',['showLabels'=>false])->textInput(['readonly' => true]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <?= $form->field($model, 'cext1',['showLabels'=>false])->textInput(['placeholder'=>'Dolares']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <?= $form->field($model, 'cext2',['showLabels'=>false])->textInput(['placeholder'=>'Euros']); ?>
                </div>
            </div>


        </div>



        <div class="form-group kv-fieldset-inline">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Cierre' : 'Cierre', ['data' => [
                    'confirm' => '¿ Conteo de efectivo completado ?',
                    'method' => 'post',
                ],'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>


        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>



