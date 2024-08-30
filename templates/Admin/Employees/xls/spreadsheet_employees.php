<?php
require_once(ROOT . DS .'vendor' . DS . 'phpexcel' . DS .'Classes'.DS.'PHPExcel.php');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Daman System");

//HEADER
$i=1;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, '#');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'PS Number');
$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, 'Employee Name');
$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, 'Mobile');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, 'Gender');
$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, 'Passport No');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, 'Passport Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, 'Work Permit No');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, 'Work Permit Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, 'Entry Permit No');
$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, 'Entry Permit Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, 'Change Status Date');

$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, 'Visa No');

$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, 'Visa Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, 'Emirates ID No');
$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, 'Emirates ID Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, 'Basic Salary');
$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, 'Accommodation');
$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, 'Transportation');
$objPHPExcel->getActiveSheet()->setCellValue('V'.$i, 'Others');
$objPHPExcel->getActiveSheet()->setCellValue('W'.$i, 'Labor Card No');
$objPHPExcel->getActiveSheet()->setCellValue('X'.$i, 'Labor Card Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('Y'.$i, 'Health Card No');
$objPHPExcel->getActiveSheet()->setCellValue('Z'.$i, 'Health Card Expiry Date');
$objPHPExcel->getActiveSheet()->setCellValue('AA'.$i, 'Creation & Modification');
//DATA
/*$i++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $user->id);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $user->name);
*/

$objPHPExcel->getActiveSheet()->getStyle('A1:AA1')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getStyle('A1:AA1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('eeff92');

/*$objPHPExcel->getStyle('A1:AA1')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'a2d246')
        )
    )
);*/


//if u have a collection of users just loop
//DATA
foreach($employees as $employee){ 
    $i++;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $i);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $employee->company->name/*$employee->name*/);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $employee->ps_number);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $employee->name /*$employee->email*/);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $employee->email/*$employee->gender*/);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $employee->mobile_no/*$employee->nationality*/);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $employee->gender);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $employee->passport_no);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, date('j M,Y',strtotime($employee->passport_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $employee->work_permit_no);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, date('j M,Y',strtotime($employee->work_permit_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $employee->entry_permit_no);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$i, date('j M,Y',strtotime($employee->entry_permit_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$i, date('j M,Y',strtotime($employee->status_change_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$i, $employee->visa_no);
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$i, date('j M,Y',strtotime($employee->visa_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$i, $employee->emiratesID_no);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.$i, date('j M,Y',strtotime($employee->emiratesID_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('S'.$i, $employee->s_basic);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.$i, $employee->accomodation);
	$objPHPExcel->getActiveSheet()->setCellValue('U'.$i, $employee->transportion);
	$objPHPExcel->getActiveSheet()->setCellValue('V'.$i, $employee->others);
	$objPHPExcel->getActiveSheet()->setCellValue('W'.$i, $employee->labor_card_no);
	$objPHPExcel->getActiveSheet()->setCellValue('X'.$i, date('j M,Y',strtotime($employee->labor_card_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('Y'.$i, $employee->health_card_no);
	$objPHPExcel->getActiveSheet()->setCellValue('Z'.$i, date('j M,Y',strtotime($employee->health_card_exp_date)));
	$objPHPExcel->getActiveSheet()->setCellValue('AA'.$i, $employee->modified);

}
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Employee Data');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
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
	ob_end_clean();
	ob_start();

    $objWriter->save('php://output');
}