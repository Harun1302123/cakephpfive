<style>
	.clor{
		color:red;
	}
</style>
<div class="content-wrapper">
    <!-- Main content -->
	<?php echo  $this->Flash->render();?>
    <section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Dependent</h2>
		<div class="main_info_sec">	
            <?php echo $this->Form->create($dependent,array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Select Employee<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('employee_id', array('options'=> $employees,'required' => 'required', 'class' => 'input_field', 'label' => false ));  ?>
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Dependent Name<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Select Relation <span class="clor"> * </span> :</label>
								 <?php echo $this->Form->input('relation', array('options'=> $relations,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							   
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Passport No<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('passport_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<?php 
									$passport_exp_date = '';
									if(date('Y-m-d',strtotime($dependent['passport_exp_date'])) !='1970-01-01'){
										$passport_exp_date = date('Y-m-d',strtotime($dependent['passport_exp_date']));
									}
								?>
								<label class = "nitin">Passport Expiry Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('passport_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$passport_exp_date));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Entry Permit No<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('entry_permit_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<?php 
									$entry_permit_exp_date = '';
									if(date('Y-m-d',strtotime($dependent['entry_permit_exp_date'])) !='1970-01-01'){
										$entry_permit_exp_date = date('Y-m-d',strtotime($dependent['entry_permit_exp_date']));
									}
								?>
								<label class = "nitin">Entry Permit Expiry Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('entry_permit_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false,'value' =>$entry_permit_exp_date));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">VISA No.<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('visa_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<?php 
									$visa_exp_date = '';
									if(date('Y-m-d',strtotime($dependent['visa_exp_date'])) !='1970-01-01'){
										$visa_exp_date = date('Y-m-d',strtotime($dependent['visa_exp_date']));
									}
								?>
								<label class = "nitin">VISA Expiry Date<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('visa_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$visa_exp_date));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Emirates ID No<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('emiratesID_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<?php 
									$emiratesID_exp_date = '';
									if(date('Y-m-d',strtotime($dependent['emiratesID_exp_date'])) !='1970-01-01'){
										$emiratesID_exp_date = date('Y-m-d',strtotime($dependent['emiratesID_exp_date']));
									}
								?>
								<label class = "nitin">Emirates ID Expiry Date<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('emiratesID_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$emiratesID_exp_date));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Health Care Card No.<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('health_card_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

					</div>
				
					 <div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<?php 
									$health_card_exp_date = '';
									if(date('Y-m-d',strtotime($dependent['health_card_exp_date'])) !='1970-01-01'){
										$health_card_exp_date = date('Y-m-d',strtotime($dependent['health_card_exp_date']));
									}
								?>
								<label class = "nitin">Health Care Card Expiry Date<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('health_card_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$health_card_exp_date));  ?>
							</div>
						</div>
					 </div>
					 <div class="row">
						<div class="col-lg-12 col-sm-12 col-xs-12">
							<div class="form_block">
								<label>Attachment Files</label>
								<?php //pr($center['center_attachments']);die;
								foreach($dependent['documents'] as $ca){
									?>
									<div style='float:left;' class='col-lg-2 attachments'>
									<h5 class='attachment_title'><?php echo $ca['aTitle']; ?></h5>
									<?php												
									if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>
										<a target="_blank" href="<?php echo BASE_URL;?>/webroot/documents/dependent/<?php echo $ca->file;?>"><img src='<?php echo BASE_URL;?>/webroot/documents/dependent/<?php echo $ca->file;?>' style='width:100px;height:100px;'>
								
									<?php } else { ?>
										<a href="<?php echo BASE_URL;?>/webroot/documents/dependent/<?php echo $ca->file;?>"><img src='<?php echo BASE_URL;?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
										<?php }	?>								
										<br>

										<a href='<?php echo BASE_URL."/client/dependents/deleteDependentDocument/".base64_encode($ca->id);?>' onclick="javascript:return confirm('Are you sure you want to delete this, it cannot be undo?');">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
							 <?php echo $this->Form->input('files[]', array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field', 'label' => false));  ?>
							 <button class="save" type='button' onclick='javascript:$("#files").trigger("click");' style='float:left;margin-left: 0px;'><i class="glyphicon glyphicon-paperclip"></i>Add More Files</button>
							<span style="color:#367FA9;font-size:90%; padding : 0px 149px 0px 0px;" id="count_image"></span>
								
							</div>
						</div>
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="global_btn_info">
								<button class="save"><i class="fa fa-floppy-o"></i> Submit</button>
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
<?php $this->Html->script('client/ajax_save_document',['block'=>'scriptBottom']); ?>
  <script>
	$('#files').change(function(){				
		var numFiles = $(this, this)[0].files.length;
		$("#count_image").html(numFiles + " File Selected");	
	});	
	$('.date_expiry').datepicker({ 'dateFormat':'yy-mm-dd','changeMonth':true,'changeYear':true,'minDate':0});
  </script>
