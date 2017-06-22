<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\productividad\models\Tareas */

$this->title = 'Nueva Tareas';
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tareas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'area' => $area['area_id'],
    ]) ?>

</div>
