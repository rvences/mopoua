<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Colaboradores */

$this->title = 'Create Colaboradores';
$this->params['breadcrumbs'][] = ['label' => 'Colaboradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colaboradores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
