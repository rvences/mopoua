<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\Tipoproveedores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipoproveedores-form fondo">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipoproveedor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
