<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\caja\models\Arqueo */
/* @var $modelsNotas backend\modules\caja\models\Conteonotas */
/* @var $ingresoegreso backend\modules\caja\models\Tipoingresoegreso */

$this->title = 'Creando Arqueo';
$this->params['breadcrumbs'][] = ['label' => 'Arqueos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arqueo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsNotas' => $modelsNotas,
        'ingresoegreso' => $ingresoegreso,
    ]) ?>

</div>
