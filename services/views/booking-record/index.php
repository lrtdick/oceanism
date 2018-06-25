<h1 class="text-center"><?=$buttons['page_title']['booking_record_list']?></h1>
<style>
    h1{color: #960a0b;margin: 5px 20px 50px 20px}
    th{text-align: center}
    td{text-align: center}
    .btn{margin: 2px}
</style>

<?=\yii\bootstrap\Html::a($buttons['common']['add'],['booking-record/add'],['class'=>'btn btn-sm btn-success pull-left'])?>
<link rel="stylesheet" href="/businesses/services/index/css/flatpickr.min.css" />
<script src="/businesses/services/index/js/flatpickr.min.js"></script>
<script src="/businesses/services/index/js/flatpickr.l10n.zh.js"></script>


<!--serch-->

<form action="" method="get">
    <div class="input-group col-1-3 pull-left" >
<span class="input-group-btn">
           <button class="btn btn-info btn-search"> <?=$buttons['common']['search']?></button>
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
<!--search-->


<table class="table table-bordered">
    <tr>
        <th><?=$buttons['common']['action']?></th>
        <th><?=$buttons['table_title']['status']?></th>
        <?php foreach ($columnList as $k=>$v):?>

            <td><?=isset($buttons['table_title'][$v])?$buttons['table_title'][$v]:$v?></td>
        <?php endforeach ?>
    </tr>


    <?php foreach ($models as $model):?>
        <tr>
<!--            ACTION-->
            <td>
                <?php
//                未到店
                if($model->status==1 && !$model->checkin_time){
                    echo \yii\bootstrap\Html::a($buttons['common']['checkin'],['booking-record/checkin','id'=>$model->id],['class'=>'btn btn-xs btn-info check']);
                    echo \yii\bootstrap\Html::a($buttons['common']['cancel'],['booking-record/cancel','id'=>$model->id],['class'=>'btn btn-xs btn-danger check']);
                    //有删除权限
                    if(Yii::$app->user->can('booking-record/del')){

                        echo "<a href='#' class='btn btn-xs btn-danger shanchu' title='/businesses/services/index/booking-record/del?id=$model->id' >".$buttons['common']['del']."</a>";

                    }
//                    已到店
                }elseif($model->status==2 && isset($model->checkin_time)){
                    //checkout
                    echo \yii\bootstrap\Html::a($buttons['common']['checkout'],['settle-accounts/index','id'=>$model->id],['class'=>'btn btn-xs btn-info check']);
                }
                //消费记录
                ?>
                <?=\yii\bootstrap\Html::a($buttons['common']['view_consume_record'],['record/index','order_id'=>$model->id],['class'=>'btn btn-xs btn-success'])?>
<!--                //预定商品记录-->
                <?=\yii\bootstrap\Html::a($buttons['common']['view_booking_goods'],['booking-goods/index','order_id'=>$model->id],['class'=>'btn btn-xs btn-success'])?>
            </td>
            <td>
                <?php
                if($model->status==1 && !$model->checkin_time){
                    echo'<span style="color: red;width: 20%;height: 20px;font-size: 12px">未到店</span>';
                }elseif($model->status==2){
                    echo '<span style="color: red;width: 20%;height: 20px;font-size: 12px">已到店</span>';
                }elseif($model->status==3){
                    echo '<span style="color: red;width: 20%;height: 20px;font-size: 12px">已离店</span>';
                }
                ?>
            </td>
<!--            INFO-->

            <?php foreach ($columnList as $k=>$v):?>
                <?php if($v =='booking_time'||$v =='plan_checkin_time'||$v =='plan_checkout_time'):?>
                    <td><?= date('Y-m-d',$model->$v )?></td>

                <?php else:?>
                    <td><?= $model->$v ?></td>
                <?php endif ?>
            <?php endforeach ?>
            <!--            END-->

        </tr>
    <?php endforeach;?>

</table>
<!--            END-->


<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);

