<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Mopoua',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems = [
            ['label' => 'Tareas', 'url'=> ['/productividad/tareas/index']],

            ['label' => 'Mi Nomina', 'url'=> ['/nomina/mi-nomina']],




            ['label' => 'Conteo Efectivo', 'url'=> ['/caja/conteodiario/contar']],
            (\common\models\User::isUserCaja(Yii::$app->user->identity->id) ) ?
            [
                'label' => 'Caja', 'items' =>array(
                    ['label' => 'Apertura / Cierre', 'url'=> ['/caja/conteodiario/index'], 'visible' => \common\models\User::isUserCaja(Yii::$app->user->identity->id)],
                    ['label' => 'Arqueo', 'url'=> ['/caja/arqueo/create'], 'visible' => \common\models\User::isUserCaja(Yii::$app->user->identity->id)],
                    ['label' => 'Caja - Catálogos' , 'items' =>array(
                        ['label' => 'Insumos', 'url'=> ['/caja/tipoingresoegreso']],
                        ['label' => 'Arqueo todos', 'url'=> ['/caja/arqueo/index']],
                    ), 'visible' => \common\models\User::isUserAdmin(Yii::$app->user->identity->id)],
            )] : '',

            (\common\models\User::isUserCocina(Yii::$app->user->identity->id) ) ?
            [
                'label' => 'MRP - Catálogos', 'items' =>array(
                    ['label' => 'Insumos', 'url'=> ['/mrp/insumo']],


                    ['label' => 'Catálogos' , 'items' =>array(
                        ['label' => 'Tipo de Proveedores', 'url'=> ['/mrp/tipoproveedores']],
                        ['label' => 'Proveedores', 'url'=> ['/mrp/proveedores']],
                        ['label' => 'Clave Presupuestal', 'url'=> ['/mrp/clavepresupuestal']],
                        ['label' => 'Unidad de Medida', 'url'=> ['/mrp/unidadmedida']],
                    ), 'visible' => \common\models\User::isUserAdmin(Yii::$app->user->identity->id)],
            )] : '',

            (\common\models\User::isUserAdmin(Yii::$app->user->identity->id) ) ?
                [
                    'label' => 'Nomina', 'items' =>array(
                        ['label' => 'Colaboradores', 'url'=> ['/nomina/colaboradores']],
                        ['label' => 'Calendarización de Pagos', 'url'=> ['/nomina/fechas-pago']],
                        ['label' => 'Movimientos Diarios', 'url'=> ['/nomina/movimiento-diario']],



                    ['label' => 'Catálogos' , 'items' =>array(
                        ['label' => 'Catálogo de Puestos', 'url'=> ['/nomina/catpuestos']],
                        ['label' => 'Catálogo de Percepcion y Deduccion', 'url'=> ['/nomina/cattipopd']],

                    ), ],
                )] : '',

            ['label' => 'Personal', 'items'=> array(
                ['label' => 'Logout (' . Yii::$app->user->identity->username . Yii::$app->user->identity->id . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']],
            )],

        ];
        /*
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
        */
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Mopoua <?= date('Y') ?></p>

        <p class="pull-right">Potenciado por Nibira</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
