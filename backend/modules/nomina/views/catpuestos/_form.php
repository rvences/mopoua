<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Catpuestos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catpuestos-form fondo">

    <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

        <div class="form-group kv-fieldset-inline">
            <?= Html::activeLabel($model, 'Puesto', [
                'label'=>'Puesto, Tipo y Plaza',
                'class'=>'col-sm-2 control-label'
            ]); ?>

            <div class="col-sm-3">
                <?= $form->field($model, 'puesto',['showLabels'=>false])->textInput(['placeholder'=>'Nombre del Puesto']); ?>
            </div>

            <div class="col-sm-3">
                <?php $lista = array([1 => 'Directo']); ?>
                <?= $form->field($model, 'tipo_colaborador',['showLabels'=>false])->textInput(['placeholder'=>'Tipo de Colaborador'])->dropDownList(\backend\modules\nomina\models\Catpuestos::getTipocolaborador(), ['prompt'=>'[Tipo Colaborador]']); ?>
            </div>

            <div class="col-sm-2">
                <?= $form->field($model, 'plazas',['showLabels'=>false])->textInput(['placeholder'=>'Plazas disponibles']); ?>
            </div>

            <div class="col-sm-2">
                <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <div class="form-group kv-fieldset-inline">
            <?= Html::activeLabel($model, 'Funciones', [
                'label'=>'Requisitos y Funciones',
                'class'=>'col-sm-2 control-label'
            ]); ?>
            <div class="col-sm-5">
                <?= $form->field($model, 'requisitos',['showLabels'=>false])->textarea(['placeholder'=>'Requisitos', 'rows' => 6]); ?>
            </div>
            <div class="col-sm-5">
                <?= $form->field($model, 'funciones',['showLabels'=>false])->textarea(['placeholder'=>'Funciones a Realizar', 'rows' => 6]); ?>
            </div>
        </div>

        <div class="form-group kv-fieldset-inline">
            <?= Html::activeLabel($model, 'Habilidades', [
                'label'=>'Habilidades y Conocimientos',
                'class'=>'col-sm-2 control-label'
            ]); ?>
            <div class="col-sm-5">
                <?= $form->field($model, 'habilidades',['showLabels'=>false])->textarea(['placeholder'=>'Habilidades', 'rows' => 6]); ?>
            </div>
            <div class="col-sm-5">
                <?= $form->field($model, 'conocimientos',['showLabels'=>false])->textarea(['placeholder'=>'Conocimientos previos', 'rows' => 6]); ?>
            </div>
        </div>



    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i>Descripción del Salario</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelstipopd[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'clave_tipopd',
                    'monto',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelstipopd as $i => $modeltipopd): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Ingresos / Egresos</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $modeltipopd->isNewRecord) {
                                echo Html::activeHiddenInput($modeltipopd, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php
                                    $lista = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\Cattipopd::find()->asArray()->all(), 'clave', 'concepto');
                                    echo $form->field($modeltipopd, "[{$i}]clave_tipopd")->dropDownList($lista)->label('Clave '); ?>
                                </div>

                                <div class="col-xs-6">
                                    <?= $form->field($modeltipopd, "[{$i}]monto")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
<?php /*
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="col-xs-3">
                                        <?= $form->field($modeltipopd, "[{$i}]presentacion")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-xs-9">
                                        <?php
                                        $lista = \yii\helpers\ArrayHelper::map(\backend\modules\mrp\models\Unidadmedida::find()->asArray()->all(), 'id', 'descripcion');
                                        echo $form->field($modelPresentacion, "[{$i}]presentacionunidad_id")->dropDownList($lista)->label('Unitaria '); ?>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-3">
                                        <?= $form->field($modelPresentacion, "[{$i}]equivalencia")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-xs-9">
                                        <?php
                                        $lista = \yii\helpers\ArrayHelper::map(\backend\modules\mrp\models\Unidadmedida::find()->asArray()->all(), 'id', 'descripcion');
                                        echo $form->field($modelPresentacion, "[{$i}]equivalenciasunidad_id")->dropDownList($lista)->label('Con unidad mínima'); ?>
                                    </div>
                                </div>
                            </div>
*/ ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>











</div>
