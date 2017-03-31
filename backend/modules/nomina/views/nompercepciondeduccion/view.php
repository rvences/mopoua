<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Nompercepciondeduccion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nompercepciondeduccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nompercepciondeduccion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'puesto_id',
            'clave_tipopd',
            'monto',
            'created',
            'updated',
        ],
    ]) ?>

</div>
