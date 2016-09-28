<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Arqueo */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelsNotas \backend\modules\caja\models\Conteonotas */
/* @var $ingresoegreso \backend\modules\caja\models\Tipoingresoegreso */
?>

<div class="arqueo-form fondo">
    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'comentario')->textarea(['rows' => 3]) ?>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon glyphicon-usd"></i>Notas</h4></div>
            <div class="panel-body">

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsNotas as  $modelNotas) {} ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-body">
                            <?php
                            $i=0;
                            foreach ($ingresoegreso as $i => $dato) : ?>
                                <?php if (($i % 2 == 0) ) {
                                    // necessary for update action.
                                    if (! $dato->isNewRecord) {
                                        echo Html::activeHiddenInput($modelNotas, "[{$i}]id");
                                    }
                                        echo Html::activeHiddenInput($modelNotas, "[{$i}]tipo" , ['value'=>$dato->tipo]);
                                ?>
                                <div class="row fondo">
                                    <div class="col-sm-4">
                                        <?= $form->field($modelNotas, "[{$i}]descripcion",['showLabels'=>false] )->textInput(['readonly'=>true, 'value'=>$dato->descripcion]) ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?= $form->field($modelNotas, "[{$i}]cantidad",['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'Monto 0.00']) ?>
                                    </div>

                                <?php } else {
                                        // necessary for update action.
                                        if (! $dato->isNewRecord) {
                                            echo Html::activeHiddenInput($modelNotas, "[{$i}]id");
                                        }
                                        echo Html::activeHiddenInput($modelNotas, "[{$i}]tipo" , ['value'=>$dato->tipo]);
                                    ?>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelNotas, "[{$i}]descripcion",['showLabels'=>false] )->textInput(['readonly'=>true, 'value'=>$dato->descripcion]) ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?= $form->field($modelNotas, "[{$i}]cantidad",['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'Monto 0.00']) ?>
                                    </div>
                                </div>

                                <?php } ?>

                            <?php endforeach;
                            if (($i % 2 == 0) ) { ?>
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                <?= Html::submitButton($model->isNewRecord ? 'Nueva' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

