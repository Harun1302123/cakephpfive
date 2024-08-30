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
<?php echo  $this->Flash->render(); ?>
    <!-- Main content -->
    <div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
        <h2 ><i class="fa fa-building-o"></i> Manage Companies</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <?php
            echo $this->Form->create(
                $company,
                array(
                        'id' => 'fileupload',
                        'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload',
                        'enctype' => 'multipart/form-data'
                    )
            );
        ?>




<section class="content">
  <!-- Your Page Content Here -->
  <?php // echo "<pre>"; print_r($company); echo "</pre>"; ?>
   <div class="main_info_sec">
	   <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
		   <div class="col-lg-6">
			   <a href="<?php  echo $this->request->getAttribute('webroot');  ?>admin/companies/add" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
		   </div>
		   <div class="col-lg-6">
				<div class="for-search">
				   <div class="pull-right">
						<form class="form-inline">
						  <div class="form-group">
							<label class="sr-only" for="searchQuery">Name</label>
							<input type="text" class="form-control" id="searchQuery" placeholder="Company Name">
						  </div>
						  <button type="submit" class="btn btn-default" id="search-query">Search</button>
						</form>
					</div>
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
					if(!$company->isEmpty()){
							foreach($company as $companys){
						?>
						<tr>
							<td><?php echo $companys->name;?></td>
							<td><?php echo $companys->trade_license_no;?></td>
							<td><?php echo $this->DateC->DateFormetforView($companys->trade_license_expiry_date);?></td>
							<td><?php echo $companys->estblishment_card_no;?></td>
							<td><?php echo $this->DateC->DateFormetforView($companys->created);?></td>
							<td>

							<?php
							$edit = '<a href="'.$this->request->getAttribute('webroot').'admin/companies/edit/'.base64_encode($companys->id).'">
								<i class="fa fa-edit" title="Edit"></i></a>';

								$delete = '<a href="'.$this->request->getAttribute('webroot').'admin/companies/delete/'.base64_encode($companys->id).'" onclick="return confirm('."'Are you sure you want to delete?'".');">
								<i class="fa fa-remove" title="Delete" ></i></a>';

								$attachment = '<a data-attach-cmpny="'.base64_encode($companys->id).'" class="attach_for_company" href="javascript:void(0)">
								<i class="fa fa-upload" title="Upload Attachment" ></i></a>';

								echo $edit.'  '.$delete.'  '.$attachment;
							?>
							</td>
						</tr>
						<?php }		}else{ ?>
					   <tr><td colspan="6" class="no_record">No Record Found</td></tr>
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

</div>
    <!--end::Card header-->
</div>

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
			<form id="attac_upload" class="form-horizontal" method="post" action="<?php echo $this->request->getAttribute('webroot'); ?>admin/companies/upload_attachment" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" class="company-id" name="company-id" value="">
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

<?php echo $this->Html->script('admin/company_attachment',['block'=>'scriptBottom']);  ?>
<script>
	// $('#attac_upload').parsley();
</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
</style>
