<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/4
 * Time: 14:40
 */

namespace services\controllers;


use services\filters\RbacFilter;
use yii\web\Controller;

class IndexController extends BaseController
{   public $layout=false;
    public function actionIndex(){
        if(\Yii::$app->user->isGuest){


            return $this->redirect(['admin/login']);
        }


        $buttons=$this->BaseButton['zh'];

        return $this->render('index',
            [
                'buttons'=>$buttons,
            ]
        );


    }
}