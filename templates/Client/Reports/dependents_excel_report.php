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
<table class="table ">
    <tr>
        <td>
        	<h4>Dependent Report</h4>
        </td>
    </tr>
    <tr>
        <td>
        	<h5>Created Date: <?php echo date('j F,Y'); ?></h5>
        </td>
    </tr>
		<?php if($_GET['expired_type'] == 'passport_expired' ){?>
        <tr><td><h5>Comments: Passport Expiry(<?php echo $_GET['start_date_ex_type']; ?> - <?php $_GET['end_date_ex_type']; ?>)</h5></td></tr>
        <?php }else if($_GET['expired_type'] == 'visa_expired'){  ?>
        <tr><td><h5>Comments: Visa Expiry(<?php echo $_GET['start_date_ex_type']; ?> - <?php echo $_GET['end_date_ex_type']; ?>)</h5></td></tr>
        <?php }else if($_GET['expired_type'] == 'emirates_id_expired'){  ?>
        <tr><td><h5>Comments: EmiratesID Expiry(<?php echo $this->DateC->DateFormetforView($_GET['start_date_ex_type']); ?> - <?php echo $_GET['end_date_ex_type']; ?>)</h5></td></tr>
        <?php }else if($_GET['expired_type'] == 'labor_card_expired'){  ?>
        <tr><td><h5>Comments: Labor Card Expiry(<?php echo  $_GET['start_date_ex_type']; ?> - <?php echo $_GET['end_date_ex_type']; ?>)</h5></td></tr>
        <?php }else if($_GET['expired_type'] == 'health_card_exp_date'){  ?>
        <tr><td><h5>Comments: Health Card Expiry(<?php echo  $_GET['start_date_ex_type'] ?> - <?php echo $_GET['end_date_ex_type']; ?>)</h5></td></tr>
        <?php } ?>
     
</table>
<table class="table ">
<thead>
	<tr bgcolor="#C8FD03">
		<th align='left'><?php echo 'COMPANY';?></th>
		<th align='center'><?php echo 'EMPLOYEE NAME';?></th>
        <td align="center">DEPENDENTS NAME </td>
        
        <th align='center'><?php echo 'RELATION';?></th>
		
		<td align='left'><?php echo 'Nationality';?></td>
                <td align='left'><?php echo 'Unified No';?></td>

		
        
        <th align='center'><?php echo 'PASSPORT NO';?></th>
        <th align='center'><?php echo 'PASSPORT EXPIRE DATE';?></th>
        <th align='center'><?php echo 'VISA NO';?></th>
        <th align='center'><?php echo 'VISA EXPIRE DATE';?></th>
        <th align='center'><?php echo 'EMIRATES ID NO';?></th>
        <th align='center'><?php echo 'EMIRATES ID EXPIRE DATE';?></th>
        <th align='center'><?php echo 'HEALTH CARD EXPIRE DATE';?></th>
        
        <th align='center'><?php echo 'STATUS';?></th>
        <th align='right'><?php echo 'CREATED';?></th>
	</tr>
    
	<?php  if(!$full_trans_records->isEmpty()){
				foreach($full_trans_records as $full_trans_record){
					//echo '<pre>'; print_r($full_trans_record); exit;
		?>
		<tr>																
			<td><?php echo $full_trans_record['employee']['company']['name'] ;?></td>
			<td><?php echo ucfirst($full_trans_record['employee']['name']);?></td>
            <td><?php echo $full_trans_record['name']; ?></td>
            <td><?php echo $relations[$full_trans_record['relation']]; ?></td>
            
		<td align='left'><?php echo $full_trans_record['unified_no'];?></td>
        <td align='left'><?php echo $full_trans_record['nationality'];?></td>
					
                <th align='center'><?php echo $full_trans_record['passport_no']; ?></th>
                <th align='center'><?php echo $this->DateC->DateFormetforView($full_trans_record['passport_exp_date']); ?></th>
                <th align='center'><?php echo $full_trans_record['visa_no']; ?></th>
                <th align='center'><?php echo $this->DateC->DateFormetforView($full_trans_record['visa_exp_date']); ?></th>
                <th align='center'><?php echo $full_trans_record['emiratesID_no'];?></th>
                <th align='center'><?php echo $this->DateC->DateFormetforView($full_trans_record['emiratesID_exp_date']);?></th>
                <th align='center'><?php echo $this->DateC->DateFormetforView($full_trans_record['health_card_exp_date']);?></th>
                
             <td><?php echo $full_trans_record['status'] == 1 || is_null($full_trans_record['status'])  ? 'Active' : 'Canceled'; ?></td>
            <td><?php echo $this->DateC->DateFormetforView($full_trans_record['created']);?></td>
		</tr>
		<?php } ?>
			
		<?php } ?>
	 
	 
</thead>
</table>