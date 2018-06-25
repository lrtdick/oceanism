<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\Record;
use yii\data\Pagination;

class RecordController extends BaseController
{
    /*客服查看某个用户的消费记录*/
    public function actionIndex($order_id)
    {

        /*分页条数10*/
        $query=Record::find()->where(['order_id'=>$order_id]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager,'order_id'=>$order_id]);
    }
    /*客服添加某个人的消费记录*/
    public function actionAdd($order_id){
        $model=new Record();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            
            $model->admin_id=\Yii::$app->user->getId();
            $model->order_id=$order_id;
            $model->created_time=time();
            $model->save();
            \Yii::$app->session->setFlash('success','记录成功');
            return "<script>window.history.go(-2);</script>";
        }
        return $this->render('add',['model'=>$model]);
    }
    /*代理商查看某个用户的消费记录*/
    public function actionAgentList($order_id)
    {
        /*分页条数10*/
        $query=Record::find()->where(['pid'=>$order_id,'status'=>1]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('agent_index',['models'=>$models,'pager'=>$pager]);
    }

    /*查看所有的消费记录*/
    public function actionIndexAll()
    {
        /*分页条数10*/
        $query=Record::find()->where(['status'=>1]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->orderBy('id desc')->all();
        return $this->render('index_all',['models'=>$models,'pager'=>$pager]);
    }
    /*删除一条消费记录*/
    public function actionDel(){
        $record=Record::findOne(['id'=>\Yii::$app->request->get('id')]);
        if($record){
            $record->status=0;
            $record->save();
            \Yii::$app->session->setFlash('success','成功删除一条消费记录');
        }else{
            \Yii::$app->session->setFlash('danger','消费记录删除失败');
        }
        return "<script>window.history.go(-1);</script>";
    }
    /*单独添加一条消费记录*/
    public function actionAddOne(){
        $model=new Record();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->rid=\Yii::$app->user->getId();
            $model->created_time=time();
            $model->save();
            \Yii::$app->session->setFlash('success','记录成功');
            return "<script>window.history.go(-2);</script>";
        }
        return $this->render('add_one',['model'=>$model]);
    }
    /*代理商下的客人消费记录*/
    public function actionAgentIndex(){
        $userid=\Yii::$app->user->identity->getId();
        /*分页条数10*/
        $query=Record::find()->where(['status'=>1,'rid'=>$userid]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->orderBy('id desc')->all();
        return $this->render('index_one',['models'=>$models,'pager'=>$pager]);
    }
    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'only'=>['add','index','agent-list','agent-add','index-all','del','add-one','agent-index'],
            ]
        ];
    }
}
