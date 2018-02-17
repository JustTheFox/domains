<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\components\InfoMessageWidget;


$this->title = 'Гостевая книга';
?>
<div class="container">

<h2 class="text-center mb-5">Гостевая книга</h2>
    <h5 class="text-center">Выпускная работа по курсу "Базовый PHP" от компании MediaSoft</h5>
    <h5 class="text-center mb-5">Выполнила: Спиридонова Любовь, УлГТУ</h5>
   <?=InfoMessageWidget::widget()?>
    <?php  if(!$is_auth){?>
	    <section class="pb-4 mess__up">
                    <div class="alert alert-info text-center">
                Чтобы оставить комментарий <a href="/login">авторизуйтесь</a> или
                <a href="/reg">зарегистрируйтесь</a>
            </div>
         </section>
    <?php  } else {?>
		<?php  $form =  ActiveForm::begin(['id' => 'comment-form','action' => '/add/comment','options' => [
        'style' => 'width:730px;margin:0 auto;',
    ],

		]); ?>
		<?= $form->field($model, 'user')->textInput(['disabled' => 1,'value'=> $username])->label('')?>
		<?= $form->field($model, 'comment')->textarea(['cols' => 5,'rows' => 8,'placeholder' => 'Введите сообщение'])->label('');?>
	<div class="checkbox">
		<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
	</div>
		 

		<?php ActiveForm::end(); }?>  
    <hr>
    <?php 
    foreach ($messages as $message) {?>
	<section>
	<div class="message-item mb-3">
			<div class="row">
				<div class="col-sm-3">
					<div class="message-data">
						<img class="user__img img-fluid rounded float-left float-sm-none" src="<?=$message["avatar"] ?>">
                        <p>Пользователь:<br></p><h5><?=$message["user"] ?></h5>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="message-body">
						<p class="message-date">
							<?=$message["created_at"] ?>

			<?php

			 if($user_id  == $message->user_id) {?>
										

							<a href="/delete/<?=$message->id?>" class="btn btn-sm btn-danger" onclick="return confirm('Комментарий будет безвозвратно удалён. Вы уверены?')"><i class="fa fa-trash-o" aria-hidden="true"></i> <span class="hidden-sm-down">Удалить</span></a>	
							<a href="/change/<?=$message->id?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-sm-down">Редактировать</span></a>	
							<?php }?>							</p>

                        <hr>
						<?=$message["message"] ?>
					</div>
				</div>
			</div>
		</div>
        <hr>
				
			
		</section>
    	
    <?php }?>
					
    <div id="pagination">
	<?= LinkPager::widget([
			'pagination' => $pagination,
			'firstPageLabel' => 'В начало',
			'lastPageLabel' => 'В конец',
			'prevPageLabel' => '&laquo;'
	]) ?>
	</div>
</div>


		
	
	
