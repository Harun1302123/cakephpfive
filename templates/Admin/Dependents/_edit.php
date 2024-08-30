<style>
.clor {
	color: red;
}
.doc-status .btn {
	cursor: default;
}
</style>
<div class="content-wrapper">
<!-- Main content -->
<?php echo  $this->Flash->render();?>
<section class="content">
  <!-- Your Page Content Here -->
  <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Dependent</h2>
  <div class="main_info_sec"> <?php echo $this->Form->create($dependent,array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
    <div class="global_form">
      <div class="row">
        <fieldset>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Select Employee<span class="clor"> * </span> :</label>
              <?php echo $this->Form->input('employee_id', array('options'=> $employees,'required' => 'required', 'class' => 'input_field', 'label' => false ));  ?> </div>
          </div>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Dependent Name<span class="clor"> * </span> :</label>
              <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
          </div>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Select Relation <span class="clor"> * </span> :</label>
              <?php echo $this->Form->input('relation', array('options'=> $relations,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
          </div>

          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Nationality<span class="clor"> * </span> :</label>
              <?php echo $this->Form->input('nationality', array('options'=>$countries,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
          </div>

          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Unified No :</label>
              <?php echo $this->Form->input('unified_no', array('class' => 'input_field', 'label' => false));  ?> </div>
          </div>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Status<span class="clor"> * </span> :</label>
              <?php echo $this->Form->input('status', array('options'=>['1'=>'Active','0'=>'Cancelled'],'required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
          </div>
        </fieldset>
        <fieldset>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Passport No<span class="clor"> * </span> :</label>
              <?php echo $this->Form->input('passport_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Passport Expiry Date<span class="clor"> * </span> :</label>
              <?php echo $this->Form->text('passport_exp_date', array('required' => 'required', 'class' => 'input_field date_expiry readonly' , 'placeholder'=>'DD/MM/YY' , 'label' => false));  ?> </div>
          </div>
          <div class="col-lg-2 col-sm-12 col-xs-12">
            <div class="addfiles pull-right"> <?php echo $this->Form->input('files.passport_files[]', array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file', 'id' => 'hcard-files' ,'label' => false));  ?> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span> <span class="save" name="next" onclick='javascript:$("#hcard-files").trigger("click");' value="next"><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>
          </div>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">VISA No.<span class="clor"> * </span> :</label>
              <?php echo $this->Form->input('visa_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">VISA Expiry Date<span class="clor"> * </span> :</label>
              <?php echo $this->Form->text('visa_exp_date', array('required' => 'required', 'class' => 'input_field date_expiry readonly'  , 'placeholder'=>'DD/MM/YY' , 'label' => false));  ?> </div>
          </div>
          <div class="col-lg-2 col-sm-12 col-xs-12">
            <div class="addfiles pull-right"> <?php echo $this->Form->input('files.visa_files[]', array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file', 'id' => 'visa-files' ,'label' => false));  ?> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span> <span class="save" name="next" onclick='javascript:$("#visa-files").trigger("click");'  value="next"><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>
          </div>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Emirates ID No :</label>
              <?php echo $this->Form->input('emiratesID_no', array( 'class' => 'input_field', 'label' => false));  ?> </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Emirates ID Expiry Date :</label>
              <?php echo $this->Form->text('emiratesID_exp_date', array( 'class' => 'input_field date_expiry readonly' ,  'label' => false  , 'placeholder'=>'DD/MM/YY' ));  ?> </div>
          </div>
          <div class="col-lg-2 col-sm-12 col-xs-12">
            <div class="addfiles pull-right"> <?php echo $this->Form->input('files.id_files[]', array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file' , 'id' => 'id-files' , 'label' => false));  ?> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span> <span class="save"  name="next" onclick='javascript:$("#id-files").trigger("click");'  value="next"><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>
          </div>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Health Care Card No. :</label>
              <?php echo $this->Form->input('health_card_no', array( 'class' => 'input_field', 'label' => false));  ?> </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-xs-12">
            <div class="form_block">
              <label class = "nitin">Health Care Card Expiry Date :</label>
              <?php echo $this->Form->text('health_card_exp_date', array('class' => 'input_field date_expiry readonly', 'label' => false , 'placeholder'=>'DD/MM/YY' ));  ?> </div>
          </div>
          <div class="col-lg-2 col-sm-12 col-xs-12">
            <div class="addfiles pull-right"> <?php echo $this->Form->input('files.hcard_files[]', array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file', 'id' => 'hcard-files' ,'label' => false));  ?> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span> <span class="save" name="next" onclick='javascript:$("#hcard-files").trigger("click");' value="next"><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>
          </div>
        </fieldset>
        <hr>
        <fieldset>
          <div class="col-lg-10 person_documents col-sm-12 col-xs-12">
            <h4>Documents verification</h4>
            <table class="table borderless">
              <tr>
                <td width="10%">Passport: </td>
                <td width="45%"> Received</br>
                  <?php echo $this->Form->input('clients_document.passport_receive_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.passport_receive_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['passport_receive_admin_date']  ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['passport_receive_admin']){
                        echo $this->DateC->DateFormetforView($dependent['clients_document']['passport_receive_admin_date']);
                    }
                    ?>
                  </span>
                  <?php
						if($dependent['clients_document']['passport_send_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['passport_send_client_date']).')</span>' ;
							}
					?>
                  </span>
                  <?php if($dependent['clients_document']['passport_receive_client']){ ?>
                  <span class="resend">
                  <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="passport" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                  </span>
                  <?php }?></td>
                <td width="45%">Sent</br>
                  <?php echo $this->Form->input('clients_document.passport_send_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.passport_send_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['passport_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['passport_send_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['passport_send_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['passport_receive_client']){
							echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['passport_receive_client_date']).')</span>';
							}
					?>
                  </span></td>
              </tr>
              <tr>
                <td width="10%">Birthday Certificate: </td>
                <td width="45%"> Received</br>
                  <?php echo $this->Form->input('clients_document.bc_receive_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.bc_receive_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['bc_receive_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['bc_receive_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['bc_receive_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['bc_send_client']){
							echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['bc_send_client_date']).')</span>';
							}
					?>
                  </span>
                  <?php if($dependent['clients_document']['bc_receive_client']){ ?>
                  <span class="resend">
                  <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="bc" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                  </span>
                  <?php }?></td>
                <td width="45%">Sent</br>
                  <?php echo $this->Form->input('clients_document.bc_send_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.bc_send_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['bc_send_admin_date']));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['bc_send_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['bc_send_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['bc_receive_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['bc_receive_client_date']).')</span>' ;
							}
					?>
                  </span></td>
              </tr>
              <tr>
                <td width="10%">Marriage Certificate: </td>
                <td width="45%"> Received</br>
                  <?php echo $this->Form->input('clients_document.mc_receive_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.mc_receive_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['mc_receive_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['mc_receive_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['mc_receive_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['mc_send_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['mc_send_client_date']).')</span>';
							}
					?>
                  </span>
                  <?php if($dependent['clients_document']['mc_receive_client']){ ?>
                  <span class="resend">
                  <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="mc" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                  </span>
                  <?php }?></td>
                <td width="45%">Sent</br>
                  <?php echo $this->Form->input('clients_document.mc_send_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.mc_send_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['mc_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['mc_send_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['mc_send_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['mc_receive_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['mc_receive_client_date']).')</span>';
							}
					?>
                  </span></td>
              </tr>
              <tr>
                <td width="10%">Emirates ID: </td>
                <td width="45%"> Received</br>
                  <?php echo $this->Form->input('clients_document.eid_receive_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.eid_receive_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['eid_receive_admin_date'] ));  ?><span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['eid_receive_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['eid_receive_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['eid_send_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['eid_send_client_date']).')</span>';
							}
					?>
                  </span>
                  <?php if($dependent['clients_document']['eid_receive_client']){ ?>
                  <span class="resend">
                  <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="eid" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                  </span>
                  <?php }?></td>
                <td width="45%">Sent</br>
                  <?php echo $this->Form->input('clients_document.eid_send_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.eid_send_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['eid_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['eid_send_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['eid_send_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['eid_receive_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['eid_receive_client_date']).')</span>';
							}
					?>
                  </span></td>
              </tr>
              <tr>
                <td width="10%">Degree Certificate: </td>
                <td width="45%"> Received</br>
                  <?php echo $this->Form->input('clients_document.dc_receive_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.dc_receive_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['dc_receive_admin_date'] ));  ?><span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['dc_receive_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['dc_receive_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['dc_send_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['dc_send_client_date']).')</span>';
							}
					?>
                  </span>
                  <?php if($dependent['clients_document']['dc_receive_client']){ ?>
                  <span class="resend">
                  <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="dc" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                  </span>
                  <?php }?></td>
                <td width="45%">Sent</br>
                  <?php echo $this->Form->input('clients_document.dc_send_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.dc_send_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['dc_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['dc_send_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['dc_send_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['dc_receive_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['dc_receive_client_date']).')</span>';
							}
					?>
                  </span></td>
              </tr>
              <tr>
                <td width="10%">Medical: </td>
                <td width="45%"> Received</br>
                  <?php echo $this->Form->input('clients_document.medical_receive_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.medical_receive_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['medical_receive_admin_date'] ));  ?><span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['medical_receive_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['medical_receive_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['medical_send_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['medical_send_client_date']).')</span>';
							}
					?>
                  </span>
                  <?php if($dependent['clients_document']['medical_receive_client']){ ?>
                  <span class="resend">
                  <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="medical" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                  </span>
                  <?php }?></td>
                <td width="45%">Sent</br>
                  <?php echo $this->Form->input('clients_document.medical_send_admin', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.medical_send_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['medical_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['medical_send_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['medical_send_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['medical_receive_client']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['medical_receive_client_date']).')</span>';
							}
					?>
                  </span></td>
              </tr>
              <tr>
                <td width="10%">Other: </td>
                <td width="45%"> Received</br>
                  <?php
                 $class =  ($dependent['clients_document']['other_receive_value'] != '') && $dependent['clients_document']['other_receive_admin']  ? '' : 'other_doc' ;

				  echo $this->Form->input('clients_document.other_receive_admin', array('class' => "regular-checkbox persnal-doc-check $class", 'label' => false, 'type'=>'checkbox'));  ?>
                  <?php echo $this->Form->input('clients_document.other_receive_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['other_receive_admin_date'] ));  ?><span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['other_receive_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['other_receive_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['other_send_client']){
							echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['other_send_client_date']).')</span>';
							}
					?>
                  </span>
                  <?php if($dependent['clients_document']['other_receive_value'] != ''){ ?>
                  <div  class="other-doc-parent form_block">

                    <?php  echo $this->Form->input('clients_document.other_receive_value', array('class' => "input_field", "style"=>"width: 90%; margin-top:10px;" , 'required' => 'true' ,'label' => false)); ?>

                  </div>
                  <?php } ?>
                  <?php if($dependent['clients_document']['other_receive_client'] && ($dependent['clients_document']['other_receive_admin'] || $dependent['clients_document']['other_send_client'])  ){ ?>
                  <span class="resend">
                  <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="other" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                  </span>
                  <?php }?></td>
                <td width="45%">Sent</br>
                  <?php
				 $class =  ($dependent['clients_document']['other_send_admin'] != '') && $dependent['clients_document']['other_send_admin'] ? '' : 'other_doc' ;

				 echo $this->Form->input('clients_document.other_send_admin', array('class' => "regular-checkbox persnal-doc-check $class", 'label' => false, 'type'=>'checkbox'));  ?>
                  <?php echo $this->Form->input('clients_document.other_send_admin_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['other_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                  <?php if($dependent['clients_document']['other_send_admin']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['other_send_admin_date']);
						}
						?>
                  </span>
                  <?php
						if($dependent['clients_document']['other_receive_client'] && ($dependent['clients_document']['other_receive_client'] || $dependent['clients_document']['other_send_admin']) ){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received (' . $this->DateC->DateFormetforView($dependent['clients_document']['other_receive_client_date']).')</span>';
							}
					?>
                  </span>
                  <?php if($dependent['clients_document']['other_send_value'] != ''){ ?>
                  <div  class="other-doc-parent form_block">
                    <?php  echo $this->Form->input('clients_document.other_send_value', array('class' => "input_field", "style"=>"width: 90%; margin-top:10px;", 'required' => 'true' ,'label' => false)); ?>

                  </div>
                  <?php } ?></td>
              </tr>
            </table>
          </div>
        </fieldset>
        <hr>
      </div>
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
          <div class="form_block">
            <label>Attachment Files</label>
            <?php //pr($center['center_attachments']);die;
								foreach($dependent['documents'] as $ca){
									?>
            <div style='float:left; text-align: center;' class='col-lg-2 attachments'>
              <h5 class='attachment_title'><?php echo $ca['aTitle']; ?></h5>
              <?php
									if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>
              <a target="_blank" href="<?php echo BASE_URL;?>/admin/dependents/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo BASE_URL;?>/attachments/center/img.png' style='width:100px;height:100px;'>
              <?php } else { ?>
              <a target="_blank" href="<?php echo BASE_URL;?>/admin/dependents/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo BASE_URL;?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
              <?php }	?>
              <br>
              <a href='<?php echo BASE_URL;?>/admin/dependents/files/<?php echo base64_encode($ca->id); ?>' onclick="javascript:return confirm('Are you sure you want to delete this, it cannot be undo?');">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' class='set_title' id='<?php echo base64_encode($ca->id); ?>' controller='<?php echo $controller; ?>' >Edit</a>

			  <a style='margin-left: 10px;'  href='<?php echo BASE_URL."/admin/dependents/DownloadDependentDocument/".base64_encode($ca->id);?>' >Download</a>

			  </div>
            <?php
								}?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-xs-12">
          <div class="global_btn_info">
            <!--<label>Files</label>-->
            <?php echo $this->Form->input('files[]', array('id' => 'files', 'style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field', 'label' => false));  ?>
            <button class="save" type='button' onclick='javascript:$("#files").trigger("click");' style='float:left;margin-left: 0px;'><i class="glyphicon glyphicon-paperclip"></i>Add More Files</button>
            <span style="color:#367FA9;font-size:90%; padding : 0px 149px 0px 0px;" id="count_image"></span> </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12">
          <div class="global_btn_info" style="text-align: center;">
            <input style="height: 46px; padding: 0 25px 0 25px;margin: 0 0 10px 20px;display: inline-block;font-size: 15px;color: #ffffff;text-transform: uppercase;font-weight: 900;background: #3c8dbc;border: none;border-radius: 3px;position: relative;" type="button" value="Generate PDF" id="cmd">
            </button>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12">
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
<?php echo $this->Html->script('select2.min'); ?> <?php echo $this->Html->css('select2.min'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script>
	$('#files').change(function(){
		var numFiles = $(this, this)[0].files.length;
		$("#count_image").html(numFiles + " File Selected");
	});
	$(window).load(function () {
		$('select').select2();
			var doc = new jsPDF();
			var specialElementHandlers = {
				'#editor': function (element, renderer) {
				return true;
			}
		};


		$('.date_expiry').datepicker({ 'dateFormat':'dd/mm/yy',
			'changeMonth':true,
			'changeYear':true ,
			'minDate':0,
			'onClose': function(dateText, inst) {
				$(this).datepicker('option', 'dateFormat', 'dd/mm/yy');
			}
		});


		$('#cmd').click(function () {
				doc.text(10, 20, 'Employee Name:   '+$('select[name=employee_id] option:selected').text());
				doc.text(10, 30, 'Dependent Name:   '+$('input[name=name]').val());
				doc.text(10, 40, 'Relation :   '+$('select[name=relation] option:selected').text());
				doc.text(10, 50, 'Passport No:   '+$('input[name=passport_no]').val());
				doc.text(10, 60, 'Passport Expiry Date:   '+$('input[name=passport_exp_date]').val());
				doc.text(10, 70, 'Entry Permit No:   '+$('input[name=entry_permit_no]').val());
				doc.text(10, 80, 'Entry Permit Expiry Date:   '+$('input[name=visa_no]').val());
				doc.text(10, 90, 'VISA No.:   '+$('input[name=passport_no]').val());


				doc.text(10, 100, 'VISA Expiry Date:   '+$('input[name=visa_exp_date]').val());
				doc.text(10, 110, 'Emirates ID No:   '+$('input[name=emiratesID_no]').val());

				doc.text(10, 120, 'Emirates ID Expiry Date:   '+$('input[name=emiratesID_exp_date]').val());
				doc.text(10, 130, 'Health Care Card No:   '+$('input[name=health_card_no]').val());

				doc.text(10, 140, 'Health Care Card Expiry Date:	'+$('input[name=health_card_exp_date]').val());


				doc.save('profile-'+$('input[name=name]').val()+'.pdf');
			});

		$(".person_documents input").change(function() {
			if(this.checked) {
				//console.log($(this).parent().parent().children('.documents_date').children('.date').html());
				$(this).parent().parent().children('.documents_date').children('.date').html(formatDate(new Date()));
				date = new Date()
				$('input#'+$(this).attr('id')+'-date').val(date.getDate()+'/'+ (date.getMonth()+1) +'/'+ date.getFullYear());
			}else{
				$('input[name="'+$(this).attr('name')+'_date"]').val('');
				$(this).parent().parent().children('.documents_date').children('.date').html('');
			}
		});

	function formatDate(date) {
		var monthNames = [
			"Jan", "Feb", "March",
			"April", "May", "June", "July",
			"Aug", "Sep", "Oct",
			"Nov", "Dec"
		];

		var day = date.getDate();
		var monthIndex = date.getMonth();
		var year = date.getFullYear();
		return day + ' ' + monthNames[monthIndex] + ' ' + year;
	}

	$('.other_doc').change(function() {
		if(this.checked) {
			var name = $(this).attr('name');
			name = name.replace('_admin','_value');
			//console.log($(this).parent().parent('td').html());
			$(this).parent().parent('td').append('<div  class="other-doc-parent form_block"><input  name="'+name+'" type="text"  class="input_field" style="width: 90%; margin-top:10px" required /></div>');
		}else{
			$(this).parent().parent().children('.other-doc-parent').remove();
		}
	});

	/*$(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });*/

	$('.re-set-doc').click(function(){
			type_id   = $(this).attr('type-id');
			data_type = $(this).attr('data-type');
			data = {'type_id' : type_id,'data_type' : data_type };
			//console.log(data); return false;
			$.ajax({
				url: webroot+'/admin/dependents/re_set',
				data : data,
				cache: false,
				type:'POST',
				context : this,
				success: function(html){
					html = JSON.parse(html);
					if(html.status == true){
						if(data_type == 'other'){
							$(this).parent().parent('td').parent('tr').find('.input_field').remove();
						}
						$(this).parent().parent('td').next().children('.documents_date').children().html('');
						$(this).parent().siblings('.documents_date').children().html('');
						$('#clients-document-'+data_type+'-send-admin').attr('checked', false);
						$('#clients-document-'+data_type+'-receive-admin').attr('checked', false);
						$('#clients-document-'+data_type+'-send-admin-date').val('');
						$('#clients-document-'+data_type+'-receive-admin-date').val('');
						//$('#clients-document-'+data_type+'-receive-admin').trigger('click');
						$(this).parent().parent('td').next().children('.documents_date').children().html('');
						$(this).parent().remove();
						$('#clients-document-'+data_type+'-send-client').trigger('click');
					}
				}
			});
		});

		var inputs = $("form input, form select , form textarea");
		$('#submit').click(function(event){
		var i = 0;
		var flag = true;
		event.preventDefault();
		inputs.each(function(index) {
		var input = $(this);
		//console.log(input[0].type.required);
		if (!input.val() && (input[0].required) && (input[0].type != 'hidden') || (input[0].type=== "radio" && !input[0].type.is(':checked'))) {
		$(this).css('border','1px solid red');
		//console.log(input[0]);
		if(i == 0){
			flag = false;
			window.scrollTo('#'+$(this).attr('id') , 200);
		}
		i++;
		//validForm = false;
		}else{
		$(this).css('border' , '1px solid rgba(0,0,0,.15)');
		}
		});

		if(flag){
		var data = new FormData($('form#fileupload')[0]);
		console.log($(this).html());
		$(this).children('i').removeClass('fa-floppy-o').addClass('fa-spinner fa-spin');
		$.ajax({
			url: $('form').attr('action'),
			type: "POST",
			data: data,
			cache: false,
			processData: false,
			contentType: false,
			context: this,
			success: function(result){
				$(this).children('i').addClass('fa-floppy-o').removeClass('fa-spinner fa-spin');
				var result = JSON.parse(result);
				if(result.status){
					$.notify(result.message, "success");
					//window.location.href = document.referrer == '' ? result.url : window.history.back();
					setTimeout(function(){
							if(document.referrer == ''){
								console.log('heree');
								window.location.href  = result.url;
							}else{
								console.log('heree22');
								window.history.back()
							}
						}, 2000);
					}else{
					$.notify(result.message, "error");
					//window.location.href =result.url;
				}
		}});
		}
		});

		jQuery.fn.scrollTo = function(elem, speed) {
		$(this).animate({
		scrollTop:  $(this).scrollTop() - $(this).offset().top + $(elem).offset().top
		}, speed == undefined ? 1000 : speed);
		return this;
		};
});
</script>
