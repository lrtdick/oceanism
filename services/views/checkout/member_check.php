<h1 class="text-center">结账（check）</h1>
<style>
    h1{color: #960a0b;margin: 5px 20px 50px 20px}
    th{text-align: center}
    td{text-align: center}
</style>
&nbsp;<input type="button" name="Submit" value="返回上一页"  class="btn btn-sm btn-success pull-left" onclick="javascript:window.history.back(-1);">
<table class="table table-bordered">
    <tr>
        <th colspan="9" style="background: cornflowerblue">预定商品</th>
    </tr>
    <tr>
        <th>商品名称</th>
        <th>商品数量</th>
<!--        2018-9-12 不需要显示价格 只显示东西-->
<!--        <th>人民币单价(PRICE CNY)</th>-->
<!--        <th>比索单价(PRICE PESO)</th>-->
<!--        <th>人民币(Total CNY)</th>-->
<!--        <th>比索(Total PESO)</th>-->
    </tr>
<!--    --><?php //$cny=0;$peso=0;?>
    <?php foreach ($goods as $good):?>
        <tr>
            <td><?=$good->goods_name?></td>
            <td><?=$good->goods_amount?></td>
<!--            <td>--><?//=$good->cny?><!--</td>-->
<!--            <td>--><?//=$good->peso?><!--</td>-->
<!--            <td>--><?//=$good->cny_total?><!--</td>-->
<!--            <td>--><?//=$good->peso_total?><!--</td>-->
        </tr>
<!--        未结账1的参与计算-->
<!--        --><?php //if($good->status==1):?>
<!--            --><?php //$cny+=$good->cny_total;$peso+=$good->peso_total;?>
<!--        --><?php //endif;?>
    <?php endforeach;?>
<!--    <tr>-->
<!--        <td>共计</td>-->
<!--        <td colspan="4">人民币（cny）:--><?//=$cny?><!--</td>-->
<!--        <td colspan="4">比索（peso）:--><?//=$peso?><!--</td>-->
<!--    </tr>-->
</table>
<table class="table table-bordered">
    <tr>
        <th colspan="11" style="background: cornflowerblue">预定信息</th>
    </tr>
    <tr>
        <th>护照(Passport)</th>
        <th>微信(Wechat)</th>
        <th>姓名(Username)</th>
        <th>需到付的Cny</th>
        <th>需到付的Peso</th>
        <th>预定到店</th>
        <th>预定离店</th>
        <th>预定时间(Predetermined Time)</th>
        <th>到店时间(Checkin Time)</th>
        <th>离店时间(Checkout Time)</th>
        <th>备注栏(Remark)</th>
    </tr>
        <tr>
            <td><?=$bookings->passport?></td>
            <td><?=$bookings->wechat?></td>
            <td><?=$bookings->name?></td>
            <td  style="color:red"><?=$bookings->deposit_cny?></td>
            <td  style="color:rebeccapurple"><?=$bookings->deposit_peso?></td>
            <td><?=$bookings->plan_checkin_time?date('Y-m-d H:i:s',$bookings->plan_checkin_time):''?></td>
            <td><?=$bookings->plan_checkout_time?date('Y-m-d H:i:s',$bookings->plan_checkout_time):''?></td>
            <td><?=$bookings->booking_time?date('Y-m-d H:i:s',$bookings->booking_time):''?></td>
            <td><?=$bookings->checkin_time?date('Y-m-d H:i:s',$bookings->checkin_time):''?></td>
            <td><?=$bookings->checkout_time?date('Y-m-d H:i:s',$bookings->checkout_time):''?></td>
            <td><?=$bookings->remark?></td>
        </tr>
</table>

<table class="table table-bordered">
    <tr>
        <th colspan="11" style="background: cornflowerblue">消费记录</th>
    </tr>
    <tr>
        <th>操作人(Emploee)</th>
        <th>项目(type)</th>
        <th>人民币(Cny)</th>
        <th>比索(Peso)</th>
        <th>消费内容(Content)</th>
        <th>备注栏(Remark)</th>
        <th>消费时间(Created Time)</th>
    </tr>
    <?php $goods_cny=0;$goods_peso=0;?>
    <?php foreach ($records as $record):?>
        <tr>
            <td><?=\services\models\Admin::findOne($record->admin_id)?\services\models\Admin::findOne($record->admin_id)->username:'无'?></td>
            <td><?=\services\models\CustomerSpendingRecord::type()[$record->type]?></td>
            <td><?=$record->cny?></td>
            <td><?=$record->peso?></td>
            <td><?=$record->content?></td>
            <td><?=$record->remark?></td>
            <td><?=$record->created_time?date('Y-m-d H:i:s',$record->created_time):''?></td>
        </tr>
        <?php $goods_cny+=$record->cny;$goods_peso+=$record->peso;?>
    <?php endforeach;?>
    <tr>
        <td>共计</td>
        <td colspan="3" style="color:red">人民币（cny）:<?=$goods_cny?></td>
        <td colspan="3" style="color:rebeccapurple">比索（peso）:<?=$goods_peso?></td>
    </tr>
</table>
<table class="table table-bordered">
    <tr>
        <td colspan="10" style="background: cornflowerblue">结算</td>
    </tr>
    <tr>
        <th>合计</th>
        <th colspan="3" style="color:red">人民币（cny）:<?=$goods_cny+$bookings->deposit_cny?></th>
        <th colspan="3"  style="color:rebeccapurple">比索（peso）:<?=$goods_peso+$bookings->deposit_peso?></th>
    </tr>
    <tr>
        <td colspan="11">
            <?php if(Yii::$app->user->can('checkout/admin-check')):?>
                <form action="/businesses/services/index/checkout/admin-check" method="post">
                    <div class="pull-right" style="width: 30%;height: 30px"></div>
                    <div class="input-group col-md-2 pull-right" style="width: 20%;height: 30px">
                        <input name="peso" type="text" class="form-control" placeholder="支付比索(peso here)" / >
                        <span class="input-group-btn">
                        <button class="btn btn-info btn-search">确认付款</button>
                    </span>
                    </div>
<!--                    <div class="input-group  pull-right" ><strong> </strong></div>-->
                    <div class="input-group col-md-2 pull-right" >
                        <input name="cny" type="text" class="form-control"  placeholder="支付人民币(cny here)" />
                    </div>
                    <input name="id" type="hidden" value="<?=$id?>">
                    <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
                </form>
            <?php else:?>
                <form action="/businesses/services/index/checkout/admin-check" method="post">
                    <div class="pull-right" style="width: 40%;height: 30px"></div>
                    <div class="input-group col-md-2 pull-right" style="width: 20%;height: 30px">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-search">确认付款</button>
                        </span>
                    </div>
                    <input name="id" type="hidden" value="<?=$id?>">
                    <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
                </form>
            <?php endif;?>
        </td>
    </tr>
</table>
