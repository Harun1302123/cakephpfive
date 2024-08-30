<style>
.clor {
	color: red;
}
</style>
<div class="content-wrapper">
<!-- Main content --> 
<?php echo  $this->Flash->render();?>
<section class="content"> 
  <!-- Your Page Content Here -->
  <h2 class="global_title"><i class="fa fa-building-o"></i> Add Record</h2>
  <div class="main_info_sec"> <?php echo $this->Form->create($setting,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
    <div class="global_form">
      <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="form_block">
          <label class = "nitin">Api Key<span class="clor"> * </span> :</label>
          <?php echo $this->Form->input('apiKey', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
      </div>
      <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="form_block">
          <label class = "nitin">Sms Usr<span class="clor"> * </span> :</label>
          <?php echo $this->Form->input('smsUsr', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
      </div>
      <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="form_block">
          <label class = "nitin">Sms Pass<span class="clor"> * </span> :</label>
          <?php echo $this->Form->input('smsPass', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?> </div>
      </div>
      <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="form_block">
          <label class = "nitin">Alert Before<span class="clor"> * </span> :</label>
          <?php echo $this->Form->input('alert_bf', array('required' => 'required', 'class' => 'input_field','type'=>'number','min'=>'0', 'label' => false));  ?> </div>
      </div>
      
       <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="form_block">
          <label class = "nitin">CC-Emails<span class="clor"> * </span> :</label>
          <?php echo $this->Form->input('cc_emails', array('required' => 'required', 'class' => 'input_field','type'=>'number','min'=>'0', 'label' => false));  ?> </div>
      </div>
      
      <div class="col-lg-12 col-sm-12 col-xs-12">
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
