<h1 style="color: #960a0b" class="text-center">存取款转账记录</h1>
<style>
    th{text-align: center}
    td{text-align: center}
</style>
<?=\yii\bootstrap\Html::a('添加记录',['transfer/add'],['class'=>'btn btn-sm btn-success'])?>
<table class="table table-bordered">
    <tr>
        <th>银行卡号(Credit Card Numbers)</th>
        <th>人民币(CNY)</th>
        <th>比索(POSE)</th>

        <th>备注信息(Comment)</th>
        <th>创建时间(Create time)</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?= $model->number ?></td>
            <td><?= $model->rmb ?></td>
            <td><?= $model->peso ?></td>
            <td><?= $model->comment ?></td>
            <td><?= date('Y-m-d',$model->ctime)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('编辑',['transfer/edit','id'=>$model->id],['class'=>'btn btn-sm btn-info'])?>
                <a href="/businesses/services/index/transfer/del?id=<?=$model->id?>" class="btn btn-sm btn-danger shanchu" title="">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);