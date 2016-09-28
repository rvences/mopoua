<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Tipoingresoegreso */

$this->title = 'Create Tipoingresoegreso';
$this->params['breadcrumbs'][] = ['label' => 'Tipoingresoegresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoingresoegreso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
