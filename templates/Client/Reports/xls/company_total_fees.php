<?php
require_once(ROOT . DS .'vendor' . DS . 'phpexcel' . DS .'Classes'.DS.'PHPExcel.php');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Daman System");
$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

//HEADER
$i=1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Name');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, 'Total Govt. Fees');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Total Typing Fees');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, 'Total Fees');

//if u have a collection of users just loop
//DATA

foreach($companyTrans as $company_transaction){
    $i++;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, @$company_transaction->company_name)->getColumnDimension('A')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, @$company_transaction->govt_sum)->getColumnDimension('B')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, @$company_transaction->typing_sum)->getColumnDimension('C')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, @$company_transaction->total_fees)->getColumnDimension('D')->setAutoSize(TRUE);
}


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Company Total Fees');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
//call the function in the controller with $output_type = F and $file with complete path to the file, to generate the file in the server for example attach to email
if (isset($output_type) && $output_type == 'F') {
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save($file);
 } else {
    // Redirect output to a client's web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$file.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
}
?>
