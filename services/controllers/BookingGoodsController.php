<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\BookingRecord;
use services\models\BookingGoods;
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

    /*客服查看所有预定商品*/
    public function actionBookingGoodsIndex(){
        /*分页条数10*/
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


    /*商品预定 done*/
    public function actionAdd($order_id){
        //固定部分
        $view= Yii::$app->controller->action->id;


        $model=new BookingGoods();
        $request=\Yii::$app->request;
        $model->order_id=$order_id;
        if($request->post()){
            $goods_name=$request->post('goods_name');
            $goods_amount=$request->post('goods_amount');
            $cny=$request->post('cny');
            $peso=$request->post('peso');
            $goods_id=$request->post('id');
            $user_id=\Yii::$app->user->identity->getId();
            if($goods_name && $goods_amount && isset($cny) && isset($peso) && $goods_id && $user_id){
                foreach($goods_name as $k=>$name){
                    $goods=clone $model;
                    $goods->user_id=$user_id;
                    $goods->goods_name=$name;
                    $goods->goods_amount=$goods_amount[$k];
                    $goods->goods_id=$goods_id[$k];
                    $goods->cny=$cny[$k];
                    $goods->peso=$peso[$k];
                    $goods->cny_total=$cny[$k]*$goods_amount[$k];
                    $goods->peso_total=$peso[$k]*$goods_amount[$k];
                    $goods->booking_time=time();
                    $goods->status=1;

                    $goods->save(false);
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




    /*代理商预定商品列表*/
    public function actionAgentBookingGoodsList($id){
        /*分页条数10*/
        $query=BookingGoods::find()->where(['pid'=>$id]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->orderBy('id desc')->all();
        return $this->render('agent_booking_goods_list',['models'=>$models,'pager'=>$pager,'id'=>$id]);
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


    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'only'=>[
                    'index',
                    'agent-index',
                    'add',
                    'agent-add',
                    'checkin',
                    'del',
                    'cancel',
                    'del',
                ],
            ]
        ];
    }

}
