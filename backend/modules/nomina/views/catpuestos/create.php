<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Catpuestos */

$this->title = 'Nuevo Puesto';
$this->params['breadcrumbs'][] = ['label' => 'Catálogo de Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catpuestos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelstipopd' => $modelstipopd,
    ]) ?>

</div>
