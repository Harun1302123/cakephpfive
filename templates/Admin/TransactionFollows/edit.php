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
      <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Record</h2>
		<div class="main_info_sec">	
            <?php echo $this->Form->create('Followtransactions',  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Company<span class="clor"> * </span> :</label>
								<?php echo $this->Form->select('company_id', $company,array('required' => 'required', 'class' => 'input_field', 'value'=>$followData['company_id'],'label' => false,'empty' => '--Select Company--')); ?>				
							</div>
						</div>
						
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Transaction<span class="clor"> * </span> :</label>
								<?php echo $this->Form->select('transaction_id',$transData,array('required' => 'required', 'class' => 'input_field','value'=>$followData['transaction_id'],'label' => false,'empty'=>'-- Select Transaction --'));  ?>
							</div>
						</div>						
					</div>	
					
					<div class="row">						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Transaction Type<span class="clor"> * </span> :</label>
								<?php								
								echo $this->Form->select('transaction_type', $typesData,array('required' => 'required','class' =>'input_field','value'=>$followData['transaction_type'],'label' => false,'empty'=>'-- Select Transaction Type--'));  ?>
							</div>
						</div>  

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">For Category<span class="clor"> * </span> :</label>
							  <?php 
							  $for_whom = ['1'=>'Employee','2'=>'Dependent'];
							  echo $this->Form->select('for_whom', $for_whom, array('required' => 'required', 'class' => 'input_field','value'=>$followData['for_whom'],'label' => false,'empty'=>'-- Select For Whom --'));  ?>
							</div>
						</div>
					</div>

					<div class="row">						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Name<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field','value'=>$followData['name'], 'label' => false));  ?>
							</div>
						</div>  

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Starting Date<span class="clor"> * </span> :</label>
							  <?php 
							  $start_date = date('Y-m-d', strtotime($followData['starting_date']));
							  echo $this->Form->input('starting_date',array('required' => 'required', 'class' => 'input_field','value'=>$start_date,'id'=>'start_date','label' => false));  ?>
							</div>
						</div>
					</div>	
					
					<div class="row">						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Status<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->select('status', $statusData,array('required' => 'required','value'=>$followData['status'],'class' => 'input_field','empty'=>'--Select Status--','label' => false));  ?>
							</div>
						</div>  

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Note<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('note', array('required' => 'required', 'class' => 'input_field','value'=>$followData['name'], 'label' => false));  ?>
							</div>
						</div>
					</div>
					
					<div class="row">						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Transaction Finished<span class="clor"> * </span> :</label>
							  <?php 
							  $options = ['1'=>'Yes','2'=>'No'];
							  echo $this->Form->select('trans_finish', $options,array('required' => 'required', 'value'=>$followData['trans_finish'],'class' => 'input_field','empty'=>'-- Select Tranasction Finish--','label' => false));  ?>
							</div>
						</div>  

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Completion Date<span class="clor"> * </span> :</label>
							  <?php 
							  $complete_date = date('Y-m-d', strtotime($followData['completion_date']));
							  echo $this->Form->input('completion_date', array('required' => 'required', 'class' => 'input_field', 'value'=>$complete_date,'id'=>'complete_date','label' => false));  ?>
							</div>
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
	$('#start_date').datepicker({
		'dateFormat':'yy-mm-dd',
		'minDate': '0'
	  });
	$('#complete_date').datepicker({
		'dateFormat':'yy-mm-dd',
		'minDate': '0'
	});
</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
</style>