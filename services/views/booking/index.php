<h1 class="text-center">预定列表(Predetermined List)</h1>
<style>
    h1{color: #960a0b;margin: 5px 20px 50px 20px}
    th{text-align: center}
    td{text-align: center}
</style>
<?=\yii\bootstrap\Html::a('Predetermined',['booking/booking'],['class'=>'btn btn-sm btn-success pull-left'])?>
<link rel="stylesheet" href="/businesses/services/index/css/flatpickr.min.css" />
<script src="/businesses/services/index/js/flatpickr.min.js"></script>
<script src="/businesses/services/index/js/flatpickr.l10n.zh.js"></script>
<form action="" method="get">
    <div class="input-group col-md-2 pull-right" >
        <input name="startTime" type="text" class="form-control" id="my-startDate" placeholder="请选择预定时间" / >
        <span class="input-group-btn">
           <button class="btn btn-info btn-search">查找</button>
        </span>
    </div>
    <div class="input-group  pull-right" ><strong> </strong></div>
    <div class="input-group col-md-2 pull-right" >
        <input name="username" type="text" class="form-control" id="my-startDate" placeholder="请输入姓名搜索" />
    </div>
    <div class="input-group  pull-right" ><strong> </strong></div>
    <div class="input-group col-md-2 pull-right" >
        <input name="tel" type="text" class="form-control"  placeholder="请输入手机号搜索"/ >
    </div>
    <div class="input-group col-md-2 pull-right" >
        <input name="username" type="text" class="form-control" placeholder="请输入护照搜索"/>
    </div>
    <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
</form>
<table class="table table-bordered">
    <tr>
        <th>护照(Passport)</th>
        <th>手机号(Tel)</th>
        <th>姓名(Username)</th>
        <th>人民币(Deposit Cny)</th>
        <th>菲律宾币(Deposit Peso)</th>
        <th>预定时间(Predetermined Time)</th>
        <th>到店时间(Checkin Time)</th>
        <th>离店时间(Checkout Time)</th>
        <th>备注栏(Remark)</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->passport?></td>
            <td><?=$model->tel?></td>
            <td><?=$model->username?></td>
            <td><?=$model->deposit_cny?></td>
            <td><?=$model->deposit_peso?></td>
            <td><?=$model->Predetermined_time?date('Y-m-d H:i:s',$model->Predetermined_time):''?></td>
            <td><?=$model->checkin_time?date('Y-m-d H:i:s',$model->checkin_time):''?></td>
            <td><?=$model->checkout_time?date('Y-m-d H:i:s',$model->checkout_time):''?></td>
            <td><?=$model->remark?></td>
            <td>
                <?php
                    if(!$model->checkin_time){
                       echo \yii\bootstrap\Html::a('Checkin',['booking/checkin','id'=>$model->id],['class'=>'btn btn-sm btn-info']);
                    }elseif($model->checkin_time && !$model->checkout_time){
                        echo '<span style="color: red">消费中</span>';
                        echo \yii\bootstrap\Html::a('Checkout',['booking/checkout','id'=>$model->id],['class'=>'btn btn-sm btn-info']);
                    }elseif($model->checkin_time && $model->checkout_time){
                        echo '<span style="color: red">已离店</span>';
                    }
                ?>
                <a href="#" class="btn btn-sm btn-danger shanchu" title="/businesses/services/index/booking/del?id=<?=$model->id?>">delete</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>

<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);


