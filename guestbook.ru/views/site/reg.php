<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2 class="text-center">Регистрация</h2>
<?php

    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => [
        'style' => 'width:500px;margin:0 auto;',
        ]
    ]) ?>
    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Имя пользователя'])?>
    <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail']) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль']) ?>
    <?= $form->field($model, 'conf_password')->passwordInput(['placeholder' => 'Подтверждение пароля'])?>
    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end() ?>
