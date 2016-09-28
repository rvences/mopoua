<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Tipoingresoegreso */

$this->title = 'Update Tipoingresoegreso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipoingresoegresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipoingresoegreso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
