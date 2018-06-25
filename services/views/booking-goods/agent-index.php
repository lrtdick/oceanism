<h1 class="text-center">预定商品详情</h1>
<style>
    h1{color: #960a0b;margin: 5px 20px 50px 20px}
    th{text-align: center}
    td{text-align: center}
</style>
<?=\yii\bootstrap\Html::a('添加预定商品',['booking-goods/agent-add','passport'=>$passport],['class'=>'btn btn-sm btn-success pull-left'])?>
&nbsp;<input type="button" name="Submit" value="返回上一页"  class="btn btn-sm btn-success" onclick="javascript:window.history.back(-1);">
<table class="table table-bordered">
    <tr>
        <th>商品名称</th>
        <th>商品数量</th>
        <th>单价(cny)</th>
        <th>单价(peso)</th>
        <th>人民币(Deposit Cny)</th>
        <th>比索(Deposit Peso)</th>
        <th>操作</th>
    </tr>
    <?php $cny=0;$peso=0;?>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->goods_name?></td>
            <td><?=$model->goods_num?></td>
            <td><?=$model->cny_o?></td>
            <td><?=$model->peso_o?></td>
            <td><?=$model->cny?></td>
            <td><?=$model->peso?></td>
            <td><?=$model->start_time?date('Y-m-d H:i:s',$model->start_time):''?></td>
            <td><?=$model->end_time?date('Y-m-d H:i:s',$model->end_time):''?></td>
            <td>
                <?php if($model->state==0):?>
                    <?=\yii\bootstrap\Html::a('取消',['booking/booking-goods-remove','id'=>$model->id],['class'=>'btn btn-sm btn-warning'])?>
                <?php elseif($model->state==2):?>
                    <span style="color: red">已取消</span>
                <?php else:?>
                    <span style="color: red">已结账</span>
                <?php endif;?>
            </td>
        </tr>
        <?php if($model->state==0):?>
        <?php $cny+=$model->cny;$peso+=$model->peso;?>
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


