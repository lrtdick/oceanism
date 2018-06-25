<?php

namespace services\models;

use Yii;

/**
 * This is the model class for table "ktz_consume_type".
 *
 * @property integer $id
 * @property string $type
 * @property integer $state
 * @property integer $status
 * @property integer $created_time
 */
class ConsumeType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ktz_consume_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['type', 'required'],
            [['state', 'status', 'created_time'], 'integer'],
            [['type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '消费类型',
            'state' => 'State',
            'status' => 'Status',
            'created_time' => 'Created Time',
        ];
    }
}
