<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\search\ConteodiarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conteodiario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'inal1') ?>

    <?= $form->field($model, 'inal2') ?>

    <?= $form->field($model, 'inal3') ?>

    <?php // echo $form->field($model, 'inal4') ?>

    <?php // echo $form->field($model, 'inal5') ?>

    <?php // echo $form->field($model, 'inal6') ?>

    <?php // echo $form->field($model, 'inal7') ?>

    <?php // echo $form->field($model, 'inal8') ?>

    <?php // echo $form->field($model, 'inal9') ?>

    <?php // echo $form->field($model, 'inal10') ?>

    <?php // echo $form->field($model, 'inal11') ?>

    <?php // echo $form->field($model, 'inal12') ?>

    <?php // echo $form->field($model, 'inal13') ?>

    <?php // echo $form->field($model, 'inal14') ?>

    <?php // echo $form->field($model, 'inal15') ?>

    <?php // echo $form->field($model, 'inal16') ?>

    <?php // echo $form->field($model, 'iext1') ?>

    <?php // echo $form->field($model, 'iext2') ?>

    <?php // echo $form->field($model, 'fapertura') ?>

    <?php // echo $form->field($model, 'cnal1') ?>

    <?php // echo $form->field($model, 'cnal2') ?>

    <?php // echo $form->field($model, 'cnal3') ?>

    <?php // echo $form->field($model, 'cnal4') ?>

    <?php // echo $form->field($model, 'cnal5') ?>

    <?php // echo $form->field($model, 'cnal6') ?>

    <?php // echo $form->field($model, 'cnal7') ?>

    <?php // echo $form->field($model, 'cnal8') ?>

    <?php // echo $form->field($model, 'cnal9') ?>

    <?php // echo $form->field($model, 'cnal10') ?>

    <?php // echo $form->field($model, 'cnal11') ?>

    <?php // echo $form->field($model, 'cnal12') ?>

    <?php // echo $form->field($model, 'cnal13') ?>

    <?php // echo $form->field($model, 'cnal14') ?>

    <?php // echo $form->field($model, 'cnal15') ?>

    <?php // echo $form->field($model, 'cnal16') ?>

    <?php // echo $form->field($model, 'cext1') ?>

    <?php // echo $form->field($model, 'cext2') ?>

    <?php // echo $form->field($model, 'fcierre') ?>

    <?php // echo $form->field($model, 'montoapertura') ?>

    <?php // echo $form->field($model, 'montocierre') ?>

    <?php // echo $form->field($model, 'arqueo_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
