<h1 style="color: #960a0b" class="text-center">固定资产列表(Fixed Assets List)</h1>
<style>
    th{text-align: center}
    td{text-align: center}
</style>
<?=\yii\bootstrap\Html::a('create',['fixed-assets-goods/add'],['class'=>'btn btn-sm btn-success'])?>
<table class="table table-bordered">
    <tr>
        <th>分类(Category)</th>
        <th>商品名称(Gname)</th>
        <th>商品简介(Intro)</th>
        <th>人民币(Price Cny)</th>
        <th>菲律宾币(Price Peso)</th>
        <th>库存(STOCK)</th>
        <th>添加时间(created Time)</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->categoryOne->cname?></td>
            <td><?=$model->gname?></td>
            <td><?=$model->intro?></td>
            <td><?=$model->price_cny?></td>
            <td><?=$model->price_peso?></td>
            <td><?=$model->stock?></td>
            <td><?=$model->created_time?date('Y-m-d H:i:s',$model->created_time):''?></td>
            <td>
                <?=\yii\bootstrap\Html::a('edit',['fixed-assets-goods/edit','id'=>$model->id],['class'=>'btn btn-sm btn-info'])?>
                <a href="#" class="btn btn-sm btn-danger shanchu" title="/businesses/services/index/fixed-assets-goods/del?id=<?=$model->id?>">delete</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);


