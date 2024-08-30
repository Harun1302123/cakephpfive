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
            <h2>Edit Company Transaction</h2>
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
                            'id' => 'type',
                            'disabled' => 'disabled'
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

     <?php  foreach($company_transaction['trasections_relation'] as $key_ => $value_){?>
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
                                'id' => $key_.'type',
                                'class' => 'form-control mb-2 input_field',
                                'label' => false ,
                                'type' => 'select', 
                                'options' => $transactions,
                                'value' => $key_ 
                            )
                        );  
                    ?>

                    <?php 
                        echo $this->Form->hidden(
                            "trasections_relation.$key_.trasections_relation_id", 
                                array(
                                    'class' => 'input_field',
                                    'label' => false,
                                    'value' => $value_['trasections_relation_id'] 
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
                                'label' => false,
                                'value' => $value_['starting_date']
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
                            'options' => $transaction_status,
                            'class' => 'form-control mb-2', 
                            'label' => false,
                            'value' =>$value_['status']
                            )
                        );  
                    ?>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="fv-row w-100 flex-md-root" >
                    <div class="completion-date-block" <?php echo $value_['status'] == 3 ? '' : 'style="display:none"'  ?>>
                    <!--begin::Label-->
                    <label class="form-label">Completion Date</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <?php 
                        echo $this->Form->text(
                            "trasections_relation.$key_.completion_date",
                            array(
                                'class' => 'form-control mb-2 input_field readonly '. $idDateEnd .' ' ,
                                'label' => false,
                                'value' => $value_['completion_date']
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
                                    'label' => false,
                                    'value' => $value_['note']
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
                                        'class' => 'form-control mb-2 file',
                                        'value' => $key_
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
$(document).ready(function () {
    var dateFormat = "d/m/y";

    $("#type").change(function () {
        // '<?php  $i = 0; ?>'
        var type = $(this).val();
        webroot = "<?php echo BASE_URL; ?>";
        $.ajax({
            url: webroot + "/admin/companies/getOptions",
            cache: false,
            type: "POST",
            data: { type: type },
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            success: function (htmlD) {
                var obj = $.parseJSON(htmlD);
                $.each(obj, function (key, value) {
                    option +=
                        '<option value="' + key + '" >' + value + "</option>";
                });
                html = "";

                $.each(obj, function (key, value) {
                    var obj = $.parseJSON(htmlD);
                    $.each(obj, function (key, value) {
                        option +=
                            '<option value="' +
                            key +
                            '" >' +
                            value +
                            "</option>";
                    });
                    html = "";

                    $.each(obj, function (key, value) {
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
                                    html +='<input type="text" name="trasections_relation['+key+'][completion_date]" id="complete_date' + key + '"  required="required" class="form-control mb-2 input_field readonly end_date"readonly="readonly">';                    
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
                  
                    });
                    //console.log(html);
                    $(".transectionDiv").html(html);
      
                    flatpickr(".start_date", {
                        dateFormat: dateFormat,
                    });

                    flatpickr(".end_date", {
                        dateFormat: dateFormat,
                    });
                });
                //console.log(html);
                $(".transectionDiv").html(html);

                activateFileUploadCounter();
          
            },
        });
    });

    function company_emp() {
        var company_id = $("#company-id").val();
        $.ajax({
            url: webroot + "/admin/companies/getEmployees",
            cache: false,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: { company_id: company_id },
            success: function (html) {
                var obj = $.parseJSON(html);
                $("#employee-id").html("").trigger("change");
                option = "";
                $.each(obj, function (key, value) {

                    if (key == <?php echo $company_transaction["employee_id"]; ?>) {
                        option +=
                            '<option selected value="' +
                            key +
                            '" >' +
                            value +
                            "</option>";
                    } else {
                        option +=
                            '<option value="' +
                            key +
                            '" >' +
                            value +
                            "</option>";
                    }
                });
                $("#employee-id").html(option);
                $("#for-whom").trigger("change");
                $("#employee-id").trigger("change");
                if (Object.keys(obj).length == 1) {
                    $.each(obj, function (key, value) {
                        $("#employee-id").val(key).trigger("change");
                        return false;
                    });
                } /**/
            },
        });
    }

    company_emp();
    
    $("#company-id").change(function () {
        company_emp();
    });

    $("#employee-id").change(function () {
        if ($("#employee-id").html() != "") {
            emp_dep();
        }
    });

    var pageload = true;

    function emp_dep() {
        var dependentId = '<?php echo $company_transaction["dependet_id"] ?>';
        console.log(dependentId);

        var dependent_id = $("#employee-id").val();
        $.ajax({
            url: webroot + "/admin/companies/getdependent",
            cache: false,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: { dependent_id: dependent_id },
            success: function (html) {
                var obj = $.parseJSON(html);
                $("#dependet-id").html("").trigger("change");
                option = "<option></option>";
                $.each(obj, function (key, value) {
                    if (key == dependentId) {
                        option +=
                            '<option selected="selected" value="' +
                            key +
                            '" >' +
                            value +
                            "</option>";
                        selectedOpn = key;
                    } else {
                        option +=
                            '<option value="' +
                            key +
                            '" >' +
                            value +
                            "</option>";
                    }
                });
                $("#dependet-id").html(option);
                if (selectedOpn != "") {
                    $("#dependet-id").val(selectedOpn).trigger("change");
                } else {
                    if (Object.keys(obj).length == 1) {
                        $.each(obj, function (key, value) {
                            $("#dependet-id").val(key).trigger("change");
                            return false;
                        });
                    }
                }
                if (!pageload) {
                    //TakeEmailAndNumber();
                }
                pageload = false;
            },
        });
    }

    var flag = 0;

    $("#for-whom").change(function () {
        if ($(this).val() == 2) {
            $(".dependet-textbox").removeClass("hide");
            
        } else {
            $(".dependet-textbox").addClass("hide");
        }
        if (flag != 0) {
            //console.log('hhereee445');
            emp_dep();
            $("#type").trigger("change");
            if ($(this).val() == 2) {
                $('select[name="transaction_type_id"]').html(
                    "<option value='1'>Family New Visa</option><option value='2'>Family Visa renewal</option><option value='3'>Cancellation</option><option value='4'>Visa Modify</option>"
                );
            } else {
                $('select[name="transaction_type_id"]').html(
                    "<option value='1'>New Visa</option><option value='2'>Visa renewal</option><option value='3'>Labour card renewal</option><option value='4'>Labour cancellation</option><option value='5'>Immigration cancellation</option><option value='6'>Contract Modify</option><option value='7'>Visa Modify</option>"
                );
            }
        }
        flag++;
    });

    var inputs = $(
        "#fileupload input, #fileupload select , #fileupload textarea"
    );

    $("#submit").click(function (event) {
        var i = 0;
        var flag = true;
        event.preventDefault();
        inputs.each(function (index) {
            var input = $(this);

            if (
                (!input.val() &&
                    input[0].required &&
                    input[0].type != "hidden") ||
                (input[0].type === "radio" && !input[0].type.is(":checked"))
            ) {
                if (input.is("select")) {
                    $(this).parent().css("border", "1px solid red");
                }

                $(this).css("border", "1px solid red");

                if (i == 0) {
                    flag = false;
                    window.scrollTo("#" + $(this).attr("id"), 200);
                }
                i++;
                //validForm = false;
            } else {
                $(this).css("border", "1px solid rgba(0,0,0,.15)");
            }
        });
        console.log(flag)
        if (flag) {
            var data = new FormData($("form#fileupload")[0]);
            const o = document.getElementById("submit");
            o.setAttribute("data-kt-indicator", "on")
            
            $.ajax({
                url: $("form").attr("action"),
                type: "POST",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                context: this,
                success: function (result) {
                    o.removeAttribute("data-kt-indicator")
                   
                    var result = JSON.parse(result);
                    if (result.status) {
                        toastr.success(result.message);

                        setTimeout(function () {
                            window.location.href = result.url;
                        }, 2000);
                    } else {
                        toastr.error(result.message);

                        //window.location.href =result.url;
                    }
                },
            });
        }
    });

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
})
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
