<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Arqueo */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelsConteonotas \backend\modules\caja\models\Conteonotas */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-diario").each(function(index) {
        jQuery(this).html("Nota: " + (index + 1))
    });
});


jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-diario").each(function(index) {
        jQuery(this).html("Nota: " + (index + 1))
    });
});
';


$this->registerJs($js);
?>

<div class="arqueo-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<?php /*
    <?= $form->field($model, 'montoadeudo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'montoingreso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'montoegreso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'montoretiro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'liquidoadeudo')->textInput() ?>
*/?>
    <?= $form->field($model, 'comentario')->textarea(['rows' => 3]) ?>


<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Egresos - Compras</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsConteonotas[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'descripcion',
                    'cantidad',
                    'formapago',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsConteonotas as $i => $modelConteonotas): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-diario pull-left">Nota <?= ($i +1 ) ?></span>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $modelConteonotas->isNewRecord) {
                                echo Html::activeHiddenInput($modelConteonotas, "[{$i}]id");
                            }
                            ?>

                            <div class="row">
                                <div class="col-sm-8">
                                    <?php // Estado
                                    $lista = ArrayHelper::map(\backend\modules\mrp\models\Proveedores::find()->where(['paga_cajero' => true])->asArray()->all(), 'nombre_corto', 'razon_social');
                                    echo $form->field($modelConteonotas, "[{$i}]descripcion")->dropDownList($lista, ['prompt'=>'Selecciona...'])
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelConteonotas, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>



</div>


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-list-alt"></i> Egresos - Compras</h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsConteonotas[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'descripcion',
                        'cantidad',
                        'formapago',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsConteonotas as $i => $modelConteonotas): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-diario pull-left">Nota <?= ($i +1 ) ?></span>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelConteonotas->isNewRecord) {
                                    echo Html::activeHiddenInput($modelConteonotas, "[{$i}]id");
                                }
                                ?>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <?php // Estado
                                        $lista = ArrayHelper::map(\backend\modules\mrp\models\Proveedores::find()->where(['paga_cajero' => true])->asArray()->all(), 'nombre_corto', 'razon_social');
                                        echo $form->field($modelConteonotas, "[{$i}]descripcion")->dropDownList($lista, ['prompt'=>'Selecciona...'])
                                        ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($modelConteonotas, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>



    </div>












    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
