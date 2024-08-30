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
  <h2 class="global_title"><i class="fa fa-building-o"></i> Manage Dependent</h2>
   <div class="main_info_sec">
	   <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
		   <div class="col-lg-3">
			   <a href="<?php echo BASE_URL; ?>/admin/dependents/add" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
		   </div>

			<div class="col-lg-9 pull-right">
			<div class="for-search">
			  <form class="form-inlin" id="report-form">
				   <div class="row">

                      <div class="col-md-4">
						 <div class="form_block" >
							<?php echo $this->Form->input('company_id',['type' => 'select', 'options'=>$companies,'label'=>false,'div'=>false ,'empty'=>'Select Company','class'=>"form-control"]); ?>
						 </div>
					  </div>


                      <div class="col-md-4">
						 <div class="form_block" >
							<?php echo $this->Form->input('employee_id',['type' => 'select', 'options'=>$employees,'label'=>false,'div'=>false ,'empty'=>'Select Employee','class'=>"form-control"]); ?>
						 </div>
					  </div>
					  <div class="col-md-4">
						 <div class="form_block">
							<input type="text" class="form-control" name="email_or_name" id="searchQuery" placeholder="Name">
						 </div>
					  </div>
					  <div class="col-md-2 pull-right">
						 <div class="form_block">
							<button type="submit" class="btn btn-large btn-block btn-info" id="search-reports">Search</button>
						 </div>
					  </div>
				   </div>
				</form>
			  </div>
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
	<div class="for-search hide">
	   <div class="pull-right" style="margin-right: 10px;margin-bottom:10px;">
			  <button class="btn btn-primary" id="create-xls-dependents">Export to Excel</button>
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
						<th align='left'><?php echo $this->Paginator->sort('name', 'Name');?></th>
						<th align='left'><?php echo $this->Paginator->sort('passport_no', 'Passport No');?></th>
						<th align='left'><?php echo $this->Paginator->sort('passport_exp_date', 'Passport Expire Date');?></th>

						<th align='left'><?php echo $this->Paginator->sort('visa_no', 'Visa No');?></th>
						<th align='left'><?php echo $this->Paginator->sort('visa_exp_date', 'Visa  Expire Date');?></th>

						<th align='left'><?php echo $this->Paginator->sort('emiratesID_no', 'Emirates ID No');?></th>
						<th align='left'><?php echo $this->Paginator->sort('emiratesID_exp_date', 'Emirates ID Expiry Date');?></th>
						<th align='left'>Action</th>
					</tr>
					<?php
					if(!$dependents->isEmpty()){
							foreach($dependents as $dependent){
						?>
						<tr>
							<td><?php echo $dependent->name;?></td>
							<td><?php echo $dependent->passport_no;?></td>
							<td><?php echo $this->DateC->DateFormetforView($dependent->passport_exp_date); ?></td>

							<td><?php echo $dependent->visa_no;?></td>
							<td><?php echo $this->DateC->DateFormetforView($dependent->visa_exp_date); ?></td>

							<td><?php echo $dependent->emiratesID_no;?></td>
							<td><?php echo $this->DateC->DateFormetforView($dependent->emiratesID_exp_date);?></td>
							<td>
							<?php

								$edit = '<a href="'.BASE_URL.'/admin/dependents/edit/'.base64_encode($dependent->id).'">
								<i class="fa fa-edit" title="Edit"></i></a>';

								$delete = '<a href="'.BASE_URL.'/admin/dependents/delete/'.base64_encode($dependent->id).'" onclick="return confirm('."'Are you sure you want to delete?'".');">
								<i class="fa fa-remove" title="Delete" ></i></a>';

								$attachment = '<a data-attach-depet="'.base64_encode($dependent->id).'" class="attach_for_depet" href="javascript:void(0)">
								<i class="fa fa-upload" title="Upload Attachment" ></i></a>';

								echo $edit.'  '.$delete.'  '.$attachment;
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

<!-- Modal -->
  <div class="modal fade" id="upload-model" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Attachment</h4>
        </div>
        <div class="modal-body">
			<form id="attac_upload" class="form-horizontal" method="post" action="/admin/dependents/upload_attachment" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" class="dependent-id" name="dependent-id" value="">
                <input type="hidden"  name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
                <div class="form-group">
					<label class="control-label col-sm-2" for="title">Title:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="attachment-title" id="attachment-title" placeholder="Enter Attachment Title" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="attachment-file">File:</label>
					<div class="col-sm-10">
						<input type="file" class="form-control" id="attachment-file" name="attachment-file" accept="image/x-png,image/gif,image/jpeg,.pdf" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Upload</button>
				</div>
				</div>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <?php echo $this->Html->script('admin/dependent_attachment',['block'=>'scriptBottom']); ?>

<script>
	$('#attac_upload').parsley();
</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
</style>
