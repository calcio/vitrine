<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this);
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
        'brandLabel' => 'Vitrine (Admin)',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems[] = [
        'label' => '<span class="glyphicon glyphicon-map-marker"></span> Go to site',
        'url' => ['/site/index'],
        'options' => ['class' => 'dropdown'],
        'template' => '<a href="{url}" class="href_class">{label}</a>',
        'items' => [
            ['label' => '<span class="glyphicon glyphicon-home"></span> Home', 'url' => ['/site/index'], 'linkOptions' => ['target' => '_blank']],
        ],
        ['label' => 'Login', 'url' => ['/site/login']]
    ];

    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-dashboard"></span> Dashboard', 'url' => ['default/dashboard']];
        $menuItems[] = [
            'label' => '<span class="glyphicon glyphicon-wrench"></span> Tools',
            'url' => ['/#'],
            'options' => ['class' => 'dropdown'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
                ['label' => '<span class="glyphicon glyphicon-info-sign"></span> About', 'url' => ['about/index']],

                '<li role="separator" class="divider"></li>',
                ['label' => '<span class="glyphicon glyphicon-user"></span> USERS'],
                ['label' => '&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span> Add user', 'url' => ['user/create'],],
                ['label' => '&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-list"></span> List user', 'url' => ['user/index'],],

                '<li role="separator" class="divider"></li>',
                ['label' => '<span class="glyphicon glyphicon-shopping-cart"></span> PRODUCTS'],
                ['label' => '&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span> Add product', 'url' => ['product/create'],],
                ['label' => '&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-list"></span> List product', 'url' => ['product/index'],],

                '<li role="separator" class="divider"></li>',
                ['label' => '<span class="glyphicon glyphicon-tags"></span> CATEGORIES'],
                ['label' => '&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span> Add category', 'url' => ['category/create'],],
                ['label' => '&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-list"></span> List category', 'url' => ['category/index'],],
                
                '<li role="separator" class="divider"></li>',
            ]
        ];
        $menuItems[] = [
            'label' => '<span class="glyphicon glyphicon-log-out"></span> Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['default/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
