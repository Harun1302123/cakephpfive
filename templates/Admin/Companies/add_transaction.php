<?php
	   if($this->request->getSession()->read('Auth.User.user_role_id') == '1'){
			$disabled 		= 'false';
			$idDateStart 	= 'start_date';
			$idDateEnd 		= 'complete_date';
		}else{
			$disabled 		= 'true';
			$idDateStart 	= '';
			$idDateEnd 	    = '';
		}
?>
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Add Company Transaction</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <?php
            echo $this->Form->create(
                $company_transaction,
                array(
                        'id' => 'fileupload',
                        'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload',
                        'enctype' => 'multipart/form-data'
                    )
            );
        ?>

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Company</label>
                <!--end::Label-->
                <!--begin::Input-->
                <!-- <input type="text" class="form-control mb-2" value=""> -->
                <?php echo $this->Form->input('company_id', array('type' => 'select', 'id' => 'company-id', 'options' => $companies, 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Category</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php 
                    $for_whom = ['' =>'Select Category' , '1' => 'Employee','2'=>'Dependent'];
                    echo $this->Form->input(
                        'for_whom', 
                        array(
                            'id' => 'for-whom', 
                            'type' => 'select', 
                            'options' => $for_whom, 
                            'required' => 'required', 
                            'class' => 'form-control mb-2', 
                            'label' => false
                        )
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Select Employee</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php 
                    echo $this->Form->text('employee_id', 
                        array(
                            'type' => 'select', 
                            'id' => 'employee-id', 
                            'required' => 'required', 
                            'class' => 'form-control mb-2', 
                            'label' => false
                            )
                    );  
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <div class="hide dependet-textbox">
                    <!--begin::Label-->
                    <label class="required form-label">Select Dependent</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <?php 
                        echo $this->Form->input(
                            'dependet_id', 
                            array(
                                'id' => 'dependet-id', 
                                'type' => 'select',
                                'required' => 'required', 
                                'class' => 'form-control mb-2', 
                                'label' => false,
                                'options' => []
                            )
                        );  
                    ?>
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->
        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Transaction</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php 
                    echo $this->Form->input(
                        'transaction_type_id', 
                        array(
                            'type' => 'select', 
                            'options' => $transactions_type_ids,
                            'required' => 'required', 
                            'class' => 'form-control mb-2 input_field',
                            'label' => false,
                            'id' => 'type'
                        )
                    );  
                ?> 
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
       
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->
    <div class="transectionDiv">

     <?php  foreach($transactions as $key_ => $value_){?>
        <div class="innerRow pt-10 p-5">
            <!--begin::Input row-->
            <div class="d-flex flex-wrap gap-5">
                <!--begin::Input group-->
                <div class="fv-row w-100 flex-md-root">
                    <!--begin::Label-->
                    <label class="form-label">Type</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <?php 
                        echo $this->Form->input(
                            "trasections_relation.$key_.transaction_type_id",
                            array(
                                'class' => 'form-control mb-2 input_field',
                                'label' => false ,
                                'type' => 'select', 
                                'options' => $transactions,
                                'value' => $key_ 
                            )
                        );  
                    ?>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row w-100 flex-md-root">
                    <!--begin::Label-->
                    <label class="form-label">Starting Date</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <?php 
                        echo $this->Form->text(
                            "trasections_relation.$key_.starting_date",
                            array(
                                'class' => 'input_field readonly start_date form-control mb-2',
                                'id' => $idDateStart.$key_,
                                'disabled'=> $disabled,
                                'label' => false
                            )
                        );  
                    ?>

                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Input row-->

             <!--begin::Input row-->
             <div class="d-flex flex-wrap gap-5">
                <!--begin::Input group-->
                <div class="fv-row w-100 flex-md-root">
                    <!--begin::Label-->
                    <label class="form-label">Status</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <?php 
                        echo $this->Form->text(
                            "trasections_relation.$key_.status", 
                            array(
                            'type' => 'select', 
                            'required' => 'required', 
                            'options'=>$transaction_status,
                            'class' => 'form-control mb-2', 
                            'label' => false
                            )
                        );  
                    ?>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="fv-row w-100 flex-md-root" >
                    <div class="completion-date-block" style="display:none">
                    <!--begin::Label-->
                    <label class="form-label">Completion Date</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <?php 
                        echo $this->Form->text(
                            "trasections_relation.$key_.completion_date",
                            array(
                                'required' => 'required',
                                'class' => 'form-control mb-2 input_field readonly '. $idDateEnd .' ' ,
                                'disabled' => $disabled,
                                'label' => false,
                                'value' => date('d/m/Y')
                            )
                        );  
                    ?>
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
             
            </div>
            <!--end::Input row-->

            <div class="d-flex flex-wrap gap-5">
                <!--begin::Input group-->
                <div class="fv-row w-100 flex-md-root">
                    <!--begin::Label-->
                    <label class="form-label">Note</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    
                    <?php 
                        echo $this->Form->text(
                                "trasections_relation.$key_.note", 
                                array(
                                    'class' => 'form-control mb-2 input_field',
                                    'label' => false
                                )
                            );  
                    ?> 
                </div>
                    <!--end::Input-->
                <div class="fv-row w-100 flex-md-root pt-8">
                        <!--begin::Input group-->
                    <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>
                    <!--begin::Input-->
                    <div style="float:right;">
                        <?php
                                echo $this->Form->input(
                                    "trasections_relation.$key_._files[]",
                                    array(
                                        'id' => ''.$key_.'files',
                                        'style'=>'display:none;',
                                        'type' => 'file',
                                        'multiple'=>'multiple',
                                        'label' => false,
                                        'class' => 'form-control mb-2 file'
                                    )
                                )
                            ?>

                        <button class="btn btn-primary" type='button'
                            onclick='javascript:$("#<?php echo $key_?>files").trigger("click");'
                            style='float:left;margin-left: 0px;'>
                            <i class="fas fa-paperclip"></i>
                            <span class="indicator-label">Upload</span>
                        </button>
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::Input group-->
            </div>
        </div>
     <?php } ?>
    </div>
    <!--begin::Input row-->
    <div class="d-flex flex-wrap gap-5 pt-10">
        <!--begin::Input group-->
        <div class="fv-row w-100 flex-md-root">
            
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row w-100 flex-md-root">
            <button style="float: right;" type="submit" id="submit" class="btn btn-primary">
                <i class="far fa-save"></i>
                <!--begin::Indicator label-->
                <span class="indicator-label">Save Changes</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Input row-->
    <?php echo $this->Form->end(); ?>

    </div>
    <!--end::Card header-->
</div>

<script type="text/javascript">
$(window).load(function () {
    // $('select').select2();

    var dateFormat = "d/m/y";

    var i = 1;
    var j = 1;
    var k = 1;

    $(document).on('change' , '#type' , function () {
        var type = $(this).val();
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
                    // html += '<div class="col-md-12 innerRow"><div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Type<span class="clor"> * </span> :</label><select name="trasections_relation['+key+'][transaction_type_id]" value="'+key+'" required="required" class="input_field transaction_id">'+option+'</select></div></div>';

                    // html += '<div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Starting Date<span class="clor"> * </span> :</label><input type="text" name="trasections_relation['+key+'][starting_date]" class="input_field start_date readonly"></div></div>';

                    // //html += '<div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Starting Date<span class="clor"> * </span> :</label><?php //echo $this->Form->text("trasections_relation."+key+".starting_date",array('required' => 'required', 'class' => 'input_field readonly','id'=>$idDateStart  ,'disabled'=> $disabled  ,'label' => false,'value'=>date('d/m/Y')));  ?></div></div>';

                    // html += '<div class="col-lg-6 col-sm-12 col-xs-12 status"><div><div class="form_block"><label class = "nitin">Status<span class="clor"> * </span> :</label><select name="trasections_relation['+key+'][status]" required="required" class="input_field" id="trasections-relation-'+key+'-status" tabindex="-1" ><option value="1">Pending</option><option value="2">Under Process</option><option value="3">Done</option></select> </div></div></div>';


                    // //html += '<div class="col-lg-6 col-sm-12 col-xs-12 status"><div class="form_block"><label class = "nitin">Status<span class="clor"> * </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.status",array('options'=>$transaction_status,'required' => 'required','class' => 'input_field','label' => false));  ?> </div></div>';

                    // html += '<div class="col-lg-6 col-sm-12 col-xs-12 completion-date-block"  style="display:none"><div class="form_block"><label class = "nitin">Completion Date<span class="clor"> * </span> :</label><input type="text" name="trasections_relation['+key+'][completion_date]" required="required" class="input_field readonly end_date" ></div>';

                    // //html += '<div class="col-lg-6 col-sm-12 col-xs-12 completion-date-block"  style="display:none"><div class="form_block"><label class = "nitin">Completion Date<span class="clor"> * </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.completion_date",array('required' => 'required', 'class' => 'input_field readonly', 'id'=>$idDateEnd , 'disabled' => $disabled, 'label' => false,'value'=>date('d/m/Y')));  ?></div>';

                    // html += '</div><div class="col-lg-4 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Note<span class="clor"> </span> :</label><input type="number" name="trasections_relation['+key+'][note]" class="input_field" id="trasections-relation-'+key+'-note"> </div></div>';

                    // //html += '</div><div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Note<span class="clor"> </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.note", array('class' => "input_field $i ",'label' => false));  ?> </div></div></div>';

                    // html += '<div class="col-lg-2 col-sm-12 col-xs-12"><div class="addfiles pull-right"> <div class="input file"><input type="file" name="trasections_relation['+key+'][_files][]" style="display:none;" multiple="multiple" class="input_field file" id="'+key+'files"></div> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span><span class="save" onclick="javascript:$(&quot;#1files&quot;).trigger(&quot;click&quot;);"><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div></div></div>';
                    
                    html    +='<div class="innerRow pt-10 p-5">';
    html    +='<div class="d-flex flex-wrap gap-5">';
        html    +='<div class="fv-row w-100 flex-md-root">';
            html    +='<label class="form-label">Type</label>';
            html    +='<select name="trasections_relation['+key+'][transaction_type_id]" value="'+key+'" required="required" class="form-control mb-2 input_field transaction_id">'+option+'</select>';                
        html    +='</div>'
        html    +='<div class="fv-row w-100 flex-md-root">';
            html    +='<label class="form-label">Starting Date</label>';
            html    +='<input type="text" name="trasections_relation['+key+'][starting_date]" class="input_field readonly start_date form-control mb-2" readonly="readonly">';
            html    +='</div>';
        html    +='</div>';

    html    +='<div class="d-flex flex-wrap gap-5">';
        html    +='<div class="fv-row w-100 flex-md-root">';
        html    +='<label class="form-label">Status</label>';
        html    +='<select name="trasections_relation['+key+'][status]" required="required" class="form-control mb-2 input_field" id="trasections-relation-'+key+'-status" tabindex="-1" ><option value="1">Pending</option><option value="2">Under Process</option><option value="3">Done</option></select>';
        html        +='</div>';
                
        html   +='<div class="fv-row w-100 flex-md-root">';
         html   +='<div class="completion-date-block" style="display:none">';
            html +='<label class="form-label">Completion Date</label>';
            html +='<input type="text" name="trasections_relation['+key+'][completion_date]" required="required" class="form-control mb-2 input_field readonly end_date"readonly="readonly">';                    
                    html +='</div>';
            html +='</div>';
             
        html +='</div>';

        html +='<div class="d-flex flex-wrap gap-5">';
            html +='<div class="fv-row w-100 flex-md-root">';
            html +='<label class="form-label">Note</label>';
                   
                    
            html +='<input type="text" name="trasections_relation['+key+'][note]" class="form-control mb-2 input_field" id="trasections-relation-'+key+'-note"> ';
        html +='</div>';
        html +='<div class="fv-row w-100 flex-md-root pt-8">';
            html +='<span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>';
            html +='<div style="float:right;">';
                html +='<input type="file" name="trasections_relation['+key+'][_files][]" id="'+key+'files" style="display:none;" multiple="multiple" class="form-control mb-2 input_field file">';
                html +='<button class="btn btn-primary" type="button" onclick="javascript:$(&quot;#1files&quot;).trigger(&quot;click&quot;);" style="float:left;margin-left: 0px;">';
                    html +='<i class="fas fa-paperclip"></i>';
                    html +='<span class="indicator-label">Upload</span>';
                html +='</button>';
            html +='</div>';
        html +='</div>';
    html +='</div>';
html +='</div>';
                    
                    
                    <?php //$i = $i+1; ?>
                });
                if(k > 1){
                    checkTrasection(
                        {
                            employee_id:$('#employee-id').val(), 
                            dependet_id:$('#dependet-id').val(), 
                            transaction_type_id : $('#type').val(), 
                            for_whom : $('#for-whom').val()
                        }
                    );
                }
                k++;
                //console.log(html);
                $('.transectionDiv').html(html);

                $(document).ready(
                    function() {
                        flatpickr(".complete_date", {
                            dateFormat: dateFormat,
                        });

                        flatpickr(".start_date", {
                            dateFormat: dateFormat,
                        });

                        flatpickr(".end_date", {
                            dateFormat: dateFormat,
                        });

                        activateFileUploadCounter()
                    }
                )
       
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

	function company_emp(){
		var company_id = $('#company-id').val();
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
		if(j > 2){
		    checkTrasection(
                {
                    employee_id: $('#employee-id').val(), 
                    dependet_id: $('#dependet-id').val(), 
                    transaction_type_id : $('#type').val(), 
                    for_whom : $('#for-whom').val()
                }
            );
		}
		j++;
	});

	function TakeEmailAndNumber(){
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
			// $('select[name="transaction_type_id"]').select2('destroy');
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

            const o = document.getElementById("submit");
            o.setAttribute("data-kt-indicator", "on")

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
                    o.removeAttribute("data-kt-indicator")

                    var result = JSON.parse(result);
                    if(result.status){
                        toastr.success(result.message);

                        setTimeout(function(){window.location.href =result.url;}, 2000);
                        }else{
                        toastr.error(result.message);
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

    flatpickr(".complete_date", {
        dateFormat: dateFormat,
    });

    flatpickr(".start_date", {
        dateFormat: dateFormat,
    });

    flatpickr(".end_date", {
        dateFormat: dateFormat,
    });
    
    activateFileUploadCounter();

    function activateFileUploadCounter()
    {
        $("input.file").change(function () {
        var numFiles = $(this, this)[0].files.length;
        $(this)
            .parent()
            .siblings("span.count_image")
            .html(numFiles + " File Selected");
        });
    }
    

});
</script>

<style>
.hide {
  display: none !important;
}
.innerRow{
    border: 1px solid #f3f2f2;
    background-color: #f7f7f7;
    border-radius: 6px;
	margin-top: 10px
}
</style>
