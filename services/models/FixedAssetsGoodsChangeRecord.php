<?php

namespace services\models;

use Yii;

/**
 * This is the model class for table "FixedAssetsGoodsChangeRecord".
 *
 * @property integer $id
 * @property integer $gid goood_id
 * @property integer $user_id
 * @property integer $type
 * @property integer $amount
 * @property string $remark
 * @property integer $ctime
 * @property integer $state
 */

class FixedAssetsGoodsChangeRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ktz_fixed_assets_goods_change_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'type', 'amount'], 'required'],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gid' => 'GoodsID',
            'type' => 'How',
            'amount' => 'amount',
            'remark' => 'remark',
        ];
    }

    public static function getType(){
            return [
                0=>'Buy',
                1=>'Broken',
                2=>'Gone missing',
                3=>'Use up',
                4=>'Abrase'
                ];


    }
}
