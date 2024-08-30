<?php
require_once(ROOT . DS .'vendor' . DS . 'phpexcel' . DS .'Classes'.DS.'PHPExcel.php');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Daman System");
$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

//HEADER
$i=1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Employee ID');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, 'Employee Name');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'PS Number');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, 'Gender ');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, 'Nationality');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, 'Mobile No');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, 'Passport No');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, 'Passport Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, 'Work Permit No');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, 'Work Permit Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, 'Entry Permit No ');
$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, 'Entry Permit Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, 'VISA No');
$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, 'VISA Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, 'Emirates ID No');
$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, 'Emirates ID Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, 'Labor Card No');
$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, 'Labor Card Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, 'Health Care Card No');
$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, 'Health Care Card Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('V'.$i, 'Company Name');


//if u have a collection of users just loop
//DATA
foreach($employees as $employee){
    $i++;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, @$employee->id)->getColumnDimension('A')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, @$employee->name)->getColumnDimension('B')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, @$employee->ps_number)->getColumnDimension('C')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, @$employee->email)->getColumnDimension('D')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, @$employee->gender)->getColumnDimension('E')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, @$employee->nationality)->getColumnDimension('F')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, @$employee->mobile_no)->getColumnDimension('G')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, @$employee->passport_no)->getColumnDimension('H')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, @$employee->passport_exp_date)->getColumnDimension('I')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, @$employee->work_permit_no)->getColumnDimension('J')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, @$employee->work_permit_exp_date)->getColumnDimension('K')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, @$employee->entry_permit_no)->getColumnDimension('L')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, @$employee->entry_permit_exp_date)->getColumnDimension('M')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, @$employee->visa_no)->getColumnDimension('N')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, @$employee->visa_exp_date)->getColumnDimension('O')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, @$employee->emiratesID_no)->getColumnDimension('P')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, @$employee->emiratesID_exp_date)->getColumnDimension('Q')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, @$employee->labor_card_no)->getColumnDimension('R')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, @$employee->labor_card_exp_date)->getColumnDimension('S')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, @$employee->health_card_no)->getColumnDimension('T')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, @$employee->health_card_exp_date)->getColumnDimension('U')->setAutoSize(TRUE);
	$objPHPExcel->getActiveSheet()->setCellValue('V'.$i, @$employee->company->name)->getColumnDimension('V')->setAutoSize(TRUE);

}


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Employee Data');

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