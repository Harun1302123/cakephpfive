<table class="table table-bordered table-hover">
<thead>
	<tr>
		
		<th align='left'><?php echo $this->Paginator->sort('name', 'Name');?></th>
		
		
		<th align='left'><?php echo $this->Paginator->sort('gov_fees', 'Total Govt. fees');?></th>
		<th align='left'><?php echo $this->Paginator->sort('typing_fees', 'Total Typing fees');?></th>
		<th align='left'><?php echo $this->Paginator->sort('typing_fees', 'Total fees');?></th>

	</tr>
	<?php //if(!$companyTrans->isEmpty()){
			
			foreach($companyTrans as $companyTran){
		?>
				
		<tr>																
			<td><?php echo $companyTran['company_name'];?></td>
			
			<td><?php echo $companyTran['govt_sum'];?></td>
			<td><?php echo $companyTran['typing_sum'];?></td>
			<td><?php echo $companyTran['total_fees'];?></td>
		</tr>
		
		<?php  } ?>
	   
</thead>
</table>