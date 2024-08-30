<style>
.table_listing .download_report {
	margin: 0 3px 5px;
	display: inline-block;
}
</style>
<div class="content-wrapper"> <?php //echo  $this->Flash->render();?> 
  <!-- Main content -->
  <section class="content"> 
    <!-- Your Page Content Here -->
    <h2 class="global_title"><i class="fa fa-building-o"></i>Send_Recieve Report</h2>
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
      <div class="for-search">
        
        <div class="	pull-right" style="margin-right: 10px;">
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
                <td align='left'>DOCUMENTS</td>
                <th align='left'>DATE OF RECEIVE</th>
                <th align='left'>DATE OF SENT</th>
             </tr><?php ?>
              <?php //echo '<pre>'; print_r($documents); exit;
			  if(count($documents) > 0){ 
				foreach($documents as $documents_dataRow){
					//echo '<pre>'; print_r($documents_dataRow); exit;
				if(count($documents_dataRow->dependent)  > 0  || count($documents_dataRow->employee->id ) > 0){
					//echo 'ssss'; exit;
					//echo '<pre>'; print_r($documents_dataRow); exit;
						?>
                    
                    
                  <?php  if($documents_dataRow->passport_receive_admin == 1){?>
                    	<tr>
                         <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
                        
                    	<td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
                        <td align='left'>Passport</td>
                        <td align='left'> <?php echo $this->DateC->DateFormetforView($documents_dataRow->passport_receive_admin_date) ?></td>
                        <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->passport_send_admin_date) ?></td>
						</tr>
				<?php }?>
                
                <?php  if($documents_dataRow->bc_receive_admin == 1){?>
                    	<tr>
                         <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
                        
                    	<td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
                        <td align='left'>Birthday Certificate:</td>
                        <td align='left'> <?php echo $this->DateC->DateFormetforView($documents_dataRow->bc_receive_admin_date) ?></td>
                        <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->bc_send_admin_date) ?></td>
						</tr>
				<?php }?>
                
                <?php  if($documents_dataRow->mc_receive_admin == 1){?>
                    	<tr>
                         <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
                        
                    	<td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
                        <td align='left'>Marriage Certificate</td>
                        <td align='left'> <?php echo $this->DateC->DateFormetforView($documents_dataRow->mc_receive_admin_date) ?></td>
                        <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->mc_send_admin_date) ?></td>
						</tr>
				<?php }?>
                
                 <?php  if($documents_dataRow->eid_receive_admin == 1){?>
                    	<tr>
                         <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
                        
                    	<td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
                        <td align='left'>Emirates ID</td>
                        <td align='left'> <?php echo $this->DateC->DateFormetforView($documents_dataRow->eid_receive_admin_date) ?></td>
                        <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->eid_send_admin_date) ?></td>
						</tr>
				<?php }?>
                
                
                <?php  if($documents_dataRow->dc_receive_admin == 1){?>
                    	<tr>
                        <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
                        
                    	<td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
                        <td align='left'>Degree Certificate</td>
                        <td align='left'> <?php echo $this->DateC->DateFormetforView($documents_dataRow->dc_receive_admin_date) ?></td>
                        <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->dc_send_admin_date) ?></td>
						</tr>
				<?php }?>
                
                
                <?php  if($documents_dataRow->medical_receive_admin == 1){?>
                    	<tr>
                         <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
                        
                    	<td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
                        <td align='left'>Medical</td>
                        <td align='left'> <?php echo $this->DateC->DateFormetforView($documents_dataRow->medical_receive_admin_date) ?></td>
                        <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->medical_send_admin_date) ?></td>
						</tr>
				<?php }?>
                
                
                 <?php  if($documents_dataRow->other_receive_admin == 1){?>
                    	<tr>
                        <td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?></td>
                        
                    	<td align='left'><?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .'('. $documents_dataRow->dependent->name .')'; ?></td>
                        <td align='left'>Other</td>
                        <td align='left'> <?php echo $this->DateC->DateFormetforView($documents_dataRow->other_receive_admin_date) ?></td>
                        <td align='left'><?php echo $this->DateC->DateFormetforView($documents_dataRow->other_send_admin_date) ?></td>
						</tr>
				<?php }?>
                
               <?php  }
			     }
			  }else{ ?>
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
                <?php // echo $this->Paginator->prev('  ' . __('Previous'));?> <?php //echo $this->Paginator->numbers();?> <?php //echo $this->Paginator->next('  ' . __('Next'));?>
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
			url: webroot+"/client/companies/getEmployees",
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
	//var searchQuery = $('#report-form').serialize();
	//if(!searchQuery)
	//return false;
	
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
	searchQuery = '';
	if(flag){
		//set current location 
		var target = webroot+'/client/reports/send_recieve_report';
		
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
