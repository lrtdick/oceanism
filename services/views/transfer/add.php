<div class="site-login">
    <div class="show-img-box">
        <?php
        $form=\yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'number')->textInput();
        echo $form->field($model,'rmb')->textInput(['placeholder'=>'请至少输入一个币种']);
        echo $form->field($model,'peso')->textInput(['placeholder'=>'请至少输入一个币种']);
		echo $form->field($model,'comment')->textInput(['placeholder'=>'请填写备注信息']);
        echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-sm btn-success']);
        echo '&nbsp;',\yii\bootstrap\Html::a('取消',['transfer/index'],['class'=>"btn btn-sm btn-danger"]);
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>