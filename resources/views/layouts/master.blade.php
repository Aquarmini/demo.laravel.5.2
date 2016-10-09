<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.js"></script>
    {{--<script src="{{asset('lib/basic/m.basic.min.js')}}"></script>--}}
    <script src="{{\Helper::web('lib/basic/m.basic.min.js')}}"></script>

    <style>
        body {
            padding-bottom: 70px;
        }
    </style>
</head>
<body>
<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}"/>
<div class="container-fluid">
    @yield('content')
</div>

@include('layouts.footer')

</body>
</html>