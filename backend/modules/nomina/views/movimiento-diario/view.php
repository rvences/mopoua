<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\MovimientoDiario */
?>
<div class="movimiento-diario-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute'=>'colaborador_id',
                'value' => function ($model) {
                    return $model->colaborador->nombre . ' ' . $model->colaborador->apaterno . ' ' . $model->colaborador->amaterno;
                }
            ],
            'movimiento_fecha:date',
            [
                'attribute'=>'movimiento_nomina_id',
                'value' => function ($model) {
                    return $model->movimientoNomina->movimiento;
                }
            ],
            'movimiento_nomina_info',
            'monto',
            [
                'attribute'=>'aplicado_en_nomina',
                'value' => function ($model) {
                    if ($model->aplicado_en_nomina == 1) { return 'Aplicado'; } else { return 'Pendiente'; }
                }
            ],
            //'nomina_glosa_id',
            'created_at:date',

            //'created_by',
        ],
    ]) ?>

</div>
