<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\Insumo */
/* @var $modelsPresentacion \backend\modules\mrp\models\Presentacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insumo-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>


    <div class="row">
        <div class="col-xs-3">
            <?php
            $lista = \yii\helpers\ArrayHelper::map(\backend\modules\mrp\models\Clavepresupuestal::find()->asArray()->all(), 'id','clavepresupuestal');
            echo $form->field($model, 'clavepresupuestal_id')->dropDownList($lista);
            ?>
        </div>

        <div class="col-xs-4">
            <?= $form->field($model, 'insumo_generico')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-xs-4">
            <?php
            $lista = \yii\helpers\ArrayHelper::map(\backend\modules\mrp\models\Unidadmedida::find()->asArray()->all(), 'id', 'descripcion');
            echo $form->field($model, 'unidad_id')->dropDownList($lista);
            ?>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i>Presentaciones</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsPresentacion[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'insumo',
                    'marca',
                    'presentacion',
                    'presentacionunidad_id',
                    'equivalencia',
                    'equivalenciasunidad_id',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsPresentacion as $i => $modelPresentacion): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Presentación del Insumo</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $modelPresentacion->isNewRecord) {
                                echo Html::activeHiddenInput($modelPresentacion, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <?= $form->field($modelPresentacion, "[{$i}]insumo")->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="col-xs-6">
                                    <?= $form->field($modelPresentacion, "[{$i}]marca")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="col-xs-3">
                                        <?= $form->field($modelPresentacion, "[{$i}]presentacion")->textInput(['maxlength' => true]) ?>
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

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
