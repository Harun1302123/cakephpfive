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
  <h2 class="global_title"><i class="fa fa-building-o"></i> Manage Companies</h2>
   <div class="main_info_sec">
	   <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
		   <div class="col-lg-12">
			   <a href="/admin/Companies/companyrecord/" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
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
						<th align='left'><?php echo $this->Paginator->sort('cmpny_name', 'Company Name');?></th>
						<th align='left'><?php echo $this->Paginator->sort('trade_lic_number', 'Trade License Number');?></th>
						<th align='left'><?php echo $this->Paginator->sort('lic_expiry_date', 'Trade License Expiry Date');?></th>
						<th align='left'><?php echo $this->Paginator->sort('card_number', 'Establishment Card No');?></th>
						<th align='left'><?php echo $this->Paginator->sort('created', 'Created');?></th>
						<th align='left'>Action</th>
					</tr>
					<?php 
					if($company){
							foreach($company as $companys){
						?>
						<tr>
							<td><?php echo $companys->name;?></td>
							<td><?php echo $companys->trade_license_no;?></td>
							<td><?php echo date('j F,Y H:i:s',strtotime($companys->trade_license_expiry_date));?></td>							
							<td><?php echo $companys->estblishment_card_no;?></td>							
							<td><?php echo date('j F,Y H:i:s',strtotime($companys->mod_date));?></td>
							<td>
							<?php	
							
								$edit = '<a href="'.BASE_URL.'/admin/Companies/companyrecord/'.base64_encode($companys->id).'">
								<i class="fa fa-edit" title="Edit"></i></a>';
								
								$delete = '<a href="'.BASE_URL.'/admin/Companies/delete/'.base64_encode($companys->id).'" onclick="return confirm('."'Are you sure you want to delete?'".');">
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
