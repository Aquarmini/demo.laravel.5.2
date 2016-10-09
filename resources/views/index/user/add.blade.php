@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-group">
                    <label for="username">username</label>
                    <input type="text" class="form-control" id="username" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control" id="password" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control" id="name" placeholder="name">
                </div>
                <a onclick="sub()" class="btn btn-default">提交</a>
            </form>
        </div>
    </div>
    <script>
        function sub() {
            var username = $("#username").val();
            var password = $("#password").val();
            var name = $("#name").val();

            var json = {
                "username": username,
                "password": password,
                "name": name,
                "_token": $("#_token").val()
            };

            $.post('/index/user/save', json, function (jsonData) {
                console.log(jsonData);
                if (jsonData.status == '1') {
                    alert('新建成功');
                }
                else {
                    alert('失败');
                }
            }, 'json')
        }
    </script>
@endsection
