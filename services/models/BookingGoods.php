<?php

namespace services\models;

use Yii;

/**
 * This is the model class for table "ktz_booking_goods".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $adminid
 * @property integer $goods_id
 * @property string $goods_name
 * @property string $cny
 * @property string $peso
 * @property string $cny_o
 * @property string $peso_o
 * @property integer $people
 * @property integer $state
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $created_time
 * @property integer $goods_num
 */
class BookingGoods extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ktz_booking_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'goods_name'], 'required'],
            [['order_id', 'user_id', 'goods_id', 'people', 'status', 'booking_time'], 'integer'],
            [['cny', 'peso','cny_total','peso_total'], 'number','numberPattern'=>'/^\d*\.*\d*$/'],
            [['goods_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '操作人员ID',
            'goods_id' => '商品ID',
            'goods_name' => '商品名称(Goods Name)',
            'cny' => '人民币单价(Cny)',
            'peso' => '比索单价(Peso)',
            'people' => '人数(People)',
            'status' => '状态(Status)',
            'booking_time' => '预定时间(Booking Time)',
        ];
    }
    /*获取所有商品*/
    public static function getGoods(){
        $goods=Goods::find()->where(['status'=>1])->all();
        return $goods;
    }
    /*获取所有商品*/
    public static function getCategory(){
        $category=CategoryGoods::find()->where(['status'=>1])->all();
        return $category;
    }
}
