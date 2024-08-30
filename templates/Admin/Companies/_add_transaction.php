<style>
.clor {
	color: red;
}
</style>
<div class="content-wrapper">
<?php
	   if($this->request->getSession()->read('Auth.User.user_role_id') == '1'){
			$disabled 		= 'false';
			$idDateStart 	= 'start_date';
			$idDateEnd 		= 'complete_date';
		}else{
			$disabled 		= 'true';
			$idDateStart 	= '';
			$idDateEnd 	    = '';
		} ?>
<!-- Main content -->
<?php echo  $this->Flash->render();?>
<section class="content">
  <!-- Your Page Content Here -->
  <h2 class="global_title"><i class="fa fa-building-o"></i> Add Company Transaction</h2>
  <div class="main_info_sec"> <?php echo $this->Form->create($company_transaction,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
    <div class="global_form">
      <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "form-label">Company<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('company_id',array('type' => 'select', 'id' => 'company-id', 'options'=>$companies,'required' => 'required', 'class' => 'form-control mb-2 input_field','label' => false)); ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "form-label">Category<span class="clor"> * </span> :</label>
            <?php
                $for_whom = ['' =>'Select Category' , '1'=>'Employee','2'=>'Dependent'];
                echo $this->Form->input('for_whom',array('id' => 'for-whom', 'type' => 'select', 'options'=>$for_whom,'required' => 'required', 'class' => 'form-control mb-2 input_field','label' => false , 'disabled' => array('')));  ?>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "form-label">Select Employee<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('employee_id',array('type' => 'select', 'id' => 'employee-id', 'options'=>[],'required' => 'required', 'class' => 'form-control mb-2 input_field','label' => false ));  ?>
          </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-xs-12 hide dependet-textbox">
          <div class="form_block">
            <label class = "form-label">Select Dependent<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('dependet_id',array('id' => 'dependet-id','type' => 'select', 'options'=>[], 'class' => 'input_field','label' => false ));  ?>
          </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "form-label">Transaction<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input('transaction_type_id', array('type' => 'select', 'options'=>$transactions_type_ids,'required' => 'required', 'class' => 'form-control mb-2 input_field','label' => false,'id'=>'type'));  ?> </div>
        </div>
        <div class="transectionDiv">
     <?php  foreach($transactions as $key_ => $value_){?>
     <?php //echo '<pre>'; print_r($value_); exit; ?>
      <div class="innerRow col-md-12">
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block 123">
            <label class = "form-label">Type:<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input("trasections_relation.$key_.transaction_type_id", array('class' => 'form-control mb-2 input_field','label' => false , 'type' => 'select', 'options'=>$transactions ,'value' =>$key_ ));  ?>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "form-label">Starting Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text("trasections_relation.$key_.starting_date",array('class' => 'form-control mb-2 input_field readonly start_date ','id'=>$idDateStart.$key_  ,'disabled'=> $disabled  ,'label' => false));  ?>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12 status">
          <div class="form_block">
            <label class = "form-label">Status<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input("trasections_relation.$key_.status",array('type' => 'select', 'options'=>$transaction_status,'required' => 'required','class' => 'form-control mb-2 input_field','label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12 completion-date-block"  style="display:none">
          <div class="form_block">
            <label class = "form-label">Completion Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text("trasections_relation.$key_.completion_date",array('required' => 'required', 'class' => 'input_field readonly '. $idDateEnd .' ' , 'disabled' => $disabled, 'label' => false,'value'=>date('d/m/Y')));  ?>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "form-label">Note<span class="clor"> </span> :</label>
            <?php echo $this->Form->text("trasections_relation.$key_.note", array('class' => 'input_field','label' => false));  ?> </div>
        </div>
        <div class="col-lg-2 col-sm-12 col-xs-12">

          <div class="addfiles pull-right"> <?php echo $this->Form->input("trasections_relation.$key_._files[]", array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'form-control mb-2 input_field file', 'id' => ''.$key_.'files' , 'label' => false));  ?> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>
          <span  class="save" onclick='javascript:$("#<?php echo $key_?>files").trigger("click");'><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>



        </div>
        </div>
     <?php } ?>

        </div>



        <div  class="text-right addMoreTra hide" >  <i class="fa fa-plus" aria-hidden="true"></i>Add more Trasection </div>



        <div class="col-lg-12 col-sm-12 col-xs-12">
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
<?php echo $this->Html->script('admin/autocomlete',['block'=>'scriptBottom']); ?> <?php echo $this->Html->script('select2.min'); ?> <?php echo $this->Html->css('select2.min'); ?>
<script src="<?php echo BASE_URL; ?>/js/bootstrap-notify.js"></script>
<script type="text/javascript">
$(window).load(function () {
		var i = 1;
		var j = 1;
		var k = 1;
		$(document).on('change' , '#type' , function () {
			var type = $(this).val();
			webroot = '<?php echo BASE_URL; ?>';
			$.ajax({
				url: webroot+"/admin/companies/getOptions",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
				cache: false,
				type:'POST',
				data: {'type':type , 'for_whom' : $('#for-whom').val()},
				success: function(htmlD){
					var obj = $.parseJSON(htmlD);

					html = '';

					$.each( obj, function( key, value ) {
						$.each( obj, function( inner_key, inner_value ) {
							if(inner_key == key){
								option += '<option selected value="'+inner_key+'" >'+inner_value+'</option>'
							}else{
								option += '<option value="'+inner_key+'" >'+inner_value+'</option>'
							}
						});
						html += '<div class="col-md-12 innerRow"><div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "form-label">Type<span class="clor"> * </span> :</label><select name="trasections_relation['+key+'][transaction_type_id]" value="'+key+'" required="required" class="input_field transaction_id">'+option+'</select></div></div>';

						html += '<div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "form-label">Starting Date<span class="clor"> * </span> :</label><input type="text" name="trasections_relation['+key+'][starting_date]" class="input_field start_date readonly"></div></div>';

						//html += '<div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "form-label">Starting Date<span class="clor"> * </span> :</label><?php //echo $this->Form->text("trasections_relation."+key+".starting_date",array('required' => 'required', 'class' => 'input_field readonly','id'=>$idDateStart  ,'disabled'=> $disabled  ,'label' => false,'value'=>date('d/m/Y')));  ?></div></div>';

						html += '<div class="col-lg-6 col-sm-12 col-xs-12 status"><div><div class="form_block"><label class = "form-label">Status<span class="clor"> * </span> :</label><select name="trasections_relation['+key+'][status]" required="required" class="input_field" id="trasections-relation-'+key+'-status" tabindex="-1" ><option value="1">Pending</option><option value="2">Under Process</option><option value="3">Done</option></select> </div></div></div>';


						//html += '<div class="col-lg-6 col-sm-12 col-xs-12 status"><div class="form_block"><label class = "form-label">Status<span class="clor"> * </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.status",array('options'=>$transaction_status,'required' => 'required','class' => 'input_field','label' => false));  ?> </div></div>';

						html += '<div class="col-lg-6 col-sm-12 col-xs-12 completion-date-block"  style="display:none"><div class="form_block"><label class = "form-label">Completion Date<span class="clor"> * </span> :</label><input type="text" name="trasections_relation['+key+'][completion_date]" required="required" class="input_field readonly end_date" ></div>';

						//html += '<div class="col-lg-6 col-sm-12 col-xs-12 completion-date-block"  style="display:none"><div class="form_block"><label class = "form-label">Completion Date<span class="clor"> * </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.completion_date",array('required' => 'required', 'class' => 'input_field readonly', 'id'=>$idDateEnd , 'disabled' => $disabled, 'label' => false,'value'=>date('d/m/Y')));  ?></div>';

						html += '</div><div class="col-lg-4 col-sm-12 col-xs-12"><div class="form_block"><label class = "form-label">Note<span class="clor"> </span> :</label><input type="number" name="trasections_relation['+key+'][note]" class="input_field" id="trasections-relation-'+key+'-note"> </div></div>';

						//html += '</div><div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "form-label">Note<span class="clor"> </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.note", array('class' => "input_field $i ",'label' => false));  ?> </div></div></div>';

						html += '<div class="col-lg-2 col-sm-12 col-xs-12"><div class="addfiles pull-right"> <div class="input file"><input type="file" name="trasections_relation['+key+'][_files][]" style="display:none;" multiple="multiple" class="input_field file" id="'+key+'files"></div> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span><span class="save" onclick="javascript:$(&quot;#1files&quot;).trigger(&quot;click&quot;);"><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div></div></div>';
						<?php //$i = $i+1; ?>
					});
					if(k > 1){
					checkTrasection({employee_id:$('#employee-id').val() , dependet_id:$('#dependet-id').val() , transaction_type_id : $('#type').val()  , for_whom : $('#for-whom').val()});
					}
					k++;
					//console.log(html);
					$('.transectionDiv').html(html);
					$('.start_date , .end_date , .complete_date').datepicker({
						'dateFormat':'dd/mm/yy',
					});
					//$('select').select2();
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


	/*function returnTrasectionData(){

			return html;
	}*/
	webroot = '<?php echo BASE_URL; ?>';
	function company_emp(){
		var company_id = $('#company-id').val();
        console.log(company_id)
		$.ajax({
			url: webroot+"/admin/companies/getEmployees",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
			cache: false,
			type:'POST',
			data: {'company_id':company_id},
			success: function(html){
				$('#employee-id').html('').trigger('change');
				var obj = $.parseJSON(html);
				option = '<option></option>';
				$.each( obj, function( key, value ) {
					option += '<option value="'+key+'" >'+value+'</option>'
				});
				$('#employee-id').html(option);
				if(Object.keys(obj).length == 1 ){
					$.each( obj, function( key, value ) {
						$('#employee-id').val(key).trigger('change');
						return false;
					});
				}
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
			url: webroot+"/admin/companies/getdependent",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
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
				if(Object.keys(obj).length == 1 ){
					$.each( obj, function( key, value ) {
						$('#dependet-id').val(key).trigger('change');
						return false;
					});
				}
				if(i != 1){
					checkTrasection({employee_id:dependent_id , transaction_type_id : $('#type').val()  , for_whom : $('#for-whom').val()});
				}
				i++;
			}
		});

	}
	$('#dependet-id').change(function(){
		console.log(j);
		if(j > 2){
		checkTrasection({employee_id:$('#employee-id').val() , dependet_id:$('#dependet-id').val() , transaction_type_id : $('#type').val()  , for_whom : $('#for-whom').val()});
		}
		j++;
	});

	/**/function TakeEmailAndNumber(){
		var employee_id = $('#employee-id').val();
		$.ajax({
			url: webroot+"/admin/companies/takeemailandnumber",
			cache: false,
			type:'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
			data: {'employee_id':employee_id},
			success: function(html){
				var obj = $.parseJSON(html);
				$('#email').val(obj.email);
				$('#mobile-no').val(obj.mobile_no);
			}
		});
	}

	$('#for-whom').change(function(){
		if($(this).val() == 2){
			$('.dependet-textbox').removeClass('hide');
			emp_dep();
			$('select[name="transaction_type_id"]').select2('destroy');
			//$('select[name="transaction_type_id"]').
			$('select[name="transaction_type_id"]').html("<option value='1'>Family New Visa</option><option value='2'>Family Visa renewal</option><option value='3'>Cancellation</option><option value='4'>Visa Modify</option>");
			}else{
				$('select[name="transaction_type_id"]').html("<option value='1'>New Visa</option><option value='2'>Visa renewal</option><option value='3'>Labour card renewal</option><option value='4'>Labour cancellation</option><option value='5'>Immigration cancellation</option><option value='6'>Contract Modify</option><option value='7'>Visa Modify</option>");
			$('.dependet-textbox').addClass('hide');
		}
		$('#type').trigger('change');
	});

	var inputs = $("#fileupload input, #fileupload select , #fileupload textarea");
	$('#submit').click(function(event){
	var i = 0;
	var flag = true;
	event.preventDefault();
	inputs.each(function(index) {
	var input = $(this);

	if (!input.val() && (input[0].required) && (input[0].type != 'hidden') || (input[0].type=== "radio" && !input[0].type.is(':checked'))) {


		if(input.is("select")){
			$(this).parent().css('border','1px solid red');
		}

		$(this).css('border','1px solid red');

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
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
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
					setTimeout(function(){window.location.href =result.url;}, 2000);
					}else{
					$.notify(result.message, "error");
					//window.location.href =result.url;
				}
		}});
	}
});


	function checkTrasection (data){
		//console.log(data); return false;
		$.ajax({
			url: webroot+"/admin/companies/CheckTrasectionAlready",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
			cache: false,
			type:'POST',
			data: data,
			success: function(html){
				console.log(html);
				if(html == 1){
					/*if (window.confirm("The trasection is Already is in process!")) {
 				 		window.open("transactions", "Thanks for Visiting!");
					}*/
					var txt;
					var r = confirm("The trasection for this is already is in process!");
					if (r == true) {
						//txt = "You pressed OK!";
					} else {
						window.location.href = webroot+"/admin/companies/transactions";
						//txt = "You pressed Cancel!";
					}
				}
			}
		});
	}



});

	$select = $('select').select2();
  	$('#fileupload').parsley();

	$('.complete_date').datepicker({
		'dateFormat':'dd/mm/yy'
	});
	$('.start_date , .end_date').datepicker({
		'dateFormat':'dd/mm/yy',
	});
	//$('#start_date').attr('readonly','readonly');
	//$('#complete_date').attr('readonly','readonly');
	/*$(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });*/
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
.innerRow{
    border: 1px solid #f3f2f2;
    padding: 11px;
    background-color: #f7f7f7;
    border-radius: 6px;
	margin-top: 5px
}
</style>

