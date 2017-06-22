<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use backend\modules\nomina\models\Colaboradores;
use backend\modules\productividad\models\Prodcatalogos;

/* @var $this yii\web\View */
/* @var $model backend\modules\productividad\models\Tareas */
/* @var $form yii\widgets\ActiveForm */
?>



<?php
$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    // *********** Valores por defecto en combos
    $model->asignado_id = (empty($model->asignado_id)) ? Yii::$app->user->identity->id : $model->asignado_id; // Para preseleccionar el dato
    //$model->estado_id = (empty($model->estado_id)) ? Prodcatalogos::getEstadoDefecto() : $model->estado_id;

    echo $form->errorSummary($model);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        'attributes'=>[       // 2 column layout
            'asignado_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    //'data'=>$model->asignado_id
                    'data' => ArrayHelper::map(Colaboradores::listUserActive($area), 'id', 'nombrecompleto'),
                    'options' => ['placeholder' => 'Asignado a'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ],
            ],
            'tipoactividad_id' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\widgets\Select2',
                'options' => [
                    'data' => ArrayHelper::map(Prodcatalogos::getTipoactividadActivo(), 'id', 'descripcion'),
                    //'data' => ArrayHelper::map(Prodcatalogos::find()->where(['activo'=>1])->andWhere(['campo'=> 'estado'])->orderBy('descripcion')->asArray()->all(), 'id', 'descripcion'),
                    'options' => ['placeholder' => 'Tipo Actividad'],
                ]
            ],
            'fecha_limite'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'kartik\datecontrol\DateControl',
            ],
        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[       // 2 column layout
            'tarea'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Tarea...']],

        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>3,
        'attributes'=>[       // 2 column layout
            'actions'=>[
                'columnOptions'=>['colspan'=>2],
                'type'=>Form::INPUT_RAW,
                'value'=>'<div style="text-align: left; margin-top: 20px">' .
                    Html::resetButton('Restablecer', ['class'=>'btn btn-default']) . ' ' .
                    Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
                    '</div>'
            ],

        ]
    ]);

ActiveForm::end();

?>




