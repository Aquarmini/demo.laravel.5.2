<?php
namespace App\Services;
class HelperService
{
    private $root = '/';

    /**
     * [web 返回网站根目录]
     * @author limx
     */
    public function web($path)
    {
        return $this->root . $path;
    }

    public function pdo()
    {
        $config['host'] = env('DB_HOST', '127.0.0.1');
        $config['user'] = env('DB_USERNAME', 'root');
        $config['pwd'] = env('DB_PASSWORD', '');
        $config['dbname'] = env('DB_DATABASE', 'test');
        $config['host'] = env('DB_HOST', '127.0.0.1');
        $config['charset'] = 'utf8';

        return \limx\tools\MyPDO::getInstance($config);
    }

    public function mysql($dbname = '')
    {
        $config['type'] = 'mysql';
        $config['host'] = env('DB_HOST', '127.0.0.1');
        $config['user'] = env('DB_USERNAME', 'root');
        $config['pwd'] = env('DB_PASSWORD', '');
        $config['dbname'] = empty($dbname) ? env('DB_DATABASE', 'test') : $dbname;
        $config['host'] = env('DB_HOST', '127.0.0.1');
        $config['charset'] = 'utf8';

        return \limx\tools\MyPDO::getInstance($config);
    }

    public function sqlite($dbname = '')
    {
        $dbname = empty($dbname) ? env('DB_DATABASE', 'test') : $dbname;
        $config['type'] = 'sqlite';
        $config['dbname'] = database_path('sqlite/' . $dbname . '.sqlite');

        return \limx\tools\MyPDO::getInstance($config);
    }

    public function redis()
    {
        $config['host'] = env('REDIS_HOST', '127.0.0.1');
        $config['auth'] = env('REDIS_PASSWORD', '');
        $config['port'] = env('REDIS_PORT', '6379');

        return \limx\tools\MyRedis::getInstance($config);
    }

    public function wxRedirectUri($path)
    {
        $url = env('WX_REDIRECT_URI', 'http://laravel.tp5.lmx0536.cn/');
        return $url . $path;
    }
}