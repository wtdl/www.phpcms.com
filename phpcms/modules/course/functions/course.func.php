<?php
/**
 * 深圳网通动力网络技术有限公司
 * User: pengjian (szpengjian@gmail.com)
 * Date: 18-5-20
 * Time: 下午11:20
 */


/**
 * 导出数据
 */
function exportExcel($filename="demo",$header=array(),$data,$debug = false){
    if ($debug){
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
    }
    require_once PHPCMS_PATH.'phpcms/libs/classes/PHPExcel.php';
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    //配置表格的行高
    $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
    $rows = 0;
    $header = array(
        '网站建设',
        '网站推广',
        'SEO优化',
        '电子邮箱',
        '小心点'
    );

    foreach ($header as $key => $val){
        $objPHPExcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($key))->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit('A'.++$key, $val,PHPExcel_Cell_DataType::TYPE_STRING);
    }

    $objPHPExcel->setActiveSheetIndex(0);
    ob_end_clean();
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$filename.'-'.date("Y-m-d H:i",time()).'.xls"');
    header('Cache-Control: max-age=0');
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit();
}