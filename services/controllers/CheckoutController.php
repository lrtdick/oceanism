<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\Booking;
use services\models\BookingGoods;
use services\models\BookingRecord;
use services\models\CustomerSpendingRecord;
use services\models\FinanceSystem;
use services\models\Record;
use yii\db\Exception;

class CheckoutController extends BaseController
{
    /*客人结账页面*/
    public function actionIndex($id){
//        预定记录状态要为2 或者3已结账
        $bookings=BookingRecord::find()->where(['status'=>2,'id'=>$id])->orWhere(['status'=>3,'id'=>$id])->one();
//        $this->dd($bookings);
//        预定时商品记录 0 为删除1未结账2为已结账 3取消
        $goods=BookingGoods::find()->where(['order_id'=>$id,'status'=>1])->orWhere(['status'=>2,'order_id'=>$id])->orderBy('id desc')->all();

        //        到店消费记录1未结账的  0已删除的 1未结账的 2已结账
        $records=CustomerSpendingRecord::find()->where(['order_id'=>$id,'status'=>1])->orWhere(['order_id'=>$id,'status'=>2])->orderBy('id desc')->all();

//        $this->dd($records);
        return $this->render('member_check',['goods'=>$goods,'records'=>$records,'bookings'=>$bookings,'id'=>$id]);
    }

    /*后台管理员结账有打折权限客服结账无打折权限*/
    public function actionAdminCheck(){
        $cny=0;//消费人民币
        $peso=0;//消费比索
        $request=\Yii::$app->request;
        $id=$request->post('id');
        $transaction = \Yii::$app->db->beginTransaction();
        try{
        $bookings=BookingRecord::find()->where(['status'=>2,'id'=>$id])->one();

//        预定时商品记录 0 为删除1未结账2为已结账 3取消
        $goods=BookingGoods::find()->where(['order_id'=>$id])->andWhere(['status'=>1])->orderBy('id desc')->all();

        //        到店消费记录1未结账的  0已删除的 1未结账的 2已结账
        $records=CustomerSpendingRecord::find()->where(['order_id'=>$id])->andWhere(['status'=>1])->orderBy('id desc')->all();


        //预定商品结账
            //总到店消费
            if($goods){
                foreach($goods as $good){
                    if($good->status=1){
                        $good->status=2;
                        $good->save();
                    }
                }
            }

            //总到店消费
            if($records){
                foreach($records as $record){
                    $cny+=$record->cny;
                    $peso+=$record->peso;
                    $record->status=2;
                    $record->save();
                }
            }
            /*总到店消费+到店付定金*/
            if($bookings){
                $cny=$cny+$bookings->deposit_cny;
                $peso=$peso+$bookings->deposit_cny;
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
            if($bookings){
                $bookings->checkout_time=time();
                $bookings->status=3;
                $bookings->save(false);
            }
            /*空白处填写入账的金额就是$cny和$peso*/
            $system=new FinanceSystem();
            $system->peso=$peso;
            $system->rmb=$cny;
            $system->ctime=time();
            $system->collect='客人结账';
            $system->comment='护照号为'.$bookings->passport.'的'.$bookings->name.'客人结账';
            $system->save();

            $transaction->commit();
            \Yii::$app->session->setFlash('success','客人结账成功');
            return $this->redirect(['booking-record/index']);
        }catch(Exception $e) {
            $transaction->rollBack();
            \Yii::$app->session->setFlash('danger','客人结账失败');
            return "<script>window.history.go(-1);</script>";
        }
    }

    /**
     * 过滤器
     * @return array
     */
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
