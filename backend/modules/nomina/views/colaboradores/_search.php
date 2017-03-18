<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\search\ColaboradoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaboradores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clave') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apaterno') ?>

    <?= $form->field($model, 'amaterno') ?>

    <?php // echo $form->field($model, 'rfc') ?>

    <?php // echo $form->field($model, 'curp') ?>

    <?php // echo $form->field($model, 'nss') ?>

    <?php // echo $form->field($model, 'puesto') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'tabulador') ?>

    <?php // echo $form->field($model, 'fingreso') ?>

    <?php // echo $form->field($model, 'fbaja') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
