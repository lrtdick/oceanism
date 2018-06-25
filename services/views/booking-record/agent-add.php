
<div class="site-login">
    <div class="show-img-box">
        <?php
        $form=\yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'passport');
        echo $form->field($model,'wechat');
        echo $form->field($model,'username');
        echo $form->field($model,'plan_checkin_time')->textInput(['placeholder' =>'yyyy-mm-dd Only']);
        echo $form->field($model,'plan_checkout_time')->textInput(['placeholder' =>'yyyy-mm-dd Only']);
        echo $form->field($model,'remark')->textarea(['rows'=>10,'cols'=>10]);
        echo \yii\bootstrap\Html::submitButton($buttons['common']['submit'],['class'=>'btn btn-sm btn-success']);
        echo '&nbsp;<input type="button" name="Submit" value="返回上一页"  class="btn btn-sm btn-success" onclick="javascript:window.history.back(-1);">';
        \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>
<!--<script>-->
<!--    var time_start = $(".my-startDate").flatpickr({-->
<!--        defaultDate:new Date(parseInt() * 1000).toLocaleString().replace(/:\d{1,2}$/,' ') || new Date(),-->
<!--        time_24hr:true,-->
<!--        allowInput:true,-->
<!--        enableTime:true,-->
<!--        enableSeconds:true,-->
<!--        altFormat:"Y-m-d H:i:S",-->
<!--        onChange:function(dateObject, dateString){-->
<!--            var start = Date.parse(dateObject);-->
<!--            var end = Date.parse($(".my-endDate").val());-->
<!--            if(start > end){-->
<!--                alert("开始日期不能大于结束日期")-->
<!--                $(".my-startDate").val($(".my-endDate").val());-->
<!--            }-->
<!--        }-->
<!--    });-->
<!--    var time_end = $(".my-endDate").flatpickr({-->
<!--        defaultDate:new Date(parseInt() * 1000).toLocaleString().replace(/:\d{1,2}$/,' ') || new Date(),-->
<!--        time_24hr:true,-->
<!--        allowInput:true,-->
<!--        enableTime:true,-->
<!--        enableSeconds:true,-->
<!--        altFormat:"Y-m-d H:i:S",-->
<!--        onChange:function(dateObject, dateString){-->
<!--            var start = Date.parse($(".my-startDate").val());-->
<!--            var end = Date.parse(dateObject);-->
<!--            if(start > end){-->
<!--                alert("结束日期不能小于于开始日期")-->
<!--                $(".my-endDate").val($(".my-startDate").val());-->
<!--            }-->
<!--        }-->
<!--    });-->
<!--    $(".toggle-table").on("click", function(){-->
<!--        if(!$("#main").hasClass("show")){-->
<!--            $("#main-table, #main").toggleClass("show1");-->
<!--            setTimeout(function(){-->
<!--                myChart.setOption(option);-->
<!--            }, 5)-->
<!--        }-->
<!--        else {-->
<!--            $("#main-table, #main").toggleClass("show1");-->
<!--        }-->
<!--    });-->
<!--</script>-->