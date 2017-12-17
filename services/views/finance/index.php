
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
                <option value="<?=$model['collect']?>" <?=$key==$model['collect']?'selected':''?> >
                    <?php
                    if ($model['collect']==1){
                        echo '固定资产';
                    }elseif ($model['collect']==2){
                        echo '潜水运行';
                    }elseif ($model['collect']==3){
                        echo '日常办公开销';
                    }elseif ($model['collect']==4){
                        echo '维修及维护';
                    }elseif ($model['collect']==5){
                        echo '员工工资';
                    }elseif ($model['collect']==6){
                        echo '房屋及水电';
                    }elseif ($model['collect']==7){
                        echo '公关费用';
                    }elseif ($model['collect']==8){
                        echo '收入定金';
                    }elseif ($model['collect']==9){
                        echo '尾款';
                    }elseif ($model['collect']==10){
                        echo '代理商结账';
                    }elseif ($model['collect']==11){
                        echo '定金退还';
                    }else{
                        echo '请选择搜索类型';
                    }
                    ?>
                </option>

            <?php endforeach;?>
        </select>
        <span class="input-group-btn">
           <button class="btn btn-info btn-search">查找</button>
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
           <td><?php if ($model['collect']==1){
                        echo '固定资产';
                    }elseif ($model['collect']==2){
                        echo '潜水运行';
                    }elseif ($model['collect']==3){
                        echo '日常办公开销';
                    }elseif ($model['collect']==4){
                        echo '维修及维护';
                    }elseif ($model['collect']==5){
                        echo '员工工资';
                    }elseif ($model['collect']==6){
                        echo '房屋及水电';
                    }elseif ($model['collect']==7){
                        echo '公关费用';
                    }elseif ($model['collect']==8){
                        echo '收入定金';
                    }elseif ($model['collect']==9){
                        echo '尾款';
                    }elseif ($model['collect']==10){
                        echo '代理商结账';
                    }elseif ($model['collect']==11){
                        echo '定金退还';
                    }else{
                        echo '请选择搜索类型';
                    } ?></td>
            <td><?= $model->peso ?></td>
            <td><?= $model->rmb ?></td>

            <td><?=$model->comment?></td>
            <td><?= date('Y-m-d',$model->ctime)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('编辑',['finance/edit','id'=>$model->id],['class'=>'btn btn-sm btn-info'])?>
                <a href="/businesses/services/index/finance/del?id=<?=$model->id?>" class="btn btn-sm btn-danger shanchu" title="">删除</a>
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

