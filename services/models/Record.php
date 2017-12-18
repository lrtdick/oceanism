<?php

namespace services\models;

use Yii;

/**
 * This is the model class for table "record".
 *
 * @property integer $id
 * @property integer $rid
 * @property string $username
 * @property string $passport
 * @property string $tel
 * @property integer $type
 * @property string $cny
 * @property string $peso
 * @property string $content
 * @property string $remark
 * @property integer $created_time
 */

class Record extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ktz_guest_spending_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rid', 'username', 'passport', 'tel', 'type', 'created_time'], 'required'],
            [['rid', 'type', 'created_time'], 'integer'],
            [['cny', 'peso'], 'number'],
            [['content'], 'string'],
            [['username'], 'string', 'max' => 50],
            [['passport', 'remark'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rid' => '记录(Rid)',
            'username' => '姓名(Username)',
            'passport' => '护照(Passport)',
            'tel' => '手机号(Tel)',
            'type' => '1代表住宿记录2代表参加潜水记录3代表租用装备记录4代表车辆接送的记录5代表其他(Type)',
            'cny' => '人民币(Cny)',
            'peso' => '菲律宾币(Peso)',
            'content' => '消费内容(Content)',
            'remark' => '备注栏(Remark)',
            'created_time' => '消费时间(Created Time)',
        ];
    }
}
