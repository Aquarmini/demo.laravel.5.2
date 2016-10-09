<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return view('index.demo.geetest');
    }

}
