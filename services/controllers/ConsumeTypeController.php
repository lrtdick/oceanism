<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\ConsumeType;
use yii\data\Pagination;

class ConsumeTypeController extends BaseController
{
    /*消费类型列表*/
    public function actionIndex()
    {
        /*分页条数10*/
        $query=ConsumeType::find()->where(['state'=>1]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    /*消费类型的添加*/
    public function actionAdd(){
        $model=new ConsumeType();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->created_time=time();
            $model->save();
            \Yii::$app->session->setFlash('success','消费类型添加(create consume type success)');
            return $this->redirect(['consume-type/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    /*消费类型的修改*/
    public function actionEdit($id){
        $model=ConsumeType::findOne($id);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->save();
            \Yii::$app->session->setFlash('success','消费修改成功(edit consume type success)');
            return $this->redirect(['consume-type/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    /*消费类型的禁用*/
    public function actionStatus($id){
        $model=ConsumeType::findOne($id);
        if($model){
            if($model->status==1){
                $model->status=0;
                $model->save();
                \Yii::$app->session->setFlash('success','禁用成功(ban success)');
            }else{
                $model->status=1;
                $model->save();
                \Yii::$app->session->setFlash('success','启用(using success)');
            }
        }else{
            \Yii::$app->session->setFlash('danger',"对不起您要禁用获取启用的数据没有找到(sorry it's not found)");
        }
        return "<script>window.history.go(-1);</script>";
    }
    /*消费类型的删除*/
    public function actionDel(){
        $model=ConsumeType::findOne(\Yii::$app->request->get('id'));
        if($model){
            $model->state=0;
            $model->save();
            \Yii::$app->session->setFlash('success','删除成功(delete success)');
        }else{
            \Yii::$app->session->setFlash('success',"对不起您要删除的数据没有找到(sorry it's not found)");
        }
        return $this->redirect(['consume-type/index']);
    }
    /*public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'only'=>['add','index','edit','del'],
            ]
        ];
    }*/
}
