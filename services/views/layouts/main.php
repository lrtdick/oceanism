<?php

/* @var $this \yii\web\View */
/* @var $content string */

use services\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this)
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
    <script src="/businesses/services/index/js/echarts.min.js"></script>
    <script src="/businesses/services/index/js/jquery.min.js"></script>
    <script src="/businesses/services/index/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="/businesses/services/index/js/amazeui.min.js"></script>
    <script src="/businesses/services/index/js/amazeui.datatables.min.js"></script>
    <script src="/businesses/services/index/js/dataTables.responsive.min.js"></script>
    <script src="/businesses/services/index/js/app.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<!--    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>-->
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<!--<footer class="footer">
    <div class="container">
    </div>
</footer>-->
<script>
    $(".shanchu").on("click", function(){
        var _this = $(this);
        if(confirm("确定删除？")){
            window.location.href = _this.attr('title');
        }
    })
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
