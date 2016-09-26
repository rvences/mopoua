<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $modelArqueo backend\modules\caja\models\Arqueo */
/* @var $modelsConteonotas \backend\modules\caja\models\Conteonotas */

$this->title = 'Create Arqueo';
$this->params['breadcrumbs'][] = ['label' => 'Arqueos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arqueo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $modelArqueo,
        'modelsConteonotas' => $modelsConteonotas,
    ]) ?>

</div>
