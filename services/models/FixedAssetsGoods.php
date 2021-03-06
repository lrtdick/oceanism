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
class FixedAssetsGoods extends \yii\db\ActiveRecord
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
        return 'ktz_fixed_assets_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'gname', 'is_sale'], 'required'],
            [['category_id', 'stock', 'is_sale', 'state'], 'integer'],
            [['price_cny', 'price_peso'], 'number', 'numberPattern' => '/^\d*\.*\d*$/'],
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
            'gname' => '名称(Gname)',
            'intro' => '简介(Intro)',
            'stock' => '库存(Stock)',
            'price_cny' => '人民币(Price Cny)',
            'price_peso' => '菲律宾币(Price Peso)',
            'is_sale' => '是否上架(Is Sale)',
            'state' => 'State',
        ];
    }

    /*获取所有未删除的分类*/
    public static function getCategory()
    {
        return ArrayHelper::merge(['' => '请选择商品分类'], ArrayHelper::map(FixedAssetsCategory::findAll(['state' => 1]), 'id', 'cname'));
    }

    /*获取所有未删除的物品*/
    public static function getGoods()
    {
        return ArrayHelper::merge(['' => '请选择物品'], ArrayHelper::map(FixedAssetsGoods::findAll(['state' => 1]), 'id', 'gname'));
    }



    /*商品和商品分类的一对一关系*/
    public function getCategoryOne()
    {
        return $this->hasOne(FixedAssetsCategory::className(), ['id' =>'category_id']);

    }
}