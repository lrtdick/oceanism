<?php
namespace services\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class FinanceSystem extends ActiveRecord {


    public static function tableName() {
        return  'ktz_finance_system';
    }


    public function rules()
    {
       return [
           [['collect'],'required','message'=>'{attribute}不能为空'],
            [['rmb','peso','comment'],'safe']
       ];
    }

  public function attributeLabels()
  {
      return [
         'collect'=>'总汇(collect)',
          'rmb' =>'人民币(CNY)',
          'peso'=> '比索(PESO)',
          'comment'  => '备注信息(Comment)',
      ];
  }
  
  /*获取所有类型*/
    public static function getType(){
        return ArrayHelper::merge(['type'=>0],FinanceSystem::find()->select(['collect'])->groupBy('collect')->asArray()->all());
    }
}