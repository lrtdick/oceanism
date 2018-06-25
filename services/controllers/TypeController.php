<?php
namespace services\controllers;

use services\filters\RbacFilter;
use services\models\Type;
use yii\data\Pagination;
use yii\web\Controller;

class TypeController extends BaseController{
    public function actionIndex(){
        //$rs = new FinanceSystem();
        $key = \Yii::$app->request->get('key');
        $rs = Type::find();
        $total = $rs->count();
        //每页显示条数 3
        $perPage = 6;
        //分页工具类
        $pager = new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$perPage
        ]);
        // var_dump($brands);exit;
        $models = $rs->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }

    public function actionAdd(){
        // var_dump(111);exit;
        $model = new Type();
        // $model->scenario=Admin::SCENARIO_ADD;//指定场景
        //  var_dump($model);exit;
        if($model->load(\Yii::$app->request->post()) && $model->validate() ){
            //验证数据
            //var_dump($model);exit;
            $model->save(false);//默认情况下 保存是会调用validate方法  有验证码是，需要关闭验证
            //添加成功保存提示信息到session中并跳转首页
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['type/index']);
        }
        return $this->render('add', ['model' => $model]);

    }

    public function actionEdit($id){
        $model = Type::findOne(['id'=>$id]);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->save();
            \Yii::$app->session->setFlash('success','修改成功');
            return  $this->redirect('index');

        }
        return $this->render('add',['model'=>$model]);
    }

    public function actionDel($id){
        $model = Type::findOne(['id'=>$id]);
        $model->delete();
        return $this->redirect(['type/index']);
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