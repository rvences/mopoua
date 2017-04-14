<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Arqueo */

$this->title = "Arqueo del día de " . $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $msg_ingreso_efe = ''; $msg_ingreso_ele = ''; $msg_egreso_com = ''; $msg_ingreso_adeudo = ''; $msg_ingreso_emp = ''; $msg_retiro_emp = ''; $msg_egreso_com = ''; $msg_egreso_serv = '';
foreach ( $detalle as $tipo_nota) : ?>
    <?php ($tipo_nota->tipo == 'INGRESO EFECTIVO' )          ? $msg_ingreso_efe   .= '<div class="row text-info"><div class="col-sm-1"></div> <div class="col-sm-4">' .$tipo_nota->descripcion . '</div><div class="col-sm-3">$ ' . $tipo_nota->cantidad . '</div></div>'  : '' ?>
    <?php ($tipo_nota->tipo == 'INGRESO ELECTRONICO' )       ? $msg_ingreso_ele   .= '<div class="row text-info"><div class="col-sm-1"></div> <div class="col-sm-4">' .$tipo_nota->descripcion . '</div><div class="col-sm-3">$ ' . $tipo_nota->cantidad . '</div></div>'  : '' ?>
    <?php ($tipo_nota->tipo == 'INGRESO ADEUDOS ANTERIORES') ? $msg_ingreso_adeudo.= '<div class="row text-info"><div class="col-sm-1"></div> <div class="col-sm-4">' .$tipo_nota->descripcion . '</div><div class="col-sm-3">$ ' . $tipo_nota->cantidad . '</div></div>'  : '' ?>
    <?php ($tipo_nota->tipo == 'INGRESO EMPRESA' )           ? $msg_ingreso_emp   .= '<div class="row text-info"><div class="col-sm-1"></div> <div class="col-sm-4">' .$tipo_nota->descripcion . '</div><div class="col-sm-3">$ ' . $tipo_nota->cantidad . '</div></div>'  : '' ?>
    <?php ($tipo_nota->tipo == 'RETIRO EMPRESA' )            ? $msg_retiro_emp    .= '<div class="row text-info"><div class="col-sm-1"></div> <div class="col-sm-4">' .$tipo_nota->descripcion . '</div><div class="col-sm-3">$ ' . $tipo_nota->cantidad . '</div></div>'  : '' ?>
    <?php ($tipo_nota->tipo == 'EGRESO COMPRA' )             ? $msg_egreso_com    .= '<div class="row text-info"><div class="col-sm-1"></div> <div class="col-sm-4">' .$tipo_nota->descripcion . '</div><div class="col-sm-3">$ ' . $tipo_nota->cantidad . '</div></div>'  : '' ?>
    <?php ($tipo_nota->tipo == 'EGRESO SERVICIO' )           ? $msg_egreso_serv   .= '<div class="row text-info"><div class="col-sm-1"></div> <div class="col-sm-4">' .$tipo_nota->descripcion . '</div><div class="col-sm-3">$ ' . $tipo_nota->cantidad . '</div></div>'  : '' ?>
<?php endforeach; ?>

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

    <?php $total =
        $model->efectivoapertura
        + $model->efectivosistema
        //+ $model->dineroelectronico
        + $model->depositoempresa
        - $model->egresocomprasservicio
        - $model->egresocompras
        - $model->retiroempresa
    ;?>

    <?php if ($total > $model->efectivocierre) { ?>
        <div class="row alert-danger">
            <div class="col-sm-3">Favor de rectificar </div><div class="col-sm-7">$ <?= money_format('%i', $total - $model->efectivocierre); ?> Le debes a PKory, si te equivocaste da clic en Modificar y justificalo en la información relevante</div>
        </div>
    <?php } ?>

    <?php if ($total < $model->efectivocierre) { ?>
        <div class="row alert-warning">
            <div class="col-sm-3">Favor de rectificar </div><div class="col-sm-7">$ <?= money_format('%i', $total - $model->efectivocierre); ?> Revisa las notas que no incluiste, si continua la deuda da clic en Modificar y justificalo en la información relevante </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-sm-6">
            Usuario: <?= $model->username ?>
        </div>
        <div class="col-sm-6">
            Fecha del Arqueo: <?php $formatter = \Yii::$app->formatter;  echo $formatter->asDatetime($model->farqueo, 'long'); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-3">Efectivo reportado por el Cajero al Inicio de Turno (+)</div><div class="col-sm-3">$ <?= $model->efectivoapertura ?></div>
    </div>


    <?php if ($model->dineroelectronico >0 || $model->efectivosistema > 0 ) : ?>
    <div class="row  bg-info">
        <div class="col-sm-3">Ventas (+) </div><div class="col-sm-2">$ <?= $model->dineroelectronico + $model->efectivosistema ?></div>
    </div>
    <?= $msg_ingreso_efe ?>
    <?= $msg_ingreso_ele ?>
    <?php endif; ?>

    <?php if ($model->depositoempresa >0 ) : ?>
        <div class="row  bg-info">
            <div class="col-sm-3">Efectivo Agregado a la Caja (+) </div><div class="col-sm-2">$ <?= $model->depositoempresa ?></div>
        </div>
        <?= $msg_ingreso_emp ?>
    <?php endif; ?>


    <?php if ($model->egresocomprasservicio >0 || $model->egresocompras > 0 ) : ?>
        <div class="row bg-info">
            <div class="col-sm-3">Compras (-) </div><div class="col-sm-2">$ <?= $model->egresocomprasservicio + $model->egresocompras ?></div>
        </div>
        <?= $msg_egreso_com ?>
        <?= $msg_egreso_serv ?>
    <?php endif; ?>

    <?php if ($model->retiroempresa >0 ) : ?>
        <div class="row  bg-info">
            <div class="col-sm-3">Retiro Efectivo (-) </div><div class="col-sm-2">$ <?= $model->retiroempresa ?></div>
        </div>
        <?= $msg_ingreso_emp ?>
    <?php endif; ?>


    <div class="row">

        <div class="col-sm-10">El sistema indica que se debe cerrar en efectivo con: $ <?= money_format('%i', $total); ?> y Electrónico: $ <?= money_format('%i', $model->dineroelectronico); ?> </div>


    </div>

    <div class="row ">
        <div class="col-sm-3">Efectivo Reportado por el Cajero al cierre</div><div class="col-sm-3">$ <?= $model->efectivocierre ?></div>

        <div class="col-sm-6 bg-info">
            <?php if ($monedas->cnal1 > 0)  echo  '<p>' . $monedas->cnal1 . ' monedas de $ 10c = ' . $monedas->cnal1 * .10 . '</p>' ; ?>
            <?php if ($monedas->cnal2 > 0)  echo  '<p>' . $monedas->cnal2 . ' monedas de $ 20c = ' . $monedas->cnal2 * .20 . '</p>' ; ?>
            <?php if ($monedas->cnal3 > 0)  echo  '<p>' . $monedas->cnal3 . ' monedas de $ 50c = ' . $monedas->cnal3 * .50 . '</p>' ; ?>
            <?php if ($monedas->cnal4 > 0)  echo  '<p>' . $monedas->cnal4 . ' monedas de $ 1 = ' . $monedas->cnal4 * 1 . '</p>' ; ?>
            <?php if ($monedas->cnal5 > 0)  echo  '<p>' . $monedas->cnal5 . ' monedas de $ 2 = ' . $monedas->cnal5 * 2 . '</p>' ; ?>
            <?php if ($monedas->cnal6 > 0)  echo  '<p>' . $monedas->cnal6 . ' monedas de $ 5 = ' . $monedas->cnal6 * 5 . '</p>' ; ?>
            <?php if ($monedas->cnal7 > 0)  echo  '<p>' . $monedas->cnal7 . ' monedas de $ 10 = ' . $monedas->cnal7 * 10 . '</p>' ; ?>
            <?php if ($monedas->cnal8 > 0)  echo  '<p>' . $monedas->cnal8 . ' monedas de $ 20 = ' . $monedas->cnal8 * 20 . '</p>' ; ?>
            <?php if ($monedas->cnal9 > 0)  echo  '<p>' . $monedas->cnal9 . ' monedas de $ 50 = ' . $monedas->cnal9 * 50 . '</p>' ; ?>
            <?php if ($monedas->cnal10 > 0)  echo  '<p>' . $monedas->cnal10 . ' monedas de $ 100 = ' . $monedas->cnal10 * 100 . '</p>' ; ?>
            <?php if ($monedas->cnal11 > 0)  echo  '<p>' . $monedas->cnal11 . ' billetes de $ 20 = ' . $monedas->cnal11 * 20 . '</p>' ; ?>
            <?php if ($monedas->cnal12 > 0)  echo  '<p>' . $monedas->cnal12 . ' billetes de $ 50 = ' . $monedas->cnal12 * 50 . '</p>' ; ?>
            <?php if ($monedas->cnal13 > 0)  echo  '<p>' . $monedas->cnal13 . ' billetes de $ 100 = ' . $monedas->cnal13 * 100 . '</p>' ; ?>
            <?php if ($monedas->cnal14 > 0)  echo  '<p>' . $monedas->cnal14 . ' billetes de $ 200 = ' . $monedas->cnal14 * 200 . '</p>' ; ?>
            <?php if ($monedas->cnal15 > 0)  echo  '<p>' . $monedas->cnal15 . ' billetes de $ 500 = ' . $monedas->cnal15 * 500 . '</p>' ; ?>
            <?php if ($monedas->cnal16 > 0)  echo  '<p>' . $monedas->cnal16 . ' billetes de $ 1000 = ' . $monedas->cnal16 * 1000 . '</p>' ; ?>
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
