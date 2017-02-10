<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage(); ?>

<!DOCTYPE html>

<html lang="<?= \Yii::$app->language; ?>">

<head>
    <title><?= Html::encode($this->title) ?></title>

    <meta charset="<?= \Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags(); ?>

    <?php $this->head(); ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php NavBar::begin(['brandLabel' => \Yii::$app->params['siteName'], 'options' => ['class' => 'navbar-inverse navbar-fixed-top']]); ?>
    <?= Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Notices', 'url' => ['/site/about']],
            ['label' => 'Add notice', 'url' => ['/site/contact']]
        ]
    ]); ?>
    <?php NavBar::end(); ?>

    <div class="container">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]); ?>
        <?= $content; ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= \Yii::$app->params['siteName']; ?><?= date('Y'); ?></p>
        <p class="pull-right"><?= \Yii::powered(); ?></p>
    </div>
</footer>

<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
