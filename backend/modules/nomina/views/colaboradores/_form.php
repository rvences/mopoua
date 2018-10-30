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

    <?= $form->field($model, 'clave')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'apaterno')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'amaterno')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'rfc')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'curp')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'nss')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?php
    $dato = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\Catpuestos::find()->select('id, puesto, tipo_colaborador')->asArray()->orderBy('puesto')->all(), 'id',
        function($model, $defaultValue) {
            return $model['tipo_colaborador'].' '.$model['puesto'];
        }
    );?>
    <?= $form->field($model, 'puesto_id')->dropDownList($dato, ['prompt'=>'[Seleccionar]']); ?>

    <?= $form->field($model, 'fingreso')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
    ]) ?>

    <?php echo (Yii::$app->controller->action->id == 'create' ?
        '' :
        $form->field($model, 'fbaja')->widget(\kartik\datecontrol\DateControl::classname(), [
            'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
        ]));
    ?>
    <?php /*

    <?= $form->field($model, 'activo')->textInput() ?>
*/ ?>

    <?php
    $dato = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\TemporalidadPago::find()->select('id, temporalidad')->asArray()->orderBy('temporalidad')->all(), 'id',
        function($model, $defaultValue) {
            return $model['temporalidad'];
        }
    );?>
    <?= $form->field($model, 'temporalidad_pago_id')->dropDownList($dato, ['prompt'=>'[Seleccionar]']); ?>

  
	<?php /*if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } */?>

    <?php ActiveForm::end(); ?>
    
</div>
