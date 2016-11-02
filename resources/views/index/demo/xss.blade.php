@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-group">
                    <label for="name">xss脚本</label>
                    <textarea class="form-control" name="xss" id="xss" cols="30" rows="10"><script>window.location = "http://www.lmx0536.cn/";</script></textarea>
                </div>
                <a onclick="sub()">提交</a>
            </form>
        </div>
        <div id="info"></div>
    </div>
    <script>
        function sub() {
            var json = {
                'xss': $("#xss").val(),
                '_token': $("#_token").val()
            };
            $.post("/index/demo/xss", json, function (jsonData) {
                if (jsonData.status = 1) {
                    $("#info").html(jsonData.data.xss);
                }
            }, "json");
        }
    </script>
@endsection