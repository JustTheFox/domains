<?php

namespace app\modules\admin\controllers;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
   	public $layout = "main";
    public $baseUrl = '\web';

   	public function beforeAction($action){
   		if(!Yii::$app->user->isGuest){
   			if(Yii::$app->user->identity->username != Yii::$app->params["adminName"]) return $this->redirect("/");
        else return true;
   		}
      return  $this->redirect("/");
   	}



   	public function actionIndex(){
        return $this->render('index',[
        ]);
   	}

    private function getWord($number, $words) 
  {
    $keys = array(2, 0, 1, 1, 1, 2);
    $mod = $number % 100;
    $word_key = ($mod > 7 && $mod < 20)? 2: $keys[min($mod % 10, 5)];
    return $words[$word_key];
  }

}
