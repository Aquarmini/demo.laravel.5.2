@extends('layouts.master')
@section('content')

        <!-- 为使用方便，直接使用jquery.js库，如您代码中不需要，可以去掉 -->
{{--<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>--}}
        <!-- 引入封装了failback的接口--initGeetest -->
<script src="http://static.geetest.com/static/tools/gt.js"></script>

<!-- 若是https，使用以下接口 -->
<!-- <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script> -->
<!-- <script src="https://static.geetest.com/static/tools/gt.js"></script> -->

<form class="popup" action="/index/demo/geetest" method="post">
    <h2>嵌入式Demo</h2>
    <input class="inp" name="type" type="hidden" value="pc">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <br>
    <p>
        <label for="username2">用户名：</label>
        <input class="inp" id="username2" type="text" value="极验验证">
    </p>
    <br>
    <p>
        <label for="password2">密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
        <input class="inp" id="password2" type="password" value="123456">
    </p>

    <div id="embed-captcha"></div>
    <p id="wait" class="show">正在加载验证码......</p>
    <p id="notice" class="hide">请先拖动验证码到相应位置</p>

    <br>
    <input class="btn" id="embed-submit" type="submit" value="提交">
</form>

<script>
    var handlerEmbed = function (captchaObj) {
        $("#embed-submit").click(function (e) {
            var validate = captchaObj.getValidate();
            console.log(validate);
            if (!validate) {
                $("#notice")[0].className = "show";
                setTimeout(function () {
                    $("#notice")[0].className = "hide";
                }, 2000);
                e.preventDefault();
            }
        });
        // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
        console.log(captchaObj);
        captchaObj.appendTo("#embed-captcha");
        captchaObj.onReady(function () {
            $("#wait")[0].className = "hide";
        });
        // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
    };
    initGeetest({
        gt: "{{$geetest['gt']}}",
        challenge: "{{$geetest['challenge']}}",
        product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
        offline: !{{$geetest['success']}} // 表示用户后台检测极验服务器是否宕机，一般不需要关注
        // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
    }, handlerEmbed);

</script>

@endsection