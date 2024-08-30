<style>
	.table_listing .download_report{
		margin: 0 3px 5px;
		display: inline-block;
	}
		
</style>
<div class="content-wrapper">
<?php echo  $this->Flash->render();?>
    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-building-o"></i>Transaction Report</h2>
       <div class="main_info_sec">
		   <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
			   <!-- <div class="col-lg-12">
				   <a href="/admin/companies/add_transaction" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
			   </div> -->
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
           <!--- for searching ----->
		  <?php if(!$follow->isEmpty()){ ?>
		   
		   <div class="clearfix"></div>
		   <div class="for-search">
			  <form class="form-inlin" id="report-form">
				   <div class="row">
					  <div class="col-md-3">
						 <div class="form_block" >
							<label for="for_whom">Category:</label>
							<?php echo $this->Form->input('for_whom',['options'=>['1'=>'Employees','2'=>'Dependent'],'label'=>false,'div'=>false ,'empty'=>'Select Category','class'=>"form-control"]); ?>
						 </div>
					  </div>
					  <div class="col-md-3">
						 <div class="form_block" >
							<label for="company_id">Company:</label>
							<?php echo $this->Form->input('company_id',['options'=>$companies,'label'=>false,'div'=>false ,'empty'=>'Select Company','class'=>"form-control"]); ?>
						 </div>
					  </div>
					  <div class="col-md-3">
						 <div class="form_block" >
							<label for="company_id">Transaction:</label>
							<?php echo $this->Form->input('transaction_id',['options'=>$transactions,'label'=>false,'div'=>false ,'empty'=>'Select Transaction','class'=>"form-control"]); ?>
						 </div>
					  </div>
					  <div class="col-md-3">
						 <div class="form_block" >
							<label for="company_id">Transaction Type:</label>
							<?php echo $this->Form->input('transaction_type_id',['options'=>$transactions_type_ids,'label'=>false,'div'=>false ,'empty'=>'Select Transaction Type','class'=>"form-control"]); ?>
						 </div>
					  </div>
					  <div class="col-md-3">
						 <div class="form_block" >
							<label for="company_id">Start Date:</label>
							<?php echo $this->Form->input('starting_date',['label'=>false,'div'=>false ,'class'=>"form-control date_picker"]); ?>
						 </div>
					  </div>
					  <div class="col-md-3">
						 <div class="form_block" >
							<label for="company_id">Complition Date:</label>
							<?php echo $this->Form->input('completion_date',['label'=>false,'div'=>false, 'class'=>"form-control date_picker"]); ?>
						 </div>
					  </div>
					  <div class="col-md-3">
						 <div class="form_block">
							<label class="" for="searchQuery">Email or Name</label>
							<input type="text" class="form-control" name="email_or_name" id="searchQuery" placeholder="Email or Name">
						 </div>
					  </div>
					  <div class="col-md-3">
						 <div class="form_block">
							<label>&nbsp;</label>
							<button type="submit" class="btn btn-large btn-block btn-info" id="search-reports">Search</button>
						 </div>
					  </div>
				   </div>
				</form>
		   </div>
		  <?php } ?>
		   <div class="for-search">
			   <div class="pull-right">
					  <button class="btn  btn-danger" id="create-xl">Export to Excel</button>
				</div> 
		   </div> 
         <!-- Table -->  
		 <div class="table_listing rep_content">
			<div class="text-center overlape" id="loader" style="display:none">
			   <img src ="/img/loading.gif" width="60px" height="60px">
			</div>
			<div class="table-responsive">
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
							<!-- <th align='left'>Action</th> -->
						</tr>
						<?php if(!$follow->isEmpty()){
								//pr($follow); die;
								foreach($follow as $followtrans){
							?>
							<tr>																
								<td><?php echo $followtrans['company']['name'];?></td>
								<td><?php echo ucfirst($followtrans['name']);?></td>
								<td><?php echo $followtrans['email'];?></td>
								<td><?php echo $followtrans['transaction']['name'];?></td>
								<td><?php echo $followtrans['transaction_type']['transaction_name'];?></td>
								<td><?php echo date('j M,Y',strtotime($followtrans['starting_date']));?></td>
								<td><?php echo date('j M,Y',strtotime($followtrans['completion_date']));?></td>
								
								
								<td><?php echo date('j F,Y H:i:s',strtotime($followtrans['created']));?></td>
								<!--td>
								<?php	
								/*
									$edit = '<a href="'.BASE_URL.'/admin/companies/edit_transaction/'.base64_encode($followtrans->id).'">
									<i class="fa fa-edit" title="Edit"></i></a>';
												
									echo $edit;	*/								
								?>
								</td-->
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
<?php echo $this->Html->script('admin/search_report',['block'=>'scriptBottom']); ?>
<script>
	$('.date_picker').datepicker({ 'dateFormat':'mm/dd/yy'});	
</script>
<style>
	.for-search{
		    padding: 0 20px 20px 20px;
			margin-bottom: 20px;
			}
</style>