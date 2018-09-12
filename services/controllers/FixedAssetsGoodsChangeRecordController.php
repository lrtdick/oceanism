<?php
namespace services\controllers;
use services\filters\RbacFilter;
use services\models\FixedAssetsGoods;
use services\models\FixedAssetsGoodsChangeRecord;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;


class FixedAssetsGoodsChangeRecordController extends BaseController
{
	
	public function actionIndex(){
        //固定部分
        $view= Yii::$app->controller->action->id;

//        var_dump($view);exit();

        $Search_condition=[
            'search_key'=>\Yii::$app->request->get("search_key"),
            'search_value'=>trim(\Yii::$app->request->get("search_value")),
            'search_start'=>\Yii::$app->request->get('search_start'),
            'search_end'=>\Yii::$app->request->get('search_end'),
        ];
        $columnList= FixedAssetsGoodsChangeRecord::getTableSchema()->columnNames;
        $models = FixedAssetsGoodsChangeRecord::SeachModelList($Search_condition,5,$columnList[0],'DESC');


        $this->data[ 'models']=$models['lists'];
        $this->data[ 'pager']=$models['pager'];
        $this->data[ 'search_condition']=$Search_condition;
        $this->data[ 'columnList']=$columnList;
        return $this->render($view,$this->data);

	}

	public function actionAdd(){
        $model = new FixedAssetsGoodsChangeRecord();
      //  var_dump($model);exit;
        if($model->load(\Yii::$app->request->post()) && $model->validate() ){
            //验证数据
            //var_dump($model);exit;
            $model['user_id'] = $this->data['user_id'];
            $model['ctime'] = time();
            $model->save(false);//默认情况下 保存是会调用validate方法  有验证码是，需要关闭验证
            //添加成功保存提示信息到session中并跳转首页
//            var_dump($model);
//            修改数量
            $good = FixedAssetsGoods::findOne(['id'=>$model->gid]);
            $good->stock +=$model->amount;
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

        //修改时先撤销数量改变
        $minus=$model->amount;
        $good = FixedAssetsGoods::findOne(['id'=>$model->gid]);
        if( $model->status!=0){
            $good->stock -= $minus;
            $good->save(false);
        }


        $model->status=0;
        $model->save();
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
