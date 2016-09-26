<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\search\ArqueoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="arqueo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'farqueo') ?>

    <?= $form->field($model, 'montoadeudo') ?>

    <?= $form->field($model, 'montoapertura') ?>

    <?php // echo $form->field($model, 'montocierre') ?>

    <?php // echo $form->field($model, 'montoingreso') ?>

    <?php // echo $form->field($model, 'montoegreso') ?>

    <?php // echo $form->field($model, 'montoretiro') ?>

    <?php // echo $form->field($model, 'liquidoadeudo') ?>

    <?php // echo $form->field($model, 'comentario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
