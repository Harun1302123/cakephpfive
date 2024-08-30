<style>
.clor {
	color: red;
}
</style>
<div class="content-wrapper">
<!-- Main content -->
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

								 echo  $this->Flash->render();?>
<section class="content">
  <!-- Your Page Content Here -->
  <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Company Transaction</h2>
  <div class="main_info_sec"> <?php echo $this->Form->create($company_transaction,  array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
    <div class="global_form">
      <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Company<span class="clor"> * </span> :</label>
            <?php  echo $this->Form->input('company_id',array('id' => 'company-id', 'type' => 'select', 'options'=>$companies,'required' => 'required', 'class' => 'input_field', 'value'=>$company_transaction['company_id'],'label' => false)); ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Category<span class="clor"> * </span> :</label>
            <?php
				$for_whom = ['1'=>'Employee','2'=>'Dependent'];
				echo $this->Form->input('for_whom', array('type' => 'select', 'id' => 'for-whom', 'options'=>$for_whom,'required' => 'required', 'class' => 'input_field','value'=>$company_transaction['for_whom'],'label' => false));  ?>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Select Employee<span class="clor"> * </span> :</label>
            <?php
				echo $this->Form->input('employee_id', array('id' => 'employee-id', 'type' => 'select', 'options'=>[],'required' => 'required', 'class' => 'input_field','label' => false ));  ?>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12 hide dependet-textbox">
          <div class="form_block">
            <label class = "nitin">Select Dependent<span class="clor"> * </span> :</label>
            <?php
				echo $this->Form->input('dependet_id', array('id' => 'dependet-id', 'type' => 'select', 'options'=>[], 'class' => 'input_field','label' => false ));  ?>
          </div>
        </div>
        <!--<div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Mobile No.<span class="clor"> * </span> :</label>
            <?php //echo $this->Form->input('mobile_no', array('required' => 'required', 'class' => 'input_field','label' => false));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Email<span class="clor"> * </span> :</label>
            <?php //echo $this->Form->input('email',array('required' => 'required','type'=>'email' ,'class' => 'input_field','label' => false));  ?> </div>
        </div>-->
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Transaction<span class="clor"> * </span> :</label>
            <?php
            echo $this->Form->input('transaction_type_id', array('id'=>'type', 'type' => 'select', 'options'=>$transactions_type_ids,'required' => 'required','class' =>'input_field', 'disabled'=>'disabled' ,'label' => false ,));  ?>
          </div>
        </div>
<?php //echo '<pre>'; print_r($optionsV); exit;
		//print_r($company_transaction['transaction_type_id']); exit; ?>
        <div class="transectionDiv">
     <?php  foreach($company_transaction['trasections_relation'] as $key_ => $value_){?>
     <?php //echo '<pre>'; print_r($value_); exit; ?>
      <div class="innerRow col-md-12">
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block 123">
            <label class = "nitin">Type:<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input("trasections_relation.$key_.transaction_type_id", array('id' => $key_.'type', 'type' => 'select', 'class' => 'input_field','label' => false , 'options'=>$transactions,   'value' =>$key_  ));  ?>

            <?php echo $this->Form->hidden("trasections_relation.$key_.trasections_relation_id", array('class' => 'input_field','label' => false   ,'value' => $value_['trasections_relation_id'] ));  ?>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Starting Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text("trasections_relation.$key_.starting_date",array( 'class' => 'input_field readonly '.$idDateStart /*,'disabled'=> $disabled*/  ,'label' => false, 'value' => $value_['starting_date']));  ?>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12 status">
          <div class="form_block">
            <label class = "nitin">Status<span class="clor"> * </span> :</label>
            <?php echo $this->Form->input("trasections_relation.$key_.status", array('type' => 'select', 'options'=>$transaction_status,'required' => 'required','class' => 'input_field','label' => false , 'value' =>$value_['status']));  ?> </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12 completion-date-block" <?php echo $value_['status'] == 3 ? '' : 'style="display:none"'  ?>  >
          <div class="form_block">
            <label class = "nitin">Completion Date<span class="clor"> * </span> :</label>
            <?php echo $this->Form->text("trasections_relation.$key_.completion_date",array('class' => 'input_field readonly '.$idDateEnd, /*'disabled' => $disabled, */'label' => false , 'value' =>$value_['completion_date']));  ?>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-xs-12">
          <div class="form_block">
            <label class = "nitin">Note<span class="clor"> </span> :</label>
            <?php echo $this->Form->text("trasections_relation.$key_.note", array('class' => 'input_field','label' => false, 'value' =>$value_['note']));  ?> </div>
        </div>
        <div class="col-lg-2 col-sm-12 col-xs-12">

          <div class="addfiles pull-right"> <?php echo $this->Form->input("trasections_relation.$key_._files[]", array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file', 'id' => ''.$key_.'files' , 'label' => false, 'value' =>$key_));  ?> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>
          <span  class="save" onclick='javascript:$("#<?php echo $key_?>files").trigger("click");'><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>



        </div>
        </div>
     <?php } ?>

        </div>        <div  class="text-right addMoreTra hide" >  <i class="fa fa-plus" aria-hidden="true"></i>Add more Trasection </div>




        <div class="col-lg-12 col-sm-12 col-xs-12">
          <div class="global_btn_info">
            <button id="submit"  class="save"><i class="fa fa-floppy-o"></i> Submit</button>
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

<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<?php echo $this->Html->script('admin/autocomlete',['block'=>'scriptBottom']); ?>
<?php echo $this->Html->script('select2.min'); ?>
<?php echo $this->Html->css('select2.min'); ?>
<?php echo $this->Html->script('bootstrap-notify.js'); ?>


<script type="text/javascript">

$(document).ready(function () {
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
                        html +=
                            '<div class="col-md-12 innerRow"><div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Type<span class="clor"> * </span> :</label><select name="trasections_relation[' +
                            key +
                            '][transaction_type_id]" required="required" class="input_field transaction_id">' +
                            option +
                            "</select></div></div>";

                        html +=
                            '<div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Starting Date<span class="clor"> * </span> :</label><input type="text" name="trasections_relation[' +
                            key +
                            '][starting_date]" class="input_field start_date readonly"></div></div>';

                        //html += '<div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Starting Date<span class="clor"> * </span> :</label><?php //echo $this->Form->text("trasections_relation."+key+".starting_date",array('required' => 'required', 'class' => 'input_field readonly','id'=>$idDateStart  ,'disabled'=> $disabled  ,'label' => false,'value'=>date('d/m/Y')));  ?></div></div>';

                        html +=
                            '<div class="col-lg-6 col-sm-12 col-xs-12 status"><div><div class="form_block"><label class = "nitin">Status<span class="clor"> * </span> :</label><select name="trasections_relation[' +
                            key +
                            '][status]" required="required" class="input_field" id="trasections-relation-' +
                            key +
                            '-status" tabindex="-1" ><option value="1">Pending</option><option value="2">Under Process</option><option value="3">Done</option></select> </div></div></div>';

                        //html += '<div class="col-lg-6 col-sm-12 col-xs-12 status"><div class="form_block"><label class = "nitin">Status<span class="clor"> * </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.status",array('options'=>$transaction_status,'required' => 'required','class' => 'input_field','label' => false));  ?> </div></div>';

                        html +=
                            '<div class="col-lg-6 col-sm-12 col-xs-12 completion-date-block"  style="display:none"><div class="form_block"><label class = "nitin">Completion Date<span class="clor"> * </span> :</label><input type="text" name="trasections_relation[' +
                            key +
                            '][completion_date]" required="required" class="input_field readonly end_date" id="complete_date' +
                            key +
                            '"></div>';

                        //html += '<div class="col-lg-6 col-sm-12 col-xs-12 completion-date-block"  style="display:none"><div class="form_block"><label class = "nitin">Completion Date<span class="clor"> * </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.completion_date",array('required' => 'required', 'class' => 'input_field readonly', 'id'=>$idDateEnd , 'disabled' => $disabled, 'label' => false,'value'=>date('d/m/Y')));  ?></div>';

                        html +=
                            '</div><div class="col-lg-4 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Note<span class="clor"> </span> :</label><input type="number" name="trasections_relation[' +
                            key +
                            '][note]" class="input_field" id="trasections-relation-' +
                            key +
                            '-note"> </div></div>';

                        //html += '</div><div class="col-lg-6 col-sm-12 col-xs-12"><div class="form_block"><label class = "nitin">Note<span class="clor"> </span> :</label><?php //echo $this->Form->input("trasections_relation.$i.note", array('class' => "input_field $i ",'label' => false));  ?> </div></div></div>';

                        html +=
                            '<div class="col-lg-2 col-sm-12 col-xs-12"><div class="addfiles pull-right"> <div class="input file"><input type="file" name="trasections_relation[' +
                            key +
                            '][_files][]" style="display:none;" multiple="multiple" class="input_field file" id="1files"></div> <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span><span class="save" onclick="javascript:$(&quot;#1files&quot;).trigger(&quot;click&quot;);"><i class="glyphicon glyphicon-paperclip"></i> Upload</span> </div></div></div>';
                    });
                    //console.log(html);
                    $(".transectionDiv").html(html);
                    $(".start_date , .end_date").datepicker({
                        dateFormat: "dd/mm/yy",
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
                });
                //console.log(html);
                $(".transectionDiv").html(html);
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
            $('select[name="transaction_type_id"]').select2("destroy");
            //$('select[name="transaction_type_id"]').
            //$('select[name="transaction_type_id"]').select2();
            // then call parsley
            //$(".attendance-form").parsley();
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

    /*$(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });*/

    //$('select').select2();

    $("select").select2();
    $("#fileupload").parsley();
    $(".start_date").datepicker({
        dateFormat: "dd/mm/yy",
        //'minDate':0
    });
    var nowTemp = new Date();
    var now = new Date(
        nowTemp.getFullYear(),
        nowTemp.getMonth(),
        nowTemp.getDate(),
        0,
        0,
        0,
        0
    );

    $(".complete_date").datepicker({
        dateFormat: "dd/mm/yy",
    }); //.datepicker("setDate", "0");
    //$('#start_date').attr('readonly','readonly');
    //$('#complete_date').attr('readonly','readonly');

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
                console.log(input);
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

        if (flag) {
            var data = new FormData($("form#fileupload")[0]);
            console.log($(this).html());
            $(this)
                .children("i")
                .removeClass("fa-floppy-o")
                .addClass("fa-spinner fa-spin");
            $.ajax({
                url: $("form").attr("action"),
                type: "POST",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                context: this,
                success: function (result) {
                    console.log(result)
                    $(this)
                        .children("i")
                        .addClass("fa-floppy-o")
                        .removeClass("fa-spinner fa-spin");
                    var result = JSON.parse(result);
                    if (result.status) {
                        $.notify(result.message, "success");
                        setTimeout(function () {
                            window.location.href = result.url;
                        }, 2000);
                    } else {
                        $.notify(result.message, "error");
                        //window.location.href =result.url;
                    }
                },
            });
        }
    });
});
</script>


<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
.innerRow{
    border: 1px solid #f3f2f2;
    padding: 11px;
    background-color: #f7f7f7;
    border-radius: 6px;
	margin-top: 5px
}
</style>
