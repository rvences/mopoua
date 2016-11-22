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
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
        <div class="col-sm-3">Efectivo Caja en Apertura (+)</div><div class="col-sm-3">$ <?= $model->efectivoapertura ?></div>
    </div>

    <?php if ( ($model->egresocomprasservicio + $model->egresocompras) > 0 )  { ?>
    <div class="row">
        <div class="col-sm-3">Compras (-)</div><div class="col-sm-3">$ <?= $model->egresocomprasservicio + $model->egresocompras ?></div>
    </div>
    <?php } ?>

    <?php if ( ($model->retiroempresa) > 0 )  { ?>
        <div class="row">
            <div class="col-sm-3">Retiro de Excedente (-)</div><div class="col-sm-3">$ <?= $model->retiroempresa ?></div>
        </div>
    <?php } ?>

    <?php if ( ($model->depositoempresa) > 0 )  { ?>
        <div class="row">
            <div class="col-sm-3">Depósito por falta de efectivo (+)</div><div class="col-sm-3">$ <?= $model->depositoempresa ?></div>
        </div>
    <?php } ?>

    <?php if ( ($model->efectivosistema) > 0 )  { ?>
        <div class="row">
            <div class="col-sm-3">Ventas en efectivo reportadas por SoftRestaurant (+)</div><div class="col-sm-3">$ <?= $model->efectivosistema ?></div>
        </div>
    <?php } ?>

    <?php if ( ($model->dineroelectronico) > 0 )  { ?>
        <div class="row">
            <div class="col-sm-3">Ventas con Tarjetas o Firmas (+)</div><div class="col-sm-3">$ <?= $model->dineroelectronico ?></div>
        </div>
    <?php } ?>

    <div class="row">

        <?php $total = $model->efectivoapertura - $model->egresocomprasservicio - $model->egresocompras - $model->retiroempresa
            + $model->depositoempresa + $model->efectivosistema;?>
        <div class="col-sm-3">El sistema indica que se debe cerrar en efectivo con:(=)</div><div class="col-sm-3">$ <?= money_format('%i', $total); if ($model->efectivoadeudoanterior > 0 ) {  ?> , de los cuales <?=$model->efectivoadeudoanterior ?> son para saldar la deuda anterior<?php } ?></div>
    </div>

    <?php if ($total > $model->efectivocierre) { ?>
        <div class="row alert-danger">
            <div class="col-sm-3">Favor de rectificar </div><div class="col-sm-3">$ <?= money_format('%i', $total - $model->efectivocierre); ?> Le debes a PKory, si continua la deuda da clic en Modificar y justificalo en la información relevante</div>
        </div>
    <?php } ?>

    <?php if ($total < $model->efectivocierre) { ?>
        <div class="row alert-warning">
            <div class="col-sm-3">Favor de rectificar </div><div class="col-sm-3">$ <?= money_format('%i', $total - $model->efectivocierre); ?> Revisa las notas que no incluiste, si continua la deuda da clic en Modificar y justificalo en la información relevante </div>
        </div>
    <?php } ?>


    <?php if ( ($model->efectivocierre) > 0 )  { ?>
        <div class="row">
            <div class="col-sm-3">Efectivo que contaste al cerrar la caja fue de:</div><div class="col-sm-3">$ <?= $model->efectivocierre ?></div>
        </div>
    <?php } ?>

    <div class="row alert-danger">
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
