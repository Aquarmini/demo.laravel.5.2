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
        $redis = Helper::redis(1);
        $res = $redis->zRange('chat:server', 0, 10);
        $data = [];
        foreach ($res as $i => $v) {
            $data[$i]['ip'] = $v;
            $data[$i]['score'] = $redis->zScore('chat:server', $v);
        }

        $res = $redis->hgetall('chat:roomid:ip');
        $room = [];
        foreach ($res as $i => $v) {
            $room[$i]['id'] = $i;
            $room[$i]['ip'] = $v;
        }
        return view('index.server_dispatch.index', ['data' => $data, 'roomid' => $room]);
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
        if ($redis->hget('chat:roomid:ip', $id)) {
            return Ajax::error('已经开过房间');
        }

        $ips = $redis->zRange('chat:server', 0, 0);
        $ip = $ips[0];
        $redis->hset('chat:roomid:ip', $id, $ip);
        $redis->hIncrBy('chat:roomid:count', $id, 1);
        $redis->zIncrBy('chat:server', 1, $ip);

        $data['ip'] = $ip;
        return Ajax::success($data);
    }

    public function postEnterroom()
    {
        $id = request()->input('id');
        $redis = Helper::redis(1);
        $ip = '';
        // TODO: 是否已经开房
        if ($ip = $redis->hget('chat:roomid:ip', $id)) {
            $redis->zIncrBy('chat:server', 1, $ip);
            $redis->hIncrBy('chat:roomid:count', $id, 1);
            return Ajax::success([$ip]);
        }
        return Ajax::error('未开房间');
    }

    public function postExitroom()
    {
        $id = request()->input('id');
        $redis = Helper::redis(1);
        $ip = '';
        // TODO: 是否已经开房
        if ($ip = $redis->hget('chat:roomid:ip', $id)) {
            $redis->zIncrBy('chat:server', -1, $ip);
            $count = $redis->hIncrBy('chat:roomid:count', $id, -1);
            if ($count <= 0) {
                // 房间内 无人 删除roomid
                $redis->hdel('chat:roomid:count', $id);
                $redis->hdel('chat:roomid:ip', $id);
            }
            return Ajax::success([$count]);
        }
        return Ajax::error('未开房间');
    }
}
