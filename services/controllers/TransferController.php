<?php
namespace services\controllers;



use services\filters\RbacFilter;
use services\models\FinanceSystem;
use services\models\OriginalAmount;
use services\models\Transfer;
use yii\web\Controller;
use yii\data\Pagination;


class TransferController extends BaseController{
	
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
        $models = $rs->limit($pager->limit)->orderBy('id desc')->offset($pager->offset)->all();
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
            return $this->redirect(['index']);
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

    ///实时资产  操作原始资产 进行增加

    public function actionProperty(){



        //修改原始金额
        if(\Yii::$app->request->get('rmb')){

            //echo 111;exit;

            $model = OriginalAmount::findOne(['id'=>1]);

            $model->cny = \Yii::$app->request->get('rmb');

            $model->save();


            \Yii::$app->session->setFlash('success','修改成功');

            return  $this->redirect('property');

        }

        if(\Yii::$app->request->get('peso')){

            //echo 111;exit;

            $model = OriginalAmount::findOne(['id'=>1]);

            $model['peso'] = \Yii::$app->request->get('peso');

            $model->save();

            \Yii::$app->session->setFlash('success','修改成功');

            return  $this->redirect('property');

        }


        //1 初始化变量
        $select1cny1 = 0;
        $select1peso2 = 0;

        $startdate='';
        $enddate='';
        $select2=FinanceSystem::find()->where(['state'=>1]);
        $select3=FinanceSystem::find()->where(['state'=>1]);
        //start time
        if(\Yii::$app->request->get('startdate')){

            $startdate=\Yii::$app->request->get('startdate');
            //select1
            $select1=FinanceSystem::find()->where(['state'=>1])->andwhere(['<','ctime',strtotime($startdate)]);

            //select1净收入
            $select1cny1 =abs($select1->sum('rmb')) ;
            $select1peso2 = abs($select1->sum('peso'));


            //select2
            $select2->andwhere(['>','ctime',strtotime($startdate)]);
            $select3->andwhere(['>','ctime',strtotime($startdate)]);


        }

        //有endtime
        if(\Yii::$app->request->get('enddate')){

            $enddate=\Yii::$app->request->get('enddate');
            //select2
            $select2=  $select2->andWhere(['<','ctime',strtotime($enddate)+24*60*60]);
            $select3=  $select3->andWhere(['<','ctime',strtotime($enddate)+24*60*60]);

        }


        //原始资产
        $Original_cny =floatval(OriginalAmount::find()->one()->cny) ;
        $Original_peso =floatval(OriginalAmount::find()->one()->peso)  ;


        //净收入
        $select2_cny1 = floatval( $select2->sum('rmb'));
        $select2_peso1 = floatval( $select2->sum('peso'));

        //rmb总资产
        // 原始 + select1 净收入 +select2 净收入
        $total_rmb = $Original_cny + $select1cny1 + $select2_cny1;
        $total_peso = $Original_peso + $select1peso2 + $select2_peso1;

        //该时间段起始资金
        // 原始 + select1净收入
        $startcny =  $Original_cny + $select1cny1;
        $startpeso = $Original_peso  + $select1peso2;

        return $this->render('property',
            [ 'startdate'=>$startdate,//搜索传入时间
                'enddate'=>$enddate,

                'Original_cny'=>$Original_cny,//rmb原始资产
                'Original_peso'=>$Original_peso,//peso 原始资产

                'Start_cny'=>$startcny,//起始资金
                'Start_peso'=>$startpeso,//起始资金

                'real_cny'=>$select2_cny1,//rmb净收入
                'real_peso'=>$select2_peso1,//peso 净收入

                'total_rmb'=>$total_rmb,//rmb总资产
                'total_peso'=>$total_peso,//peos 总资产
            ]);

    }
    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),
                'only'=>['add','index','edit','del','property'],
            ]
        ];
    }
}
