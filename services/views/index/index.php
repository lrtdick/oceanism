<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use services\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="icon" type="image/png" href="">
    <link rel="apple-touch-icon-precomposed" href="">
    <link rel="stylesheet" href="/businesses/services/index/css/amazeui.min.css" />
    <link rel="stylesheet" href="/businesses/services/index/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/businesses/services/index/css/app.css">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php //$this->beginBody() ?>
<div class="am-g tpl-g">
    <!-- 头部 -->
    <header>
        <!-- logo -->
        <div class="am-fl tpl-header-logo">
            <a href="javascript:none" target="mainFrame" style="font-size: 20px;color: black">海洋主义</a>
        </div>
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 侧边切换 -->
            <div class="am-fl tpl-header-switch-button am-icon-list">
                <span></span>
            </div>
            <!-- 搜索 -->
            <div class="am-fl tpl-header-search" style="width: 40%;">
                <form class="tpl-header-search-form" action="javascript:;">
                    <!--                    <button class="tpl-header-search-btn am-icon-search"></button>-->
                    <!--                    <input class="tpl-header-search-box" type="text" placeholder="搜索内容..." style="width: 80%;">-->
                </form>
            </div>
            <!-- 其它功能-->
            <div class="am-fr tpl-header-navbar">
                <ul>
                    <!-- 欢迎语 -->
                    <li class="am-text-sm tpl-header-navbar-welcome">
                        <a href="javascript:;"><?=$buttons['up_menu']['welcome']?>, <span><?=Yii::$app->user->identity['username']?></span> </a>
                    </li>

                    <li class="am-text-sm">
                        <a href="/businesses/services/index/admin/logout">
                            <span class="am-icon-sign-out"></span> <?=$buttons['up_menu']['logout']?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- 侧边导航栏 -->
    <div class="my-box11">
        <div class="left-sidebar">
            <!-- 用户信息 -->
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable">
                    <div class="tpl-user-panel-profile-picture">
                        <img src="../img/haiyang.jpg" alt="">
                    </div>
                    <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i><?=
                        Yii::$app->user->identity['username']?Yii::$app->user->identity['username']:''
                        ?></span>
                    <a href="/businesses/services/index/admin/userupdate" target="main_iframe" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> <?=$buttons['left_menu']['change_password']?></a>
                </div>
            </div>
            <!-- 用户信息 -->
            <!-- 菜单 -->
            <ul class="sidebar-nav">
                <li class="sidebar-nav-heading">基本功能<span class="sidebar-nav-heading-info"></span></li>
                <li class="sidebar-nav-link">

                </li>
                <!--系统设置-->
                                <?php if(Yii::$app->user->can('admin/index') || Yii::$app->user->can('rbac/role-index') || Yii::$app->user->can('rbac/permission-index')):?>
                                <li class="sidebar-nav-link">
                                    <a href="javascript:;" class="sidebar-nav-sub-title">
                                        <i class="am-icon-home  sidebar-nav-link-logo" target="main_iframe"></i>系统管理
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <?php if(Yii::$app->user->can('admin/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/admin/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo" ></span> 账号管理
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('rbac/role-index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/rbac/role-index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo" ></span> 角色管理
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('rbac/permission-index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/rbac/permission-index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 权限管理
                                            </a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </li>
                                <?php endif;?>
                                <?php if(Yii::$app->user->can('category-goods/index') || Yii::$app->user->can('goods/index')):?>
                                <li class="sidebar-nav-link">
                                    <a href="#" class="sidebar-nav-sub-title">
                                        <i class="am-icon-calendar  sidebar-nav-link-logo"></i>商品管理
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <?php if(Yii::$app->user->can('category-goods/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/category-goods/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 商品分类
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('goods/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/goods/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 商品列表
                                            </a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </li>
                                <?php endif;?>
                                <?php if(Yii::$app->user->can('booking-record/index') || Yii::$app->user->can('booking-record/agent-index') || Yii::$app->user->can('consume-type/index')):?>
                                <li class="sidebar-nav-link">
                                    <a href="#" class="sidebar-nav-sub-title">
                                        <i class="am-icon-codepen sidebar-nav-link-logo"></i>预定管理
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <?php if(Yii::$app->user->can('booking-record/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/booking-record/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 预定列表(客服)
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('booking-record/agent-index')):?>
                                            <li class="sidebar-nav-link">
                                                <a href="/businesses/services/index/booking-record/agent-index" target="main_iframe">
                                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 预定列表(代理商)
                                                </a>
                                            </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('consume-type/index')):?>
                                            <li class="sidebar-nav-link">
                                                <a href="/businesses/services/index/consume-type/index" target="main_iframe">
                                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 消费类型
                                                </a>
                                            </li>
                                        <?php endif;?>
                                    </ul>
                                </li>
                                <?php endif;?>
                                <?php /*if(Yii::$app->user->can('member/agent') || Yii::$app->user->can('member/index')):*/?><!--
                                <li class="sidebar-nav-link">
                                    <a href="#" class="sidebar-nav-sub-title">
                                        <i class="am-icon-users sidebar-nav-link-logo"></i>客人管理
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <?php /*if(Yii::$app->user->can('member/agent')):*/?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/member/agent" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 客人列表(代理商)
                                            </a>
                                        </li>
                                        <?php /*endif;*/?>
                                        <?php /*if(Yii::$app->user->can('member/index')):*/?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/member/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 客人列表(客服)
                                            </a>
                                        </li>
                                        <?php /*endif;*/?>
                                    </ul>
                                </li>
                                --><?php /*endif;*/?>
                                <?php /*if(Yii::$app->user->can('booking/booking-goods-index')):*/?><!--
                                <li class="sidebar-nav-link">
                                    <a href="#" class="sidebar-nav-sub-title">
                                        <i class="am-icon-user-plus sidebar-nav-link-logo"></i>预定商品
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <?php /*if(Yii::$app->user->can('booking/booking-goods-index')):*/?>
                                            <li class="sidebar-nav-link">
                                                <a href="/businesses/services/index/booking/booking-goods-index" target="main_iframe">
                                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 预定商品(客服)
                                                </a>
                                            </li>
                                        <?php /*endif;*/?>
                                    </ul>
                                </li>
                                --><?php /*endif;*/?>
                                <?php /*if(Yii::$app->user->can('record/index-all') || Yii::$app->user->can('record/agent-index')):*/?><!--
                                <li class="sidebar-nav-link">
                                    <a href="#" class="sidebar-nav-sub-title">
                                        <i class="am-icon-cart-plus sidebar-nav-link-logo"></i>消费系统
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <?php /*if(Yii::$app->user->can('record/index-all')):*/?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/record/index-all" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 消费记录(客服)
                                            </a>
                                        </li>
                                        <?php /*endif;*/?>
                                        <?php /*if(Yii::$app->user->can('record/agent-index')):*/?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/record/agent-index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 消费记录(代理商)
                                            </a>
                                        </li>
                                        <?php /*endif;*/?>
                                    </ul>
                                </li>
                                --><?php /*endif;*/?>
                                <?php if(Yii::$app->user->can('type/index') || Yii::$app->user->can('finance/finance-index') || Yii::$app->user->can('transfer/index') || Yii::$app->user->can('transfer/property')):?>
                                <li class="sidebar-nav-link">
                                    <a href="#" class="sidebar-nav-sub-title">
                                        <i class="am-icon-money sidebar-nav-link-logo"></i>财务系统
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <?php if(Yii::$app->user->can('type/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/type/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 类型列表
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('finance/finance-index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/finance/finance-index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 财务记录列表
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('transfer/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/transfer/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 存取款转账记录
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('transfer/property')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/transfer/property" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 公司资产分析-特殊权限
                                            </a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </li>
                                <?php endif;?>
                                <?php if(Yii::$app->user->can('fixed-assets-category/index') || Yii::$app->user->can('fixed-assets-goods/index') || Yii::$app->user->can('fixed-assets-goods-change-record/index')):?>
                                <li class="sidebar-nav-link">
                                    <a href="#" class="sidebar-nav-sub-title">
                                        <i class="am-icon-money sidebar-nav-link-logo"></i>固定资产管理系统<br/>fixed assets management system
                                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                                    </a>
                                    <ul class="sidebar-nav sidebar-nav-sub">
                                        <?php if(Yii::$app->user->can('fixed-assets-category/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/fixed-assets-category/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 固定资产分类列表
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('fixed-assets-goods/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/fixed-assets-goods/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 固定资产列表
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(Yii::$app->user->can('fixed-assets-goods-change-record/index')):?>
                                        <li class="sidebar-nav-link">
                                            <a href="/businesses/services/index/fixed-assets-goods-change-record/index" target="main_iframe">
                                                <span class="am-icon-angle-right sidebar-nav-link-logo"></span> 固定资产列表改变记录
                                            </a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </li>
                                <?php endif;?>
            </ul>
        </div>
    </div>
<!--    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <!-- 内容区域 -->
    <div class="iframe-box">
        <?= Alert::widget() ?>
        <iframe src="/businesses/services/index/admin/index" id="main_iframe" class="main_iframe" name="main_iframe" frameborder="0" onload="" scrolling="yes" style="padding: 1px"></iframe>
    </div>
    <script src="/businesses/services/index/js/echarts.min.js"></script>
    <script src="/businesses/services/index/js/jquery.min.js"></script>
    <script src="/businesses/services/index/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="/businesses/services/index/js/amazeui.min.js"></script>
    <script src="/businesses/services/index/js/amazeui.datatables.min.js"></script>
    <script src="/businesses/services/index/js/dataTables.responsive.min.js"></script>
    <script src="/businesses/services/index/js/app.js"></script>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
