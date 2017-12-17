<?php

namespace services\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
//        "css/amazeui.min.css",
//        "css/amazeui.datatables.min.css",
//        "css/app.css",
    ];
    public $js = [
//        "js/echarts.min.js",
//        "js/jquery.min.js",
//        "js/theme.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
