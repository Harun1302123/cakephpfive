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
		<th align='left'><?php echo 'COMPANY';?></th>
		<th align='left'><?php echo 'NAME';?></th>
		<th align='left'><?php echo 'TRANSACTION';?></th>
		<th align='left'><?php echo 'TYPE';?></th>
		<th align='left'><?php echo 'STARTED DATE';?></th>
		<th align='left'><?php echo 'STATUS';?></th>
		<th align='left'><?php echo 'COMLETED DATE';?></th>
		<th align='left'><?php echo 'NOTE';?></th>
		<th align='left'><?php echo 'USER';?></th>

	</tr>
	<?php if(!$full_trans_records->isEmpty()){
			//echo '<pre>'; print_r($full_trans_records); exit;
			foreach($full_trans_records as $full_trans_record){
				//if($full_trans_record->starting_date == ''){continue;}
					if($full_trans_record->_matchingData['CompanyTransactions']->for_whom == 1){
							if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 1) {
								$optionsV =array(0 =>'Quota', 1 =>'Job Offer', 2 =>'Work permit', 3 =>'Pre Aprovel',  4 =>'Bank guarantee', 5 =>'E Visa', 6=>'Change status', 7 =>'Medical fitness',  8 =>'Emirates ID', 9 =>'Typing labour card' , 10 =>'Submit labour card',  11 =>'Visa stamp', 12=>'Send to Employee');
							} else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 2) {
								$optionsV =array(0 =>'Medical fitness',  1 =>'Emirates ID', 2=>'Visa stamp');
							} else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 3) {
								$optionsV =array(0 =>'Offer Letter',  1 =>'Send to Employee', 2=>'Submisstion');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 4){
								$optionsV =array(0 =>'Type Application', 1 =>'Send Signature',  2 =>'Submit in MOL');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 5){
								$optionsV =array(0 =>'Type Application', 1 =>'Approved by EDNRD');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 6){
								$optionsV =array(0 =>'Send to Employee', 1 =>'Submit to MOL');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 7){
								$optionsV =array(0 =>'Type Application', 1 =>'Send VISA in EDNRD');
							}
						}else{
							if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 1) {
								$optionsV =array(0 =>'Entry Permint', 1 =>'Change status', 2 =>'Medical', 3 =>'Emirates ID',  4 =>'Visa stamp');
							} else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 2) {
								$optionsV =array(0 =>'Medical', 1 =>'Emirates ID',  2 =>'Visa stamp');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 3) {
								$optionsV =array(0 =>'Type Application', 1 =>'Approved by EDNRD');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 4) {
								$optionsV =array( 0 =>'Type Application' , 1 =>'Submit VISA in EDNRD');
							}
						}
			//echo '<pre>'; print_r($full_trans_record->transaction_type_id); continue;
		?>
		<tr>
              	<td><?php echo $full_trans_record->_matchingData['Companies']->name;?></td>
                <td><?php echo $full_trans_record->_matchingData['CompanyTransactions']->name;?></td>
                <td><?php echo $transactions_type_ids[$full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id];?></td>
                <td><?php echo isset($optionsV[$full_trans_record->transaction_type_id]) ? $optionsV[$full_trans_record->transaction_type_id] : null; ?></td>
                <td><?php echo $this->DateC->DateFormetforViewReport($full_trans_record->starting_date);?></td>
                <td><?php echo $transaction_status[$full_trans_record->status];?></td>
                <td><?php echo $full_trans_record->status == 3 ? $this->DateC->DateFormetforViewReport($full_trans_record->completion_date) : 'NULL'; ?></td>
                <td><?php echo $full_trans_record->note;?></td>
                <td>
                    <?php
                        if (!is_null($full_trans_record->user)) {
                            echo $full_trans_record->user->Username;
                        } else {
                            echo null;
                        }
                    ?>
                </td>
                <!--td>
								<?php
								/*
									$edit = '<a href="'.BASE_URL.'/admin/companies/edit_transaction/'.base64_encode($followtrans->id).'">
									<i class="fa fa-edit" title="Edit"></i></a>';

									echo $edit;	*/
								?>
								</td-->
              </tr>
		<?php } ?>

		<?php } ?>


</thead>
</table>
