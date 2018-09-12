<h1 class="text-center">消费记录(Records of Money)</h1>
<style>
    h1{color: #960a0b;margin: 5px 20px 50px 20px}
    th{text-align: center}
    td{text-align: center}
</style>
<table class="table table-bordered">
    <tr>
        <th>操作人(Emploee)</th>
        <th>姓名(Username)</th>
        <th>护照(Passport)</th>
        <th>手机号(Tel)</th>
        <th>属性(type)</th>
        <th>人民币(Cny)</th>
        <th>比索(Peso)</th>
        <th>消费内容(Content)</th>
        <th>备注栏(Remark)</th>
        <th>消费时间(Created Time)</th>
        <th>状态</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->admin->username?></td>
            <td><?=$model->username?></td>
            <td><?=$model->passport?></td>
            <td><?=$model->tel?></td>
            <td><?=\services\models\Record::$type[$model->type]?></td>
            <td><?=$model->cny?></td>
            <td><?=$model->peso?></td>
            <td><?=$model->content?></td>
            <td><?=$model->remark?></td>
            <td><?=$model->created_time?date('Y-m-d H:i:s',$model->created_time):''?></td>
            <td style="color: red"><?=$model->state==1?"已结账":"未结账"?></td>
        </tr>
    <?php endforeach;?>
</table>

<?php
//分页工具条
echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);


