<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\MovimientoDiario */
?>
<div class="movimiento-diario-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'colaborador_id',
            'movimiento_fecha',
            'movimiento_nomina_id',
            'movimiento_nomina_info',
            'monto',
            'aplicado_en_nomina',
            'nomina_glosa_id',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
