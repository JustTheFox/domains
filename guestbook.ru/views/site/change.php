<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2 class="text-center">Редактирование комментария</h2>
<?php

    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
    ]) ?>
    <?= $form->field($model, 'comment')->textarea(['rows' => 8,'cols' => 5,'value' => $old_comment])->label("")?>

    <?= Html::submitButton('Cохранить', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end() ?>
