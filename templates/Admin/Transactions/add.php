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
      <h2 class="global_title"><i class="fa fa-building-o"></i> Add Transaction</h2>
		<div class="main_info_sec">	
            <?php echo $this->Form->create($transaction,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Transaction<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Goverment Fees<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('gov_fees', array('required' => 'required', 'type'=>'number','min'=>'0','class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Typing Fees<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('typing_fees', array('required' => 'required','type'=>'number', 'min'=>'0','class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>             
											
						<div class="col-lg-6 col-sm-6 col-xs-6">
							<div class="global_btn_info">
								<button class="save"><i class="fa fa-floppy-o"></i> Submit</button>
							</div>
						</div>
					</div>                    
              </div>
        </div>
    </section>
            <?php echo $this->Form->end(); ?>
 </div>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>


<script type="text/javascript">
  	$('#fileupload').parsley();
</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
</style>