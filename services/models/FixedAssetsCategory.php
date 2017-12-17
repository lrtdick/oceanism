<?php

namespace services\models;

use Yii;

/**
 * This is the model class for table "category_goods".
 *
 * @property integer $id
 * @property string $cname
 * @property string $intro
 * @property integer $state
 * @property integer $sort
 * @property integer $created_time
 */
class FixedAssetsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fixed_assets_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cname'], 'required'],
            [['state', 'sort', 'created_time'], 'integer'],
            [['cname'], 'string', 'max' => 100],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cname' => '分类名称(Cname)',
            'intro' => '分类简介(Intro)',
            'state' => 'State',
            'sort' => '排序(Sort)',
            'created_time' => 'Created Time',
        ];
    }
}
