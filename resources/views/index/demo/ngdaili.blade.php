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

@endsection