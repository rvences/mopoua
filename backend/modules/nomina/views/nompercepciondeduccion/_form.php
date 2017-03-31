<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Nompercepciondeduccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nompercepciondeduccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'puesto_id')->textInput() ?>

    <?= $form->field($model, 'clave_tipopd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
