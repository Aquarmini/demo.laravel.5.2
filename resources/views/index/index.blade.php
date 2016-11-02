@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>文章</h3>
            <a class="btn btn-default" href="/index/doc/index">收集的文章</a>
            <a class="btn btn-default" href="/index/doc/lnmp7">centos lnmp7</a>
        </div>
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
            <a class="btn btn-default" href="/index/index/scope">Query Scope</a>
            <a class="btn btn-default" href="/index/index/distinct">DB Distinct</a>
            <a class="btn btn-default" href="/index/index/hash">Hash</a>

        </div>
        <div class="col-md-12">
            <h3>Laravel模型关系测试</h3>
            <a class="btn btn-default" href="/index/relation/index">初始化</a>
            <a class="btn btn-default" href="/index/relation/roleuser">(1n)查询某ROLE下所有USER</a>
            <a class="btn btn-default" href="/index/relation/userrole">(n1)查询某USER的ROLE</a>
            <a class="btn btn-default" href="/index/relation/usertitle">(nn)查询某USER的TITLE</a>
            <a class="btn btn-default" href="/index/relation/titleuser">(nn)查询某TITLE的USER</a>
            <a class="btn btn-default" href="/index/relation/userbook">(1n)查询某USER的BOOK</a>
            <a class="btn btn-default" href="/index/relation/rolebook">(1nn)查询某ROLE的BOOK</a>
            <a class="btn btn-default" href="/index/relation/eager">Eager Loading</a>
            <a class="btn btn-default" href="/index/relation/load">Lazy Eager Loading</a>
            <a class="btn btn-default" href="/index/relation/mostbookuser">查询拥有BOOK最多的10个USER</a>
        </div>
        <div class="col-md-12">
            <h3>其他测试</h3>
            <a class="btn btn-default" href="/index/demo/ifelse">ifelse</a>
            <a class="btn btn-default" href="/index/demo/sql">sql注入</a>
            <a class="btn btn-default" href="/index/demo/toexcel">导出EXCEL</a>
            <a class="btn btn-default" href="/index/demo/geetest">极验验证码</a>
            <a class="btn btn-default" href="/index/demo/js">js引用</a>
            <a class="btn btn-default" href="/index/demo/peity">peity</a>
            <a class="btn btn-default" href="/index/demo/zzfby">正则非捕获元</a>
            <a class="btn btn-default" href="/index/demo/mypdo">测试MyPDO的事务</a>
            <a class="btn btn-default" href="/index/demo/myredis">测试MyRedis</a>
            <a class="btn btn-default" href="/index/demo/jobs">测试 Jobs</a>
            <a class="btn btn-default" href="/index/demo/arrget">获取数组某一项的值</a>
            <a class="btn btn-default" href="/index/demo/getarr">测试getArr函数</a>
            <a class="btn btn-default" href="/index/demo/del">Redis批量删除</a>
            <a class="btn btn-default" href="/index/demo/md5">MD5测试</a>
            <a class="btn btn-default" href="/index/demo/cookie">COOKIE测试</a>
            <a class="btn btn-default" href="/index/demo/yaoyiyao">H5摇一摇</a>
            <a class="btn btn-default" href="/index/demo/ups">update的同时查出表主键</a>
            <a class="btn btn-default" href="/index/demo/buquan">php 补全函数</a>
            <a class="btn btn-default" href="/index/demo/xiaoxi">执行消息队列</a>
            <a class="btn btn-default" href="/index/demo/object">object</a>

        </div>
    </div>
@endsection