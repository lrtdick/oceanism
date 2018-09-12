<?php

namespace services\controllers;

use services\filters\RbacFilter;
use services\models\Goods;
use yii\data\Pagination;
use Yii;

class GoodsController extends BaseController
{
    /*商品列表*/
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
        $columnList= Goods::getTableSchema()->columnNames;
        $models = Goods::SeachModelList($Search_condition,10,$columnList[0],'DESC');
        $this->data[ 'models']=$models['lists'];
        $this->data[ 'pager']=$models['pager'];
        $this->data[ 'search_condition']=$Search_condition;
        $this->data[ 'columnList']=$columnList;
        return $this->render($view,$this->data);


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

        $this->data['model']=$model;
        return $this->render('add',$this->data);
    }
    /*商品修改*/
    public function actionEdit($id){
        $model=Goods::findOne($id);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->created_time=time();
            $model->save();
            \Yii::$app->session->setFlash('info','商品修改成功');
            return $this->redirect(['goods/index']);
        }

        $this->data['model']=$model;
        return $this->render('add',$this->data);
    }

    /*商品删除为逻辑删除*/
    public function actionDel(){
        $model=Goods::findOne(\Yii::$app->request->get('id'));
        if($model){
            $model->status=0;
            $model->save();
            \Yii::$app->session->setFlash('success','删除成功(delete success)');
        }else{
            \Yii::$app->session->setFlash('success',"对不起您要删除的数据没有找到(sorry it's not found)");
        }
        return $this->redirect(['goods/index']);
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
