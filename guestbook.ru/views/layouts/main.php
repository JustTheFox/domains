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
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => 'Гостевая Книга',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/']],

            Yii::$app->user->isGuest ? (
                ['label' => 'Регистрация', 'url' => ['/reg']]
            ) : ['label' => 'Профиль', 'url' => ['/profile']],
             Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация', 'url' => ['/login']]
            ) : ['label' => 'Выход', 'url' => ['/logout']]
        ],
    ]);
    NavBar::end();
    ?>
</div>
<div class="container"> 
<?=$content ?>
</div>
<footer class="footer">
    <div class="container"><span>2017 © by JustTheFox</span></div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
