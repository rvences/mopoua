<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\search\PresentacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presentacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'insumo_id') ?>

    <?= $form->field($model, 'insumo') ?>

    <?= $form->field($model, 'marca') ?>

    <?= $form->field($model, 'presentacion') ?>

    <?php // echo $form->field($model, 'presentacionunidad_id') ?>

    <?php // echo $form->field($model, 'equivalencia') ?>

    <?php // echo $form->field($model, 'equivalenciasunidad_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
