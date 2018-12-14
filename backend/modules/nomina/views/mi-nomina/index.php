<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\nomina\models\search\NominaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mi Nomina';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomina-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <div class="nomina-form">

        <?php $form = ActiveForm::begin(); ?>

        <?php
        $subQuery = \backend\modules\nomina\models\Nomina::find()->select('fecha_pago_id as id')->where(['colaborador_id' => Yii::$app->user->identity->colaborador_id])->all();
        $dato = \yii\helpers\ArrayHelper::map(\backend\modules\nomina\models\FechasPago::find()->select('id, de, hasta')->where(['in', 'id', $subQuery])->asArray()->orderBy('de DESC')->all(), 'id',
            function($model, $defaultValue) {
                return $model['de'].' al '.$model['hasta'];
            }
        );?>
        <?= $form->field($model, 'fecha_pago_id')->dropDownList($dato, ['prompt'=>'[Seleccionar]'])->label(false); ?>

        <div class="form-group">
            <?= Html::submitButton('Consultar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php
        if (isset($nomina) ) { ?>

            <div class="row">
                <div class="col-sm-10"><h2><?= $nomina['colaborador']; ?></h2></div>
            </div>
            <div class="row">
                <div class="col-sm-5"><h2><?= $nomina['puesto']; ?></h2></div>
                <div class="col-sm-5"><h2>Salario Neto: $<?= $nomina['salario_neto'] . ' ( ' . $nomina['forma_pago'] . ') '; ?></h2></div>
            </div>
        <?php }
        if (isset ($nominaGlosa)) { ?>
        <fieldset>
            <legend class="bg-warning">Desglose de la información</legend>
        </fieldset>
            <?php
            foreach ( $nominaGlosa as $key => $valor) { ?>
                <div class="row">
                    <?php
                    if ($valor['percepcion']> 0 || $valor['pk']> 0) { ?>
                    <div class="col-sm-1 bg-success"><p>+</p></div>
                    <?php } else { ?>
                    <div class="col-sm-1 bg-danger"><p>-</p></div>
                    <?php } ?>
                    <div class="col-xs-6 "><p><?=$valor['concepto']; ?></p></div>
                    <div class="col-xs-4 "><p><?=$valor['percepcion'] + $valor['deduccion'] + $valor['pk'] + $valor['creditos']; ?></p></div>
                </div>

            <?php
            }
        } ?>
        <?php ActiveForm::end(); ?>

    </div>

    <?php /*
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>






    <?= $form->field($valor, 'id')->textInput() ?>

    <?= $form->field($valor, 'de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($valor, 'colaborador_id')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>






    <p>
        <?= Html::a('Create Nomina', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_pago_id',
            'salario_neto',
            'colaborador_id',
            'colaborador',
            //'puesto_id',
            //'puesto',
            //'forma_pago',
            //'created_by',
            //'created_at',
            //'numero_cuenta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
 */ ?>
</div>
