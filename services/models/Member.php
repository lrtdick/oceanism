<?php

namespace services\models;

use Yii;

/**
 * This is the model class for table "ktz_member".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $passport
 * @property string $tel
 * @property string $username
 * @property string $created_time
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ktz_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            ['id', 'integer'],
            [['passport', 'username'], 'string', 'max' => 255],
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
            'passport' => 'Passport',
            'tel' => 'Tel',
            'username' => 'Username',
        ];
    }
}
