<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Colaboradores */

$this->title = 'Actualizar información del Colaborador: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Colaboradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="colaboradores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
