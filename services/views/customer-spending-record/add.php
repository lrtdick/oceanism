<div class="site-login">
    <div class="show-img-box">
        <?php
        $form=\yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'type')->dropDownList(\services\models\Record::type1());
        echo $form->field($model,'cny');
        echo $form->field($model,'peso');
        echo $form->field($model,'content')->textarea(['rows'=>10,'cols'=>10]);
        echo $form->field($model,'remark')->textarea(['rows'=>5,'cols'=>5]);
        echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-sm btn-success']);
        echo '&nbsp;<input type="button" name="Submit" value="返回上一页"  class="btn btn-sm btn-success" onclick="javascript:window.history.back(-1);">';
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>