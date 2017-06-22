<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\productividad\models\search\TareasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tareas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'asignado_id') ?>

    <?= $form->field($model, 'tipoactividad_id') ?>

    <?= $form->field($model, 'estado_id') ?>

    <?= $form->field($model, 'tarea') ?>

    <?php // echo $form->field($model, 'resultado') ?>

    <?php // echo $form->field($model, 'fecha_limite') ?>

    <?php // echo $form->field($model, 'user_solicita_id') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'user_realizo_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
