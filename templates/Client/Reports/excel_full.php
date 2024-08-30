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
				if($full_trans_record->starting_date == ''){continue;}
					if($full_trans_record->company_transaction->for_whom == 1){
						if ($full_trans_record->company_transaction->transaction_type_id == 1) {
							$optionsV =array(1 =>'Quota', 2 =>'Job Offer', 3 =>'Work permit', 4 =>'Pre Aprovel',  5 =>'Bank guarantee', 6 =>'E Visa', 7=>'Change status', 8 =>'Medical fitness',  9 =>'Emirates ID', 10 =>'Typing labour card' , 11 =>'Submit labour card',  12 =>'Visa stamp', 13=>'Send to Employee');
						} else if ($full_trans_record->company_transaction->transaction_type_id == 2) {
							$optionsV =array(1 =>'Medical fitness',  2 =>'Emirates ID', 3=>'Visa stamp');
						} else if ($full_trans_record->company_transaction->transaction_type_id == 3) {
							$optionsV =array(1 =>'Offer Letter',  2 =>'Send to Employee', 3=>'Submisstion');
						}
					}else{
						if ($full_trans_record->company_transaction->transaction_type_id == 1) {
							$optionsV =array(1 =>'Entry Permint', 2 =>'Change status', 3 =>'Medical', 4 =>'Emirates ID',  5 =>'Visa stamp');
						} else if ($full_trans_record->company_transaction->transaction_type_id == 2) {
							$optionsV =array(1 =>'Medical', 2 =>'Emirates ID',  3 =>'Visa stamp');
					}
				}
			//echo '<pre>'; print_r($transactions_type_ids); continue;
		?>
		<tr>
			<td><?php echo $full_trans_record->company_transaction->company->name;?></td>
			<td><?php echo ucfirst($full_trans_record->company_transaction->name);?></td>
			<td><?php echo $transactions_type_ids[$full_trans_record->company_transaction->transaction_type_id];?></td>
            <td><?php echo $optionsV[$full_trans_record->transaction_type_id];?></td>
			<td><?php echo $this->DateC->DateFormetforView($full_trans_record->starting_date);?></td>
			<td><?php echo $transaction_status[$full_trans_record->status];?></td>
			<td><?php echo $full_trans_record->status == 3 ? $this->DateC->DateFormetforView($full_trans_record->completion_date) : 'NULL'; ?></td>
            <td><?php echo $full_trans_record->note;?></td>
            <td><?php echo $full_trans_record->user ? $full_trans_record->user->Username : null; ?></td>

		</tr>
		<?php } ?>

		<?php } ?>


</thead>
</table>
