<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\components\InfoMessageWidget;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2 class="text-center">Авторизация</h2>
<?=InfoMessageWidget::widget()?>
<?php
 $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => [
        'style' => 'width:330px;margin:0 auto;',
    ]
    ]) ?>
    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Имя пользователя'])?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль']) ?>
   <?= $form->field($model, 'rememberMe')->checkbox()?>
    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end() ?>

