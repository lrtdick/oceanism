
<h1 style="color: #960a0b" class="text-center">Goods Broken Record List</h1>
<style>
    th{text-align: center}
    td{text-align: center}
    .aaa{
        margin-right: 20px;
    }
</style>
<?=\yii\bootstrap\Html::a('添加物品数量变更',['fixed-assets-goods-change-record/add'],['class'=>'btn  btn-success pull-left aaa'])?>
<form action="" method="get">
    <div class="input-group col-md-3 pull-left" >

        <span class="input-group-btn">
           <button class="btn btn-info btn-search">查找</button>
        </span>
    </div>
    <div class="input-group  pull-left" ><strong> </strong></div>
    <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
</form>


<table class="table table-bordered">
    <tr>
        <th>物品</th>
        <th>type</th>
        <th>数量</th>
        <th>备注</th>
        <th>创建时间</th>
        
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
           <td><?= \services\models\FixedAssetsGoods::getGoods()[$model->gid] ?></td>
           <td><?= $model->type ?></td>
            <td><?= $model->amount ?></td>
            <td><?= $model->remark ?></td>
            <td><?= date('Y-m-d H:i:s',$model->ctime)?></td>
            <td>
                <a href="/businesses/services/index/fixed-assets-goods-change-record/del?id=<?=$model->id?>" class="btn btn-sm btn-danger shanchu" title="">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<script src="/businesses/services/index/js/jquery.min.js"></script>
<script>
     /*function getSelectText() {

    }*/
    $('#test').change(function () {
        var key = $('#test').val();
       // alert(111);
        console.log(key);
       var url ="/businesses/services/index/finance/finance-index?key="+key;
       var data = {
            'username':username,
                'password':password,
                '_csrf-backend':backend
        },
        $.post(url,function (re) {
            console.log(re);
        })
    })
</script>
<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);

