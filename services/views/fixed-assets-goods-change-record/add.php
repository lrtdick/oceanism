<div class="site-login">
    <div class="show-img-box">
        <?php
        $form=\yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'gid')->dropDownList(\services\models\FixedAssetsGoods::getGoods());
        echo $form->field($model,'type')->dropDownList(\services\models\FixedAssetsGoodsChangeRecord::getType());
        echo $form->field($model,'amount')->textInput(['placeholder'=>'-减少 +增加']);
        echo $form->field($model,'remark')->textInput(['placeholder'=>'填写备注信息']);
        echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-sm btn-success']);
        echo '&nbsp;',\yii\bootstrap\Html::a('取消',['finance/finance-index'],['class'=>"btn btn-sm btn-danger"]);
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>