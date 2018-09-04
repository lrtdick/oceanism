<?php

namespace services\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $passport
 * @property string $wechat
 * @property string $name
 * @property integer $booking_time
 * @property integer $checkin_time
 * @property integer $checkout_time
 * @property string $deposit_cny
 * @property string $deposit_peso
 * @property string $agent_bonus
 * @property integer $stutas
 * @property string $remark
 * @property string $plan_checkin_time
 * @property string $plan_checkout_time
 */
class BookingRecord extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ktz_booking_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['passport', 'wechat', 'name'], 'string'],
//            [['passport', 'wechat',], 'unique'],
            [['plan_checkin_time', 'plan_checkout_time'], 'required'],
            [['deposit_cny', 'deposit_peso'], 'number'],
            [['passport', 'remark'], 'string', 'max' => 255],
            [['wechat'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_checkin_time'=>'预定到店时间(plan arrive at)',
            'plan_checkout_time'=>'预定离店时间(plan leave at)',
            'user_id' => '操作人员id',
            'passport' => '护照(passport)',
            'wechat' => '微信(wechat)',
            'name' => '姓名(name)',
            'booking_time' => '预定时间(Booking Time)',
            'checkin_time' => '到店时间(Checkin Time)',
            'checkout_time' => '离店时间(Checkout Time)',
            'deposit_cny' => '到店需付(Pay When arrive CNY)',
            'deposit_peso' => '到店需付(Pay When arrive PESO)',
            'agent_bonus' => '代理商提成(FOR AGENT)',
            'status' => '状态(State)',
            'remark' => '备注栏(Remark)',
        ];
    }
    public static function getAdmin(){
        return Admin::find()->where(['status'=>1])->asArray()->all();
    }
}
