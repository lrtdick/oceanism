<?php

namespace services\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $gname
 * @property string $intro
 * @property string $specification
 * @property string $unit
 * @property string $sn
 * @property integer $stock
 * @property string $price_cny
 * @property string $price_peso
 * @property integer $is_sale
 * @property integer $state
 * @property integer $created_time
 */

class Goods extends BaseActiveRecord
{
    /*商品是否上架*/
    public static $is_on_sale = [
        0 => '下架',
        1 => '上架',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ktz_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'gname', 'is_on_sale'], 'required'],
            [['category_id', 'is_on_sale', 'status'], 'integer'],
            [['price_cny', 'price_peso','price_agent_cny','price_agent_peso'], 'number'],
            [['gname'], 'string', 'max' => 100],
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
            'category_id' => '所属分类(Category)',
            'gname' => '商品名称(Gname)',
            'intro' => '商品简介(Intro)',
            'stock' => '数量(Stock)',
            'price_cny' => '挂牌价(Price CNY)',
            'price_peso' => '挂牌价(Price PESO)',
            'price_agent_cny' => '代理商协议价(Price CNY for Agent)',
            'price_agent_peso' => '代理商协议价(Price PESO for Agent)',
            'is_on_sale' => '是否上架(Is ON Sale)',
            'status' => '状态',
        ];
    }

    /*获取所有未删除的分类*/
    public static function getCategory()
    {
        return ArrayHelper::merge(['' => '请选择商品分类'], ArrayHelper::map(CategoryGoods::findAll(['status' => 1]), 'id', 'cname'));
    }

    /*商品和商品分类的一对已关系*/
    public function getCategoryOne()
    {
        return $this->hasOne(CategoryGoods::className(), ['id' =>'category_id']);

    }
}