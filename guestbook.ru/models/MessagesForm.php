<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

// Название модели состоит из 2 частей название модели Form
class MessagesForm extends ActiveRecord
{

	public $user;
    public $comment;
    public function rules()
    {
        return [
           ['comment', 'required'],
        ];
    }

     public static function tableName()
    {
        return 'messages';
    }


    public function attributeLabels()
    {
        return [
            'comment' => 'Комментарий',
            'user' => '',
        ];
    }

  

}
