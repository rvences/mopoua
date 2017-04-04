<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Colaboradores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaboradores-form">
    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">

        <?= Html::activeLabel($model, 'nombre', ['label'=>'Colaborador', 'class'=>'col-sm-2 control-label']) ?>


        <div class="col-sm-3">
            <?= $form->field($model, 'nombre',['showLabels'=>false])->textInput(['placeholder'=>'Nombre']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'apaterno',['showLabels'=>false])->textInput(['placeholder'=>'Apellido Paterno']); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'amaterno',['showLabels'=>false])->textInput(['placeholder'=>'Apellido Materno']); ?>
        </div>


        <?= Html::activeLabel($model, 'clave', ['label'=>'Biométrico, RFC, CURP', 'class'=>'col-sm-2 control-label']) ?>

        <div class="col-sm-2">
            <?= $form->field($model, 'clave',['showLabels'=>false])->textInput(['placeholder'=>'Clave']); ?>
        </div>



        <div class="col-sm-2">
            <?= $form->field($model, 'rfc',['showLabels'=>false])->textInput(['placeholder'=>'RFC']); ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'curp',['showLabels'=>false])->textInput(['placeholder'=>'Curp']); ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'nss',['showLabels'=>false])->textInput(['placeholder'=>'Numero Seguro Social']); ?>
        </div>

    </div>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Colaboradores', [
            'label'=>'Puesto',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-2">
            <?php
            $dato = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\Catpuestos::find()->asArray()->all(), 'id', 'puesto');
            echo $form->field($model, 'puesto_id',['showLabels'=>false])->dropDownList($dato); ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'fingreso')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
            ]) ?>
        </div>

        <div class="col-sm-4">

            <?= $form->field($model, 'fbaja')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
            ])

            /*$form->field($model, 'fbaja')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                'ajaxConversion'=>false,
                'widgetOptions' => [
                    'pluginOptions' => [

                        'autoclose' => true
                    ]
                ]
            ]);
            */
            ?>
                   </div>
        <div class="col-sm-3">
            <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <div class="form-group">
        </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>

