<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\Tipoproveedores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipoproveedores-form fondo">
    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'tipoproveedor', [
            'label'=>'Registra Nuevo Proveedor',
            'class'=>'col-sm-3 control-label'
        ]); ?>

        <div class="col-sm-5">
            <?= $form->field($model, 'tipoproveedor',['showLabels'=>false])->textInput(['placeholder'=>'Tipo de Proveedor']); ?>
        </div>

        <div class="col-sm-4">
            <?= Html::submitButton($model->isNewRecord ? 'Nueva' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
