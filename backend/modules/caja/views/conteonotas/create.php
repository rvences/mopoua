<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Conteonotas */

$this->title = 'Create Conteonotas';
$this->params['breadcrumbs'][] = ['label' => 'Conteonotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conteonotas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
