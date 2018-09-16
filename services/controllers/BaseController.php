<?php
namespace services\controllers;

use services\models\Admin;
use yii\web\Controller;




class BaseController extends Controller
{
    public $data=[];


    public $BaseButton=[
        'ww'=>[
            //常用
            'common'=>[
                'add'=>'Create One',
                'del'=>'Delete',
                'edit'=>'Edit',
                'cancel'=>'Cancel',
                'search'=>'Search',
                'view_consume_record'=>'View Consume Record',
                'view_booking_goods'=>'View Travel Plan Products',
                'action'=>'Action',
                'search_condition'=>'Search',
                'submit'=>'Submit',
                'checkout'=>'CheckOut',
                'checkin'=>'CheckIn',
            ],
            //上边栏
            'up_menu'=>[
                'welcome'=>'Welcome',
                'logout'=>'LogOut',

            ],
            //左边栏
            'left_menu'=>[
                'welcome'=>'Welcome',
                'change_password'=>'Change Password',
            ],
            //左菜单
            'left_menu' =>
                [
                    "后台账户管理"=> [
                        '后台用户列表'=>'admin/admin_user',
                        '新增后台用户'=>'admin/admin_user/add'
                    ],

                    "权限角色管理"=> [
                        '角色管理'=>'admin/role',
                        '权限管理'=>'admin/permission'
                    ],

                    "Oauth接口管理"=> [
                        'Oauth客户端管理'=>'admin/oauth/client',
                        'Oauth授权范围管理'=>'admin/oauth/scope',
                        'Oauth授权方式'=>'admin/oauth/grant'
                    ],
                    '前台账户管理'=> [
                        '账号管理'=>'admin/account',
                        '用户管理'=>'admin/account_user',
                        '健康属性配置'=>'admin/user_profile_set',
                        '用户健康数据'=>'admin/user_profile_info',
                        '页面管理'=>'admin/page',
                        '文档'=>'doc',
                    ],
                    '产品+订单管理'=> [
                        "产品列表"=>'admin/product',
                        "产品分类"=>'admin/product_category',
                        "订单管理"=>'admin/order_info',
                        "采样管管理"=>'admin/sample',
                    ],
                    '客服操作'=> [
                        "生成内部采样记录"=>'admin/create_qr_form_admin',
                        "DNA送样订单管理"=>'admin/dna_order_list',
                        "化验订单管理"=>'admin/genotyping_order_list',
                        "优惠码管理"=>'admin/promo_code_list',
                        "代理商管理"=>'admin/agent_list',
                    ],
                    '问卷'=> [
                        '问卷分类'=>'admin/qa_category',
                        "问卷编辑"=>'admin/qa_questionaire',
                        //"问卷结果"=>'admin/qa_result'
                        "问卷结果"=>'admin/user_risk_assessment'
                    ],

                    '报告'=> [
                        '报告管理'=>'admin/report',
                    ],

                    "生成器"=> [
                        '生成器'=>'admin/code_generator',
                    ],
                    "通知中心"=> [
                        '新建通知'=>'admin/messages/create',
                        '通知中心'=>'admin/messages',
                    ],
                ],
            //页面标题
            'page_title'=>[
                'booking_list'  =>'BOOKING LIST',
                'agent_booking_list'  =>'BOOKING LIST(Agent)',
                'fixed_goods_change_records_title'=>'固定资产管理表',
            ],
            'booking_list'  =>'预定列表',
            'agent_booking_list'  =>'代理商预定列表',
            'fixed_goods_change_records_title'=>'固定资产管理表',
            //表头
            'table_title'=>[
                'id'=>'ID',
                'name'=>'Name',
                'passport'=>'Passport',
                'tel'=>'Mobile No',
                'wechat'=>'Wechat No',
                'booking_cny'=>'Booking Use CNY',
                'booking_peso'=>'Booking Use PESO',
                'plan_arrivel_at'=>'Plan Arrivel Time',
                'plan_leave_at'=>'Plan Leave Time',
                'booking_at'=>'Booking Time',
                'real_arrivel_at'=>'Arrivel Time',
                'real_leave_at'=>'Leave Time',
                'remark'=>'Remark',
                'status'=>'Status',
                'action'=>'Action',
            ],
            //搜索
            'search_form'=>[
                'search_passport'=>'Passport',
                'search_name'=>'name',
                'search_start'=>'From',
                'search_end'=>'To',
            ],
            'is_on_sale' => [
                        0 => '下架',
                        1 => '上架',
                    ],
        ],
        'en'=>[
            //常用
            'common'=>[
                'add'=>'Add One',
                'del'=>'Delete One',
                'edit'=>'Edit',
                'cancel'=>'Cancel',
                'search'=>'Search',
                'view_consume_record'=>'View Consume Record',
                'view_booking_goods'=>'View Plan Goods',
                'action'=>'Action',
                'search_condition'=>'Search Condition',
                'submit'=>'Submit',
                'checkout'=>'Check out',
                'checkin'=>'Check in',
            ],
            //上边栏
            'up_menu'=>[
                'welcome'=>'Welcome',
                'logout'=>'Logout',

            ],
            //左边栏
            'left_menu'=>[
                'welcome'=>'Welcome',
                'change_password'=>'Change Password',
            ],
            //页面标题
            'page_title'=>[
                'booking_record_list'  =>'Orders',
                'agent_booking_record_list'  =>'Agent Orders',
                'fixed_goods_change_records_title'=>'Fixed Assets',
            ],
            //表头
            'table_title'=>[
                //商品列表
                'category_id'=>'Category ID',
                'goods_name'=>'Name',
                'intro'=>'Intro',
                'stock'=>'Stock',
                'price_cny'=>'Price(CNY)',
                'price_peso'=>'Price(PESO)',
                'price_agent_cny'=>'Agent Price(CNY)',
                'price_agent_peso'=>'Agent Price(PESO)',
                'is_on_sale'=>'is on sale？',
                'created_time'=>'Created Time',

                //预定列表
                'id'=>'Records ID',
                'name'=>'Name',
                'passport'=>'Passport',
                'tel'=>'Mobile',
                'wechat'=>'Wechat',
                'booking_cny'=>'Payment CNY when Arrive',
                'booking_peso'=>'Payment Peso when Arrive',

                'remark'=>'Remark',
                'status'=>'Status',
                'action'=>'Action',
                'username'=>'Agent Name',
                'userid'=>'Agent id',
                'booking_time'=>'Booking Time',
                'checkin_time'=>'Checkin Time',
                'checkout_time'=>'Checkout Time',

                'deposit_cny'=>'Payment CNY when Arrive',
                'deposit_peso'=>'Payment Peso when Arrive',
                'agent_bonus'=>'Agent Bonus',
                'plan_checkin_time'=>'Plan Checkin Time',
                'plan_checkout_time'=>'Plan Checkout Time',
                //商品列表

                //固定资产列表
                'gid'=>'GOODS ID',
                'user_id'=>'ACCOUNT ID',
                'type'=>'TYPE',
                'amount'=>'AMOUNT',
                'ctime'=>'Created Time',

            ],
            //搜索
            'search_form'=>[
                'search_passport'=>'Search by passport',
                'search_name'=>'Search by name',
                'search_start'=>'Search by start time',
                'search_end'=>'Search by end time',
            ],
            'is_on_sale' => [
                0 => 'No',
                1 => 'Yes',
            ],
            'goods_status' => [
                0 => 'Disable',
                1 => 'Enable',
            ],
            'tips'=>[
                'agent_booking_list'=>"How to use agent order list：
                        " ,
            ]

        ],
        'zh'=>[
            //常用
            'common'=>[
                'add'=>'添加一条',
                'del'=>'删除',
                'edit'=>'修改',
                'cancel'=>'取消',
                'search'=>'搜索',
                'view_consume_record'=>'查看消费记录',
                'view_booking_goods'=>'预订项目',
                'action'=>'操作',
                'search_condition'=>'查询条件',
                'submit'=>'提交',
                'checkout'=>'确认结账',
                'checkin'=>'确认到店',
            ],
            //上边栏
            'up_menu'=>[
                'welcome'=>'欢迎你',
                'logout'=>'退出',

            ],
            //左边栏
            'left_menu'=>[
               'welcome'=>'欢迎你',
                'change_password'=>'修改密码',
            ],
            //页面标题
            'page_title'=>[
                'booking_record_list'  =>'预定列表',
                'agent_booking_record_list'  =>'代理商预定列表',
                'fixed_goods_change_records_title'=>'固定资产管理表',
            ],
            //表头
            'table_title'=>[
                //商品列表
                'category_id'=>'分类id',
                'goods_name'=>'商品名称',
                'intro'=>'商品简介',
                'stock'=>'库存数量',
                'price_cny'=>'价格(CNY)',
                'price_peso'=>'价格(PESO)',
                'price_agent_cny'=>'代理价格(CNY)',
                'price_agent_peso'=>'代理价格(PESO)',
                'is_on_sale'=>'在售？',
                'created_time'=>'创建时间',

                //预定列表
                'id'=>'编号',
                'name'=>'姓名',
                'passport'=>'护照号',
                'tel'=>'手机号',
                'wechat'=>'微信号',
                'booking_cny'=>'需要到付的CNY',
                'booking_peso'=>'需要到付的PESO',

                'remark'=>'备注',
                'status'=>'状态',
                'action'=>'操作',
                'username'=>'姓名',
                'userid'=>'代理id',
                'booking_time'=>'预定时间',
                'checkin_time'=>'实际到店时间',
                'checkout_time'=>'实际离店时间',

                'deposit_cny'=>'到店需付CNY',
                'deposit_peso'=>'到店需付Peso',
                'agent_bonus'=>'代理提成',
                'plan_checkin_time'=>'预定到店时间',
                'plan_checkout_time'=>'预定离店时间',
                //商品列表

                //固定资产列表
                'gid'=>'物品id',
                'user_id'=>'账户id',
                'type'=>'类型',
                'amount'=>'数量',
                'ctime'=>'创建时间',

            ],
            //搜索
            'search_form'=>[
                'search_passport'=>'输入护照搜索',
                'search_name'=>'输入姓名搜索',
                'search_start'=>'输入开始时间段',
                'search_end'=>'输入结束时间段',
            ],
            'is_on_sale' => [
                        0 => '下架',
                        1 => '上架',
                    ],
            'goods_status' => [
                        0 => '禁用',
                        1 => '启用',
                    ],
            'tips'=>[
                'agent_booking_list'=>"代理商预订页面功能简介：
                        " ,
            ]

        ]
    ];//E

    public $BaseStatu=[

        'en'=>[

        ],//en
        'zh'=>[

        ],//ZH




    ];//e
    public function  dd($w){
        var_dump($w);
        exit();
    }
    public function init(){
        parent::init();
        //实现当前控制器内所有返回结果为json格式

        //查询
        $userid=\Yii::$app->user->getId();
        $user=Admin::findOne(['id'=>$userid]);

        if($user){
            if($user->use_en==1){
                $this->data['buttons']=  $this->BaseButton['en'];
                $this->data['status']=  $this->BaseStatu['en'];
//                var_dump('en');
            }else{
                $this->data['buttons']=  $this->BaseButton['zh'];
                $this->data['status']=  $this->BaseStatu['zh'];
//                var_dump('zh');
            }
           $this->data['user_id']= $userid;
        }else{
            $this->data['buttons']=  $this->BaseButton['zh'];
            $this->data['status']=  $this->BaseStatu['zh'];
        }




    }

    public function getButtons(){
        //查询
        $userid=\Yii::$app->user->getId();
        $user=Admin::findOne(['id'=>$userid]);
        if($user){
            if($user->use_en==1){
                $this->data['buttons']=  $this->BaseButton['en'];
                $this->data['status']=  $this->BaseStatu['en'];
            }else{
                $this->data['buttons']=  $this->BaseButton['zh'];
                $this->data['status']=  $this->BaseStatu['zh'];
            }
            $this->data['user_id']= $userid;

        }else{
            $this->data['buttons']=  $this->BaseButton['zh'];
            $this->data['status']=  $this->BaseStatu['zh'];
        }


    }



}
