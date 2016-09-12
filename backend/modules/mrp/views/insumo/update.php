<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\Insumo */
/* @var $modelsPresentacion \backend\modules\mrp\models\Presentacion */

$this->title = 'Actualizar: ' . $model->insumo_generico;
$this->params['breadcrumbs'][] = ['label' => 'Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="insumo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPresentacion' => $modelsPresentacion,

    ]) ?>

</div>
