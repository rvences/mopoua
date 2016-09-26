<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Arqueo */

$this->title = 'Update Arqueo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Arqueos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="arqueo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
