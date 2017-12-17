<h1 style="color: #960a0b" class="text-center">固定资产分类</h1>
<style>
    th{text-align: center}
    td{text-align: center}
</style>
<?=\yii\bootstrap\Html::a('create',['fixed-assets-category/add'],['class'=>'btn btn-sm btn-success'])?>
<table class="table table-bordered">
    <tr>
        <th>分类名称(Cname)</th>
        <th>分类简介(Intro)</th>
        <th>创建时间(Created Time)</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->cname?></td>
            <td><?=$model->intro?></td>
            <td><?=$model->created_time?date('Y-m-d H:i:s',$model->created_time):''?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['fixed-assets-category/edit','id'=>$model->id],['class'=>'btn btn-sm btn-info'])?>
                <a href="#" class="btn btn-sm btn-danger shanchu" title="/businesses/services/index/fixed-assets-category/del?id=<?=$model->id?>">delete</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);


