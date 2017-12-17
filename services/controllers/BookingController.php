<?php

namespace services\controllers;

use services\models\Booking;
use yii\data\Pagination;

class BookingController extends \yii\web\Controller
{
    /*预定列表*/
    public function actionIndex()
    {
        /*分页条数10*/
        $query=Booking::find();
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    /*预定*/
    public function actionBooking(){
        $model=new Booking();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->userid=\Yii::$app->user->identity->getId();
            $model->Predetermined_time=time();
            $model->save();
            \Yii::$app->session->setFlash('success','预定成功(Predetermined success)');
            return "<script>window.history.go(-2);</script>";
        }
        return $this->render('booking',['model'=>$model]);
    }
    /*记录到店时间*/
    public function actionCheckin($id){
        $model=Booking::findOne($id);
        if($model){
            $model->checkin_time=time();
            $model->save();
            \Yii::$app->session->setFlash('success','贵宾'.$model->username.'到店时间记录成功('.$model->username.'to store time record success)');
        }else{
            \Yii::$app->session->setFlash('success',"对不起该数据没有找到(sorry it's not found)");
        }
        return "<script>window.history.go(-1);</script>";
    }
    /*记录离店时间*/
    public function actionCheckout($id){
        $model=Booking::findOne($id);
        if($model){
            $model->checkout_time=time();
            $model->save();
            \Yii::$app->session->setFlash('success','贵宾'.$model->username.'离店店时间记录成功('.$model->username.'to store time record success)');
        }else{
            \Yii::$app->session->setFlash('success',"对不起该数据没有找到(sorry it's not found)");
        }
        return "<script>window.history.go(-1);</script>";
    }
    /*删除一条预订记录*/
    public function actionDel(){
        $model=Booking::findOne(\Yii::$app->request->get('id'));
        if($model){
            $model->delete();
            \Yii::$app->session->setFlash('success','删除成功(delete success)');
        }else{
            \Yii::$app->session->setFlash('success',"对不起您要删除的数据没有找到(sorry it's not found)");
        }
        return "<script>window.history.go(-1);</script>";
    }
}
