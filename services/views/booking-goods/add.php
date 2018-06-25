<div class="site-login">
    <h3 style="color:cornflowerblue">商品222预定</h3>
    <div class="show-img-box">
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
            <style>
                .box-form{
                    width: 1000px;
                    margin: auto;

                }
                .box{

                }
                .box-title{
                    float: left;
                    margin: 6px 10px;
                }
                .box-box{
                    width: 260px;
                    float: left;
                    margin: 6px 10px;
                }
                .box-box .box-input2{
                    width: 80px;
                    margin: 0 20px;
                }
                .box1{
                    margin: 50px 200px;
                }
            </style>
        </head>
        <body>
        <form action="" method="post" class="box-form">
            <div class="box" style="width: 100%;height:200px;">
                <label class="box-title">选择预定商品：</label>
                <?php foreach (\services\models\BookingGoods::getGoods() as $k=>$v) {?>
                    <div class="box-box">
                        <input type="checkbox" name="goods_name[]" data-k="<?=$k?>" class="box-input" value="<?= $v->gname?>"><?= $v->gname?>
                        <br/>商品数量&emsp;&emsp;&nbsp;:<input type="number" disabled name="goods_amount[]" min="1" value="1" class="box-input2 number<?=$k?>"/>
                        <br/>人民币:<?= $v->price_cny?>
                        <br/>比索:<?= $v->price_peso?>
                        <input type="hidden" name="cny[]" min="0" disabled class="price<?=$k?>"  value="<?= $v->price_cny?>"/>
                        <input type="hidden" name="peso[]" min="0" disabled class="price<?=$k?>"  value="<?= $v->price_peso?>"/>
                        <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
                        <input type="hidden" name="id[]" min="0" disabled class="box-input2 id<?=$k?>" value="<?= $v->id?>"/></div>
                <?php }?>
            </div>
            <div class="box1">
                <?=\yii\bootstrap\Html::submitButton('确认预定',['class'=>"btn btn-sm btn-success"]);?>
                &nbsp;<input type="button" name="Submit" value="取消"  class="btn btn-sm btn-success" onclick="javascript:window.history.back(-1);">
            </div>
        </form>
        </body>
        </html>
        <script>
            $(".box-input").on("change", function () {
                $('.price'+$(this).data('k')).prop('disabled', !$(this).prop("checked"));
                $('.number'+$(this).data('k')).prop('disabled', !$(this).prop("checked"));
                $('.id'+$(this).data('k')).prop('disabled', !$(this).prop("checked"))
            })
            $(".toggle-table").on("click", function(){
                if(!$("#main").hasClass("show")){
                    $("#main-table, #main").toggleClass("show1");
                    setTimeout(function(){
                        myChart.setOption(option);
                    }, 5)
                }
                else {
                    $("#main-table, #main").toggleClass("show1");
                }
            })
        </script>
    </div>
</div>