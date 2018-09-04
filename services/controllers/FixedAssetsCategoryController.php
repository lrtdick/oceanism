<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\CategoryGoods;
use services\models\FixedAssetsCategory;
use services\models\Goods;
use yii\data\Pagination;

class FixedAssetsCategoryController extends BaseController
{
    /*固定资产分类列表*/
    public function actionIndex()
    {
        /*分页条数10*/
        $query=FixedAssetsCategory::find()->where(['state'=>1]);
        $total=$query->count();
        $pageSize=10;
        $pager=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$pageSize
        ]);
        $models=$query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    /*商品分类添加*/
    public function actionAdd(){
        $model=new FixedAssetsCategory();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->created_time=time();
            $model->save();
            \Yii::$app->session->setFlash('success','固定资产分类添加成功(success)');
            return $this->redirect(['fixed-assets-category/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    /*修改商品分类*/
    public function actionEdit($id){
        $model=FixedAssetsCategory::findOne($id);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->save();
            \Yii::$app->session->setFlash('success','固定资产分类修改成功(success)');
            return $this->redirect(['fixed-assets-category/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    /*商品分类删除*/
    public function actionDel(){
        $model=FixedAssetsCategory::findOne(\Yii::$app->request->get('id'));
        if($model){
            $goods=Goods::findAll(['category_id'=>$model->id]);
            if($goods){
                \Yii::$app->session->setFlash('danger','该分类下面有商品！不能删除(delete failed)');
            }else{
                $model->state=0;
                $model->save();
                \Yii::$app->session->setFlash('success','删除成功(delete success)');
            }
        }else{
            \Yii::$app->session->setFlash('success',"对不起您要删除的数据没有找到(sorry it's not found)");
        }
        return $this->redirect(['fixed-assets-category/index']);
    }
    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'only'=>['add','index','edit','del'],
            ]
        ];
    }
}
