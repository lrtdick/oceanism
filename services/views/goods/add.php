<div class="site-login">
    <div class="show-img-box">
        <?php
        $form=\yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'category_id')->dropDownList(\services\models\Goods::getCategory());
        echo $form->field($model,'gname');
        echo $form->field($model,'intro');
        echo $form->field($model,'price_cny');
        echo $form->field($model,'price_peso');
        echo $form->field($model,'is_sale',['inline'=>1])->radioList(\services\models\Goods::$is_on_sale);
        echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-sm btn-success']);
        echo '&nbsp;<input type="button" name="Submit" value="返回上一页"  class="btn btn-sm btn-success" onclick="javascript:window.history.back(-1);">';
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>