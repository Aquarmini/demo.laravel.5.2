<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\JobsTestModel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyJobTest extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    private $time = '';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($time = '1900-01-01')
    {
        $this->time = $time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $sql = "insert into task(`create_time`,`num`,`name`)
//            values(?,?,?)";
//        $num = \limx\func\Random::str(6, 'N');
//        $str = \limx\func\Random::str(6);
//        \DB::insert($sql, [$this->time, $num, $str]);
        $job = new JobsTestModel();
        $res = $job->add();
    }
}
