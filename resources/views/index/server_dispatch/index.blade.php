@extends('layouts.master')
@section('content')
    <a onclick="initServer()" class="btn btn-default">初始化</a>

    <a onclick="openRoom()" class="btn btn-default">开房间</a>

    <script>
        function initServer() {
            var json = {
                "_token": $("#_token").val()
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
    </script>
@endsection