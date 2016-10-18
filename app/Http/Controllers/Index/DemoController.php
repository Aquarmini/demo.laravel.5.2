<?php

namespace App\Http\Controllers\Index;

use App\Models\JobsTestModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Ajax;
use Helper;

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
        $redis->set('1111', 111);
        dump($redis->keys('*'));
    }

    public function getJobs()
    {
        $job = new JobsTestModel();
        $res = $job->add();
    }

}
