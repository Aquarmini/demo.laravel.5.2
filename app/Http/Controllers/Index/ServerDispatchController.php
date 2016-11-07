<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Ajax;
use Helper;

class ServerDispatchController extends Controller
{
    public function getIndex()
    {
        return view('index.server_dispatch.index');
    }

    public function postInit()
    {
        // 初始化 数据
        $data = [
            '192.168.1.1:8080',
            '192.168.1.2:8080',
            '192.168.1.3:8080',
            '192.168.1.4:8080',
            '192.168.1.5:8080',
            '192.168.1.6:8080',
            '192.168.1.7:8080',
        ];

        $redis = Helper::redis(1);
        foreach ($data as $i => $v) {
            $redis->zAdd('chat:server', 0, $v);
        }
        return Ajax::success();
    }

    public function postOpenroom()
    {
        $id = rand(0, 1000);
        $redis = Helper::redis(1);
        // TODO: 是否已经开房
        if ($redis->get('roomid:' . $id)) {
            return Ajax::error('已经开过房间');
        }

        return Ajax::success();
    }
}
