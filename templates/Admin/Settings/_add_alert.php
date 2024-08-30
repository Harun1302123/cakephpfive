<style>
	.clor{
		color:red;
	}
	.form_block label.radio-inline {
    padding-top: 0;
    width: auto;padding-right:15px;
}
.form_block label.radio-inline input[type=radio] {
    position: relative;
    margin: 0 6px 0 0;
    opacity: 1;
    width: 16px;
    height: 16px;
    top: 3px;
}
</style>
<div class="content-wrapper">
    <!-- Main content -->
	<?php echo  $this->Flash->render();?>
    <section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-building-o"></i> Add Record</h2>
		<div class="main_info_sec">
            <?php echo $this->Form->create($alert,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Alert for<span class="clor"> * </span> :</label>
							    <?php echo $this->Form->input('alert_type_id', array('type' => 'select', 'options' => $alert_types,'required' => 'required',  'class' => 'input_field', 'label' => false));  ?>
							</div>
						</div>


                        <div class="col-lg-12 col-sm-12 col-xs-12">
							<div class="form_block" >
								<label class = "nitin">Alert Message for Employee<span class="clor"> * </span> :</label>
                                 <b> _employee_name, _passport_expiry ,  _visa_exp_date</b>
                                <?php echo $this->Form->textarea('alert_text_emp', array('type' => 'select', 'options' => $alert_types, 'id' => 'alert_text_emp' , 'required' => 'required', 'style' => 'height: 200px;', 'class' => 'input_field', 'label' => false));  ?>

							</div>
						</div>

                        <div class="col-lg-12 col-sm-12 col-xs-12">
							<div class="form_block" >
								<label class = "nitin">Alert Message for Dependent<span class="clor"> * </span> :</label>
                                <b> _employee_name, _dep_name, _passport_expiry ,  _visa_exp_date</b>
                                <?php echo $this->Form->textarea('alert_text_dep', array('type' => 'select', 'options' => $alert_types, 'id' => 'alert_text_dep' , 'required' => 'required', 'style' => 'height: 200px;', 'class' => 'input_field', 'label' => false));  ?>

							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-lg-12 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Delivery<span class="clor"> * </span> :</label>
								<?php echo $this->Form->radio('delivery', ['schedule'],['label'=>['class'=>'radio-inline']]); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-sm-12 col-xs-12 ">
							<div class="form_block">
								<label class = "nitin">Schedule<span class="clor"> * </span> :</label>
								<div class="row">
									<div class="col-lg-3">
										<?php echo $this->Form->input('schdulecount', array('type'=>'number','min'=>0,'value'=>0,'class' => 'input_field', 'label' => false));  ?>
									</div>

								</div>
							</div>
						</div>
					</div>

					<!--<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Alert Text<span class="clor"> * </span> :</label>
							    <?php //echo $this->Form->input('alert_text', array('required' => 'required', 'class' => 'input_field','row'=>'7','cols'=>'30', 'label' => false));  ?>
							</div>
						</div>
					</div>-->

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
  <!-- Modal -->
<div class="modal fade" id="alertModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Alert</h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->create(null,['id'=>'alert_type','url'=>BASE_URL.'/admin/settings/add_alert_type']); ?>
		<div class="global_form">
			<div class="row">
				<div class="col-lg-10 col-sm-12 col-xs-12">
					<div class="form_block">
						<label class = "nitin">Alert Name<span class="clor"> * </span> :</label>
						<?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
					</div>
				</div>
			</div>
	   </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="save" class="btn btn-primary save_alert">Save</button>
      </div>
	  <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>

<?php echo $this->Html->script('admin/save_alert',['block'=>'scriptBottom']); ?>
 <script>
$(window).load(function(){
	CKEDITOR.replace('alert_text_dep');
	CKEDITOR.replace('alert_text_emp');
});
 </script>
