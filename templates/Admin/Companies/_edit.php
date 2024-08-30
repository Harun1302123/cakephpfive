<style>
	.clor{
		color:red;
	}
</style>
<div class="content-wrapper">
    <!-- Main content -->
	<?php echo  $this->Flash->render();?>
	<?php // echo "<pre>"; print_r($_SERVER);  print_r($company);  echo "</pre>"; ?>
    <section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Company </h2>
		<div class="main_info_sec">
            <?php echo $this->Form->create($company,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Company Name<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Trade License Number<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('trade_license_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
					</div>

					<div class="row">
							<div class="col-lg-6 col-sm-12 col-xs-12">
								<div class="form_block">
									<label class = "nitin">Trade License Issue Date<span class="clor"> * </span> :</label>
								  <?php echo $this->Form->text('trade_license_issue_date', array('required' => 'required', 'class' => 'input_field'  ,  'label' => false,'id'=>'trade_lic_issue_date'));  ?>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12 col-xs-12">
								<div class="form_block">
									<label class = "nitin">Trade License Expiry Date<span class="clor"> * </span> :</label>
								  <?php echo $this->Form->text('trade_license_expiry_date', array('required' => 'required', 'class' => 'input_field'  , 'label' => false,'id'=>'trade_lic_expire_date'));  ?>
								</div>
							</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Immigration Card Number<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('immigration_card_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">

								<label class = "nitin">Immigration Card issue Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->text
							  ('immigration_card_issue_date', array('required' => 'required', 'class' => 'input_field' , 'label' => false,'id'=>'immigra_card_issue_date'));  ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">

								<label class = "nitin">Immigration Card Expiry Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->text('immigration_card_expiry_date', array('required' => 'required', 'class' => 'input_field' ,'label' => false,'id'=>'immigra_card_expiry_date'));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Establishment Card No<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('estblishment_card_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Dubai Chamber No<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('dubai_chember_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">

                                <label class = "nitin">Dubai Chamber Expiry Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->text('dubai_chember_expiry_date', array('required' => 'required', 'class' => 'input_field' ,  'label' => false,'id'=>'dubai_chamber_expire_date'));  ?>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">

								<label class = "nitin">Ejari Contract Start Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('contract_start_date', array('required' => 'required', 'class' => 'input_field'  , 'label' => false,'id'=>'contract_start_date'));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">

								<label class = "nitin">Ejari Contract End Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('contract_end_date', array('required' => 'required', 'class' => 'input_field', 'label' => false  ,'id'=>'contract_end_date'));  ?>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">

								<label class = "nitin">MOE certificate No :</label>
							  <?php echo $this->Form->input('moe_certificate', array( 'class' => 'input_field'  , 'label' => false,'id'=>'moe_certificate'));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">

								<label class = "nitin">MOE certificate expiry date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->text('moe_end_date', array('required' => 'required', 'class' => 'input_field', 'label' => false  ,'id'=>'moe_end_date'));  ?>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Responsible Person<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('responsible_person', array('required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'responsible_person'));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
						  <div class="form_block">
							<label class = "nitin">CC e-mails:</label>
							<?php echo $this->Form->input('cc_emails', array('class' => 'input_field', 'label' => false));  ?> </div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-sm-12 col-xs-12">
							<div class="form_block">
								<label>Attachment Files</label>
								<?php //pr($center['center_attachments']);die;
								foreach($company['documents'] as $ca){
									?>
									<div style='float:left;' class='col-lg-2 attachments'>
									<h5 class='attachment_title'><?php echo $ca['aTitle']; ?></h5>
									<?php
									if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>
										<a target="_blank" href="<?php echo BASE_URL;?>/admin/companies/files/<?php echo base64_encode($ca->id); ?>">
                                        <img src='<?php echo BASE_URL;?>/attachments/center/img.png' style='width:100px;height:100px;'>
                                        </a>

									<?php } else { ?>
										<a target="_blank" href="<?php echo BASE_URL;?>/admin/companies/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo BASE_URL;?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
										<?php }	?>
										<br>
										<a href='<?php echo BASE_URL."/admin/Companies/deleteComapnyDocument/".base64_encode($ca->id);?>' onclick="javascript:return confirm('Are you sure you want to delete this, it cannot be undo?');" >Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href='#' class='set_title' id='<?php echo base64_encode($ca->id); ?>' controller='<?php echo $controller; ?>' >Edit</a>
									</div>
									<?php
								}?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<div class="global_btn_info">
								<!--<label>Files</label>-->
							<?php echo $this->Form->input('files[]', array('id' => 'files', 'style'=>'display:none;', 'type' => 'file',  'multiple'=>'multiple', 'class' => 'input_field', 'label' => false));  ?>
							<button class="save" type='button' onclick='javascript:$("#files").trigger("click");' style='float:left;margin-left: 0px;'>
							<i class="glyphicon glyphicon-paperclip"></i>
								Add More Files
							</button>
							<span style="color:#367FA9;font-size:90%; padding : 0px 149px 0px 0px;" id="count_image"></span>

							</div>
						</div>

						<div class="col-lg-6 col-sm-6 col-xs-12">
							<div class="global_btn_info">
								<button id="submit" class="save"><i class="fa fa-floppy-o"></i> Submit</button>
							</div>
						</div>
					</div>
					</div>
              </div>
        </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->Html->script('admin/ajax_save_document',['block'=>'scriptBottom']); ?>
 <?php echo $this->Html->script('admin/check_issue_and_expiry.js',['block'=>'scriptBottom']); ?>
 <script src="<?php echo BASE_URL; ?>/js/bootstrap-notify.js"></script>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>


<script type="text/javascript">
  	$('#fileupload').parsley();

	$('#dubai_chamber_expire_date').datepicker({
	  'dateFormat':'dd/mm/yy',
	  'changeMonth':true,'changeYear':true,
	  'onClose': function(dateText, inst) {
            $(this).datepicker('option', 'dateFormat', 'dd/mm/yy');
        }
	  });
	 $('#moe_end_date').datepicker({
	  'dateFormat':'dd/mm/yy',
	  'changeMonth':true,
	  'changeYear':true,
	  'onClose': function(dateText, inst) {
			$(this).datepicker('option', 'dateFormat', 'dd/mm/yy');
		}
	});

	$('#files').change(
        function() {
	        var numFiles = $(this, this)[0].files.length;
	        $("#count_image").html(numFiles + " File Selected");
        }
    );

</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
</style>
