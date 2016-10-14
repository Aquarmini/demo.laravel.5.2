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
}