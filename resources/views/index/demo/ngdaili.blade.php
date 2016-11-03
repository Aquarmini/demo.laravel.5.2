@extends('layouts.master')
@section('content')
    <code>
        NGINX 代理
        <pre>
    location /laravel2/{
        proxy_pass http://laravel.lara.php.cn/;
    }
        </pre>
    </code>

    <code>
        NGINX 重写
        <pre>
    location ~* ^/laravel/ {
        rewrite "^/laravel/(.*)$" http://laravel.lara.php.cn/$1 last;
    }
        </pre>
    </code>
    <p>查看图片路径</p>
    <img src="/app/images/erweima.png" alt="">
    <p>结论：</p>
    <p>nginx重写对静态文件、路径等都没有影响。因为会跳转到自己的页面里</p>
    <p>nginx代理因为链接没有被重写，所以静态文件、跳转路径都要改成代理前的路径规则</p>

@endsection