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
            <?php echo $this->Form->create($user_role,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Role Name<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('name',array('required' => 'required', 'class' => 'input_field','label' => false));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Role View<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('role_view', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'],'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
					</div>

					<div class="row">
							<div class="col-lg-6 col-sm-12 col-xs-12">
								<div class="form_block">
									<label class = "nitin">Role Add<span class="clor"> * </span> :</label>
								  <?php echo $this->Form->input('role_add', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'],'required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'trade_lic_issue_date'));  ?>
								</div>
							</div>

							<div class="col-lg-6 col-sm-12 col-xs-12">
								<div class="form_block">
									<label class = "nitin">Role Edit<span class="clor"> * </span> :</label>
								  <?php echo $this->Form->input('role_edit', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'],'required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'trade_lic_expire_date'));  ?>
								</div>
							</div>
					</div>


					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Role Delete<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('role_del', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'],'required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'immigra_card_issue_date'));  ?>
							</div>
						</div>

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Role RPT<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('role_rpt', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'],'required' => 'required', 'class' => 'input_field', 'label' => false,'id'=>'immigra_card_issue_date'));  ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-sm-12 col-xs-12">
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
<script type="text/javascript">
  	$('#fileupload').parsley();
</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
</style>
