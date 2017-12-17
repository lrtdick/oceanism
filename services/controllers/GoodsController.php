<?php

namespace services\controllers;

use services\models\Goods;
use yii\data\Pagination;

class GoodsController extends \yii\web\Controller
{
    /*商品列表*/
    public function actionIndex()
    {
        /*分页条数10*/
        $query=Goods::find();
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    /*商品添加*/
    public function actionAdd(){
        $model=new Goods();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->created_time=time();
            $model->save();
            \Yii::$app->session->setFlash('success','商品添加成功');
            return $this->redirect(['goods/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    /*商品修改*/
    public function actionEdit($id){
        $model=Goods::findOne($id);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->userid=\Yii::$app->user->identity->getId();
            $model->Predetermined_time=time();
            $model->save();
            \Yii::$app->session->setFlash('info','商品修改成功');
            return $this->redirect(['goods/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    /*商品删除为逻辑删除*/
    public function actionDel(){
        $model=Goods::findOne(\Yii::$app->request->get('id'));
        if($model){
            $model->state=0;
            $model->save();
            \Yii::$app->session->setFlash('success','删除成功(delete success)');
        }else{
            \Yii::$app->session->setFlash('success',"对不起您要删除的数据没有找到(sorry it's not found)");
        }
        return $this->redirect(['goods/index']);
    }
}
