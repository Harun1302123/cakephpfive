<?php
require_once(ROOT . DS .'vendor' . DS . 'phpexcel' . DS .'Classes'.DS.'PHPExcel.php');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Daman System");
$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

//HEADER
$i=1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Dependent ID');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, 'Dependent Name');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Passport No');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, 'Passport Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, 'Work Permit No');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, 'Work Permit Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, 'Entry Permit No ');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, 'Entry Permit Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, 'VISA No');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, 'VISA Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, 'Emirates ID No');
$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, 'Emirates ID Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, 'Health Care Card No');
$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, 'Health Care Card Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, 'Employee');


//DATA
/*$i++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $user->id);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $user->name);
*/

//if u have a collection of users just loop
//DATA
foreach($dependents as $dependt){
    $i++;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, @$dependt->id)->getColumnDimension('A')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, @$dependt->name)->getColumnDimension('B')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, @$dependt->passport_no)->getColumnDimension('C')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, @$dependt->passport_exp_date)->getColumnDimension('D')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, @$dependt->employee->work_permit_no)->getColumnDimension('E')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, @$dependt->employee->work_permit_exp_date)->getColumnDimension('F')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, @$dependt->entry_permit_no)->getColumnDimension('G')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, @$dependt->entry_permit_exp_date)->getColumnDimension('H')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, @$dependt->visa_no)->getColumnDimension('I')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, @$dependt->visa_exp_date)->getColumnDimension('J')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, @$dependt->emiratesID_no)->getColumnDimension('K')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, @$dependt->emiratesID_exp_date)->getColumnDimension('L')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, @$dependt->health_card_no)->getColumnDimension('M')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, @$dependt->health_card_exp_date)->getColumnDimension('N')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, @$dependt->employee->name)->getColumnDimension('O')->setAutoSize(TRUE);
}


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Dependent Data');

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