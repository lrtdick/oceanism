
<h1 style="color: #960a0b" class="text-center"><?=$buttons['fixed_goods_change_records_title']?></h1>
<style>
    th{text-align: center}
    td{text-align: center}
    .aaa{
        margin-right: 20px;
    }
</style>
<?=\yii\bootstrap\Html::a($buttons['common']['add'],['fixed-assets-goods-change-record/add'],['class'=>'btn  btn-success pull-left aaa'])?>
<form action="" method="get">
    <div class="input-group col-1-3 pull-left" >
<span class="input-group-btn">
           <button class="btn btn-info btn-search">Search</button>
</span>
        <select class="btn" name="search_key"  >
            <option value="" >
                <?=$buttons['common']['search_condition']?>
            </option>
                <?php foreach ($columnList as $k=>$v):?>

                   <?php if($v=='id' || $v=='gid') : ?>
                        <?php else :?>
                            <option value="<?=$v?>" <?=($search_condition['search_key']==$v)?'selected':''?> >
                                <?= $v?>
                            </option>

                    <?php endif ?>
                <?php endforeach;?>
            </select>
        <input class="btn" type="text" name="search_value" value="<?= $search_condition['search_value']?>"/>

        from:<input class="btn" type="date" name="search_start" value="<?= $search_condition['search_start']?>"/>
        to:<input class="btn" type="date" name="search_end" value="<?= $search_condition['search_end']?>"/>

    </div>
    <div class="input-group  pull-left" ><strong> </strong></div>
    <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
</form>


<table class="table table-bordered">
<!--    title-->
    <tr>
        <th><?=$buttons['table_title']['action']?></th>
        <?php foreach ($columnList as $k=>$v):?>

            <td><?=$buttons['table_title'][$v]?></td>
        <?php endforeach ?>
    </tr>
    <!--    title-->

<!--    td-->
    <?php foreach ($models as $model):?>
        <tr>
            <td>
                <a href="/businesses/services/index/fixed-assets-goods-change-record/del?id=<?=$model->id?>" class="btn btn-sm btn-danger " title=""><?=$buttons['common']['del']?></a>
            </td>
        <?php foreach ($columnList as $k=>$v):?>
            <?php if($v=='ctime'):?>
            <td><?= date('Y-m-d H:i:s',$model->ctime)?></td>
              <?php else:?>
            <td><?= $model->$v ?></td>
            <?php endif ?>
        <?php endforeach ?>
        </tr>
    <?php endforeach;?>

    <!--    td-->
</table>
<script src="/businesses/services/index/js/jquery.min.js"></script>
<script>
</script>
<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);

