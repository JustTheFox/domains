<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
Здравствуйте, <?=$params["username"]?> ! Вы успешно зарегистрировались на сайте <?=$params["sitename"]?>. Ваши данные: логин: <?=$params["username"]?>,пароль: <?=$params["password"]?>. 
<br>
С уважением, сайт <?=$params["sitename"]?>