<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\Admin;
use services\models\BookingRecord;
use services\models\BookingGoods;
use yii\data\Pagination;
use Yii;
class BookingRecordController extends BaseController
{
    /*预定列表*/
    public function actionIndex()
    {
        //固定部分
        $view= Yii::$app->controller->action->id;

//        var_dump($view);exit();

        $Search_condition=[
            'search_key'=>\Yii::$app->request->get("search_key"),
            'search_value'=>trim(\Yii::$app->request->get("search_value")),
            'search_start'=>\Yii::$app->request->get('search_start'),
            'search_end'=>\Yii::$app->request->get('search_end'),
        ];
        $columnList= BookingRecord::getTableSchema()->columnNames;
        $models = BookingRecord::SeachModelList($Search_condition,5,$columnList[0],'DESC');


        $this->data[ 'models']=$models['lists'];
        $this->data[ 'pager']=$models['pager'];
        $this->data[ 'search_condition']=$Search_condition;
        $this->data[ 'columnList']=$columnList;
        return $this->render($view,$this->data);
    }

    /*代理商预定列表*/
    public function actionAgentIndex(){
        //固定部分
        $view= Yii::$app->controller->action->id;

//        var_dump($view);exit();

        $Search_condition=[
            'search_key'=>\Yii::$app->request->get("search_key"),
            'search_value'=>trim(\Yii::$app->request->get("search_value")),
            'search_start'=>\Yii::$app->request->get('search_start'),
            'search_end'=>\Yii::$app->request->get('search_end'),
        ];

        $user_id=\Yii::$app->user->identity->getId();//代理商id 测试不填 登录做完再填

        $columnList= BookingRecord::getTableSchema()->columnNames;
        $models = BookingRecord::SeachAgentBoookingRecordList($Search_condition,5,$columnList[0],'DESC');

        $this->data[ 'models']=$models['lists'];
        $this->data[ 'pager']=$models['pager'];
        $this->data[ 'search_condition']=$Search_condition;
        $this->data[ 'columnList']=$columnList;
        return $this->render($view,$this->data);

    }

    /*客服预定*/
    public function actionAdd(){

        $model=new BookingRecord();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
//            var_dump($model);exit();
            $model->user_id=\Yii::$app->user->identity->getId();//代理商id 测试不填 登录做完再填
            $model->booking_time=time();
            $model->plan_checkin_time=strtotime($model->plan_checkin_time);
            $model->plan_checkout_time=strtotime($model->plan_checkout_time);
            $model->status=1;
            $model->save(false);
            //其他属性都load
            \Yii::$app->session->setFlash('success','预定成功(Predetermined success)');
            return $this->redirect(['booking-record/index']);
        }
//        var_dump($model);exit();
        $view= Yii::$app->controller->action->id;
        $this->data['model']=$model;
        return $this->render($view,$this->data);

    }


    /*代理商预定*/
    public function actionAgentAdd(){
        $model=new BookingRecord();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->user_id=\Yii::$app->user->identity->getId();//代理商id 测试不填 登录做完再填
            $model->booking_time=time();
            $model->plan_checkin_time=strtotime($model->plan_checkin_time);
            $model->plan_checkout_time=strtotime($model->plan_checkout_time);
            $model->status=1;
            $model->save(false);
            \Yii::$app->session->setFlash('success','预定成功(Predetermined success)');
            return "<script>window.history.go(-2);</script>";

        }

        $view= Yii::$app->controller->action->id;
        $this->data['model']=$model;
        return $this->render($view,$this->data);
    }

    /*记录到店时间*/
    public function actionCheckin($id){
        $model=BookingRecord::findOne($id);
        if($model){
            $model->checkin_time=time();
            //            到店状态2
            $model->status=2;
            $model->save(false);


            \Yii::$app->session->setFlash('success','贵宾'.$model->name.'到店时间记录成功('.$model->name.'checkin success!)');
        }else{
            \Yii::$app->session->setFlash('success',"对不起该数据没有找到(sorry it's not found)");
        }
        return "<script>window.history.go(-1);</script>";
    }

    /*删除一条预订记录*/
    public function actionDel(){
        $model=BookingRecord::findOne(['id'=>\Yii::$app->request->get('id')]);
        if($model){
//            删除状态0
            $model->status=0;
            $model->save(false);
            \Yii::$app->session->setFlash('success','删除成功(delete success)');
        }else{
            \Yii::$app->session->setFlash('success',"对不起您要删除的数据没有找到(sorry it's not found)");
        }
        return "<script>window.history.go(-1);</script>";
    }


    /*取消预订单*/
    public function actionCancel($id){

        $booking=BookingRecord::findOne($id);
        if($booking){
            $booking->state=4;

            $booking->save(false);
//            商品也取消
            BookingGoods::updateAll(['status'=>3],['order_id'=>$id]);
            \Yii::$app->session->setFlash('success','订单取消成功');
        }else{
            \Yii::$app->session->setFlash('danger','订单取消失败');
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
