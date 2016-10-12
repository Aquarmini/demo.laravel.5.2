@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Laravel基础测试</h3>
            <a class="btn btn-default" href="/index/index/phpinfo">phpinfo</a>
            <a class="btn btn-default" href="/index/index/index">第一个程序</a>
            <a class="btn btn-default" href="/index/index/input?name=limx&sex=boy">get方式获取参数</a>
            <a class="btn btn-default" href="/index/index/post">post方式提交</a>
            <a class="btn btn-default" href="/index/index/list">用户列表</a>
            <a class="btn btn-default" href="/index/index/view">用户详情</a>
            <a class="btn btn-default" href="/index/index/add">用户新增</a>
            <a class="btn btn-default" href="/index/index/del">用户删除</a>
            <a class="btn btn-default" href="/index/index/model">模型测试</a>
            <a class="btn btn-default" href="/index/index/login">登录</a>
            <a class="btn btn-default" href="/index/demo/index">中间件测试</a>
        </div>
        <div class="col-md-12">
            <h3>Laravel正式测试</h3>
            <a class="btn btn-default" href="/index/user/index">User表增删改查</a>
            <a class="btn btn-default" href="/index/index/ajax">自定义Service ajaxResponse</a>
            <a class="btn btn-default" href="/index/index/session">session测试</a>
            <a class="btn btn-default" href="/index/index/cache">cache测试</a>
            <a class="btn btn-default" href="/index/index/collect">集合测试</a>
            <a class="btn btn-default" href="/index/index/array">数组测试</a>
            <a class="btn btn-default" href="/index/index/request?id=11">验证测试</a>
            <a class="btn btn-default" href="/index/index/modeltest">Model自定义函数</a>
            <a class="btn btn-default" href="/index/index/queue">队列测试</a>
            <a class="btn btn-default" href="/index/index/pwd">自定义Service 密码服务</a>
            <a class="btn btn-default" href="/index/index/helper">自定义Service Helper服务</a>
            <a class="btn btn-default" href="/index/index/widget">自定义Service Widget服务</a>
            <a class="btn btn-default" href="/index/index/insert">数据库insert if not exists</a>
            <a class="btn btn-default" href="/index/index/command">自定义新建Service服务</a>
            <a class="btn btn-default" href="/index/index/provider">Providers</a>
        </div>
        <div class="col-md-12">
            <h3>模型关系测试</h3>
            <a class="btn btn-default" href="/index/relation/index">初始化</a>
            <a class="btn btn-default" href="/index/relation/roleuser">(1n)查询某ROLE下所有USER</a>
            <a class="btn btn-default" href="/index/relation/userrole">(n1)查询某USER的ROLE</a>
            <a class="btn btn-default" href="/index/relation/usertitle">(nn)查询某USER的TITLE</a>
            <a class="btn btn-default" href="/index/relation/titleuser">(nn)查询某TITLE的USER</a>
            <a class="btn btn-default" href="/index/relation/userbook">(1n)查询某USER的BOOK</a>
            <a class="btn btn-default" href="/index/relation/rolebook">(1nn)查询某ROLE的BOOK</a>
        </div>
        <div class="col-md-12">
            <h3>其他测试</h3>
            <a class="btn btn-default" href="/index/demo/ifelse">ifelse</a>
            <a class="btn btn-default" href="/index/demo/sql">sql注入</a>
            <a class="btn btn-default" href="/index/demo/toexcel">导出EXCEL</a>
            <a class="btn btn-default" href="/index/demo/geetest">极验验证码</a>
            <a class="btn btn-default" href="/index/demo/js">js引用</a>
            <a class="btn btn-default" href="/index/demo/peity">peity</a>
        </div>
    </div>
@endsection