<?php

namespace App\Http\Controllers\Index;

use App\Models\JobsTestModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Ajax;
use Helper;
use PRedis;
use DB;
use limx\tools\wx\OAuth;
use limx\tools\wx\JsSdk;

class DemoController extends Controller
{
    public function getIndex()
    {
        return 'use middleware success';
    }

    public function getIfelse()
    {
        $num = 8;
        if ($num > 10)
            dump('num>10');
        else if ($num > 9)
            dump('num>9');
        else
            dump('num <=9');
    }

    public function getSql()
    {
        $id = request()->input('id');
        $sql = "select * from user where id = ?";
        $res = \DB::select($sql, [$id]);
        dump($res);
    }

    public function getToexcel()
    {
        $objPHPExcel = new \PHPExcel();
        //获取数据
        $datas = array(
            array('王城', '男', '18', '1997-03-13', '18948348924'),
            array('李飞虹', '男', '21', '1994-06-13', '159481838924'),
            array('王芸', '女', '18', '1997-03-13', '18648313924'),
            array('郭瑞', '男', '17', '1998-04-13', '15543248924'),
            array('李晓霞', '女', '19', '1996-06-13', '18748348924'),
        );

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Phpmarker")->setLastModifiedBy("Phpmarker")->setTitle("Phpmarker")->setSubject("Phpmarker")->setDescription("Phpmarker")->setKeywords("Phpmarker")->setCategory("Phpmarker");
        // Set document title
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '名字')->setCellValue('B1', '性别')->setCellValue('C1', '年龄')->setCellValue('D1', '出生日期')->setCellValue('E1', '电话号码');

        $i = 2;
        foreach ($datas as $data) {

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[0])->getStyle('A' . $i)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[1]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[2]);

            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D' . $i, $data[3], \PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode("@");

            // 设置文本格式
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E' . $i, $data[4], \PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
            $i++;
        }

        //保存excel—2007格式
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        //或者$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); 非2007格式

        //$objWriter->save("cache/test.xlsx");

        //输出到浏览器
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="resume.xlsx"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
    }

    public function getGeetest()
    {
        $GtSdk = new \limx\tools\GeetestLib(env('GEETEST_ID'), env('GEETEST_KEY'));
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        session(['gtserver' => $status]);
        session(['user_id' => $user_id]);

        $data['geetest'] = json_decode($GtSdk->get_response_str(), true);
        return view('index.demo.geetest', $data);
    }

    public function postGeetest()
    {
        $GtSdk = new \limx\tools\GeetestLib(env('GEETEST_ID'), env('GEETEST_KEY'));

        $user_id = session('user_id');
        if (session('gtserver') == 1) {   //服务器正常
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
            if ($result) {
                return Ajax::success(['gtserver' => 1]);
            } else {
                return Ajax::error();
            }
        } else {  //服务器宕机,走failback模式
            if ($GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
                return Ajax::success(['gtserver' => 0]);
            } else {
                return Ajax::error();
            }
        }
    }

    public function getJs()
    {
        return view('index.demo.js');
    }

    public function getPeity()
    {
        return view('index.demo.peity');
    }

    public function getZzfby()
    {
        $match = "/^http:\/\/(?:\w*).com\/$/";
        preg_match_all($match, "http://baidu.com/", $res);
        dump($res);
        $match = "/^http:\/\/(\w*).com\/$/";
        preg_match_all($match, "http://baidu.com/", $res);
        dump($res);
    }

    public function getMypdo()
    {
        $pdo = Helper::pdo();
        $sql = 'select * from user where id < ?;';
        $res = $pdo->query($sql, [4]);
        dump($res);

        $pdo->beginTransaction();
        $sql = 'insert into user(username) values(?);';
        $time = time();
        $res = $pdo->execute($sql, [$time]);
        dump($res);
        $pdo->commit();
//        $pdo->rollback();

    }

    public function getMyredis()
    {
        $redis = Helper::redis();
        $redis->set('1111', 111, 60);
        dump(PRedis::keys('*'));
    }

    public function getJobs()
    {
        $job = new JobsTestModel();
        $res = $job->add();
    }

    public function getArrget()
    {
        $config = [
            'aa' => ['bb' => ['c' => 'hello world']],
        ];

        dump($config);
        dump(\limx\func\Arr::get('aa.bb.c', $config));
    }

    public function getGetarr()
    {
        $url = 'http://laravel.tp5.lmx0536.cn/api/params';
        dump($url);
        $params = ['k1' => 'v1', 'ke' => 'v2'];
        dump($params);
        echo "结果\n";
        echo \limx\func\Curl::getArr($url, $params);
    }

    public function getDel()
    {
        $redis = Helper::redis();
        $redis->set('1', 1);
        $redis->set('2', 1);
        $redis->set('3', 1);

        $res = $redis->keys('*');
        dump($res);
        $redis->delete($res);
        dump($redis->keys('*'));
    }

    public function getMd5()
    {
        $key = 'hello world!';
        dump(md5($key));

        $key = 'hello world! 李铭昕';
        dump(md5($key));
    }

    public function getCookie()
    {
        $action = request()->input('action', 'get');
        if ($action == 'get') {
            if (!empty($_COOKIE['COOKIE_KEY'])) {
                echo $_COOKIE['COOKIE_KEY'];
            }
        } else {
            setcookie('COOKIE_KEY', 'limx', time() + 60, '/');
        }
    }

    /**
     * [getYaoyiyao desc]
     * @desc 摇一摇
     * @author limx
     */
    public function getYaoyiyao()
    {
        return view('index.demo.yaoyiyao');
    }

    public function getUps()
    {
        dump("创建存储过程");
        dump("CREATE PROCEDURE getUserName( IN `in_name` VARCHAR(255))
BEGIN
SET @update_id := 0;
UPDATE `user` SET `name` = 'limx', `username` = (SELECT @update_id := username)
WHERE `name` = in_name LIMIT 1;
SELECT @update_id AS `username`;
END;");
        $res = DB::select("CALL getUserName(?)", ['']);
        dump($res);
    }

    public function getBuquan()
    {
        $value = date('d');
        //將數字由左邊補零至三位數
        $value = str_pad($value, 9, '*', STR_PAD_LEFT);
        echo $value;
    }

    public function getXiaoxi()
    {
        system('/usr/local/php/bin/php /_html/html/tp5/laravel/artisan queue:work --daemon');
    }

    public function getObject()
    {
        $M = new \stdClass();
        dump($M);
        $M->test = 'test';
        $M->time = time();
        dump($M);

        $res = [
            'test' => 'test',
            'time' => time()
        ];
        dump($res);
    }

    public function getXss()
    {
        $data['xss'] = '';
        if (request()->input('xss')) {
            $data['xss'] = request()->input('xss');
        }
        return view('index.demo.xss', $data);
    }

    public function postXss()
    {
        $xss = request()->input('xss');
        $xss = e($xss);
        $data['xss'] = $xss;
        return Ajax::success($data);
    }

    public function getRand()
    {
        $sql = "SELECT id,`name` FROM `user`;";
        $res = DB::select($sql);
        foreach ($res as $i => $v) {
            echo $v->name . ",";
        }
        echo "\n";
        $sql = "UPDATE `user` SET `name` = CEILING(RAND()*10000+1);";
        $res = DB::update($sql);
        dump($res);
        $sql = "SELECT id,`name` FROM `user`;";
        $res = DB::select($sql);
        foreach ($res as $i => $v) {
            echo $v->name . ",";
        }
        echo "\n";
    }

    public function getWx()
    {
        $path = request()->path();
        $code = request()->input('code');
        $appid = env('APPID');
        $appsec = env('APPSECRET');
        $api = new OAuth($appid, $appsec);
        $api->code = $code;// 微信官方回调回来后 会携带code
        $url = Helper::wxRedirectUri($path);//当前的URL
        $api->setRedirectUrl($url);
        $res = $api->getUserInfo();
        dump($res);

    }

    public function getTixr()
    {
        $appid = env('APPID');
        $appsec = env('APPSECRET');
        $jssdk = new JsSdk($appid, $appsec);
        /** @var 设置TOKEN缓存地址 token_path */
        $jssdk->setTokenPath(storage_path('wx/token.php'));
        /** @var 设置票据缓存地址 ticket_path */
        $jssdk->setTicketPath(storage_path('wx/ticket.php'));
        /** @var 获得签名数据包 $signPackage */
        $signPackage = $jssdk->GetSignPackage();
        view()->share('signPackage', $signPackage);

        return view('index.demo.tixr');
    }

    public function getNgdaili()
    {
        return view('index.demo.ngdaili');
    }

    public function getRedisdel()
    {
        dump("redis-cli -a password -n 1 keys \"*\" | xargs redis-cli -a password -n 1 del");
    }

    public function getPdo2()
    {
        $mysql = Helper::mysql();
        $res = $mysql->query("SELECT COUNT(0) AS count FROM `user`");
        dump($res[0]['count']);

        $mysql = Helper::mysql('my_admin');
        $res = $mysql->query("SELECT COUNT(0) AS count FROM `tb_admin`");
        dump($res[0]['count']);
    }

    public function getSqlite()
    {
        $sqlite = Helper::sqlite();
        $sql = "CREATE TABLE IF NOT EXISTS messages (
                    id INTEGER PRIMARY KEY,
                    title TEXT,
                    message TEXT,
                    time INTEGER)";
        $sqlite->execute($sql);
        $insert = "INSERT INTO messages (title, message, time) VALUES (?, ?, ?)";
        $sqlite->execute($insert, ['t1', 'm1', time()]);
        $sqlite->execute($insert, ['t2', 'm2', time()]);
        $sqlite->execute($insert, ['t3', 'm3', time()]);
        dump($sqlite->query("SELECT * FROM messages LIMIT 0,5;"));
    }
}
