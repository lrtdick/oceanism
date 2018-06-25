<h1 style="color: #960a0b" class="text-center">资产列表</h1>
<style>
    th{text-align: center}
    td{text-align: center}
#div1{margin-right: 30px}
/*#p{margin: 40px; padding: 20px 20px 10px 435px;  font-size: 20px;}*/
/*#pa{margin: 40px; padding: 20px 20px 10px 390px;  font-size: 20px;}*/

</style>
<form action="" method="get">
    <div class="input-group col-md-3 pull-left" id="div1">
        <input type="text" class="form-control " name="rmb" placeholder="原始资金CNY" >

        <span class="input-group-btn">
           <button class="btn btn-info btn-search">create</button>
        </span>
    </div>
    <div class="input-group col-md-3 pull-left" >
        <input type="text" class="form-control " name="peso"  placeholder="原始资金PESO">

        <span class="input-group-btn">
           <button class="btn btn-info btn-search">create</button>
        </span>
    </div>
    <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
</form>
<form action="" method="get" >
    <div class="input-group col-1-3 pull-left" >
<span class="input-group-btn">
    from:<input class="btn" type="date" name="startdate" value="<?= $startdate?>">
        to:<input class="btn" type="date" name="enddate" value="<?= $enddate?>">
           <button class="btn btn-info btn-search">Search</button>
</span>


    </div>
    <div class="input-group  pull-left" ><strong> </strong></div>
    <input name="_csrf-backend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken?>">
</form>
<table class="table table-bordered">
     <tr>
         <th>币种</th>
         <th>原始资金</th>
         <th>该时间段起始资金</th>

         <th>该时间段净收入</th>
         <th>总资产</th>
     </tr>
    <tr>
        <td>CNY</td>
        <td><?=$Original_cny?></td>
        <td><?=$Start_cny ?></td>
        <td><?=$real_cny ?></td>
        <td><?=$total_rmb ?></td>
    </tr>
    <tr>
        <td>PESO</td>
        <td><?=$Original_peso ?></td>
        <td><?=$Start_peso ?></td>
        <td><?=$real_peso ?></td>
        <td><?=$total_peso ?></td>
    </tr>
</table>
<?php
//分页工具条
//echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);