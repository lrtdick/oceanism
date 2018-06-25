<?php
namespace services\models;

use yii\db\ActiveRecord;
/**
 * This is the model class for table "original_amoutn".
 *
 * @property integer $rmb
 * @property integer $peso
 *
 */

class OriginalAmount extends ActiveRecord{

    public static function tableName(){
        return 'ktz_original_amount';
    }

    public function rules()
    {
        return [
            [['cny','peso'],'safe']
        ];
    }
}