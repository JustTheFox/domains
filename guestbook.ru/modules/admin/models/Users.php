<?php

namespace app\modules\admin\models;
use Yii;
use app\modules\admin\models\Roles;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property integer $role_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property integer $created_at
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'username', 'email', 'password', 'avatar', 'created_at'], 'required'],
            [['role_id', 'created_at'], 'integer'],
            [['username'], 'string', 'max' => 30],
            [['email', 'password'], 'string', 'max' => 50],
            [['avatar'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

  


    public function attributeLabels()
    {
        return [
            'role_id' => 'Роль',
            'username' => 'Имя пользователя',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'conf_password' => 'Подтверждение пароля',
            'avatar' => 'Аватар',
            'roles' => 'Роль',
            'created_at' => 'Дата добавления',
        ];
    }


 
    public function afterFind(){
        $this->role_id = Roles::findOne($this->role_id)->name;
        $this->avatar = Yii::$app->params["pathAvatars"].$this->avatar;
        $this->created_at = date("Y-m-d h:i:s",$this->created_at);
    }

}
