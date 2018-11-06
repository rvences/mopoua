<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\search\NominaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nomina-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_pago_id') ?>

    <?= $form->field($model, 'salario_neto') ?>

    <?= $form->field($model, 'colaborador_id') ?>

    <?= $form->field($model, 'colaborador') ?>

    <?php // echo $form->field($model, 'puesto_id') ?>

    <?php // echo $form->field($model, 'puesto') ?>

    <?php // echo $form->field($model, 'forma_pago') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'numero_cuenta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
