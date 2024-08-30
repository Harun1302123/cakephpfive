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
</style>
<div class="content-wrapper">
<?php echo  $this->Flash->render();?>
    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-building-o"></i> Manage Follow Transaction</h2>
       <div class="main_info_sec">
		   <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
			   <div class="col-lg-12">
				   <a href="/admin/TransactionFollows/add/" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
			   </div>
		   </div>
        	<style>
			   .text-center.overlape {
        				position: absolute;
    					width: 100%;
   						z-index: 9999;
    					left: 0;
    					top: 39%;
				}
			   .table_listing{
				   position:relative;}
		   </style>
            
            <!-- Table -->
            
		 <div class="table_listing rep_content">
			<div class="text-center overlape" id="loader" style="display:none">
			   <img src ="/img/loading.gif" width="60px" height="60px">
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th align='left'><?php echo $this->Paginator->sort('name', 'Company Name');?></th>	
							<th align='left'><?php echo $this->Paginator->sort('Transaction', 'Transaction');?></th>
							<th align='left'><?php echo $this->Paginator->sort('Transaction Types', 'Transaction Types');?></th>
							<th align='left'><?php echo $this->Paginator->sort('Name', 'Name');?></th>
							<th align='left'><?php echo $this->Paginator->sort('created', 'Created');?></th>
							<th align='left'>Action</th>
						</tr>
						<?php if($follow){
								//pr($follow); die;
								foreach($follow as $followtrans){
							?>
							<tr>																
								<td><?php echo $followtrans['company']['name'];?></td>
								<td><?php echo $followtrans['transaction']['name'];?></td>
								<td><?php echo $followtrans['transactiontype']['transaction_name'];?></td>
								<td><?php echo $followtrans['name'];?></td>
								<td><?php echo date('j F,Y H:i:s',strtotime($followtrans->mod_date));?></td>
								<td>
								<?php	
								
									$edit = '<a href="'.BASE_URL.'/admin/TransactionFollows/edit/'.base64_encode($followtrans->id).'">
									<i class="fa fa-edit" title="Edit"></i></a>';
									
									$delete = '<a href="'.BASE_URL.'/admin/TransactionFollows/delete/'.base64_encode($followtrans->id).'" onclick="return confirm('."'Are you sure you want to delete?'".');">
									<i class="fa fa-remove" title="Delete" ></i></a>';				
									echo $edit.'  '.$delete;									
								?>
								</td>
							</tr>
							<?php }		}else{ ?>
						   <tr><td colspan="8" class="no_record">No Record Found</td></tr>
						  <?php } ?>
					</thead>
				</table>
			</div>	
			<div class="table_page_info">
				<div class="row">
					<div class="col-lg-5 col-sm-5 col-xs-12">
						<p>
							<?php echo $this->Paginator->counter('Showing {{start}} to {{end}} of {{count}}');?>
						</p>
					</div>
					
					<div class="col-lg-7 col-sm-7 col-xs-12">
						<ul class="pagination">
						<?php echo $this->Paginator->prev('  ' . __('Previous'));?>
						  <?php echo $this->Paginator->numbers();?>
						  <?php echo $this->Paginator->next('  ' . __('Next'));?>
						</ul>
					</div>
				</div>
			</div>			
		</div>            
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!---------------- / course------------->
