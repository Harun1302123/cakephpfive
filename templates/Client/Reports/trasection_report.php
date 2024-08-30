<style>
.table_listing .download_report {
	margin: 0 3px 5px;
	display: inline-block;
}
</style>
<div class="content-wrapper"> <?php echo  $this->Flash->render();?>
  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <h2 class="global_title"><i class="fa fa-building-o"></i>Employees Report</h2>
    <div class="main_info_sec">
      <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
        <!-- <div class="col-lg-12">
				   <a href="/admin/companies/add_transaction" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
			   </div> -->
      </div>
      <style>
			   .text-center.overlape {
        				position: absolute;
    					width: 100%;
   						z-index: 9999;
    					left: 0;
    					top: 39%;
				}
			   .table_listing{
				   position:relative;}
		   </style>
      <!--- for searching ----->
      <?php if(!$full_trans_records->isEmpty()){ ?>
      <div class="clearfix"></div>
      <div class="for-search">
        <form class="form-inlin" id="report-form">
          <div class="row">
            <div class="col-md-3">
              <div class="form_block" >
                <label for="for_whom">Category:</label>
                <?php echo $this->Form->input('for_whom',['options'=>['1'=>'Employees','2'=>'Dependent'],'label'=>false,'div'=>false ,'empty'=>'Select Category','class'=>"form-control"]); ?> </div>
            </div>
            <div class="col-md-3">
              <div class="form_block">
                <label class = "nitin">Select Employee<span class="clor"> * </span> :</label>
                <?php
							  echo $this->Form->input('employee_id',array('options'=>[],'required' => 'required', 'class' => 'input_field','label' => false ));  ?>
              </div>
            </div>
            <div class="col-md-3 hide dependet-textbox">
              <div class="form_block">
                <label class = "nitin">Select Dependent<span class="clor"> * </span> :</label>
                <?php
							  echo $this->Form->input('dependet_id',array('options'=>[], 'class' => 'input_field','label' => false ));  ?>
              </div>
            </div>
            <div class="clearfix" ></div>


            <div class="col-md-3">
              <div class="form_block" >
                <label for="company_id">Transaction:</label>
                <?php echo $this->Form->input('transaction_id',['options'=>$transactions_type_ids,'label'=>false,'div'=>false ,'empty'=>'Select Transaction','class'=>"form-control" ,'id'=>'type']); ?> </div>
            </div>
            <div class="col-md-3">
              <div class="form_block" >
                <label for="company_id">Transaction Type:</label>
                <?php echo $this->Form->input('transaction_type_id',['options'=>$transactions,'label'=>false,'div'=>false ,'empty'=>'Select Transaction Type','class'=>"form-control" ]); ?> </div>
            </div>
            <div class="col-md-3">
              <div class="form_block" >
                <label for="company_id">Start Date:</label>
                <?php echo $this->Form->input('starting_date',['label'=>false,'div'=>false ,'class'=>"form-control date_picker"]); ?> </div>
            </div>
            <div class="col-md-3">
              <div class="form_block" >
                <label for="company_id">Complition Date:</label>
                <?php echo $this->Form->input('completion_date',['label'=>false,'div'=>false, 'class'=>"form-control date_picker"]); ?> </div>
            </div>

            <div class="col-md-3">
              <div class="form_block">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-large btn-block btn-info" id="search-reports">Search</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <?php } ?>
      <div class="for-search">

        <div class="pull-right" style="margin-right: 10px;">
          <button class="btn btn-primary" id="create-xl-employe">Export to Excel</button>
        </div>
      </div>
      <!-- Table -->

      <div class="table_listing rep_content">
        <div class="text-center overlape" id="loader" style="display:none"> <img src ="/img/loading.gif" width="60px" height="60px"> </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th align='left'><?php echo $this->Paginator->sort('company_id', 'COMPANY');?></th>
                <th align='left'><?php echo $this->Paginator->sort('name', 'NAME');?></th>
                <th align='left'><?php echo $this->Paginator->sort('transaction_id', 'TRANSACTION');?></th>
                <th align='left'><?php echo $this->Paginator->sort('transaction_type_id', 'TYPE');?></th>
                <th align='left'><?php echo $this->Paginator->sort('starting_date', 'STARTED DATE');?></th>
                <th align='left'><?php echo $this->Paginator->sort('status', 'STATUS');?></th>
                <th align='left'><?php echo $this->Paginator->sort('completion_date', 'COMLETED DATE');?></th>
                <th align='left'><?php echo $this->Paginator->sort('note', 'NOTE');?></th>
                <th align='left'>USER</th>
                <!-- <th align='left'>Action</th> -->
              </tr>
              <?php if(!$full_trans_records->isEmpty()){
						foreach($full_trans_records as $full_trans_record){
						if($full_trans_record->starting_date == ''){continue;}
						if($full_trans_record->company_transaction->for_whom == 1){
							if ($full_trans_record->company_transaction->transaction_type_id == 1) {
								$optionsV =array(1 =>'Quota', 2 =>'Job Offer', 3 =>'Work permit', 4 =>'Pre Aprovel',  5 =>'Bank guarantee', 6 =>'E Visa', 7=>'Change status', 8 =>'Medical fitness',  9 =>'Emirates ID', 10 =>'Typing labour card' , 11 =>'Submit labour card',  12 =>'Visa stamp', 13=>'Send to Employee');
							} else if ($full_trans_record->company_transaction->transaction_type_id == 2) {
								$optionsV =array(1 =>'Medical fitness',  2 =>'Emirates ID', 3=>'Visa stamp');
							} else if ($full_trans_record->company_transaction->transaction_type_id == 3) {
								$optionsV =array(1 =>'Offer Letter',  2 =>'Send to Employee', 3=>'Submisstion');
							}
						}else{
							if ($full_trans_record->company_transaction->transaction_type_id == 1) {
								$optionsV =array(1 =>'Entry Permint', 2 =>'Change status', 3 =>'Medical', 4 =>'Emirates ID',  5 =>'Visa stamp');
							} else if ($full_trans_record->company_transaction->transaction_type_id == 2) {
								$optionsV =array(1 =>'Medical', 2 =>'Emirates ID',  3 =>'Visa stamp');
							}
						}
						//echo '<pre>'; print_r($transaction_status); exit;
			  ?>
              <tr>
                <td><?php echo $full_trans_record->company_transaction->company->name;?></td>
                <td><?php echo $full_trans_record->company_transaction->name;?></td>
               <td><?php echo $transactions_type_ids[$full_trans_record->company_transaction->transaction_type_id];?></td>
                <td><?php echo $optionsV[$full_trans_record->transaction_type_id];?></td>
                <td><?php echo $this->DateC->DateFormetforView($full_trans_record->starting_date);?></td>
                <td><?php echo $transaction_status[$full_trans_record->status];?></td>
                <td><?php echo $full_trans_record->status == 3 ? $this->DateC->DateFormetforView($full_trans_record->completion_date) : 'NULL'; ?></td>
                <td><?php echo $full_trans_record->note;?></td>
                <td><?php echo $full_trans_record->user ? $full_trans_record->user->Username : null; ?></td>
                <!--td>
								<?php
								/*
									$edit = '<a href="'.BASE_URL.'/admin/companies/edit_transaction/'.base64_encode($followtrans->id).'">
									<i class="fa fa-edit" title="Edit"></i></a>';

									echo $edit;	*/
								?>
								</td-->
              </tr>
              <?php }		}else{ ?>
              <tr>
                <td colspan="9" class="no_record">No Record Found</td>
              </tr>
              <?php } ?>
            </thead>
          </table>
        </div>
        <div class="table_page_info">
          <div class="row">
            <div class="col-lg-5 col-sm-5 col-xs-12">
              <p> <?php echo $this->Paginator->counter('Showing {{start}} to {{end}} of {{count}}');?> </p>
            </div>
            <div class="col-lg-7 col-sm-7 col-xs-12">
              <ul class="pagination">
                <?php echo $this->Paginator->prev('  ' . __('Previous'));?> <?php echo $this->Paginator->numbers();?> <?php echo $this->Paginator->next('  ' . __('Next'));?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!---------------- / course------------->
<?php echo $this->Html->script('select2.min'); ?>
<?php echo $this->Html->css('select2.min'); ?>
<script>
	webroot = '<?php echo BASE_URL; ?>';
	function company_emp(){
		//var company_id = $('#company-id').val();
		$.ajax({
			url: webroot+"/client/companies/getEmployees",
			cache: false,
			type:'POST',
			//data: {'company_id':company_id},
			success: function(html){
				//$('#employee-id').html('').trigger('change');
				var obj = $.parseJSON(html);
				option = '';
				option  = '<option value="">Select Employee</option>'
				$.each( obj, function( key, value ) {
					option += '<option value="'+key+'" >'+value+'</option>'
				});
				$('#employee-id').html(option);

				/*$.each( obj, function( key, value ) {
					$('#employee-id').val(key).trigger('change');
					return false;
				});*/
			}
		});

	}
	company_emp();

	$('#company-id').change(function(){
		company_emp();
	});

	$('#employee-id').change(function(){
		emp_dep();
	});

	function emp_dep(){
		var dependent_id = $('#employee-id').val();
		$.ajax({
			url: webroot+"/client/companies/getdependent",
			cache: false,
			type:'POST',
			data: {'dependent_id':dependent_id},
			success: function(html){
				var obj = $.parseJSON(html);
				option = '';
				$('#dependet-id').html('').trigger('change');
				$.each( obj, function( key, value ) {
					option += '<option  value="'+key+'" >'+value+'</option>';
				});
				$('#dependet-id').html(option);
				$.each( obj, function( key, value ) {
					$('#dependet-id').val(key).trigger('change');
					return false;
				});
			}
		});
	}

	$('#for-whom').change(function(){
		if($(this).val() == 2){
			$('.dependet-textbox').removeClass('hide');
			$('select[name="transaction_type_id"]').select2('destroy');
			//$('select[name="transaction_type_id"]').
			$('select[name="transaction_type_id"]').html("<option value='1'>Family New Visa</option><option value='2'>Family Visa renewal</option>");
			emp_dep();
		}else{
			$('select[name="transaction_type_id"]').html("<option value='1'>New Visa</option><option value='2'>Visa renewal</option><option value='3'>Labour card renewal</option>");
			$('.dependet-textbox').addClass('hide');
		}
	});

	$('.date_picker_type').datepicker({
		'dateFormat':'yy-mm-dd',
	});

	$('select').select2();
	$('.date_picker').datepicker({ 'dateFormat':'dd-mm-yy'});

	$("#type").change(function () {
			<?php  $i = 0; ?>
			var type = $(this).val();
			webroot = '<?php echo BASE_URL; ?>';
			$.ajax({
				url: webroot+"/client/companies/getOptions",
				cache: false,
				type:'POST',
				data: {'type':type},
				success: function(htmlD){
					var obj = $.parseJSON(htmlD);
					option = '';
					$.each( obj, function( key, value ) {
						option += '<option value="'+key+'" >'+value+'</option>'
					});
					console.log(option);
					$('#transaction-type-id').html(option);


					//console.log(html);
					//$('.transectionDiv').html(html);
					/*option = '';
					$.each( obj, function( key, value ) {
						option += '<option value="'+key+'" >'+value+'</option>'
					});
					$('#employee-id').html(option);
					if(Object.keys(obj).length == 1 ){
						$.each( obj, function( key, value ) {
							$('#employee-id').val(key).trigger('change');
							return false;
						});
					}*/
				}
			});
	});



$(document).on('click', '#create-xl-employe', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//set current location
	var target = webroot+'/client/reports/excel_full';

	//make seach query as query string
	target = target+'?'+searchQuery;
	window.open(target);
	return false;

});

$(document).on('click', '#search-reports', function(e) {
	e.preventDefault();

	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//get current location & check empty
	var target = window.location.href;
	if(!target)
	return false;

	//make seach query as query string
	target = target+'?'+searchQuery;
	$('#loader').css('display','block');
    $.get(target, function(data) {
	   // alert(data);
	   $('#loader').css('display','none');
		$('.rep_content').html(jQuery(data).find('.rep_content').html());
	},'html');
	return false;

});

</script>
<style>
	.for-search{
		padding: 0 20px 20px 20px;
		margin-bottom: 20px;
	}
	fieldset .col-md-3 {
    	background-color: rgba(204, 204, 204, 0.16);
	}
	.form_block{
		margin: 0 0 11px 0;
	}
</style>
