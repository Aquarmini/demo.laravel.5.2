<?php

namespace App\Http\Controllers\Api;

use App\Jobs\MyJobTest;
use App\Models\JobsTestModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function insJobTest()
    {
        // 高并发调用Jobs 测试队列

        // 不使用队列
//        $job = new JobsTestModel();
//        $res = $job->add();

        // 使用队列
        $job = new MyJobTest();
        $this->dispatch($job);
    }

    public function showParams()
    {
        dump(request()->url());
        $params = request()->input();
        dump($params);
    }
}
