<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use yii\data\Pagination;

// Подключаем модель форму для валидации данных 
use app\models\UserForm;
// Подключаем модель класс для манипулирования таблицой users
use app\models\Users;
// Подключаем модель класс для манипулирования таблицой messages
use app\models\Messages;
use app\models\MessagesForm;
use yii\web\User;

class SiteController extends Controller
{

    public $post_data;
    public $get_data;
    public $session;
    public $message;
    public $param;
    public $is_auth;

    public function beforeAction($action)
    {
        $this->session = Yii::$app->session;
        $this->post_data = Yii::$app->request->post();
        $this->get_data = Yii::$app->request->get();
        $this->param = Yii::$app->params;
        $this->is_auth = !Yii::$app->user->isGuest;
        return true;
    }


    public function actionIndex()
    {
        $query = Messages::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count()
        ]);

        $messages = $query->orderBy(['created_at' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $model = new MessagesForm();
        return $this->render('index', [
            "messages" => $messages,
            "pagination" => $pagination,
            'is_auth' => $this->is_auth,
            'user_id' => Yii::$app->user->identity->id,
            'username' => Users::findOne(Yii::$app->user->identity->id)->username,
            'model' => ($this->is_auth) ? $model : null
        ]);
    }


    public function actionAddcomment()
    {
        $model = new MessagesForm();
        if ($this->is_auth) {
            if ($model->load($this->post_data) && $model->validate()) {
                $message = new Messages();
                if ($message->addMessage($model)) {
                    $this->setInfoMessage("warning", $this->getMsg("message_add"));
                    $this->redirect(["/"]);
                }
            }
        }
    }


    function Insert($obj)
    {
        if ($obj->save()) return true;
        else return false;
    }

    public function actionReg()
    {
        // Создаем объект модели формы регистрации
        $model = new UserForm(['scenario' => UserForm::SCENARIO_REGISTER]);
        $result = false;
        // Выводим шаблон reg.php и передаем объект модели формы в шаблон reg.php.
        // В шаблоне reg.php модель формы будет доступна как переменная с именем model
        //Загружаем и проверяем данные 
        if ($model->load($this->post_data) && $model->validate()) {
            // Создаем объект модели Users
            $user = new Users();
            if ($user->addUser($model)) {
                $data = [
                    'template' => 'reg',
                    'subject' => 'Успешная регистрация!',
                    'from_email' => $this->param["adminEmail"],
                    'to_email' => $model->email,
                    'params' => [
                        'username' => $model->username,
                        'sitename' => $this->param["siteName"],
                        'password' => $model->password,
                    ]
                ];

                $this->sendEmail($data);
                $this->setInfoMessage("success", $this->getMsg("reg"));
                $this->redirect(["/login"]);
            }
        }
        return $this->render('reg', [
            'model' => $model,
            'message' => $message,
            'result' => $result
        ]);
    }

    public function actionError()
    {
        echo "Unknown Error";
    }

    public function actionLogin()
    {
        $error = false;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if($this->post_data){
            if ($model->load($this->post_data) && $model->login()) return $this->goHome();
            else $this->setInfoMessage("danger", $this->getMsg("auth"));
        }
        return $this->render('login', [
            'model' => $model,
            'error' => $error
        ]);
    }

    public function actionProfile()
    {
        $userData = $this->post_data["UserForm"];
        $model = new UserForm(['scenario' => UserForm::SCENARIO_CHANGEPROFILE]);
        /*SELECT * FROM  `users` WHERE id = Yii::$app->user->identity->id)*/
        $user = Users::findOne(Yii::$app->user->identity->id);
        if ($model->load($this->post_data) && $model->validate()) {
            $user = Users::findOne(Yii::$app->user->identity->id);
            $user->username = $model->username;
            $user->email = $model->email;
            $user->role_id = $this->post_data["UserForm"]["roles"];
            if ($_FILES["UserForm"]["name"]["avatar"]) {
                $model->avatar = UploadedFile::getInstance($model, 'avatar');
                $model->avatar->saveAs("avatars/" . $model->avatar->baseName . "." . $model->avatar->extension);
                $user->avatar = $model->avatar->baseName . "." . $model->avatar->extension;
            }
            if ($userData["password"]) $user->password = md5($model->password);

            $result = $this->Insert($user);

            if ($result) {
                $this->setInfoMessage("warning", $this->getMsg("profile"));
                return $this->redirect(["/"]);
            }
        }

        return $this->render('profile',[
                'user' => $user,
                'model' => $model,
                'userRoleId' => Yii::$app->user->identity->role_id
            ]);
     }        


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionDelete($id){
       $message = Messages::findOne($id);
       $result = $message->delete();
       if($result) {                 
            $this->setInfoMessage("warning",$this->getMsg("message_delete"));
            $this->redirect(["/"]);
       }

    }

    public function actionChange($id){
        $model = new MessagesForm();
        $result = false;
        $old_comment = Messages::findOne($id);
        if($model->load($this->post_data) && $model->validate()){
            $old_comment->message = $model->comment;
            $old_comment->created_at = time();
            $result = $this->Insert($old_comment);
            if($result) {
                $this->redirect(["/"]);
                $this->setInfoMessage("warning",$this->getMsg("message_change"));
            }
        }
        return $this->render('change',[
            'model' => $model,
            'old_comment' => $old_comment->message
        ]);
    }

    private function setInfoMessage($color,$message){
        $this->session->set("infoMessage",['color' =>$color,'message' => $message]);
    }

    private function getMsg($key){
        return $this->param["infoMessages"][$key]; 
    }

    private function sendEmail($data){
            return Yii::$app->mailer->compose($data["template"],["params" => $data["params"]])
            ->setFrom($data["from_email"])
            ->setTo($data["to_email"])
            ->setSubject($data["subject"]."  ".Yii::$app->name)
            ->send();
     }


    
}
