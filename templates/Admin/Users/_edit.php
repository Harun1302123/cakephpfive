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
      <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Client </h2>
		<div class="main_info_sec">
            <?php echo $this->Form->create($user,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Select User Role<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('user_role_id', array('type' => 'select', 'options'=> $user_roles,'required' => 'required', 'class' => 'input_field','label' => false));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Username<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('Username', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
					</div>

					<div class="row">
							<div class="col-lg-6 col-sm-12 col-xs-12">
								<div class="form_block">
									<label class = "nitin">Name<span class="clor"> * </span> :</label>
								  <?php echo $this->Form->input('fullName', array('required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'trade_lic_issue_date'));  ?>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12 col-xs-12">
								<div class="form_block">
									<label class = "nitin">Email Address<span class="clor"> * </span> :</label>
								  <?php echo $this->Form->input('email', array('required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'trade_lic_expire_date'));  ?>
								</div>
							</div>
					</div>

					<div class="row">
						<!-- <div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Password<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('Password', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>	 -->

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Mobile<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('mobile', array('required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'mobile'));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Status<span class="clor"> * </span> :</label>
							  <?php
							  echo $this->Form->input('status', array('type' => 'select', 'options'=>$status,'required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'status'));  ?>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Recieve Alert<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('recieve_alert', array('required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'immigra_card_issue_date'));  ?>
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


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>


<script type="text/javascript">
  	$('#fileupload').parsley();
	$('#files').change(function(){
	var numFiles = $(this, this)[0].files.length;
	$("#count_image").html(numFiles + " File Selected");
});

</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
</style>
