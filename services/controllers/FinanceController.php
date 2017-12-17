<?php
namespace services\controllers;



use services\models\FinanceSystem;
use yii\web\Controller;
use yii\data\Pagination;



class FinanceController extends Controller {
	
	public function actionFinanceIndex(){
	    //$rs = new FinanceSystem();
//        $key = \Yii::$app->request->get('key');
        $key='';
        $rs = FinanceSystem::find();
        if(\Yii::$app->request->get('key')){
            $rs->where(['collect'=>\Yii::$app->request->get('key')]);
            $key=\Yii::$app->request->get('key');
        }
        $total = $rs->count();
        $type='';
        //每页显示条数 3
        $perPage = 6;
        //分页工具类
        $pager = new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$perPage
        ]);
        // var_dump($brands);exit;
        $models = $rs->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager,'type'=>$type,'key'=>$key]);
	}

	public function actionAdd(){
	   // var_dump(111);exit;
        $model = new FinanceSystem();
       // $model->scenario=Admin::SCENARIO_ADD;//指定场景
      //  var_dump($model);exit;
        if($model->load(\Yii::$app->request->post()) && $model->validate() ){
            //验证数据
            //var_dump($model);exit;
            $model['ctime'] = time();
            $model->save(false);//默认情况下 保存是会调用validate方法  有验证码是，需要关闭验证
            //添加成功保存提示信息到session中并跳转首页
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['finance/finance-index']);
        }
        return $this->render('add', ['model' => $model]);

    }
	
	public function actionEdit($id){
		 $model = FinanceSystem::findOne(['id'=>$id]);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
				$model['utime'] = time();
                $model->save();
               \Yii::$app->session->setFlash('success','修改成功');
                return  $this->redirect('index');
            
        }
        return $this->render('add',['model'=>$model]);
	}
	
	public function actionDel($id){
		 $model = FinanceSystem::findOne(['id'=>$id]);
         $model->delete();
        return $this->redirect(['finance/finance-index']);
	}
	
	
	public function actionFinanceIndexa(){
		echo 1;
	}
	//获取数据
    public function actionAjax(){

       // var_dump($_GET['key']);exit;
        $key = \Yii::$app->request->get('key');
      //  echo $key;exit;
	    //查那个表  wp_finance_system
        $article =FinanceSystem::find()->where(['collect'=>$key])->all();
       // 这个key就是搜索条件  一样的where
      // $model->where($where)->order('ts_order_topup.update_time DESC,ts_order_topup.ordertime DESC')->findPage(20);
        return $this->render('index',['article'=>$article]);
    }

}
