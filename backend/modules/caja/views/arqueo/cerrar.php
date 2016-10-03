<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\caja\models\search\ArqueoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arqueos - Turno Cerrado';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arqueo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Tu turno lo cerraste con: $<?= $model->efectivocierre ?>, realiza el cambio de las claves del Softrestaurant a: </p>
    <p>Cajero: <?=$model->clave1?> y Caja: <?= $model->clave2 ?></p>

</div>
