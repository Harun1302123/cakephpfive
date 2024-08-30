<?php
//pr($dependents->toArray());
//die;

require_once(ROOT . DS .'vendor' . DS . 'phpexcel' . DS .'Classes'.DS.'PHPExcel.php');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Daman System");
$relationship = array('','Wife' , 'Daughter' ,'Son' , 'Mother' , 'Father' , 'Sister' , 'Other');
//HEADER
$i=1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, '#');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, 'Employee');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Dependent Name');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, 'Relation');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, 'Passport No');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, 'Passport Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, 'Entry Permit No');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, 'Entry Permit Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, 'Change Status Date');

$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, 'Visa No');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, 'Visa Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, 'Emirates ID No');
$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, 'Emirates ID Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, 'Health Card No');
$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, 'Health Card Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, 'Modification');

$objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('eeff92');
//DATA
/*$i++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $user->id);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $user->name);
*/

//if u have a collection of users just loop
//DATA
foreach($dependents as $dependt){
    $i++;
	//echo '<pre>';print_r($dependt); exit;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $i);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $dependt->employee->name);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $dependt->name);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $relationship[$dependt->relation]);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $dependt->passport_no);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, date('j M,Y',strtotime($dependt->passport_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $dependt->entry_permit_no);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, date('j M,Y',strtotime($dependt->entry_permit_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $dependt->change_status_date);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $dependt->visa_no);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, date('j M,Y',strtotime($dependt->visa_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $dependt->emiratesID_no);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, date('j M,Y',strtotime($dependt->emiratesID_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, $dependt->health_card_no);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, date('j M,Y',strtotime($dependt->health_card_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, $dependt->modified);
}
//echo $objPHPExcel->getActiveSheet()->getColumnDimension('A'); exit;
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Dependent Data');
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