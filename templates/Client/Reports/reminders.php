<style>
.table_listing .download_report {
	margin: 0 3px 5px;
	display: inline-block;
}
</style>
<?php //echo '<pre>'; print_r($full_trans_records	); exit;?>
<div class="content-wrapper"> <?php echo  $this->Flash->render();?> 
  <!-- Main content -->
  <section class="content"> 
    <!-- Your Page Content Here -->
    <h2 class="global_title"><i class="fa fa-building-o"></i>Reminders Report</h2>
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
      <?php if(count($SendAlert_data)){ ?>
      <div class="clearfix"></div>
      <div class="for-search">
        <form class="form-inlin" id="report-form">
          <div class="row">
            <div class="clearfix" ></div>
            <fieldset>
            <div class="col-md-3">
              <div class="form_block">
                <label class = "nitin">Expired Type :</label>
                <?php 
					 echo $this->Form->input('expired_type',array('options'=>$AlertTypesTable, 'class' => 'input_field','label' => false ));  ?>
              </div>
            </div>
            
            <div class="col-md-3">
            	<div class="form_block" >
            	<label for="company_id">Start Date:</label>
            <?php echo $this->Form->input('start_date_ex_type',['label'=>false,'div'=>false ,'class'=>"form-control date_picker date_picker_type"]); ?> </div>
            </div>
            
            <div class="col-md-3">
            	<div class="form_block" >
            	<label for="company_id">End Date:</label>
            <?php echo $this->Form->input('end_date_ex_type',['label'=>false,'div'=>false ,'class'=>"form-control date_picker date_picker_type"]); ?> </div>
            </div>
            
            
            
            <div class="col-md-3">
              <div class="form_block">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-large btn-block btn-info" id="search-reports-exp">Search</button>
              </div>
            </div>
            </fieldset>
          </div>
        </form>
      </div>
      <?php } ?>
      <div class="for-search">
        
        <div class="pull-right" style="margin-right: 10px;">
          <button class="btn btn-primary" id="create-xl-employe-exp">Export to Excel</button>
        </div>
      </div>
      <!-- Table -->
      
      <div class="table_listing rep_content">
        <div class="text-center overlape" id="loader" style="display:none"> <img src ="/img/loading.gif" width="60px" height="60px"> </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th align='left'>COMPANY</th>
                <th align='left'>EMPLOYEE NAME</th>
                <td align='left'>TYPE OF REMINDERS</td>
                <th align='left'>DATE OF SENT</th>
                
             </tr>
              <?php 
			  if(count($SendAlert_data)){
				foreach($SendAlert_data as $SendAlert_dataRow){
					//echo '<pre>'; print_r($SendAlert_dataRow); exit;
				?>
              <tr>
                <td><?php echo ($SendAlert_dataRow->for_whom == 2 ) ? $SendAlert_dataRow->dependent->employee->company->name :  $SendAlert_dataRow->employee->company->name  ; ?></td> 
                
                <td><?php echo ($SendAlert_dataRow->for_whom == 2 ) ? $SendAlert_dataRow->dependent->employee->name.'('.$SendAlert_dataRow->dependent->name.')':  $SendAlert_dataRow->employee->name  ; ?></td>
                <td align='left'><?php echo $SendAlert_dataRow->alert_type->name; ?></td>
                <td align='left'><?php echo $this->DateC->DateFormetforView($SendAlert_dataRow->created); ?></td>
                   
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
              <p> <?php //echo $this->Paginator->counter('Showing {{start}} to {{end}} of {{count}}');?> </p>
            </div>
            <div class="col-lg-7 col-sm-7 col-xs-12">
              <ul class="pagination">
                <?php //echo $this->Paginator->prev('  ' . __('Previous'));?> <?php //echo $this->Paginator->numbers();?> <?php //echo $this->Paginator->next('  ' . __('Next'));?>
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
		var company_id = $('#company-id').val();
		$.ajax({
			url: webroot+"/admin/companies/getEmployees",
			cache: false,
			type:'POST',
			data: {'company_id':company_id},
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
			$("#expired-type option[value='labor_card_expired']").remove();
			$("#expired-type option[value='work_permit_exp_date']").remove();
			
			emp_dep();
		}else{
			$('.dependet-textbox').addClass('hide');
			$("#expired-type option[value='labor_card_expired']").remove();
			$('#expired-type').append($("<option></option>").attr("value","labor_card_expired").text('Labor Card Expired'));
			$('#expired-type').append($("<option></option>").attr("value","work_permit_exp_date").text('Work Permit')); 
		}
	});
	
	$('.date_picker_type').datepicker({
		'dateFormat':'dd/mm/yy',
	});
	
	$('select').select2();
	$('.date_picker').datepicker({ 'dateFormat':'dd/mm/yy'});	
	
	$(document).on('click', '#search-reports-exp', function(e) {
	e.preventDefault();
	
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;

	//get current location & check empty
	var target = window.location.href;
	if(!target)
	return false;
	
	flag = true;
	/*if($('#expired-type').val() != ''){
		if($('#start-date-ex-type').val() == ''){
			$('#start-date-ex-type').css('border-color' , 'red');
			flag = false;
		}else{
			$('#start-date-ex-type').css('border-color' , '#d2d6de');
		}
		if($('#end-date-ex-type').val() == ''){
			$('#end-date-ex-type').css('border-color' , 'red');
			flag = false;
		}else{
			$('#end-date-ex-type').css('border-color' , '#d2d6de');
		}
	}*/
	if(flag){
		
		//make seach query as query string
		target = target+'?'+searchQuery;
		$('#loader').css('display','block');
		$.get(target, function(data) {
		   // alert(data);
		   $('#loader').css('display','none');
			$('.rep_content').html(jQuery(data).find('.rep_content').html());
		},'html');
		return false;
	}
	
});

	$(document).on('click', '#create-xl-employe-exp', function(e) {
	e.preventDefault();
	//check if no search query
	var searchQuery = $('#report-form').serialize();
	if(!searchQuery)
	return false;
	
	flag = true;
	/*if($('#expired-type').val() != ''){
		if($('#start-date-ex-type').val() == ''){
			$('#start-date-ex-type').css('border-color' , '#d2d6de');
			flag = false;
		}else{
			$('#end-date-ex-type').css('border-color' , '#d2d6de');
		}
		if($('#end-date-ex-type').val() == ''){
			$('#end-date-ex-type').css('border-color' , 'red');
			flag = false;
		}else{
			$('#end-date-ex-type').css('border-color' , '#d2d6de');
		}
	}*/
	if(flag){
		//set current location 
		var target = webroot+'/client/reports/reminders_report';
		
		//make seach query as query string
		target = target+'?'+searchQuery;
		window.open(target);
		return false;
	}
	
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
