<h1 style="color: #960a0b" class="text-center">商品列表(Goods List)</h1>
<style>
    th{text-align: center}
    td{text-align: center}
</style>
<?=\yii\bootstrap\Html::a($buttons['common']['add'],['goods/add'],['class'=>'btn btn-sm btn-success'])?>
<table class="table table-bordered">
    <!--    title-->
    <tr>
        <th><?=$buttons['common']['action']?></th>
        <?php foreach ($columnList as $k=>$v):?>

             <td><?=$buttons['table_title'][$v]?></td>

        <?php endforeach ?>
    </tr>
    <!--    title-->

    <!--    td-->
    <?php foreach ($models as $model):?>
        <tr>

            <td>
                <?=\yii\bootstrap\Html::a($buttons['common']['edit'],['goods/edit','id'=>$model->id],['class'=>'btn btn-sm btn-info'])?>
                <a href="#" class="btn btn-sm btn-danger shanchu" title="/businesses/services/index/goods/del?id=<?=$model->id?>"><?=$buttons['common']['del']?></a>
            </td>

            <?php foreach ($columnList as $k=>$v):?>


                    <?php if($v=='created_time'):?>
                        <td><?= date('Y-m-d',$model->created_time)?></td>
                    <?php elseif($v=='is_on_sale'):?>
                        <td><?=$buttons['is_on_sale'][$model->is_on_sale]?></td>
                    <?php elseif($v=='status'):?>
                    <td><?=$buttons['goods_status'][$model->status]?></td>
                    <?php else:?>
                        <td><?= $model->$v ?></td>
                    <?php endif ?>

            <?php endforeach ?>
        </tr>
    <?php endforeach;?>

    <!--    td-->
</table>
<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);


