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

    //横向单元格标识  
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');  
      
    $objPHPExcel->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称  
    $_row = 0;   //设置纵向单元格标识  
    $_row++;  
    $i = 0;  
    foreach($header AS $v){   //设置列标题  
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);  
        $i++;  
    }  
    $_row++;  

    if($data){  
        $i = 0;  
        foreach($data AS $_v){  
            $j = 0;  
            foreach($_v AS $_cell){  
                $objPHPExcel->getActiveSheet()->getStyle($cellName[$j])->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);  
                $j++;  
            }  
            $i++;  
        }  
    }  
    $objPHPExcel->setActiveSheetIndex(0);
    ob_end_clean();
    header('Content-Type: application/vnd.ms-excel.numberformat');
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

/**
 * 导入Excel数据
 * @param  string  $file  [description]
 * @param  integer $sheet [description]
 * @return [type]         [description]
 */
function importExecl($file='', $sheet=0){  
    $file = iconv("utf-8", "gb2312", $file);   //转码  
    if(empty($file) OR !file_exists($file)) {  
        die('file not exists!');  
    }  
    require_once PHPCMS_PATH.'phpcms/libs/classes/PHPExcel.php';  //引入PHP EXCEL类  
    $objRead = new PHPExcel_Reader_Excel2007();   //建立reader对象  
    if(!$objRead->canRead($file)){  
        $objRead = new PHPExcel_Reader_Excel5();  
        if(!$objRead->canRead($file)){  
            die('No Excel!');  
        }  
    }  
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');  
    $obj = $objRead->load($file);  //建立excel对象  
    $currSheet = $obj->getSheet($sheet);   //获取指定的sheet表  
    $columnH = $currSheet->getHighestColumn();   //取得最大的列号  
    $columnCnt = array_search($columnH, $cellName);  
    $rowCnt = $currSheet->getHighestRow();   //获取总行数  
  
    $data = array();  
    for($_row=1; $_row<=$rowCnt; $_row++){  //读取内容  
        for($_column=0; $_column<=$columnCnt; $_column++){  
            $cellId = $cellName[$_column].$_row;  
            $cellValue = $currSheet->getCell($cellId)->getValue();  
            if($cellValue instanceof PHPExcel_RichText){   //富文本转换字符串  
                $cellValue = $cellValue->__toString();  
            }  
  
            $data[$_row][$cellName[$_column]] = $cellValue;  
        }  
    }  
    return $data;  
}