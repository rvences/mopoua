<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;


/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Arqueo */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelsNotas \backend\modules\caja\models\Conteonotas */
/* @var $modelNotas \backend\modules\caja\models\Conteonotas */
/* @var $ingresoegreso \backend\modules\caja\models\Tipoingresoegreso */
?>

<div class="arqueo-form fondo">
    <?php $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_HORIZONTAL,
        ]
    ); ?>

    <div class="row">
        <div class="col-sm-9">
            <?= $form->field($model, 'comentario')->textarea(['rows' => 3]) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'propina',['showLabels'=>false])->textInput(['placeholder'=>'Propina del día']); ?>
        </div>

        <div class="col-xs-3">
            <?php
            $lista = ArrayHelper::map(User::find()->asArray()->all(), 'username', 'username');
            //$model->usercontinua = Yii::$app->user->identity->id; // Para preseleccionar el dato
            echo $form->field($model, 'usercontinua',['showLabels'=>false])->dropDownList($lista, ['prompt'=>'Abre caja en siguiente turno']);
            ?>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon glyphicon-usd"></i>Notas</h4></div>
        <div class="panel-body">


            <?php //echo "<pre>"; print_r($modelsNotas); echo "</pre>"; exit;?>
            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsNotas as $index => $modelNotas) {  // 8:22 ?>
                    <?php
                    // necessary for update action.
                    if (!$modelNotas->isNewRecord) {
                        echo Html::activeHiddenInput($modelNotas, "[{$index}]id");
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $modelNotas->descripcion; ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($modelNotas, "[{$index}]cantidad")->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                <?php } ?>

            </div>

            <?= Html::submitButton($model->isNewRecord ? 'Nueva' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        </div>
    </div>

<?php ActiveForm::end(); ?>

</div>

