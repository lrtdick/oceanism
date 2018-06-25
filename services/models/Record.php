<?php

namespace services\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['type','content'], 'required'],
            [['admin_id', 'type', 'created_time'], 'integer'],
            [['cny', 'peso'], 'number','numberPattern'=>'/^\d*\.*\d*$/'],
            [['content'], 'string'],
            ['remark', 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => '操作者ID(admin_id)',
            'type' => '消费类型',
            'cny' => '人民币(Cny)',
            'peso' => '比索(Peso)',
            'content' => '消费内容(Content)',
            'remark' => '备注栏(Remark)',
            'created_time' => '消费时间(Created Time)',
        ];
    }
    /*消费记录admin_id和客服代理商建立一对一的关系*/
    public function getAdmin(){
        return $this->hasOne(Admin::className(),['id'=>'admin_id']);
    }
    /*获取所有的类型*/
    public static function type(){
        return ArrayHelper::map(ConsumeType::find()->all(),'id','type');
    }
    /*获取所有的类型用于添加时展示*/
    public static function type1(){
        return ArrayHelper::merge([''=>'请选择消费类型'],ArrayHelper::map(ConsumeType::find()->where(['state'=>1,'status'=>1])->all(),'id','type'));
    }
}
