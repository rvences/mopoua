<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Arqueo */

$this->title = "Arqueo del día de " . $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arqueo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Finalizar el turno', ['cerrar', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿ Estas seguro de cerrar el turno ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>



    <div class="row">
        <div class="col-sm-6">
            Usuario: <?= $model->username ?>
        </div>
        <div class="col-sm-6">
            Fecha del Arqueo: <?php $formatter = \Yii::$app->formatter;  echo $formatter->asDatetime($model->farqueo, 'long'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            El sistema reporto una venta en efectivo de $<?= $model->efectivosistema ?> y de $<?= $model->dineroelectronico ?> con tarjetas o créditos
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            Compras o pagos realizados en efectivo: $<?= intval($model->egresocompras) + intval($model->egresocomprasservicio) ?>
        </div>
        <div class="col-sm-4">
            Retiro de Excedente en caja fue de: $<?= $model->retiroempresa ?>
        </div>
        <div class="col-sm-4">
            Depósitos por falta de efectivo fue de: $<?= $model->depositoempresa ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            El turno se abrió con $<?= $model->efectivoapertura ?> y cerro con $<?= $model->efectivocierre ?> en efectivo, y debió cerrar con: $<?=$model->efectivofisico ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            El adeudo anterior <?= $model->adeudoanterior ?> sumado con el adeudo actual <?= $model->adeudoactual - $model->adeudoanterior?> al cierre del día es de <b>$<?= $model->adeudoactual    ?></b>
        </div>
    </div>
<?php /*

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'farqueo',
            'comentario:ntext',
            'efectivoapertura',
            'efectivocierre',
            'efectivosistema',
            'dineroelectronico',
            'efectivoadeudoanterior',
            'depositoempresa',
            'retiroempresa',
            'egresocompras',
            'egresocomprasservicio',
            'efectivofisico',
            'adeudoanterior',
            'adeudoactual',
            'ventaturno',
            'egresoturno',
            'cerrado',
        ],
    ]) ?>
*/ ?>
</div>
