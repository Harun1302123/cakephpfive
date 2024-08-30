<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th align='left'><?php echo $this->Paginator->sort('company_id', 'Company');?></th>
			<th align='left'><?php echo $this->Paginator->sort('name', 'Name');?></th>
			<th align='left'><?php echo $this->Paginator->sort('email', 'Email');?></th>
			<th align='left'><?php echo $this->Paginator->sort('transaction_id', 'Transaction');?></th>
			<th align='left'><?php echo $this->Paginator->sort('transaction_type_id', 'Transaction Types');?></th>
			<th align='left'><?php echo $this->Paginator->sort('starting_date', 'Starting Date');?></th>
			<th align='left'><?php echo $this->Paginator->sort('completion_date', 'Completion Date');?></th>
			
			
			<th align='left'><?php echo $this->Paginator->sort('created', 'Created');?></th>
		</tr>
		<?php if(!$follow->isEmpty()){
				foreach($follow as $followtrans){
			?>
			<tr>																
				<td><?php echo $followtrans['company']['name'];?></td>
				<td><?php echo ucfirst($followtrans['name']);?></td>
				<td><?php echo $followtrans['email'];?></td>
				<td><?php echo $followtrans['transaction']['name'];?></td>
				<td><?php echo $followtrans['transaction_type']['transaction_name'];?></td>
				<td><?php echo $followtrans['starting_date'] != '' ? date('j M,Y',strtotime($followtrans['starting_date'])) : 'Not enter'; ?></td>
				<td><?php echo $followtrans['completion_date'] != '' ? date('j M,Y',strtotime($followtrans['completion_date'])) : 'Not enter';  ?></td>
				
				
				<td><?php echo date('j F,Y H:i:s',strtotime($followtrans['created']));?></td>
				
			</tr>
			<?php }		}else{ ?>
		   <tr><td colspan="7" class="no_record">No Record Found</td></tr>
		  <?php } ?>
	</thead>
</table>