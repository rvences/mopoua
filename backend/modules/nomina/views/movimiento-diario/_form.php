<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\MovimientoDiario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movimiento-diario-form">

    <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    ]); ?>
    <?php
        $fullName = new \yii\db\Expression('CONCAT_WS(" ", nombre, apaterno, amaterno)');
        $dato = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\Colaboradores::find()->select(['id','search_nombre' => $fullName] )->asArray()->all(), 'id',
            function($model, $defaultValue) {
            return $model['search_nombre'];
            }
            );
    ?>
    <?= $form->field($model, 'colaborador_id')->dropDownList($dato, ['prompt' =>'[Seleccionar]']); ?>

    <?= $form->field($model, 'movimiento_fecha')->widget(\kartik\datecontrol\DateControl::className(), [
            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
    ]); ?>

    <?php
    $dato = \yii\helpers\ArrayHelper::map( \backend\modules\nomina\models\CatMovimientosNomina::find()->select(['id', 'movimiento'])->asArray()->all(), 'id',
        function ($model, $defaultValue) {
            return $model['movimiento'];
        }
    );
    ?>

    <?= $form->field($model, 'movimiento_nomina_id')->dropDownList($dato, ['prompt' => '[Seleccionar]']) ?>

    <?= $form->field($model, 'movimiento_nomina_info')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'monto')->widget(\kartik\number\NumberControl::classname(), [
        'maskedInputOptions' => [
            'prefix' => '$ ',
            'suffix' => ' MN',
            'allowMinus' => false
        ],

    ]);
    ?>

    <?php /*
    <?= $form->field($model, 'aplicado_en_nomina')->textInput() ?>

    <?= $form->field($model, 'nomina_glosa_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>
*/?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
