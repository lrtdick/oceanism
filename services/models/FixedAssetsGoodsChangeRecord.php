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

class FixedAssetsGoodsChangeRecord extends BaseActiveRecord
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
            'gid' => '选择物品selectGoods',
            'type' => '类型Type',
            'amount' => '数量Amount',
            'remark' => '备注remark',
        ];
    }

    public static function getType(){
            return [
                0=>'购买Buy',
                1=>'损坏Broken',
                2=>'丢失Lost',
                3=>'用光Use up',
                4=>'磨损Abrase'
                ];


    }
}
