<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\Proveedores */

$this->title = $model->razon_social;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Seguro que lo quiere borrar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
            'formConfig'=>['labelSpan'=>3, 'deviceSize'=>ActiveForm::SIZE_SMALL],
        ]
    ); ?>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Proveedor', [
            'label'=>'Proveedor',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-2">
            <?php
            echo $form->field($model, 'nombre_corto',['showLabels'=>false])->textInput(['placeholder' => 'Nombre', 'readonly' =>true]);
            ?>
        </div>

        <div class="col-sm-3">
            <?php
            $dato = \yii\helpers\ArrayHelper::map(\backend\modules\mrp\models\Tipoproveedores::find()->asArray()->all(), 'id', 'tipoproveedor');
            echo $form->field($model, 'tipoproveedor_id',['showLabels'=>false])->dropDownList($dato, ['disabled' => true]); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'razon_social',['showLabels'=>false])->textInput(['placeholder'=>'Razón Social', 'readonly' =>true]); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'rfc',['showLabels'=>false])->textInput(['placeholder'=>'R F C - Hacienda', 'readonly' =>true]); ?>
        </div>
    </div>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Banco', [
            'label'=>'Datos Depósitos',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-3">
            <?= $form->field($model, 'banco',['showLabels'=>false])->textInput(['placeholder'=>'Banco', 'readonly' =>true]); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'cuenta',['showLabels'=>false])->textInput(['placeholder'=>'No. Cuenta', 'readonly' =>true]); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'clabe',['showLabels'=>false])->textInput(['placeholder'=>'CLABE Interbancaria', 'readonly' =>true]); ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'cliente',['showLabels'=>false])->textInput(['placeholder'=>'No. Cliente', 'readonly' =>true]); ?>
        </div>
    </div>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Contacto', [
            'label'=>'Datos Contacto',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-4">
            <?= $form->field($model, 'contacto',['showLabels'=>false])->textInput(['placeholder'=>'Ejecutivo', 'readonly' =>true]); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'telefono',['showLabels'=>false])->textInput(['placeholder'=>'Teléfono con CLAVE', 'readonly' =>true]); ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'correo',['showLabels'=>false])->textInput(['placeholder'=>'Correo Electrónico', 'readonly' =>true]); ?>
        </div>

    </div>

    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'Notas', [
            'label'=>'Notas',
            'class'=>'col-sm-2 control-label'
        ]); ?>

        <div class="col-sm-10">
            <?= $form->field($model, 'notas',['showLabels'=>false])->textarea(['placeholder'=>'Otra información necesaria', 'readonly' =>true]); ?>
        </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
