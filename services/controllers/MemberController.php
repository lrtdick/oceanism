<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\Booking;
use services\models\Member;
use yii\data\Pagination;

class MemberController extends BaseController
{
    /*客服端展示所有客人信息*/
    public function actionIndex()
    {
        /*分页条数10*/
        $query=Member::find();
        $total=$query->count();
        $pageSize=13;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    /*代理商获取自己的客人信息*/
    public function actionAgent(){
        $id=\Yii::$app->user->identity->getId();
        $bookings=Booking::find()->where(['userid'=>$id])->orderBy('id desc')->all();
        $members=[];
        if($bookings){
            foreach($bookings as $k=>$booking){
                $member=Member::find()->where(['tel'=>$booking->tel])->one();
                $members[$k]=$member;
            }
        }
        return $this->render('agent',['models'=>$members]);
    }
    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'only'=>['index','agent'],
            ]
        ];
    }
}
