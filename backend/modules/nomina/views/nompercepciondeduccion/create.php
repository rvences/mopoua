<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\nomina\models\Nompercepciondeduccion */

$this->title = 'Create Nompercepciondeduccion';
$this->params['breadcrumbs'][] = ['label' => 'Nompercepciondeduccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nompercepciondeduccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
