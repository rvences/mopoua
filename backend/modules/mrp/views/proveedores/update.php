<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\mrp\models\Proveedores */

$this->title = 'Actualizar a: ' . ' ' . $model->razon_social;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->razon_social, 'url' => ['view', 'id' => $model->razon_social]];
$this->params['breadcrumbs'][] = 'Actualizar';

?>
<div class="proveedores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
