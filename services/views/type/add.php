<div class="site-login">
    <div class="show-img-box">
        <?php
        $form=\yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'leixing')->textInput(['placeholder'=>'请填写类型']);
        echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-sm btn-success']);
        echo '&nbsp;',\yii\bootstrap\Html::a('取消',['type/index'],['class'=>"btn btn-sm btn-danger"]);
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>