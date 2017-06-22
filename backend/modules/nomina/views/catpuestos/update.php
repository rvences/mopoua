<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Catpuestos */

$this->title = 'Actualizando el puesto: ' . $model->tipo_colaborador . ' ' . $model->puesto;
$this->params['breadcrumbs'][] = ['label' => 'Catálogo de Puestos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->puesto, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->puesto;
?>
<div class="catpuestos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelstipopd' => $modelstipopd,
    ]) ?>

</div>
