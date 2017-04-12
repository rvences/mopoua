<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\growl;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\nomina\models\search\ColaboradoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colaboradores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colaboradores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (Yii::$app->session->getFlash('borrar')) {
        echo growl\Growl::widget([
            'type' => growl\Growl::TYPE_DANGER,
            'title' => 'Registro Eliminado',
            'icon' => 'glyphicon glyphicon-remove-sign',
            'body' => 'Se elimino correctamente ' . Yii::$app->session->getFlash('borrar'),
            'showSeparator' => true,
            'delay' => 0,
            'pluginOptions' => [
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ]
        ]);
    } else if (Yii::$app->session->getFlash('crear')) {
        echo growl\Growl::widget([
            'type' => growl\Growl::TYPE_SUCCESS,
            'title' => 'Registro Creado',
            'icon' => 'glyphicon glyphicon-ok-sign',
            'body' => 'Se agrego correctamente ' . Yii::$app->session->getFlash('crear'),
            'showSeparator' => true,
            'delay' => 0,
            'pluginOptions' => [
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ]
        ]);
    } ?>



    <?= GridView::widget([
        'export' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} &nbsp;&nbsp;{update} &nbsp;&nbsp;{delete}',
                'width'=>'105px',
            ],
            'clave',
            [                                                  // the owner name of the model
                'label' => 'Puesto',
                'value'=>function ($model) {
                    return $model->puesto->tipo_colaborador . ' ' . $model->puesto->puesto;
                },
            ],
            'nombre',
            'apaterno',
            'amaterno',
            // 'rfc',
            // 'curp',
            // 'nss',
            //'puesto_id',
            // 'fingreso',
            // 'fbaja',

        ],
    ]); ?>

</div>

<div>
    <?= $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>