<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\Insumo */
/* @var $modelsPresentacion backend\modules\mrp\models\Presentacion */

$this->title = 'Nuevo Insumo';
$this->params['breadcrumbs'][] = ['label' => 'Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insumo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPresentacion' => $modelsPresentacion,
    ]) ?>

</div>
