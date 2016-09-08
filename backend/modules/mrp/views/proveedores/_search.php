<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\search\ProveedoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre_corto') ?>

    <?= $form->field($model, 'tipoproveedor_id') ?>

    <?= $form->field($model, 'razon_social') ?>

    <?= $form->field($model, 'contacto') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'rfc') ?>

    <?php // echo $form->field($model, 'correo') ?>

    <?php // echo $form->field($model, 'notas') ?>

    <?php // echo $form->field($model, 'clabe') ?>

    <?php // echo $form->field($model, 'cuenta') ?>

    <?php // echo $form->field($model, 'banco') ?>

    <?php // echo $form->field($model, 'cliente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
