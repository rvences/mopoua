<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\caja\models\search\ArqueoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arqueos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arqueo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Arqueo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'farqueo',
            'comentario:ntext',
            'efectivoapertura',
            // 'efectivocierre',
            // 'efectivosistema',
            // 'dineroelectronico',
            // 'efectivoadeudoanterior',
            // 'depositoempresa',
            // 'retiroempresa',
            // 'egresocompras',
            // 'egresocomprasservicio',
            // 'efectivofisico',
            // 'adeudoanterior',
            // 'adeudoactual',
            // 'ventaturno',
            // 'egresoturno',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>