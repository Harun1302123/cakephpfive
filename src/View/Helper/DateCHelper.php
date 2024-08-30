<?php
namespace App\View\Helper;
use Cake\View\Helper;
class DateCHelper extends Helper {
 	 public function DateFormetCake($data){
		// echo $data; exit;
		if($date){echo 'heree'; exit;
			echo $date->format('dd/mm/yy');
		}else{
			echo 'heree14'; exit;
			echo '';
		}
	}
	
	
	 public function DateFormetforView($data){
		//date('j F,Y',strtotime($employee->emiratesID_exp_date)
		//data = $data == '' ? 'Not entered' : date('j F,Y',strtotime($data);
		//return  $data;
		return $data == '' ? '' : $data->format('j M,Y');
	}
	
	public function DateFormetforViewReport($data){
		//date('j F,Y',strtotime($employee->emiratesID_exp_date)
		//data = $data == '' ? 'Not entered' : date('j F,Y',strtotime($data);
		//return  $data;
		return $data == '' ? '' : $data;
	}
	
}
?>