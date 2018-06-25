<h1 style="color: #960a0b" class="text-center">类型</h1>
<style>
    th{text-align: center}
    td{text-align: center}
    .aaa{
        margin-right: 20px;
    }
</style>
<?=\yii\bootstrap\Html::a('create',['type/add'],['class'=>'btn  btn-success pull-left aaa'])?>
<table class="table table-bordered">
    <tr>
       <th>ID</th>
        <th>类型</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?= $model->id ?></td>
            <td><?=$model->leixing?></td>
            <td>
                <?=\yii\bootstrap\Html::a('edit',['type/edit','id'=>$model->id],['class'=>'btn btn-sm btn-info'])?>
                <a href="/businesses/services/index/type/del?id=<?=$model->id?>" class="btn btn-sm btn-danger " title="">delete</a>
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