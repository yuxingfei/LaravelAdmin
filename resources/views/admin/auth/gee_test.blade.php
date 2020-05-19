{{asset(__ADMIN_PLUGINS__.'/gee-test/gee-test.min.js')}}
<div id="wait" class="text-center"  style="height: 44px;font-size: 18px;">
    正在加载验证码...
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group text-center">
            <div id="embed-captcha" style="width: 300px;margin: 0 auto;;"></div>
        </div>
    </div>
</div>

<script>
    var handlerEmbed = function (captchaObj) {
        $("#loginButton").click(function (e) {
            var validate = captchaObj.getValidate();
            if (!validate) {
                layer.msg('请先完成验证',{icon:2});
                e.preventDefault();
            }
        });
        // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
        captchaObj.appendTo("#embed-captcha");
        captchaObj.onReady(function () {
            //$("#loginButton").attr("disabled",false);
            $("#wait").hide();
        });

    };

    $(function () {
        $.ajax({
            // 获取id，challenge，success（是否启用failback）
            url: "{{url('admin/auth/initGeeTest')}}",
            type: "POST",
            dataType: "JSON",
            success: function (result) {
                let data = result.data;
                // 使用initGeetest接口
                // 参数1：配置参数
                // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                initGeetest({
                    with: '300px',
                    gt: data.gt,
                    challenge: data.challenge,
                    new_captcha: data.new_captcha,
                    product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                    offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                }, handlerEmbed);
            }
        });
    });
</script>