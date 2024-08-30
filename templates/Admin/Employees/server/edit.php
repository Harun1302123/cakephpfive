<style>
.clor {
	color: red;
}
</style>
<div class="content-wrapper">
<!-- Main content --> 
<?php echo  $this->Flash->render();?>
<?php // echo "<pre>"; print_r($employee); echo "</pre>"; ?>
<section class="content"> 
  <!-- Your Page Content Here -->
  <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Employee</h2>
  <div class="main_info_sec"> <?php echo $this->Form->create($employee,array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
    <div class="global_form">
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-12">
          <div id="container_photo"></div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">PS Number <span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('ps_number', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Company Name.<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('company_id', array('options'=>$companies,'required' => 'required', 'class' => 'input_field', 'label' => false ,'value' =>$employee['company_id']));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Employee Name<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Email <span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('email', array('required' => 'required','type' =>'email','class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Gender<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('gender', array('options'=>['male'=>'Male','female'=>'Female'],'required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Nationality<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('nationality', array('options'=>$countries,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Mobile No<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('mobile_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Passport No<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('passport_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
			<?php 
            $passport_exp_date = '';
            if(date('Y-m-d',strtotime($employee['passport_exp_date'])) !='1970-01-01'){
            $passport_exp_date = date('Y-m-d',strtotime($employee['passport_exp_date']));
            }
            ?>
            <label class = "nitin">Passport Expiry Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('passport_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$passport_exp_date));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Work Permit No<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('work_permit_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
				<?php 
                $work_permit_exp_date = '';
                if(date('Y-m-d',strtotime($employee['work_permit_exp_date'])) !='1970-01-01'){
                $work_permit_exp_date = date('Y-m-d',strtotime($employee['work_permit_exp_date']));
                }
                ?>
            <label class = "nitin">Work Permit Expiry Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('work_permit_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$work_permit_exp_date));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Entry Permit No<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('entry_permit_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
				<?php 
                    $entry_permit_exp_date = '';
                    if(date('Y-m-d',strtotime($employee['entry_permit_exp_date'])) !='1970-01-01'){
                        $entry_permit_exp_date = date('Y-m-d',strtotime($employee['entry_permit_exp_date']));
                    }
                ?>
            <label class = "nitin">Entry Permit Expiry Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('entry_permit_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false,'value' =>$entry_permit_exp_date));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
          
			<?php 
            $status_change_date = '';
            if(date('Y-m-d',strtotime($employee['status_change_date'])) !='1970-01-01'){
            $status_change_date = date('Y-m-d',strtotime($employee['status_change_date']));
            }
            ?>

          
            <label class = "nitin">Change Status Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text('status_change_date', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$status_change_date));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">VISA No.<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('visa_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <?php 
									$visa_exp_date = '';
									if(date('Y-m-d',strtotime($employee['visa_exp_date'])) !='1970-01-01'){
										$visa_exp_date = date('Y-m-d',strtotime($employee['visa_exp_date']));
									}
								?>
            <label class = "nitin">VISA Expiry Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('visa_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$visa_exp_date));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Emirates ID No<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('emiratesID_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <?php 
									$emiratesID_exp_date = '';
									if(date('Y-m-d',strtotime($employee['emiratesID_exp_date'])) !='1970-01-01'){
										$emiratesID_exp_date = date('Y-m-d',strtotime($employee['emiratesID_exp_date']));
									}
								?>
            <label class = "nitin">Emirates ID Expiry Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('emiratesID_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$emiratesID_exp_date));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Emirates ID No<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('emiratesID_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Basic Salary<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text('s_basic', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Accommodation<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text('accomodation', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Transportion<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text('transportion', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Others<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text('others', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Labor Card No.<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('labor_card_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <?php 
									$labor_card_exp_date = '';
									if(date('Y-m-d',strtotime($employee['labor_card_exp_date'])) !='1970-01-01'){
										$labor_card_exp_date = date('Y-m-d',strtotime($employee['labor_card_exp_date']));
									}
								?>
            <label class = "nitin">Labor Card Expiry Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('labor_card_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$labor_card_exp_date));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Health Care Card No.<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('health_card_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <?php 
									$health_card_exp_date = '';
									if(date('Y-m-d',strtotime($employee['health_card_exp_date'])) !='1970-01-01'){
										$health_card_exp_date = date('Y-m-d',strtotime($employee['health_card_exp_date']));
									}
								?>
            <label class = "nitin">Health Care Card Expiry Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('health_card_exp_date_cus', array('required' => 'required', 'class' => 'input_field date_expiry', 'label' => false ,'value' =>$health_card_exp_date));  ?> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
          <div class="form_block">
            <label>Attachment Files</label>
            <?php
								foreach($employee['documents'] as $ca){
									?>
            <div style='float:left;' class='col-lg-2 attachments'>
              <h5 class='attachment_title'><?php echo $ca['aTitle']; ?></h5>
              <?php												
									if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>
              <a target="_blank" href="<?php echo BASE_URL;?>/webroot/documents/employee/<?php echo $ca->file;?>"><img src='<?php echo BASE_URL;?>/webroot/documents/employee/<?php echo $ca->file;?>' style='width:100px;height:100px;'>
              <?php } else { ?>
              <a href="<?php echo BASE_URL;?>/webroot/documents/employee/<?php echo $ca->file;?>"><img src='<?php echo BASE_URL;?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
              <?php }	?>
              <br>
              <a href='<?php echo BASE_URL."/admin/employees/deleteEmployeeDocument/".base64_encode($ca->id);?>' onclick="javascript:return confirm('Are you sure you want to delete this, it cannot be undo?');" >Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' class='set_title' id='<?php echo base64_encode($ca->id); ?>' controller='<?php echo $controller; ?>' >Edit</a> </div>
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
            <span style="color:#367FA9;font-size:90%; padding : 0px 149px 0px 0px;" id="count_image"></span> </div>
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
<?php $this->Html->script('admin/ajax_save_document',['block'=>'scriptBottom']); ?>
<?php echo $this->Html->script('select2.min'); ?> <?php echo $this->Html->css('select2.min'); ?> 
<script src="<?php echo BASE_URL; ?>/jQuery-Picture-Cut-master/src/jquery.picture.cut.js"></script> 
<script>
	$('#files').change(function(){				
	var numFiles = $(this, this)[0].files.length;
	$("#count_image").html(numFiles + " File Selected");
  });
	$('.date_expiry').datepicker({ 'dateFormat':'yy-mm-dd','changeMonth':true,'changeYear':true,'minDate':0});
	$(document).ready(function () {
		$('select').select2();
		$("#container_photo").PictureCut({                    
			InputOfImageDirectory       : "image",
			PluginFolderOnServer        : "/jQuery-Picture-Cut-master/",
			FolderOnServer              : "/webroot/img/emp/",    
			EnableCrop                  : true,
			CropWindowStyle             : "Bootstrap",         
		});
		img = '<?php !empty($employee['user_image']) ?>';
		if(img != ''){
		$('.picture-element-image').attr('src' , '<?php echo BASE_URL?>/img/emp/<?php echo $employee['user_image']; ?>');
		}
	});
  </script>