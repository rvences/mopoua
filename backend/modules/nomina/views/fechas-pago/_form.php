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
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
        ]
    ); ?>

    <?= $form->field($model, 'de')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
        'widgetOptions' => [
            'options' => ['autocomplete' => 'off'],
        ]
    ]) ?>

    <?= $form->field($model, 'hasta')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'widgetOptions' => [
                'options' => ['autocomplete' => 'off'],
        ]
    ]); ?>

    <?php /*
    <?= $form->field($model, 'total_dias')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>
 ?>
    <?= $form->field($model, 'fecha_pago')->widget(\kartik\datecontrol\DateControl::classname(), [
            'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
        ])  ?>
*/ ?>
    <?php
    $dato = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\TemporalidadPago::find()->select('id, temporalidad')->asArray()->orderBy('temporalidad')->all(), 'id',
        function($model, $defaultValue) {
            return $model['temporalidad'];
        }
    );?>
    <?= $form->field($model, 'temporalidad_pago_id')->dropDownList($dato, ['prompt'=>'[Seleccionar]']); ?>


    <?php
        echo $form->field($model, 'estado_proceso')->checkbox(['value' => 1])->label('¿Procesar la nomina?');
    ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
