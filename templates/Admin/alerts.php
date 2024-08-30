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
  <h2 class="global_title"><i class="fa fa-building-o"></i> Manage settings</h2>
   <div class="main_info_sec">
	   <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
		   <div class="col-lg-12">
			   <a href="<?php echo BASE_URL; ?>/admin/settings/add_alert" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
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
						<th align='left'><?php echo $this->Paginator->sort('AlertTypes.name', 'Alert For');?></th>
						<th align='left'><?php echo $this->Paginator->sort('delivery', 'Delivery');?></th>
						
						<th align='left'><?php echo $this->Paginator->sort('created', 'Created');?></th>
						<th align='left'>Action</th>
					</tr>
					<?php 
					if(!$alerts->isEmpty()){
							foreach($alerts as $alert){
						?>
						<tr>
							<td><?php echo $alert->alert_type->name;?></td>
							<td><?php if($alert->delivery){ echo 'scheduled';}else{echo 'Immediate'; }?></td>
																			
							<td><?php echo $this->DateC->DateFormetforView($alert->created);?></td>
							<td>
							<?php	
							
								$edit = '<a href="'.BASE_URL.'/admin/settings/edit_alert/'.base64_encode($alert->id).'">
								<i class="fa fa-edit" title="Edit"></i></a>';
								
								/*$delete = '<a href="'.BASE_URL.'/admin/settings/delete_alert/'.base64_encode($alert->id).'" onclick="return confirm('."'Are you sure you want to delete?'".');">
								<i class="fa fa-remove" title="Delete" ></i></a>';	*/			
								echo $edit;									
							?>
							</td>
						</tr>
						<?php }		}else{ ?>
					   <tr><td colspan="4" class="no_record">No Record Found</td></tr>
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
