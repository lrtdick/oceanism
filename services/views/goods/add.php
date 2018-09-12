<div class="site-login">
    <div class="show-img-box">
        <?php
        $form=\yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'category_id')->dropDownList(\services\models\Goods::getCategory());
        echo $form->field($model,'goods_name');
        echo $form->field($model,'intro');
        echo $form->field($model,'price_cny');
        echo $form->field($model,'price_peso');
        echo $form->field($model,'price_agent_cny');
        echo $form->field($model,'price_agent_peso');
        echo $form->field($model,'is_on_sale',['inline'=>1])->radioList($buttons['is_on_sale']);
        echo $form->field($model,'status',['inline'=>1])->radioList($buttons['goods_status']);
        echo \yii\bootstrap\Html::submitButton($buttons['common']['submit'],['class'=>'btn btn-sm btn-success']);
        echo '&nbsp;<input type="button" name="Submit" value="Back"  class="btn btn-sm btn-success" onclick="javascript:window.history.back(-1);">';
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>