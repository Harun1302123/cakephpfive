<style>
	.isdeleted{
		white-space: nowrap;
		padding: 5px 10px;
		margin: 0 3px;
		font-size: 13px;
		color: #fff!important;
		font-weight: 600;
		background: #a94242;
		border-radius: 3px;
	}
	.table_listing .download_report{
		margin: 0 3px 5px;
		display: inline-block;
	}
	.cus{
		font-size: small;
	}
	th,td{
		border: 1px solid  #333 !important;
	}
	th,td:nth-of-type(odd) {
    	background-color: #d9d9d9;
	}
</style>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align='left'>COMPANY</th>
      <th align='left'>EMPLOYEE NAME</th>
      <td align='left'>DOCUMENTS</td>
      <th align='left'>DATE OF RECEIVE</th>
      <th align='left'>DATE OF SENT</th>
    </tr>
    <?php ?>
    <?php 
			  if(count($documents)){ //echo '<pre>'; print_r($documents->toArray()); exit;
				foreach($documents as $documents_dataRow){
					//echo '<pre>'; print_r($documents_dataRow); exit;
				if(count($documents_dataRow->dependent)  > 0  || count($documents_dataRow->employee->id ) > 0){
					//echo 'ssss'; exit;
					//echo '<pre>'; print_r($documents_dataRow); exit;
						?>
    <?php  if($documents_dataRow->passport_receive_admin == 1){?>
    <tr>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
      <td align='left'>Passport</td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->passport_receive_admin_date) ?></td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->passport_send_admin_date) ?></td>
    </tr>
    <?php }?>
    <?php  if($documents_dataRow->bc_receive_admin == 1){?>
    <tr>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
      <td align='left'>Birthday Certificate:</td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->bc_receive_admin_date) ?></td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->bc_send_admin_date) ?></td>
    </tr>
    <?php }?>
    <?php  if($documents_dataRow->mc_receive_admin == 1){?>
    <tr>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
      <td align='left'>Marriage Certificate</td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->mc_receive_admin_date) ?></td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->mc_send_admin_date) ?></td>
    </tr>
    <?php }?>
    <?php  if($documents_dataRow->eid_receive_admin == 1){?>
    <tr>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
      <td align='left'>Emirates ID</td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->eid_receive_admin_date) ?></td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->eid_send_admin_date) ?></td>
    </tr>
    <?php }?>
    <?php  if($documents_dataRow->dc_receive_admin == 1){?>
    <tr>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
      <td align='left'>Degree Certificate</td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->dc_receive_admin_date) ?></td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->dc_send_admin_date) ?></td>
    </tr>
    <?php }?>
    <?php  if($documents_dataRow->medical_receive_admin == 1){?>
    <tr>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
      <td align='left'>Medical</td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->medical_receive_admin_date) ?></td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->medical_send_admin_date) ?></td>
    </tr>
    <?php }?>
    <?php  if($documents_dataRow->other_receive_admin == 1){?>
    <tr>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
      <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
      <td align='left'>Other</td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->other_receive_admin_date) ?></td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->other_send_admin_date) ?></td>
    </tr>
    <?php }?>
    <?php  }
			     }
			  }else{ ?>
    <tr>
      <td colspan="9" class="no_record">No Record Found</td>
    </tr>
    <?php } ?>
  </thead>
</table>
