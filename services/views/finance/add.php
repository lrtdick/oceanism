<div class="site-login">
    <div class="show-img-box">
        <?php
        $form=\yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'collect')->dropDownList(['1' => '固定资产', '2' => '潜水运行', '3' => '日常办公开销' , '4'=>'维修及维护' , '5'=>'员工工资' , '6'=>'房屋及水电' , '7'=>'公关费用','8'=>'收入定金','9'=>'尾款','10'=>'代理商结账','11'=>'定金退还']);
        echo $form->field($model,'rmb')->textInput(['placeholder'=>'请至少输入一个币种']);
        echo $form->field($model,'peso')->textInput(['placeholder'=>'请至少输入一个币种']);
        echo $form->field($model,'comment')->textInput(['placeholder'=>'填写备注信息']);
        echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-sm btn-success']);
        echo '&nbsp;',\yii\bootstrap\Html::a('取消',['finance/finance-index'],['class'=>"btn btn-sm btn-danger"]);
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>