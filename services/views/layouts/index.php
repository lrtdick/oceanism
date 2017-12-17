<?php

/* @var $this \yii\web\View */
/* @var $content string */

use services\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

LoginAsset::register($this);
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
    <script src="/businesses/services/index/js/echarts.min.js"></script>
    <link rel="stylesheet" href="/businesses/services/index/css/amazeui.min.css" />
    <link rel="stylesheet" href="/businesses/services/index/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/businesses/services/index/css/app.css">
    <script src="/businesses/services/index/js/jquery.min.js"></script>
    <script src="/businesses/services/index/js/theme.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?=$content?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
