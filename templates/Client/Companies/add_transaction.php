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
      <h2 class="global_title"><i class="fa fa-building-o"></i> Add Company Transaction</h2>
		<div class="main_info_sec">	
            <?php echo $this->Form->create($company_transaction,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
				<div class="global_form">
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Company<span class="clor"> * </span> :</label>
								<?php echo $this->Form->input('company_id',array('options'=>$companies,'required' => 'required', 'class' => 'input_field','label' => false)); ?>				
							</div>
						</div>
						
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Category<span class="clor"> * </span> :</label>
							  <?php 
							  $for_whom = ['1'=>'Employee','2'=>'Dependent'];
							  echo $this->Form->input('for_whom',array('options'=>$for_whom,'required' => 'required', 'class' => 'input_field','label' => false));  ?>
							</div>
						</div>

											
					</div>	
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Mobile No.<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('mobile_no', array('required' => 'required', 'class' => 'input_field','label' => false));  ?>
							</div>
						</div> 

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Email<span class="clor"> * </span> :</label>
								<?php echo $this->Form->input('email',array('required' => 'required','type'=>'email' ,'class' => 'input_field','label' => false));  ?>
							</div>
						</div> 	
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Name<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field','id'=>'search-name','label' => false,'autocomplete'=>'off'));  ?>
							  <div id="suggesstion-box"></div>
							</div>
						</div> 

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Transaction<span class="clor"> * </span> :</label>
								<?php //$transactionsnew = array('1'=>'New Visa','2' => 'Visa renewal','3'=>'Labour card renewal','4'=>'Family new visa ','5'=>'Family visa renewal','6'=>'Relative work permit','7'=>'Mission work permit','8'=>'Temporary work permit','9'=>'Cancellation');?>
								<?php echo $this->Form->input('transaction_type_id',array('options'=>$transactions_type_ids,'required' => 'required', 'class' => 'input_field','label' => false,'id'=>'type'));  ?>
							</div>
						</div>
						
						 	
					</div>

					<div class="row">						
						 <div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Transaction Type<span class="clor"> * </span> :</label>
								<?php $transactionstypes = array('1'=>'Quota ','2' => 'job offer letter','3'=>'bank guarantee','4'=>'entry permit','5'=>'change status','6'=>'Emirates ID','7'=>'medical fitness ','8'=>'typing labour card','9'=>'visa stamp','10'=>'submit labour card');?>
								<?php								
								echo $this->Form->input('transaction_id', array('options'=>$transactionstypes,'required' => 'required','class' =>'input_field','label' => false, 'id'=>'size'));  ?>
							</div>
						</div> 

						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Starting Date<span class="clor"> * </span> :</label>
								
							  <?php 
							  echo $this->Form->input('starting_date_cus',array('required' => 'required', 'class' => 'input_field','id'=>'start_date','label' => false,'value'=>date('Y-m-d')));  ?>
							</div>
						</div>
					</div>	
					
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Status<span class="clor"> * </span> :</label>
							  <?php echo $this->Form->input('status',array('options'=>$transaction_status,'required' => 'required','class' => 'input_field','label' => false));  ?>
							</div>
						</div>  
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Transaction Finished<span class="clor">  </span> :</label>
							  <?php 
							  $options = ['1'=>'Yes','2'=>'No'];
							  echo $this->Form->input('trans_finish',array('options'=> $options,'class' => 'input_field','empty'=>'-- Select Tranasction Finish--','label' => false));  ?>
							</div>
						</div> 
					</div>
					
					<div class="row">
						<div class="col-lg-6 col-sm-12 col-xs-12" id="completion-date-block" style="display:none">
							<div class="form_block">
								<label class = "nitin">Completion Date<span class="clor"> * </span> :</label>
								
							  <?php 
							  echo $this->Form->input('completion_date_cus',array('required' => 'required', 'class' => 'input_field','label' => false,'value'=>date('Y-m-d'),'readonly'=>'readonly'));  ?>
							</div>
						</div>
						<div class="col-lg-6 col-sm-12 col-xs-12">
							<div class="form_block">
								<label class = "nitin">Note<span class="clor">  </span> :</label>
							  <?php echo $this->Form->input('note', array('class' => 'input_field','label' => false));  ?>
							</div>
						</div>
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
<?php echo $this->Html->script('admin/autocomlete',['block'=>'scriptBottom']); ?>
<script type="text/javascript">
$(document).ready(function () {
    $("#type").change(function () {
		
        var val = $(this).val();
		if (val == "1") {
            $("#size").html("<option value='1'>Quota</option><option value='2'>job offer letter</option><option value='3'>work permit </option><option value='4'>bank guarantee</option><option value='5'>entry permit</option><option value='6'>change status</option><option value='8'>Emirates ID</option><option value='9'>medical fitness </option><option value='10'>Typing labour card</option><option value='11'>visa stamp</option><option value='12'>Submit labour card  </option>");
        } if (val == "2") {
            $("#size").html("<option value='8'>Emirates id renewal</option><option value='9'>medical fitness</option><option value='11'>visa stamp</option>");
        } else if (val == "3") {
            $("#size").html("<option value='2'>Job offer letter </option><option value='10'>Typing labour card renewal</option><option value='12'>submit labour card renewal </option>");
        } else if (val == "4") {
            $("#size").html("<option value='5'>Entry permit </option><option value='6'>change status</option><option value='8'>emirates ID</option><option value='9'>medical fitness</option><option value='11'>visa stamp</option>");
        } else if (val == "5") {
            $("#size").html("<option value='8'>Emirates ID </option><option value='9'>medical fitness</option><option value='16'>visa renewal </option>");
        }else if (val == "6") {
            $("#size").html("<option value='2'>Job offer letter </option><option value='3'>work permit</option><option value='4'>bank guarantee</option><option value='9'>labour card</option>");
        }else if (val == "7") {
            $("#size").html("<option value='2'>Job offer letter</option><option value='3'>work permit</option><option value='17'>labour card</option>");
        }else if (val == "8") {
            $("#size").html("<option value='2'>Job offer letter</option><option value='3'>work permit</option><option value='18'>labour contract </option>");
        }else if (val == "9") {
            $("#size").html("<option value='13'>Labour card cancelation </option><option value='14'>submit labour card cancelation</option><option value='15'>immigration cancelation  </option>");
        }
		else{
			
			$("#size").html("<option value='1'>Quota</option><option value='2'>job offer letter</option><option value='3'>work permit </option><option value='4'>bank guarantee</option><option value='5'>entry permit</option><option value='6'>change status</option><option value='8'>Emirates ID</option><option value='9'>medical fitness </option><option value='10'>Typing labour card</option><option value='11'>visa stamp</option><option value='12'>Submit labour card  </option>");
		}
    });
});
  	$('#fileupload').parsley();
	$('#start_date').datepicker({
		'dateFormat':'yy-mm-dd',
		'minDate':0
	  });
	$('#complete_date').datepicker({
		'dateFormat':'yy-mm-dd'
	});
	$('#start_date').attr('readonly','readonly');
	$('#complete_date').attr('readonly','readonly');
</script>
<style>
#name-list{    list-style: none;
    color: #3c8dbc;
    position: absolute;
    top: 100%;
    width: 100%;
    z-index: 9;
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 15px;
    box-shadow: 0 0 7px 0px #ccc;
    border-radius: 4px;
    margin-top: 1px;}
.parsley-errors-list{padding:0;list-style:none;color:red;}
.suggesstion-box{
	position:absolute;
}
#name-list li {
    padding: 2px 0;
}
</style>