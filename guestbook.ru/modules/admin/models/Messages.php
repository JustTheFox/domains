<?php

namespace app\modules\admin\models;

use app\modules\admin\models\Users;
use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $message
 * @property integer $created_at
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'message', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'message' => 'Сообщение',
            'created_at' => 'Добавлено',
        ];
    }

 
   

    public function afterFind(){
        $this->created_at = date("Y-m-d h:i:s",$this->created_at);
        $user = Users::findOne($this->user_id);
        $this->user_id = $user->username;
        /*
        $this->role = Roles::findOne($user->role)->one()->name;*/
    }



}
