<?php

namespace services\models;

use Yii;
use yii\data\Pagination;
use yii\data\Sort;


class BaseActiveRecord extends \yii\db\ActiveRecord
{

    /**
     * 条件搜索方法
     * @param array $Search_condition
     * @param int $page
     * @param string $orderKey
     * @param string $orderSort
     * @return mixed
     * 传入搜索条件，返回符合的数据集合
     */
    public static function SeachModelList(
        $Search_condition=[
        'search_key'=>null,
        'search_value'=>null,
        'search_start'=>'',
        'search_end'=>'',
    ],
        $perPage=6,
        $orderKey='id',
        $orderSort='DESC'
    )
    {

        $query=self::find();

        if($Search_condition['search_key']!=null && $Search_condition['search_value']!=null)
        {
            $query->andwhere([
                'like',
                $Search_condition['search_key'],
                $Search_condition['search_value']
            ]);
        }
        if($Search_condition['search_start']!=''){
            $startdate=$Search_condition['search_start'];
            $query->andwhere(['>','ctime',strtotime($startdate)]);


        }

        if($Search_condition['search_end']!=''){
            $enddate=$Search_condition['search_end'];
            $query ->andWhere(['<','ctime',strtotime($enddate)+24*60*60]);
        }
        $total = $query->count();
        //每页显示条数 3
        //分页工具类
        $pager = new Pagination([
        'totalCount'=>$total,
        'defaultPageSize'=>$perPage
    ]);
        $lists=$query->limit($pager->limit)->offset($pager->offset)->orderBy($orderKey.' '.$orderSort)->all();
        $models=[
            'pager'=>$pager,
            'lists'=>$lists,

        ];
        return $models;


    }

    public static function Me(){

        $me=self::find()->all();
        return $me;
    }
}
