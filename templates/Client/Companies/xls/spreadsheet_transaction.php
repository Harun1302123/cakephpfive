<?php
require_once(ROOT . DS .'vendor' . DS . 'phpexcel' . DS .'Classes'.DS.'PHPExcel.php');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Daman System");
$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

//HEADER
$i=1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Transaction ID');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, 'Name');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, 'Transaction');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, 'Transaction Type ');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, 'Starting Date');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, 'Completion Date');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, 'Mobile No');

//if u have a collection of users just loop
//DATA
foreach($company_transactions as $company_transaction){
    $i++;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, @$company_transaction->id)->getColumnDimension('A')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, @$company_transaction->name)->getColumnDimension('B')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, @$company_transaction->company->name)->getColumnDimension('C')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, @$company_transaction->transaction->name)->getColumnDimension('D')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, @$company_transaction->transaction_type->transaction_name)->getColumnDimension('E')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, @$company_transaction->starting_date)->getColumnDimension('F')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, @$company_transaction->completion_date)->getColumnDimension('G')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, @$company_transaction->email)->getColumnDimension('H')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, @$company_transaction->mobile_no)->getColumnDimension('I')->setAutoSize(TRUE);
}


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Company Transaction Data');
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

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