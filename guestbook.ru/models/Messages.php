<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Users;


// Название модели состоит из 2 частей название модели Form
class Messages extends ActiveRecord
{
	public $user;
	public $avatar;

	public function afterFind(){
		$user = Users::findOne($this->user_id);
		$this->user = $user->username;
		$this->created_at = date("Y-m-d h:i:s",$this->created_at);
		$this->avatar = Yii::$app->params["pathAvatars"].$user->avatar;
	}

	  public function addMessage($model){
        $this->message = $model->comment;
        $this->user_id = Yii::$app->user->identity->id;
        $this->created_at = time();
        return $this->save();
    }
}
