<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\FechasPago */
?>
<div class="fechas-pago-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => '\yii\i18n\Formatter',
            'dateFormat' => 'php:d \d\e F \d\e Y',
            'datetimeFormat' => 'MM/dd/yyyy HH:mm::ss',
        ],
        'attributes' => [
            //'id',
            'de:date',
            'hasta:date',
            'total_dias',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            'fecha_pago:date',
            'temporalidadPago.temporalidad',
        ],
    ]) ?>

</div>
