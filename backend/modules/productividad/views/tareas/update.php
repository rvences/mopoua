<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\productividad\models\Tareas */

$this->title = 'Actualizar Tareas';
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tareas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'area' => $area['area_id'],

    ]) ?>

</div>
