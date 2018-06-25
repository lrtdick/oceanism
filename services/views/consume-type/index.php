<h1 style="color: #960a0b" class="text-center">消费类型</h1>
<style>
    th{text-align: center}
    td{text-align: center}
    .aaa{
        margin-right: 20px;
    }
</style>
<?=\yii\bootstrap\Html::a('create',['consume-type/add'],['class'=>'btn  btn-success pull-left aaa'])?>
<table class="table table-bordered">
    <tr>
        <th>类型名称</th>
        <th>添加时间</th>
        <th>状态</th>
        <?php if(Yii::$app->user->can('consume-type/del') || Yii::$app->user->can('consume-type/status') || Yii::$app->user->can('consume-type/edit')):?>
        <th>操作</th>
        <?php endif;?>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->type?></td>
            <td><?=$model->created_time?date('Y-m-d H:i:s',$model->created_time):""?></td>
            <td><?=$model->status==1?'已启用':'已禁用'?></td>
            <td><?php if(Yii::$app->user->can('consume-type/status')):?>
                <?=\yii\bootstrap\Html::a($model->status==1?'ban':'using',['consume-type/status','id'=>$model->id],['class'=>$model->status==1?'btn btn-sm btn-warning':'btn btn-sm btn-success'])?>
                <?php endif;?>
                <?php if(Yii::$app->user->can('consume-type/edit')):?>
                <?=\yii\bootstrap\Html::a('edit',['consume-type/edit','id'=>$model->id],['class'=>'btn btn-sm btn-info'])?>
                <?php endif;?>
                <?php if(Yii::$app->user->can('consume-type/del')):?>
                <a href="/businesses/services/index/consume-type/del?id=<?=$model->id?>" class="btn btn-sm btn-danger shanchu" title="">delete</a>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);