<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


// Название модели состоит из 2 частей название модели Form
class Users extends ActiveRecord
{

	

	public $roles;
	
	public function afterFind(){
		$this->roles = Roles::find()->all();
	}


	public function addUser($model){
		$this->username = $model->username;
		$this->password = md5($model->password);
		$this->email = $model->email;
		$this->role_id = 2;
		$this->created_at = time();
		$this->avatar = "user.png";
		return $this->save();
	}

}
