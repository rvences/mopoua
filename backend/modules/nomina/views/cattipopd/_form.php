<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Cattipopd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cattipopd-form fondo">
    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($modelpd, 'Cattipopd', [
            'label'=>'Registra Nueva Percepción - Deducción',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-2">
            <?= $form->field($modelpd, 'clave',['showLabels'=>false])->textInput(['placeholder'=>'Clave']); ?>
        </div>

        <div class="col-sm-7">
            <?= $form->field($modelpd, 'tipo', ['showLabels'=>false])->dropDownList(\backend\modules\nomina\models\Cattipopd::gettipopd(), ['prompt'=>'[ Tipo Concepto ]']) ?>
        </div>


        <div class="col-sm-4">
            <?= $form->field($modelpd, 'concepto',['showLabels'=>false])->textInput(['placeholder'=>'Concepto']); ?>
        </div>


        <div class="col-sm-6">
            <?= $form->field($modelpd, 'descripcion',['showLabels'=>false])->textInput(['placeholder'=>'Descripción Completa de la Percepción']); ?>
        </div>





        <div class="col-sm-2">
            <?= Html::submitButton($modelpd->isNewRecord ? 'Nueva' : 'Actualizar', ['class' => $modelpd->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>



    <?php /*$form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clave')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'concepto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); */?>

</div>
