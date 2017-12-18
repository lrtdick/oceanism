<?php
namespace services\controllers;
use services\models\FixedAssetsGoods;
use services\models\FixedAssetsGoodsChangeRecord;
use yii\web\Controller;
use yii\data\Pagination;



class FixedAssetsGoodsChangeRecordController extends Controller {
	
	public function actionIndex(){
	    //$rs = new FinanceSystem();
//        $key = \Yii::$app->request->get('key');
        $key='';
        $rs = FixedAssetsGoodsChangeRecord::find();
        if(\Yii::$app->request->get('key')){
            $rs->where(['collect'=>\Yii::$app->request->get('key')]);
            $key=\Yii::$app->request->get('key');
        }
        $total = $rs->count();
        //每页显示条数 3
        $perPage = 10;
        //分页工具类
        $pager = new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>$perPage
        ]);
        // var_dump($brands);exit;
        $models = $rs->limit($pager->limit)->offset($pager->offset)->orderBy('id DESC')->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager,'key'=>$key]);
	}

	public function actionAdd(){
        $model = new FixedAssetsGoodsChangeRecord();
      //  var_dump($model);exit;
        if($model->load(\Yii::$app->request->post()) && $model->validate() ){
            //验证数据
            //var_dump($model);exit;
            $model['ctime'] = time();
            $model->save(false);//默认情况下 保存是会调用validate方法  有验证码是，需要关闭验证
            //添加成功保存提示信息到session中并跳转首页
//            var_dump($model);
//            修改数量
            $good = FixedAssetsGoods::findOne(['id'=>$model->gid]);
            $good->stock+=$model->amount;
            $good->save(false);

            \Yii::$app->session->setFlash('success','添加成功');
//            return $this->redirect(['fixed-assets-goods-change-record/index']);
        }
        return $this->render('add', ['model' => $model]);

    }
	
	public function actionEdit($id){
		 $model = FixedAssetsGoodsChangeRecord::findOne(['id'=>$id]);
		 //修改时先撤销数量改变
        $minus=$model->amount;
        $good = FixedAssetsGoods::findOne(['id'=>$model->gid]);
        $good->stock -= $minus;
        $good->save(false);

        if($model->load(\Yii::$app->request->post()) && $model->validate()){

               \Yii::$app->session->setFlash('success','修改成功');
                return  $this->redirect('index');
            
        }
        return $this->render('add',['model'=>$model]);
	}
	
	public function actionDel($id){
		 $model = FixedAssetsGoodsChangeRecord::findOne(['id'=>$id]);
        $model->state=0;
        $model->save();
        //修改时先撤销数量改变
        $minus=$model->amount;
        $good = FixedAssetsGoods::findOne(['id'=>$model->gid]);
        $good->stock -= $minus;
        $good->save(false);
        \Yii::$app->session->setFlash('success','删除');
        return $this->redirect(['fixed-assets-goods-change-record/index']);
	}
	

	//获取数据
    public function actionAjax(){

       // var_dump($_GET['key']);exit;
        $key = \Yii::$app->request->get('key');
      //  echo $key;exit;
	    //查那个表  wp_finance_system
        $article =FixedAssetsGoodsChangeRecord::find()->where(['collect'=>$key])->all();
       // 这个key就是搜索条件  一样的where
      // $model->where($where)->order('ts_order_topup.update_time DESC,ts_order_topup.ordertime DESC')->findPage(20);
        return $this->render('index',['article'=>$article]);
    }

}
