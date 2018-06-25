<?php
namespace services\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Type extends ActiveRecord{

    public static function tableName() {
        return  'ktz_type';
    }


    public function rules()
    {
        return [
            [['leixing'],'required','message'=>'{attribute}不能为空']
        ];
    }

    public function attributeLabels()
    {
        return [
            'leixing'  => '类型(Type)',
        ];
    }




}
