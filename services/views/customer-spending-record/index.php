<h1 class="text-center">消费记录(Customer Bill Record)</h1>
<style>
    h1{color: #960a0b;margin: 5px 20px 50px 20px}
    th{text-align: center}
    td{text-align: center}
</style>
<!--预定记录要是已到店才有增加消费记录功能-->
<?php if(\services\models\BookingRecord::findOne($order_id)->checkin_time && \services\models\BookingRecord::findOne($order_id)->status==2):?>
<?=\yii\bootstrap\Html::a('添加消费记录',['customer-spending-record/add','order_id'=>$order_id],['class'=>'btn btn-sm btn-success pull-left'])?>
<?php endif;?>
&nbsp;<input type="button" name="Submit" value="返回上一页"  class="btn btn-sm btn-success" onclick="javascript:window.history.back(-1);">
<table class="table table-bordered">
    <tr>
        <th>操作者(Username)</th>
        <th>项目(type)</th>
        <th>人民币(Cny)</th>
        <th>比索(Peso)</th>
        <th>消费内容(Content)</th>
        <th>备注栏(Remark)</th>
        <th>消费时间(Created Time)</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->admin->username?></td>
            <td><?=\services\models\CustomerSpendingRecord::type()[$model->type]?></td>
            <td><?=$model->cny?></td>
            <td><?=$model->peso?></td>
            <td><?=$model->content?></td>
            <td><?=$model->remark?></td>
            <td><?=$model->created_time?date('Y-m-d H:i:s',$model->created_time):''?></td>
            <td>
                <?php if(Yii::$app->user->can('customer-spending-record/del') && \services\models\BookingRecord::findOne($order_id)->status==1):?>
                    <a href="#" class="btn btn-sm btn-danger shanchu" title="/businesses/services/index/customer-spending-record/del?id=<?=$model->id?>">delete</a>
                <?php else:?>
                    <span style="color: red;width: 20%;height: 20px;font-size: 12px">
                        <?php
                        if( $model->status==1){
                            echo "未结账";
                        }elseif( $model->status==2){
                            echo "已结账";
                        }elseif( $model->status==3){
                            echo "已取消";
                        }elseif( $model->status==0){
                            echo "已删除";
                        }


                        ?></span>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
</table>

<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);


