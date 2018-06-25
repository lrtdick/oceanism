<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\Booking;
use services\models\BookingGoods;
use services\models\FinanceSystem;
use services\models\Record;
use yii\db\Exception;

class SettleAccountsController extends BaseController
{
    /*后台管理员结账有打折权限客服结账无打折权限*/
    public function actionAdminCheck(){
        $cny=0;//消费人民币
        $peso=0;//消费比索
        $request=\Yii::$app->request;
        $id=$request->post('id');
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $booking=Booking::findOne(['id'=>$id]);

            $records=Record::find()->where(['pid'=>$id])->andWhere(['state'=>0])->andWhere(['status'=>1])->all();
            if($records){
                foreach($records as $record){
                    $cny+=$record->cny;
                    $peso+=$record->peso;
                }
            }
            /*消费总金额减去定金*/
            if($booking){
                $cny=$cny+$booking->deposit_cny;
                $peso=$peso+$booking->deposit_cny;
            }
            /*结账时打折后传过来的peso*/
            if($request->post('peso')){
                $peso=$request->post('peso');
            }
            /*结账时打折后传过来的人民币*/
            if($request->post('cny')){
                $cny=$request->post('cny');
            }
            /*记录结账时间即离店时间*/
            if($booking){
                $booking->checkout_time=time();
                $booking->save(false);
            }
            /*空白处填写入账的金额就是$cny和$peso*/
            $system=new FinanceSystem();
            $system->peso=$peso;
            $system->rmb=$cny;
            $system->ctime=time();
            $system->collect='客人结账';
            $system->comment='护照号为'.$booking->passport.'的'.$booking->username.'客人结账';
            $system->save();
            /*预定单预定商品消费记录修改为已结账*/
            Booking::updateAll(['state'=>2],['id'=>$id]);
            BookingGoods::updateAll(['state'=>1],['pid'=>$id,'state'=>0]);
            Record::updateAll(['state'=>1],['pid'=>$id]);
            $transaction->commit();
            \Yii::$app->session->setFlash('success','客人结账成功');
            return $this->redirect(['booking/index']);
        }catch(Exception $e) {
            $transaction->rollBack();
            \Yii::$app->session->setFlash('danger','客人结账失败');
            return "<script>window.history.go(-1);</script>";
        }
    }
    /*客人结账页面*/
    public function actionIndex($id){
        $bookings=Booking::find()->where(['state'=>1,'id'=>$id])->one();
        $records=Record::find()->where(['pid'=>$id])->andWhere(['state'=>0])->andWhere(['status'=>1])->orderBy('id desc')->all();
        $goods=BookingGoods::find()->where(['pid'=>$id])->andWhere(['state'=>0])->orderBy('id desc')->all();
        return $this->render('member_check',['goods'=>$goods,'records'=>$records,'bookings'=>$bookings,'id'=>$id]);
    }
    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'only'=>['service-check','admin-check','index'],
            ]
        ];
    }

}
