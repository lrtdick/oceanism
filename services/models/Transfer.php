<?php
namespace services\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Transfer extends ActiveRecord {
	
	 public static function tableName() {
        return  'wp_transfer_record';
    }


    public function rules()
    {
       return [
           [['number'],'match','not'=>'ture','pattern'=>'/^([1-9]{1})(\d{14}|\d{19})$/','message'=>'请输入正确卡号'],
            [['rmb','peso'],'safe']
       ];
    }

  public function attributeLabels()
  {
      return [
         'number'=>'银行卡号(credit card numbers)',
          'rmb' =>'人民币(CNY)',
          'peso'=> '比索(PESO)'
      ];
  }
	
	
}