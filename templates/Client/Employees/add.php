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
      <h2 class="global_title"><i class="fa fa-building-o"></i> Add Employee</h2>
		<div class="main_info_sec">	
            <?php echo $this->Form->create($employee,array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data','url'=>'/client/employees/add/dependent'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">PS Number <span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('ps_number', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Company Name.<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('company_id', array('options'=>$companies,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Employee Name<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Email <span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('email', array('required' => 'required','type' =>'email','class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Gender<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('gender', array('options'=>['male'=>'Male','female'=>'Female'],'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Nationality<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('nationality', array('options'=>$countries,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Mobile No<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('mobile_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
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
								<label class = "nitin">Passport Expiry Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('passport_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false));  ?>
							</div>
						</div>
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Work Permit No<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('work_permit_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
						
						
					</div>

					
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Work Permit Expiry Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('work_permit_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false));  ?>
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
								<label class = "nitin">Entry Permit Expiry Date<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('entry_permit_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false));  ?>
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
								<label class = "nitin">VISA Expiry Date<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('visa_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false));  ?>
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
								<label class = "nitin">Emirates ID Expiry Date<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('emiratesID_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false));  ?>
							</div>
						</div>
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Labor Card No.<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('labor_card_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>

						

					</div>


					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Labor Card Expiry Date<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('labor_card_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false));  ?>
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
								<label class = "nitin">Health Care Card Expiry Date<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('health_card_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false));  ?>
							</div>
						</div>
						<!-- <div class="col-lg-3 col-sm-12 col-xs-12">
							<div class="global_btn_info">
								<button class="save" type="submit" name="skip"  value="skip"><i class="fa fa-floppy-o"></i> SKIP</button>
							</div>
						</div> -->

						
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<div class="global_btn_info">
								<!--<label>Files</label>-->
							 <?php echo $this->Form->input('files[]', array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field', 'label' => false));  ?>
							 <button class="save" type='button' onclick='javascript:$("#files").trigger("click");' style='float:left;margin-left: 0px;'><i class="glyphicon glyphicon-paperclip"></i>Add Files</button>
							<span style="color:#367FA9;font-size:90%; padding : 0px 149px 0px 0px;" id="count_image"></span>
								
							</div>
						</div>
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="global_btn_info">
								<button class="save" type="submit" name="next" value="next"><i class="fa fa-floppy-o"></i> NEXT</button>
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

  <script>
	$('#files').change(function(){				
	var numFiles = $(this, this)[0].files.length;
	$("#count_image").html(numFiles + " File Selected");
  });
	$('.date_expiry').datepicker({ 'dateFormat':'yy-mm-dd','changeMonth':true,'changeYear':true ,'minDate':0});
  </script>
