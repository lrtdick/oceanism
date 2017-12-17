<?php

namespace services\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $passport
 * @property string $tel
 * @property string $username
 * @property integer $Predetermined_time
 * @property integer $checkin_time
 * @property integer $checkout_time
 * @property string $deposit_cny
 * @property string $deposit_peso
 * @property string $commission
 * @property integer $state
 * @property string $remark
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['passport', 'tel', 'username'], 'required'],
            [['passport', 'tel',], 'unique'],
            [['userid', 'Predetermined_time', 'checkin_time', 'checkout_time', 'state'], 'integer'],
            [['deposit_cny', 'deposit_peso', 'commission'], 'number'],
            [['passport', 'remark'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 20],
            [['username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'passport' => '护照(Passport)',
            'tel' => '手机号(Tel)',
            'username' => '姓名(name)',
            'Predetermined_time' => '预定时间(Predetermined Time)',
            'checkin_time' => '到店时间(Checkin Time)',
            'checkout_time' => '离店时间(Checkout Time)',
            'deposit_cny' => '人民币(Deposit Cny)',
            'deposit_peso' => '菲律宾币(Deposit Peso)',
            'commission' => '代理商提成(Commission)',
            'state' => '状态(State)',
            'remark' => '备注栏(Remark)',
        ];
    }
}
