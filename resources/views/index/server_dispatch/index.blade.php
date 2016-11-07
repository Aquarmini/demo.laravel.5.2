@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <a onclick="initServer()" class="btn btn-default">初始化</a>

            <a onclick="openRoom()" class="btn btn-default">开房间</a>
        </div>
        <div class="col-md-12">
            <table class="table">
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td>{{$v['ip']}}</td>
                        <td>{{$v['score']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <table class="table">
                <tbody>
                @foreach($roomid as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['ip']}}</td>
                        <td>
                            <a onclick="enterRoom({{$v['id']}})">进入房间</a>
                            <a onclick="exitRoom({{$v['id']}})">退出房间</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function initServer() {
            var json = {
                " _token": $("#_token").val()
            };
            $.post("/index/server_dispatch/init", json, function (jsonData) {
                conLog(jsonData);
            }, "json");
        }

        function openRoom() {
            var json = {
                "_token": $("#_token").val()
            };

            $.post("/index/server_dispatch/openroom", json, function (jsonData) {
                conLog(jsonData);
            }, "json");
        }

        function enterRoom(id) {
            var json = {
                "_token": $("#_token").val(),
                'id': id
            };
            $.post("/index/server_dispatch/enterroom", json, function (jsonData) {
                conLog(jsonData);
            }, "json");
        }

        function exitRoom(id) {
            var json = {
                "_token": $("#_token").val(),
                'id': id
            };
            $.post("/index/server_dispatch/exitroom", json, function (jsonData) {
                conLog(jsonData);
            }, "json");
        }
    </script>
@endsection