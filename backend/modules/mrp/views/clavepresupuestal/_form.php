<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelclave backend\modules\mrp\models\Clavepresupuestal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clavepresupuestal-form fondo">

    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($modelclave, 'Clavepresupuestal', [
            'label'=>'Registra Nueva Clave',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-3">
            <?= $form->field($modelclave, 'clavepresupuestal',['showLabels'=>false])->textInput(['placeholder'=>'Clave Presupuestal']); ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($modelclave, 'descripcion',['showLabels'=>false])->textInput(['placeholder'=>'Descripción']); ?>
        </div>
        <div class="col-sm-2">
            <?= Html::submitButton($modelclave->isNewRecord ? 'Nueva' : 'Actualizar', ['class' => $modelclave->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
