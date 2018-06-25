<h1 class="text-center">客人列表(Predetermined List)</h1>
<style>
    h1{color: #960a0b;margin: 5px 20px 50px 20px}
    th{text-align: center}
    td{text-align: center}
</style>
<?=\yii\bootstrap\Html::a('Predetermined',['booking/agent-booking-one'],['class'=>'btn btn-sm btn-success pull-left'])?>
<table class="table table-bordered">
    <tr>
        <th>姓名(Username)</th>
        <th>护照(Passport)</th>
        <th>手机号(Tel)</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->username?></td>
            <td><?=$model->passport?></td>
            <td><?=$model->tel?></td>
            <td><?=$model->created_time?date('Y-m-d H:i:s',$model->created_time):''?></td>
            <td>
                <?=\yii\bootstrap\Html::a('消费记录',['record/agent-list','passport'=>$model->passport,'tel'=>$model->tel,'username'=>$model->username],['class'=>'btn btn-sm btn-success'])?>
                <?=\yii\bootstrap\Html::a('查看预订单',['booking/member-booking','passport'=>$model->passport],['class'=>'btn btn-sm btn-success'])?>
                <?=\yii\bootstrap\Html::a('查看预订商品',['booking/agent-booking-goods-list','passport'=>$model->passport],['class'=>'btn btn-sm btn-success'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>

<?php
//分页工具条
//echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);


