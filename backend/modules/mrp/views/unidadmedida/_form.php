<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelunidad backend\modules\mrp\models\Unidadmedida */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unidadmedida-form fondo">

    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($modelunidad, 'Unidadmedida', [
            'label'=>'Registra Nueva Unidad',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-2">
            <?= $form->field($modelunidad, 'unidad',['showLabels'=>false])->textInput(['placeholder'=>'Unidad']); ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($modelunidad, 'descripcion',['showLabels'=>false])->textInput(['placeholder'=>'Descripción']); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($modelunidad, 'tipo_unidad', ['showLabels'=>false])->dropDownList(\backend\modules\mrp\models\Unidadmedida::arreglotipounidad(), ['prompt'=>'Tipo Unidad']) ?>
        </div>




        <div class="col-sm-2">
            <?= Html::submitButton($modelunidad->isNewRecord ? 'Nueva' : 'Actualizar', ['class' => $modelunidad->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>



</div>
