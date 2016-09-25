<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $monedas */
/* @var $model backend\modules\caja\models\Conteodiario */

$this->title = 'Apertura / Cierre';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conteodiario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clavepresupuestal-form fondo">

        <div class="row">
            <div class="col-xs-4"><b>Fecha</b></div>
            <div class="col-xs-4"><?=\Yii::$app->formatter->asDate($model['fapertura'], 'php:D d H:i'); ?> </div>
            <div class="col-xs-4"><?=\Yii::$app->formatter->asDate($model['fcierre'], 'php:D d H:i'); ?></div>
        </div>

        <div class="row">
            <div class="col-xs-4"><b>Monto</b></div>
            <div class="col-xs-4">$ <?=$model['montoapertura']; ?> </div>
            <div class="col-xs-4">$ <?=$model['montocierre']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">Divisas</div>
            <div class="col-xs-4">Cantidad</div>
            <div class="col-xs-4">Cantidad</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Monedas</div>
            <div class="col-xs-4">Apertura</div>
            <div class="col-xs-4">Cierre</div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda1']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal1']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal1']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda2']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal2']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal2']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda3']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal3']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal3']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda4']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal4']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal4']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda5']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal5']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal5']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda6']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal6']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal6']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda7']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal7']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal7']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda8']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal8']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal8']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda9']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal9']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal9']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda10']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal10']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal10']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">Billetes</div>
            <div class="col-xs-4">Apertura</div>
            <div class="col-xs-4">Cierre</div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda11']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal11']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal11']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda12']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal12']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal12']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda13']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal13']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal13']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda14']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal14']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal14']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda15']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal15']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal15']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">$ <?=$monedas['moneda16']; ?> =</div>
            <div class="col-xs-4"><?=$model['inal16']; ?> </div>
            <div class="col-xs-4"><?=$model['cnal16']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">Dólares =</div>
            <div class="col-xs-4"><?=$model['iext1']; ?> </div>
            <div class="col-xs-4"><?=$model['cext1']; ?> </div>
        </div>
        <div class="row">
            <div class="col-xs-4">Euros =</div>
            <div class="col-xs-4"><?=$model['iext2']; ?> </div>
            <div class="col-xs-4"><?=$model['cext2']; ?> </div>
        </div>


    </div>

</div>



