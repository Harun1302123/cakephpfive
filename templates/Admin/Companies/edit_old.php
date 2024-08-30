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
		<?php
		//echo '<pre>';
		//print_r($company);?>
            <?php echo $this->Form->create('company',  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Company Name<span class="clor"> * </span> :</label>
							    <?php 								
								echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'value'=>$company['name'],'label' => false));  ?>
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Trade License Number<span class="clor"> * </span> :</label>
							  <?php 
							  echo $this->Form->input('trade_license_no', array('required' => 'required', 'class' => 'input_field', 'value'=>$company['trade_license_no'],'label' => false));  ?>
							</div>
						</div>
					</div>

					<div class="row">						
							<div class="col-lg-6 col-sm-12 col-xs-12">
								<div class="form_block">
									<label class = "nitin">Trade License Issue Date<span class="clor"> * </span> :</label>
								  <?php
								  $trade_issue_date = date('Y-m-d', strtotime($company['trade_license_issue_date']));
								  echo $this->Form->input('trade_license_issue_date', array('required' => 'required', 'class' => 'input_field', 'label' => false,'value'=>$trade_issue_date,'id'=>'trade_lic_issue_date'));  ?>
								</div>
							</div>  
							
							<div class="col-lg-6 col-sm-12 col-xs-12">
								<div class="form_block">
									<label class = "nitin">Trade License Expiry Date<span class="clor"> * </span> :</label>
								  <?php 
								  $trade_expire_date = date('Y-m-d', strtotime($company['trade_license_expiry_date']));
								  echo $this->Form->input('trade_license_expiry_date', array('required' => 'required', 'class' => 'input_field', 'label' => false,'value'=>$trade_expire_date,'id'=>'trade_lic_expire_date'));  ?>
								</div>
							</div>						
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Immigration Card Number<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('immigration_card_no', array('required' => 'required', 'class' => 'input_field', 'value'=>@$company['immigration_card_no'],'label' => false));  ?>
							</div>
						</div>	
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Immigration Card issue Date<span class="clor"> * </span> :</label>
							  <?php 
							  $immigr_issue_date = date('Y-m-d', strtotime(@$company['immigration_card_issue_date']));
							  echo $this->Form->input('immigration_card_issue_date', array('required' => 'required', 'class' => 'input_field', 'label' => false,'value'=>@$immigr_issue_date,'id'=>'immigra_card_issue_date'));  ?>
							</div>
						</div>
					</div>	
					
					<div class="row">					
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Immigration Card Expiry Date<span class="clor"> * </span> :</label>
							  <?php 
							  $immigr_expire_date = date('Y-m-d', strtotime(@$company['immigration_card_expiry_date']));
							  echo $this->Form->input('immigration_card_expiry_date', array('required' => 'required', 'class' => 'input_field','value'=>@$immigr_expire_date,'label' => false,'id'=>'immigra_card_expiry_date'));  ?>
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Establishment Card No<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('estblishment_card_no', array('required' => 'required', 'class' => 'input_field','value'=>$company['estblishment_card_no'],'label' => false));  ?>
							</div>
						</div>
					</div>
					
					<div class="row">						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Dubai Chamber No<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('dubai_chember_no', array('required' => 'required', 'class' => 'input_field', 'value'=>$company['dubai_chember_no'],'label' => false));  ?>
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Dubai Chamber Expiry Date<span class="clor"> * </span> :</label>
							  <?php
								$chamber_expire_date = date('Y-m-d', strtotime(@$company['dubai_chember_expiry_date']));	
							  echo $this->Form->input('dubai_chember_expiry_date', array('required' => 'required', 'class' => 'input_field', 'label' => false,'value'=>$chamber_expire_date,'id'=>'dubai_chamber_expire_date'));  ?>
							</div>
						</div>
					</div>	
					
					<div class="row">
						<div class="col-lg-12 col-sm-12 col-xs-12">
							<div class="form_block">
								<label>Attachment Files</label>
								<?php //pr($center['center_attachments']);die;
								foreach($company['documents'] as $ca){
									?>
									<div style='float:left;' class='col-lg-2'>
									<?php												
									if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>
										<img src='<?php echo BASE_URL;?>/webroot/documents/company/<?php echo $ca->file;?>' style='width:100px;height:100px;'>
								
									<?php } else { ?>
										<a href="<?php echo BASE_URL;?>/webroot/documents/company/<?php echo $ca->file;?>"><img src='<?php echo BASE_URL;?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
										<?php }	?>								
										<br>
										<a href='<?php echo BASE_URL."/admin/Companies/deleteImage/".base64_encode($ca->id);?>' onclick="javascript:return confirm('Are you sure you want to delete this, it cannot be undo?');">Delete</a>
									</div>
									<?php
								}?>
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<div class="global_btn_info">
								<!--<label>Files</label>-->
							 <?php echo $this->Form->input('files.', array('id' => 'attachdFile', 'style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field', 'label' => false));  ?>
							 <a class="save"  onclick='javascript:$("#attachdFile").trigger("click");' href='javascript:void(0);' style='float:left;'><i class="glyphicon glyphicon-paperclip"></i>Add More Files</a>
							 <span style="color:#367FA9;font-size:90%; padding : 0px 149px 0px 0px;" id="count_image"></span>
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
	
	$('#trade_lic_issue_date').datepicker({
	  'dateFormat':'yy-mm-dd',
	  'minDate': '0'
	  });
	  
	$('#trade_lic_expire_date').datepicker({
	  'dateFormat':'yy-mm-dd',
	  'minDate': '0'
	  });
	  
	$('#immigra_card_issue_date').datepicker({
	  'dateFormat':'yy-mm-dd',
	  'minDate': '0'
	  });  
	
	$('#immigra_card_expiry_date').datepicker({
	  'dateFormat':'yy-mm-dd',
	  'minDate': '0'
	  });	
	$('#dubai_chamber_expire_date').datepicker({
	  'dateFormat':'yy-mm-dd',
	  'minDate': '0'
	  });  
	  
	  $('#attachdFile').change(function(){				
		var numFiles = $(this, this)[0].files.length;
		$("#count_image").html(numFiles + " File Selected");	
		}); 
	  
</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
</style>