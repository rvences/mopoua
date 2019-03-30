<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Colaboradores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaboradores-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="bg-error"><?php echo $form->errorSummary($model); ?></div>
    <fieldset>
        <legend class="bg-warning">Datos Personales</legend>

        <div class="row">
            <div class="col-md-2">
                <label class="control-label" >Clave y Puesto</label>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'clave')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder'=>'Biométrico'])->label(false) ?>
            </div>
            <div class="col-md-7">
                <?php
                $dato = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\Catpuestos::find()->select('id, puesto, tipo_colaborador')->asArray()->orderBy('puesto')->all(), 'id',
                    function($model, $defaultValue) {
                        return $model['tipo_colaborador'].' '.$model['puesto'];
                    }
                );?>
                <?= $form->field($model, 'puesto_id')->dropDownList($dato, ['prompt'=>'[Seleccionar]'])->label(false); ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <label class="control-label" >Nombre(s)</label>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder'=>'Nombre'])->label(false); ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'apaterno')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder'=>'Ap. Paterno'])->label(false); ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'amaterno')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder'=>'Ap. Materno'])->label(false); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <label class="control-label" >RFC y CURP</label>
            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'rfc')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder'=>'RFC'])->label(false); ?>

            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'curp')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder'=>'CURP'])->label(false); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label class="control-label" >Servicio Médico</label>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'nss')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => 'Clave de Afiliación'])->label(false); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'fingreso')->widget(\kartik\datecontrol\DateControl::classname(), [
                    'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                ]) ?>
            </div>

            <div class="col-md-6">
                <?php echo (Yii::$app->controller->action->id == 'create' ?
                    '' :
                    $form->field($model, 'fbaja')->widget(\kartik\datecontrol\DateControl::classname(), [
                        'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                    ]));
                ?>
            </div>

        </div>

    </fieldset>

    <fieldset>
        <legend class="bg-warning">Datos para Pago</legend>

        <div class="row">
            <div class="col-md-6">
                <?php
                $dato = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\TemporalidadPago::find()->select('id, temporalidad')->asArray()->orderBy('temporalidad')->all(), 'id',
                    function($model, $defaultValue) {
                        return $model['temporalidad'];
                    }
                );?>
                <?= $form->field($model, 'temporalidad_pago_id')->dropDownList($dato, ['prompt'=>'[Seleccionar]']); ?>

            </div>

            <div class="col-md-6">
                <?php
                $dato = ['EFECTIVO' => 'EFECTIVO', 'DEPOSITO' => 'DEPOSITO'];
                ?>
                <?= $form->field($model, 'forma_pago')->dropDownList($dato, ['prompt'=>'[Seleccionar]']); ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'numero_cuenta')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </fieldset>


    <fieldset>
        <legend class="bg-warning">Datos de contacto</legend>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'telefono')->textInput(['maxlength' => true])->label('Teléfono de Contacto') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <label class="control-label" >Emergencia</label>

            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'emergencia_contacto')->textInput(['maxlength' => true, 'placeholder'=>'Contacto de Emergencia'])->label(false); ?>
            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'emergencia_telefono')->textInput(['maxlength' => true, 'placeholder'=>'Teléfono de Emergencia'])->label(false); ?>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend class="bg-danger">Información Adicional</legend>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'observaciones')->textarea(['maxlength' => true, 'placeholder'=>'Cualquier información relevante del Colaborador'] )->label(false) ?>
            </div>
        </div>


    </fieldset>



    <?php ActiveForm::end(); ?>
    
</div>
