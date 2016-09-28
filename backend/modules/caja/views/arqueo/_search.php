<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\search\ArqueoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="arqueo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'farqueo') ?>

    <?= $form->field($model, 'comentario') ?>

    <?= $form->field($model, 'efectivoapertura') ?>

    <?php // echo $form->field($model, 'efectivocierre') ?>

    <?php // echo $form->field($model, 'efectivosistema') ?>

    <?php // echo $form->field($model, 'dineroelectronico') ?>

    <?php // echo $form->field($model, 'efectivoadeudoanterior') ?>

    <?php // echo $form->field($model, 'depositoempresa') ?>

    <?php // echo $form->field($model, 'retiroempresa') ?>

    <?php // echo $form->field($model, 'egresocompras') ?>

    <?php // echo $form->field($model, 'egresocomprasservicio') ?>

    <?php // echo $form->field($model, 'efectivofisico') ?>

    <?php // echo $form->field($model, 'adeudoanterior') ?>

    <?php // echo $form->field($model, 'adeudoactual') ?>

    <?php // echo $form->field($model, 'ventaturno') ?>

    <?php // echo $form->field($model, 'egresoturno') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
