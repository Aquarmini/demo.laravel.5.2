@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-default" href="/index/user/add">新增</a>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                <th>ID</th>
                <th>登录名</th>
                <th>名称</th>
                <th>注册时间</th>
                <th>操作</th>
                </thead>
                <tbody id="list">
                @foreach($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a class="btn btn-default" href="/index/user/edit?id={{$item->id}}">编辑</a>
                            <a class="btn btn-default" onclick="del({{$item->id}})">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $list->links() }}
        </div>
    </div>
    <script>
        function del(id) {
            var json = {
                "id": id,
                "_token": $("#_token").val()
            };
            $.post('/index/user/del', json, function (jsonData) {
                if (jsonData.status == '1') {
                    console.log(jsonData);
//                    location = location;
                }
            }, 'json')
        }

        $(function () {
            bindData();
        })
        function bindData() {
            var json = {
                "_token": "{{csrf_token()}}"
            };
            $.post('/index/user/index', json, function (jsonData) {
                console.log(jsonData);
            }, 'json')
        }
    </script>
@endsection