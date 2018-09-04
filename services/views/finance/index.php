
<h1 style="color: #960a0b" class="text-center">财务列表</h1>
<style>
    th{text-align: center}
    td{text-align: center}
    .aaa{
        margin-right: 20px;
    }
</style>
<?=\yii\bootstrap\Html::a('添加今日开销',['finance/add'],['class'=>'btn  btn-success pull-left aaa'])?>
<form action="" method="get">
    <div class="input-group col-md-3 pull-left" >
        <select class="form-control" name="key"  id="test" >
            <?php foreach (\services\models\FinanceSystem::getType() as $model):?>
                <option value="<?=$model['leixing']?>" <?=$key==$model['leixing']?'selected':''?> >
                    <?php
                    echo $model['leixing'];
                    ?>
                </option>

            <?php endforeach;?>
        </select>
        <span class="input-group-btn">
           <button class="btn btn-info btn-search">search</button>
        </span>
    </div>
    <div class="input-group  pull-left" ><strong> </strong></div>
    <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
</form>


<table class="table table-bordered">
    <tr>
        <th>总汇</th>
        <th>人民币(CNY)</th>
        <th>比索(POSE)</th>
        <th>备注</th>
        <th>创建时间</th>
        
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
           <td><?= $model->collect ?></td>
            <td><?= $model->rmb ?></td>
            <td><?= $model->peso ?></td>

            <td><?=$model->comment?></td>
            <td><?= date('Y-m-d H:i:s',$model->ctime)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('编辑',['finance/edit','id'=>$model->id],['class'=>'btn btn-sm btn-info'])?>
                <a href="/businesses/services/index/finance/del?id=<?=$model->id?>" class="btn btn-sm btn-danger " title="">删除</a>
              <?php if($model->collect == 8){
                 echo \yii\bootstrap\Html::a('定金退还',['finance/edit','id'=>$model->id],['class'=>'btn btn-sm btn-primary']);
              }  ?>
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

