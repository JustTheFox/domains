<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


// Название модели состоит из 2 частей название модели Form
class UserForm extends ActiveRecord
{
  
 const SCENARIO_REGISTER = 'register';
 const SCENARIO_CHANGEPROFILE = 'changeprofile';
 const SCENARIO_CHANGEPROFILEPASSWORD = 'changeprofilepassword';
 const SCENARIO_CHANGEPROFILEAVATAR = 'changeprofileavatar';
// Поля, которые необходимо проверять
    public $username;
    public $email;
    public $password;
    public $conf_password;
    public $avatar;
    public $roles;
    
    public static function tableName()
    {
        return "users";
    }

    public function  scenarios()
    {
        return [
            self::SCENARIO_REGISTER => ['username', 'password','email','conf_password'],
            self::SCENARIO_CHANGEPROFILE => ['username', 'email','avatar','password','conf_password'],
          /*  self::SCENARIO_CHANGEPROFILEPASSWORD => ['username', 'email'],
            self::SCENARIO_CHANGEPROFILEAVATAR => ['username', 'email','avatar'],*/
        ];
    }

    // Правила валидации
    public function rules()
    {
        //1 параметром передается одно или несколько имен полей, вторым название  валидатора,
        //Остальные параметры отвечаются за дополнительные опции
        return [
           [['username', 'email', 'password','conf_password'], 'required','on' => self::SCENARIO_REGISTER],
           // Проверяем поле email с помощью валидатора email
           ['email', 'email'],
           ['password', 'string', 'min' => 6,'on' => self::SCENARIO_REGISTER],
           // Проверяем поле password на соответствие регулярному выражению: пароль должен содержать только латинские буквы в разных регистрах
           ['password', 'match', 'pattern' => '/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/','on' => self::SCENARIO_REGISTER],
           ['password', 'match','pattern' => '/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 'when' => function($model) {
                return $model->password != '';
           },'on' => self::SCENARIO_CHANGEPROFILE],
           // Проверяем поле password на равенство значению из поля conf_password с помощью валидатора compare
            //Элемент compareAttribute задает имя поля  формы, с которым поле pass должно совпадать
           ['conf_password','compare', 'compareAttribute' => 'password','on' => self::SCENARIO_REGISTER],

           ['conf_password','compare','when' => function($model) {
                return $model->password != '';
           }, 'compareAttribute' => 'password','on' => self::SCENARIO_CHANGEPROFILE],


           // Проверяем поле username на уникальность
           ['username', 'unique','targetClass' => 'app\models\Users','message' => 'Поле {attribute} должно быть уникальным!'],
           ['avatar', 'image', 'minWidth' => 100, 'maxWidth' => 1400,'minHeight' => 200, 'maxHeight' => 1400,'extensions' => 'png,jpg','on' => self::SCENARIO_CHANGEPROFILE],  
        ];
    }

     // Метки для полей формы
    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'conf_password' => 'Подтверждение пароля',
            'avatar' => 'Аватар',
            'roles' => 'Роль',
        ];
    }

    
}
