<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Tipoingresoegreso */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="tipoingresoegreso-form fondo">
    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'tipoproveedor', [
            'label'=>'Registra Nuevo',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-3">
            <?= $form->field($model, 'tipo',['showLabels'=>false])->dropDownList(['INGRESO EFECTIVO' => 'Efectivo Reportado por el Sistema',
                            'INGRESO ELECTRONICO' => 'Ingreso Electrónico',
                            'INGRESO ADEUDOS ANTERIORES' => 'Ingreso Adeudos Anteriores',
                            'INGRESO EMPRESA' => 'Ingreso Empresa', 'RETIRO EMPRESA' => 'Retiro Empresa', 'EGRESO COMPRA' => 'Egresos por Compras',
                            'EGRESO SERVICIO' => 'Egreso pago Servicios'], ['prompt'=>'Tipo Movimiento']) ?>
        </div>

        <div class="col-sm-5">
            <?= $form->field($model, 'descripcion',['showLabels'=>false])->textInput(['placeholder'=>'Descripción']); ?>
        </div>

        <div class="col-sm-1">
            <?= Html::submitButton($model->isNewRecord ? 'Nueva' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>