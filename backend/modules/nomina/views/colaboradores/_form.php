<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Colaboradores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaboradores-form">
    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Colaboradores', [
            'label'=>'Colaboradores',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-2">
            <?= $form->field($model, 'clave',['showLabels'=>false])->textInput(['placeholder'=>'Clave del Usuario']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'nombre',['showLabels'=>false])->textInput(['placeholder'=>'Nombre']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'apaterno',['showLabels'=>false])->textInput(['placeholder'=>'Apellido Paterno']); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'amaterno',['showLabels'=>false])->textInput(['placeholder'=>'Apellido Materno']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'rfc',['showLabels'=>false])->textInput(['placeholder'=>'RFC']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'curp',['showLabels'=>false])->textInput(['placeholder'=>'Curp']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'nss',['showLabels'=>false])->textInput(['placeholder'=>'Numero Seguro Social']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'puesto',['showLabels'=>false])->textInput(['placeholder'=>'Puesto']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'tipo',['showLabels'=>false])->textInput(['placeholder'=>'Tipo']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'tabulador',['showLabels'=>false])->textInput(['placeholder'=>'Tabulador']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'fingreso',['showLabels'=>false])->textInput(['placeholder'=>'Fecha de Ingreso']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'fbaja',['showLabels'=>false])->textInput(['placeholder'=>'Fecha de Baja']); ?>
        </div>
        <div class="col-sm-3">
            <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <div class="form-group">
        </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>

