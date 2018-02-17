<?php
    use yii\widgets\Breadcrumbs;
    use yii\helpers\Html;
    use app\modules\admin\assets\AdminAsset;
    AdminAsset::register($this);
    $action = Yii::$app->controller->id;

?>
dsfdf
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
          <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Admin-панель</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
            <ul class="nav navbar-nav">
              <li <?php if ($action == "default") { ?>class="active"<?php } ?>><a href="/admin">Главная</a></li>
              <li <?php if ($action == "messages") { ?>class="active"<?php } ?>><a href="/admin/messages">Сообщения</a></li>

              <li <?php if ($action == "users") { ?>class="active"<?php } ?>><a href="/admin/users">Пользователи</a></li>
            </ul>
            <p style = "margin-top:14px;margin-left:10px;float:right">
              Здравствуйте,  <?=Yii::$app->user->identity->username?>
              <a href="/logout"> Выход</a>
            </p>
        </div>
    </div>
</nav>
  <div  style =  "margin-top:60px;" class="container">
    <div class="row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
      <?=$content?>
    </div>
  </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

