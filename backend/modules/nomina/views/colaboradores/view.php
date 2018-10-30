<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Colaboradores */
?>
<div class="colaboradores-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => '\yii\i18n\Formatter',
            'dateFormat' => 'php:d \d\e F \d\e Y',
            'datetimeFormat' => 'MM/dd/yyyy HH:mm::ss',
        ],
        'attributes' => [
            //'id',
            'clave',
            'nombre',
            'apaterno',
            'amaterno',
            'rfc',
            'curp',
            'nss',
            'puesto.puesto',
            'fingreso:date',
            'fbaja:date',
            //'activo',
            'temporalidadPago.temporalidad'
        ],
    ]) ?>

</div>
