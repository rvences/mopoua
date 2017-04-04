<?php
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\nomina\models\search\NompercepciondeduccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="nompercepciondeduccion-index">
    <?php
    $salario_bruto = 0;
    $salario_neto = 0;

    foreach ($dataProvider->models as $model) {

        if ( $model->clave_tipopd == 'P001') { // Salario Base
            $salario_neto += $model->monto * 15.2;
        } elseif ( $model->clave_tipopd == 'P004') { // Incorporación voluntaria IMSS
            $salario_neto += $model->monto * 15.2;
        } elseif ( $model->clave_tipopd == 'P002') { // Servicio de Comedor
            $salario_bruto += $model->monto * 15.2;
        } else {
            $salario_bruto += $model->monto;
        }
        //echo "addMarker({$model->clave_tipopd}, {$model->monto});";
    }
    $salario_bruto += $salario_neto;
    echo "Salario Bruto: $" . $salario_bruto . ' --- ' . 'Salario Neto: $' . $salario_neto;

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'puesto_id',
            [
                'attribute' => 'clave_tipopd',
                'label' => 'Clave',
                'value' => 'clave_tipopd',

            ],
            [
                'attribute' => 'concepto',
                'label' => 'Concepto por Día',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default

                'value' => function ($data) {
                    return $data->claveTipopd->concepto;
                },
            ],
            'monto',
        ],
    ]);

    /*

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'puesto_id',
            'clave_tipopd',
            'monto',
            //'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);  */ ?>
</div>
