<?php

require_once(ROOT . DS .'vendor' . DS . 'phpexcel' . DS .'Classes'.DS.'PHPExcel.php');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Daman System");
//HEADER
$i=1;
$objPHPExcel->setActiveSheetIndex(0);
//$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Transaction ID');
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, 'Name');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, 'Mobile No.');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, 'Transaction');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, 'Transaction Type');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, 'Starting Date');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, 'Completion Date');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, 'status');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, 'Documents');

$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('eeff92');

//DATA
/*$i++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $user->id);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $user->name);
*/

//if u have a collection of users just loop
//DATA
$status_trasection = array ('','Pending' , 'Under Process' , 'Done');
foreach($company_transactions as $company_transaction){
    $i++;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $company_transaction->company->name/*$company_transaction->id*/);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $company_transaction->name);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $company_transaction->email /*$company_transaction->company->name*/);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $company_transaction->mobile_no /*@$company_transaction->transaction->name*/);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, @$company_transaction->transaction_type->transaction_name);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $company_transaction->transaction->name);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, date('j M,Y',strtotime($company_transaction->starting_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, date('j M,Y',strtotime($company_transaction->completion_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $status_trasection[$company_transaction->status]);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $company_transaction->note);
	

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
	 //echo 'hereee888'; print_r($objPHPExcel); exit; exit;
    // Redirect output to a client's web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$file.'"');
    header('Cache-Control: max-age=0');
	
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
}