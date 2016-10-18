<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobsTestModel extends Model
{
    protected $table = 'jobs_test';

    public function add()
    {
        $test = $this->orderBy('id', 'desc')->first();
        if (empty($test)) {
            // 插入第一条数据
            $this->value = rand(0, 100);
            $this->save();
        } else {
            $this->value = $test->value + 1;
            $this->save();
        }
        return $test;
    }

    public function addByTrans()
    {

    }
}
