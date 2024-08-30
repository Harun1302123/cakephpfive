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
<!--- for searching ----->
<!-- Table -->

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align='left'>COMPANY</th>
      <th align='left'>EMPLOYEE NAME</th>
      <td align='left'>TYPE OF REMINDERS</td>
      <th align='left'>DATE OF SENT</th>
      <!-- <th align='left'>Action</th> --> 
    </tr>
    <?php if(!$SendAlert_data->isEmpty()){
				foreach($SendAlert_data as $SendAlert_dataRow){
						?>
    <tr>
      <td><?php echo ($SendAlert_dataRow->for_whom == 2 ) ? $SendAlert_dataRow->dependent->employee->company->name :  $SendAlert_dataRow->employee->company->name  ; ?></td>
      <td><?php echo ($SendAlert_dataRow->for_whom == 2 ) ? $SendAlert_dataRow->dependent->employee->name.'('.$SendAlert_dataRow->dependent->name.')':  $SendAlert_dataRow->employee->name  ; ?></td>
      <td align='left'><?php echo $SendAlert_dataRow->alert_type->name; ?></td>
      <td align='left'><?php echo $this->DateC->DateFormetforView($SendAlert_dataRow->created); ?></td>
    </tr>
    <?php 
				}
                        }else{ ?>
    <tr>
      <td colspan="9" class="no_record">No Record Found</td>
    </tr>
    <?php } ?>
  </thead>
</table>
