<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/8/31 Time: 13:54
// +----------------------------------------------------------------------
namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Jobs\MyJobTest;
use App\Models\UserModel;
use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    public function getIndex()
    {
        echo 'Hello Laravel!';
    }

    public function anyInput(Request $request)
    {
        dump($request->path());
        dump($request->input());
        dump($method = $request->method());
        if ($request->isMethod('post')) {
            dump($request->input());
        }
    }

    public function getPost()
    {
        return view('index.post', ['key' => time()]);
    }

    public function getView(Request $request)
    {
        $users = DB::select('select * from user where id = ?', [1]);

        dump($users);
    }

    public function getAdd(Request $request)
    {
        $time = time();
        $res = DB::update("insert into user(name) values ('{$time}')");

        dump($res);
    }

    public function getDel(Request $request)
    {
        $users = DB::select('select * from user order by id desc');

        $res = obj_to_array($users);
        $id = $res[0]['id'];
        if ($id > 10) {
            $res = DB::update("delete from user where id = $id");
            dump($res);
        }

    }

    public function getList(Request $request)
    {
        $users = DB::select('select * from user');
        dump($users);
    }

    public function getModel()
    {
        dump(UserModel::all());
        dump(UserModel::where('id', 1)->get());
        $time = time();
        dump(UserModel::where('id', 1)->update(['name' => $time]));
    }

    public function getLogin(Request $request)
    {
        $pwd = $request->input('key', '910123');
        session(['appKey' => $pwd]);
        dump(session()->all());
    }

    public function getAjax()
    {
        $data = ['name' => 'limx', 'sex' => '男'];
        return \Ajax::success($data);
    }

    public function getSession()
    {
        dump(session()->all());
        session(['time' => time()]);
        dump(session('time'));
    }

    public function getCache()
    {
        $key = md5('LoveYi@52111');
        \Cache::put($key, 'aaa', 1);
        dump(\Cache::get($key));
    }

    public function getCollect()
    {
        $data = [1, 2, 3, 4, 5, 6, 7, 33, 44, 55, 111];
        $col = collect($data);
        dump($col);
        dump($col->avg(function ($data) {
            return $data + 1;
        }));
    }

    public function getArray()
    {
        $array = array_add(['name' => 'Desk'], 'price', 100);
        dump($array);
    }

    public function getRequest(TestRequest $request)
    {
        dump($request);
    }

    public function getModeltest()
    {
        $M = new UserModel();
        dump($M->test());
    }

    public function getQueue()
    {
        for ($i = 0; $i < 1000; $i++) {
            $time = \limx\func\Time::now();
            $job = (new MyJobTest($time))->delay(1000);
            $this->dispatch($job);
        }

    }

    public function getPwd()
    {
        $res = \PSS::pwd('910123');
        dump($res);
        dump(\PSS::check('910123', '1ac310af44b7d66fcb702f99a958cb73'));
    }

    public function getHelper()
    {
        $res = \Helper::web('app');
        dump($res);
    }

    public function getWidget()
    {
        return view('index.index.widget');
    }

    public function getInsert()
    {
        $res = DB::table('user')->updateOrInsert(['username' => '000000'], ['name' => time()]);
        dump($res);
    }

    public function getCommand()
    {
        dump(\Nginx::test());
    }

    public function getPhpinfo()
    {
        echo phpinfo();
    }

    public function getProvider()
    {
        echo 1;
    }

}