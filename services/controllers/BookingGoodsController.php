<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\BookingRecord;
use services\models\BookingGoods;
use services\models\Goods;
use Yii;
use yii\data\Pagination;

class BookingGoodsController extends BaseController
{

    /*客服查看订单预定商品详情done*/
    public function actionIndex($order_id){
        //固定部分
        $view= Yii::$app->controller->action->id;


        $query=BookingGoods::find()->where(['order_id'=>$order_id]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->orderBy('id desc')->all();
        $this->data[ 'order_id']=$order_id;
        $this->data[ 'models']=$models;

        $this->data[ 'pager']=$pager;

//                var_dump($view);exit();
        return $this->render($view,$this->data);
    }

    /*代理预定商品列表*/
    public function actionAgentIndex($order_id){
        //固定部分
        $view= Yii::$app->controller->action->id;


        $query=BookingGoods::find()->where(['order_id'=>$order_id]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->orderBy('id desc')->all();
        $this->data[ 'order_id']=$order_id;
        $this->data[ 'models']=$models;

        $this->data[ 'pager']=$pager;

        //                var_dump($view);exit();
        return $this->render($view,$this->data);
    }




    /*商品预定 done*/
    public function actionAdd($order_id){
        //固定部分
        $view= Yii::$app->controller->action->id;

        $model=new BookingGoods();
        $request=\Yii::$app->request;
        if($request->post()){
           /* var_dump($request->post());
                exit();*/
            $goods_amount=$request->post('goods_amount');
            $goods_id=$request->post('id');
//            $this->dd($request->post());

            $user_id=\Yii::$app->user->identity->getId();
            if(  $user_id
                &&count($goods_id)>0
                &&count($goods_amount)>0
                && count($goods_id)==count($goods_amount)
            ){
                foreach($goods_id as $k=>$good_id){
                    $bookingGoodsModel=new BookingGoods();
                    $bookingGoodsModel->order_id=$order_id;
                    $goodInfo=Goods::findOne(['id'=>$good_id]);
                    $bookingGoodsModel->user_id=$user_id;
                    $bookingGoodsModel->goods_id=$good_id;
                    $bookingGoodsModel->goods_name=$goodInfo->goods_name;
                    $bookingGoodsModel->goods_amount=$goods_amount[$k];
                    $bookingGoodsModel->cny=$goodInfo->price_cny;
                    $bookingGoodsModel->peso=$goodInfo->price_peso;
                    $bookingGoodsModel->cny_total= $goodInfo->price_cny*$goods_amount[$k];
                    $bookingGoodsModel->peso_total=$goodInfo->price_peso*$goods_amount[$k];
                    $bookingGoodsModel->booking_time=time();
                    $bookingGoodsModel->status=1;
                    $bookingGoodsModel->save(false);
                }
                \Yii::$app->session->setFlash('success','商品预定成功');
                return "<script>window.history.go(-2);</script>";
            }else{
                \Yii::$app->session->setFlash('danger','请填写完整数据后提交');
                return "<script>window.history.go(-1);</script>";
            }
        }
        return $this->render($view,['model'=>$model]);
    }


    /*商品预定 done*/
    public function actionAgentAdd($order_id){
        //固定部分
        $view= Yii::$app->controller->action->id;

        $model=new BookingGoods();
        $request=\Yii::$app->request;
        if($request->post()){
            /* var_dump($request->post());
                 exit();*/
            $goods_amount=$request->post('goods_amount');
            $goods_id=$request->post('id');
//            $this->dd($request->post());

            $user_id=\Yii::$app->user->identity->getId();
            if(  $user_id
                &&count($goods_id)>0
                &&count($goods_amount)>0
                && count($goods_id)==count($goods_amount)
            ){
                foreach($goods_id as $k=>$good_id){
                    $bookingGoodsModel=new BookingGoods();
                    $bookingGoodsModel->order_id=$order_id;
                    $goodInfo=Goods::findOne(['id'=>$good_id]);
                    $bookingGoodsModel->user_id=$user_id;
                    $bookingGoodsModel->goods_id=$good_id;
                    $bookingGoodsModel->goods_name=$goodInfo->goods_name;
                    $bookingGoodsModel->goods_amount=$goods_amount[$k];
                    $bookingGoodsModel->cny=$goodInfo->price_agent_cny;
                    $bookingGoodsModel->peso=$goodInfo->price_agent_peso;
                    $bookingGoodsModel->cny_total= $goodInfo->price_agent_cny*$goods_amount[$k];
                    $bookingGoodsModel->peso_total=$goodInfo->price_agent_peso*$goods_amount[$k];
                    $bookingGoodsModel->booking_time=time();
                    $bookingGoodsModel->status=1;
                    $bookingGoodsModel->save(false);
                }
                \Yii::$app->session->setFlash('success','商品预定成功');
                return "<script>window.history.go(-2);</script>";
            }else{
                \Yii::$app->session->setFlash('danger','请填写完整数据后提交');
                return "<script>window.history.go(-1);</script>";
            }
        }
        return $this->render($view,['model'=>$model]);
    }


    /*取消预定商品done*/
    public function actionCancel($id){
        $good=BookingGoods::findOne(['id'=>$id]);
        if($good){
            $good->status=3;
            $good->save(false);
            \Yii::$app->session->setFlash('success','商品'.$good->goods_name.'取消成功');
        }else{
            \Yii::$app->session->setFlash('danger','商品'.$good->goods_name.'取消失败');
        }
        return "<script>window.history.go(-1);</script>";
    }

    /*客服查看所有预定商品*/
    public function actionBookingGoodsIndex(){
        /*分页条数10*/
        return 'actionBookingGoodsIndex';
        $query=BookingGoods::find();
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->orderBy('id desc')->all();
        return $this->render('booking_goods_index',['models'=>$models,'pager'=>$pager]);
    }

    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'only'=>[
                    'index',
                    'agent-index',
                    'add',
//                    'agent-add',
                    'checkin',
                    'cancel',
                    'del',
                ],
            ]
        ];
    }

}
