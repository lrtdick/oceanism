<h1 style="color: #960a0b" class="text-center">资产列表</h1>
<style>
    th{text-align: center}
    td{text-align: center}
</style>
<table class="table table-bordered">
    <tr>
        <th>人民币(CNY)</th>

    </tr>
    <tr>
        <td><?= $rmb."( CNY )" ?></td>
    </tr>
        <tr>
            <th>比索(PESO)</th>
        </tr>
    <tr>
        <td><?= $peso."( PESO )" ?></td>
    </tr>
</table>
<?php
//分页工具条
//echo \yii\widgets\LinkPager::widget(['pagination'=>$pager,'lastPageLabel'=>'末页','nextPageLabel'=>'下一页','prevPageLabel'=>'上一页','firstPageLabel'=>'首页']);