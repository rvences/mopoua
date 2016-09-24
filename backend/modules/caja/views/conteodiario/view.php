<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Conteodiario */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Conteodiarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conteodiario-view">

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
            'username',
            'inal1',
            'inal2',
            'inal3',
            'inal4',
            'inal5',
            'inal6',
            'inal7',
            'inal8',
            'inal9',
            'inal10',
            'inal11',
            'inal12',
            'inal13',
            'inal14',
            'inal15',
            'inal16',
            'iext1',
            'iext2',
            'fapertura',
            'cnal1',
            'cnal2',
            'cnal3',
            'cnal4',
            'cnal5',
            'cnal6',
            'cnal7',
            'cnal8',
            'cnal9',
            'cnal10',
            'cnal11',
            'cnal12',
            'cnal13',
            'cnal14',
            'cnal15',
            'cnal16',
            'cext1',
            'cext2',
            'fcierre',
            'montoapertura',
            'montocierre',
            'arqueo_id',
        ],
    ]) ?>

</div>
