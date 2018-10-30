<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\FechasPago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fechas-pago-form">


    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($modelfp, 'FechasPago', [
            'label'=>'Registra las fechas de pagos',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-4">
            <?= $form->field($modelfp, 'de')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
            ]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($modelfp, 'hasta')->widget(\kartik\datecontrol\DateControl::className(), [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE
            ]); ?>
        </div>





        <div class="col-sm-2">
            <?= Html::submitButton($modelfp->isNewRecord ? 'Nueva' : 'Actualizar', ['class' => $modelfp->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>
