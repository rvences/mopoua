<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\search\CatpuestosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catpuestos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'puesto') ?>

    <?= $form->field($model, 'requisitos') ?>

    <?= $form->field($model, 'funciones') ?>

    <?= $form->field($model, 'habilidades') ?>

    <?php // echo $form->field($model, 'conocimientos') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
