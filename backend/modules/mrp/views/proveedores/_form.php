<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\Proveedores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedores-form fondo">

    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Proveedor', [
            'label'=>'Proveedor',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-2">
            <?= $form->field($model, 'nombre_corto',['showLabels'=>false])->textInput(['placeholder'=>'Nombre Comercial']); ?>
        </div>

        <div class="col-sm-3">
            <?php // = $form->field($model, 'tipoproveedor_id',['showLabels'=>false])->textInput(['placeholder'=>'Tipo de Proveedor']); ?>
            <?php
            $dato = \yii\helpers\ArrayHelper::map(\backend\modules\mrp\models\Tipoproveedores::find()->asArray()->all(), 'id', 'tipoproveedor');
            echo $form->field($model, 'tipoproveedor_id',['showLabels'=>false])->dropDownList($dato); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'razon_social',['showLabels'=>false])->textInput(['placeholder'=>'Razón Social']); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'rfc',['showLabels'=>false])->textInput(['placeholder'=>'R F C - Hacienda']); ?>
        </div>
    </div>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Banco', [
            'label'=>'Datos Depósitos',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-3">
            <?= $form->field($model, 'banco',['showLabels'=>false])->textInput(['placeholder'=>'Banco']); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'cuenta',['showLabels'=>false])->textInput(['placeholder'=>'No. Cuenta']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'clabe',['showLabels'=>false])->textInput(['placeholder'=>'CLABE Interbancaria']); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'cliente',['showLabels'=>false])->textInput(['placeholder'=>'No. Cliente']); ?>
        </div>
    </div>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Contacto', [
            'label'=>'Datos Contacto',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-4">
            <?= $form->field($model, 'contacto',['showLabels'=>false])->textInput(['placeholder'=>'Ejecutivo']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'telefono',['showLabels'=>false])->textInput(['placeholder'=>'Teléfono con CLAVE']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'correo',['showLabels'=>false])->textInput(['placeholder'=>'Correo Electrónico']); ?>
        </div>

    </div>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Notas', [
            'label'=>'Notas',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-10">
            <?= $form->field($model, 'notas',['showLabels'=>false])->textarea(['placeholder'=>'Otra información necesaria']); ?>
        </div>




    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>




    <?php ActiveForm::end(); ?>

</div>
