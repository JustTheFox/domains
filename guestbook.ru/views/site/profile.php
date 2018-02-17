<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Профиль пользователя';
?>
<h2 class="text-center mb-4">Профиль пользователя</h2>
<?php  $form =  ActiveForm::begin(['id' => 'comment-form','options' => [
        'style' => 'width:730px;margin:0 auto;padding-bottom:20px',
        'enctype' => 'multipart/form-data',
    ]]); ?>
<?= $form->field($model, 'username')->textInput(['value'=> $user->username])?>
<?= $form->field($model, 'email')->textInput(['value'=> $user->email])?>
	<div class="form-group field-userform-roles">
	<label class="control-label" for="userform-roles">Роль</label>


	<select <?php if($userRoleId != 1) {?> disabled <?php } ?> id="userform-roles" class="form-control" name="UserForm[roles]">
	<?php foreach ($user->roles as $val) {?>
		<option value="<?=$val->id?>"><?=$val->name?></option>
	<?php }?>
	</select>
</div>
<?= $form->field($model, 'avatar')->fileInput() ?>
  <?= $form->field($model, 'password')->input('password');?>
  <?= $form->field($model, 'conf_password')->input('password');?>
 <?= Html::submitButton('Cохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>  

		
   
</div>
