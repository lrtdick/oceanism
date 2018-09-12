<h1 class="text-center">预定商品详情</h1>
<style>
    h1{color: #960a0b;margin: 5px 20px 50px 20px}
    th{text-align: center}
    td{text-align: center}
</style>

<?=\yii\bootstrap\Html::a('添加预定商品',['booking-goods/agent-add','order_id'=>$order_id],['class'=>'btn btn-sm btn-success pull-left'])?>
&nbsp;<input type="button" name="Submit" value="返回上一页"  class="btn btn-sm btn-success" onclick="javascript:window.history.back(-1);">
<table class="table table-bordered">
    <tr>
        <th>商品名称</th>
        <th>商品数量</th>
        <th>单价(cny)</th>
        <th>单价(peso)</th>
        <th>总计人民币(Total Cny)</th>
        <th>总计比索(Total Peso)</th>
        <th>操作</th>
    </tr>
    <?php $cny=0;$peso=0;?>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->goods_name?></td>
            <td><?=$model->goods_amount?></td>
            <td><?=$model->cny?></td>
            <td><?=$model->peso?></td>
            <td><?=$model->cny_total?></td>
            <td><?=$model->peso_total?></td>
            <td>
                <?php if($model->status==1):?>
                    <span style="color: red">未结账</span>
                    <?php if( !\services\models\BookingRecord::findOne($order_id)->checkin_time):?>
                        <?=\yii\bootstrap\Html::a('取消',['booking-goods/cancel','id'=>$model->id],['class'=>'btn btn-sm btn-warning'])?>
                    <?php endif;?>
                <?php elseif($model->status==2):?>
                    <span style="color: red">已结账</span>
                <?php elseif($model->status==3):?>
                <span style="color: red">已取消</span>
                <?php endif;?>
            </td>
        </tr>
        <?php if($model->status==1 || $model->status==2):?>
            <?php $cny+=$model->cny_total;$peso+=$model->peso_total;?>
        <?php endif;?>
    <?php endforeach;?>
    <tr>
        <td>共计</td>
        <td colspan="2">人民币（cny）:<?=$cny?></td>
        <td colspan="2">比索（peso）:<?=$peso?></td>
    </tr>
</table>

<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);


