<?php
namespace services\controllers;



use services\models\FinanceSystem;
use services\models\Transfer;
use yii\web\Controller;
use yii\data\Pagination;


class TransferController extends \yii\web\Controller{
	
	public function actionIndex(){
		
		//$rs = new FinanceSystem();
        $rs = Transfer::find();
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
        return $this->render('index',['models'=>$models,'pager'=>$pager,'type'=>$type]);
	}
	
	public function actionAdd(){
		$model = new Transfer();
		if($model->load(\Yii::$app->request->post() ) && $model->validate()){
            //验证数据
            //var_dump($model);exit;
            $model['ctime'] = time();
            $model->save(false);//默认情况下 保存是会调用validate方法  有验证码是，需要关闭验证
            //添加成功保存提示信息到session中并跳转首页
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['tranfer/index']);
        }
        return $this->render('add',['model'=>$model]);
	}
	
	public function actionEdit($id){
		 $model = Transfer::findOne(['id'=>$id]);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
				$model['utime'] = time();
                $model->save();
               \Yii::$app->session->setFlash('success','修改成功');
                return  $this->redirect('index');
            
        }
        return $this->render('add',['model'=>$model]);
	}
	
	public function actionDel($id){
		 $model = Transfer::findOne(['id'=>$id]);
         $model->delete();
        return $this->redirect(['transfer/index']);
	}

//实时资产
	public function actionProperty(){
	    //echo  111;exit;
        //select *, sum(rmb) as sumMoney from wp_finance_system
      $rmb = FinanceSystem::find()->select("rmb")->sum("rmb");
      $peso = FinanceSystem::find()->select('pseo')->sum('peso');
      // $peso = FinanceSystem::find()->where(['collect'=>4])->select("peso")->sum("peso");

//       var_dump($peso);
//        var_dump($rmb);exit;
	    return $this->render('property',['rmb'=>$rmb,'peso'=>$peso]);
    }
}
