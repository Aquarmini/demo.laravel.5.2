@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <span class="line" id="line"></span>
        </div>
    </div>
    <script src="{{\Helper::web('lib/peity-3.2.1/jquery.peity.js')}}"></script>
    <script>
        var data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var jobs = setInterval(function () {
            data.splice(0, 1);
            data.push(Math.random());
            var str = data.join(",");
            conLog(str);
            $("#line").html(str);
            $(".line").peity("line");
        }, 1000);
    </script>
@endsection