<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{

    //Определяем поля формы авторизации
    public $username;
    public $password;
    public $rememberMe;
    // Объект аутентифицированного пользователя
    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
             'rememberMe' => 'Запомнить меня',
        ];
    }

    // Функция проверяет пароль пользователя в бд с паролем введеным из формы
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '');
            }
        }
    }

    //Функция авторизует пользователя
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(),  ($_POST["LoginForm"]["rememberMe"]) ? 10000000 : 0);
        }
        else  {
            Yii::$app->session->set("error_auth","Неверные имя пользователя и/или пароль");
             return false;
        }
    }

   
   //Функция возвращает объект аутентифицированного пользователя
    public function getUser()
    {
        echo $this->rememberMe;
        // Если пользователь не аутентифицирован, то 
        if ($this->_user === false) {
            $this->_user = UserIdentity::findByUsername($this->username);
        }

        return $this->_user;
    }
    
}
