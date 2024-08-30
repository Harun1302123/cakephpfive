<style>
    .clor {
        color: red;
    }

    .skip {
        line-height: 46px;
    }

</style>
<div class="content-wrapper">
    <!-- Main content -->
    <?php echo  $this->Flash->render();?>
    <section class="content">
        <!-- Your Page Content Here -->
        <h2 class="global_title"><i class="fa fa-building-o"></i> Add Dependent</h2>
        <div class="main_info_sec">
            <?php echo $this->Form->create($dependent,array('id' => 'fileupload', 'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload', 'enctype' => 'multipart/form-data'));?>
            <div class="global_form">
                <fieldset>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Select Employee<span class="clor"> * </span> :</label>
                            <?php echo $this->Form->input('employee_id', array('type' => 'select', 'options'=> $employees,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Dependent Name<span class="clor"> * </span> :</label>
                            <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Select Relation <span class="clor"> * </span> :</label>
                            <?php echo $this->Form->input('relation', array('type' => 'select', 'options'=> $relations,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Nationality<span class="clor"> * </span> :</label>
                            <?php echo $this->Form->input('nationality', array('type' => 'select', 'options'=>$countries,'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Unified No :</label>
                            <?php echo $this->Form->input('unified_no', array('class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Status<span class="clor"> * </span> :</label>

                            <?php echo $this->Form->input('status', array('type' => 'select', 'options'=>['1'=>'Active','0'=>'Cancelled'],'required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>

                </fieldset>
                <fieldset>

                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Passport No<span class="clor"> * </span> :</label>
                            <?php echo $this->Form->input('passport_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Passport Expiry Date<span class="clor"> * </span> :</label>
                            <?php echo $this->Form->text('passport_exp_date', array('required' => 'required', 'class' => 'input_field date_expiry readonly' , 'placeholder'=>'DD/MM/YY' , 'label' => false));  ?>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-12 col-xs-12">
                        <div class="addfiles pull-right">
                            <?php echo $this->Form->input('files.passport_files[]', array('id' => 'hcard-files', 'style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file' ,'label' => false));  ?>
                            <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;"
                                class="count_image"></span> <span class="save" name="next"
                                onclick='javascript:$("#hcard-files").trigger("click");' value="next"><i
                                    class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>
                    </div>



                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">VISA No.<span class="clor"> * </span> :</label>
                            <?php echo $this->Form->input('visa_no', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">VISA Expiry Date<span class="clor"> * </span> :</label>
                            <?php echo $this->Form->text('visa_exp_date', array('required' => 'required', 'class' => 'input_field date_expiry readonly' , 'placeholder'=>'DD/MM/YY' , 'label' => false));  ?>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-12 col-xs-12">
                        <div class="addfiles pull-right">
                            <?php echo $this->Form->input('files.visa_files[]', array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file', 'id' => 'visa-files' ,'label' => false));  ?>
                            <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;"
                                class="count_image"></span> <span class="save" name="next"
                                onclick='javascript:$("#visa-files").trigger("click");' value="next"><i
                                    class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Emirates ID No :</label>
                            <?php echo $this->Form->input('emiratesID_no', array( 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Emirates ID Expiry Date :</label>
                            <?php echo $this->Form->text('emiratesID_exp_date', array( 'class' => 'input_field date_expiry readonly' ,  'label' => false , 'placeholder'=>'DD/MM/YY' ));  ?>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-12 col-xs-12">
                        <div class="addfiles pull-right">
                            <?php echo $this->Form->input('files.id_files[]', array( 'id' => 'id-files', 'style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file', 'label' => false));  ?>
                            <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;"
                                class="count_image"></span> <span class="save" name="next"
                                onclick='javascript:$("#id-files").trigger("click");' value="next"><i
                                    class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Health Care Card No. :</label>
                            <?php echo $this->Form->input('health_card_no', array( 'class' => 'input_field', 'label' => false));  ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-xs-12">
                        <div class="form_block">
                            <label class="nitin">Health Care Card Expiry Date :</label>
                            <?php echo $this->Form->text('health_card_exp_date', array('class' => 'input_field date_expiry readonly', 'label' => false , 'placeholder'=>'DD/MM/YY' ));  ?>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-12 col-xs-12">
                        <div class="addfiles pull-right">
                            <?php echo $this->Form->input('files.hcard_files[]', array('id' => 'hcard-files', 'style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field file' ,'label' => false));  ?>
                            <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;"
                                class="count_image"></span> <span class="save" name="next"
                                onclick='javascript:$("#hcard-files").trigger("click");' value="next"><i
                                    class="glyphicon glyphicon-paperclip"></i> Upload</span> </div>
                    </div>

                </fieldset>
                </fieldset>
                <hr>
                <fieldset>
                    <div class="col-lg-8 person_documents col-sm-12 col-xs-12">
                        <h4>Documents verification</h4>
                        <table class="table borderless">
                            <tr>
                                <td width="10%">Passport: </td>
                                <td width="20%"> Received by Daman</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="passport_receive_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="passport_receive_admin_date" type="hidden" class="regular-checkbox" />
                                </td>
                                <td width="20%">Sent to Client </br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="passport_send_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="passport_send_admin_date" type="hidden" class="regular-checkbox" />
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">Birthday Certificate: </td>
                                <td width="20%"> Received by Daman</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="bc_receive_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="bc_receive_admin_date" type="hidden" class="regular-checkbox" /></td>
                                <td width="20%">Sent to Client</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="bc_send_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="bc_send_admin_date" type="hidden" class="regular-checkbox" /></td>
                            </tr>
                            <tr>
                                <td width="10%">Marriage Certificate: </td>
                                <td width="20%"> Received by Daman</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="mc_receive_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="mc_receive_admin_date" type="hidden" class="regular-checkbox" /></td>
                                </td>
                                <td width="20%">Sent to Client</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="mc_send_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="mc_send_admin_date" type="hidden" class="regular-checkbox" /></td>
                            </tr>
                            <tr>
                                <td width="10%">Emirates ID: </td>
                                <td width="20%"> Received by Daman</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="eid_receive_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="eid_receive_admin_date" type="hidden" class="regular-checkbox" /></td>
                                <td width="20%">Sent to Client</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="eid_send_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="eid_send_admin_date" type="hidden" class="regular-checkbox" /></td>
                            </tr>
                            <tr>
                                <td width="10%">Degree Certificate: </td>
                                <td width="20%"> Received by Daman</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="dc_receive_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="dc_receive_admin_date" type="hidden" class="regular-checkbox" /></td>
                                <td width="20%">Sent to Client</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="dc_send_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="dc_send_admin_date" type="hidden" class="regular-checkbox" /></td>
                            </tr>
                            <tr>
                                <td width="10%">Medical: </td>
                                <td width="20%"> Received by Daman</br>
                                    <input style="opacity: 1; margin-left: 0px;  position: relative;" value='1'
                                        name="medical_receive_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="medical_receive_admin_date" type="hidden" class="regular-checkbox" />
                                </td>
                                <td width="20%">Sent to Client</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="medical_send_admin" type="checkbox" class="regular-checkbox" />
                                    <input name="medical_send_admin_date" type="hidden" class="regular-checkbox" /></td>
                            </tr>
                            <tr>
                                <td width="10%">Other: </td>
                                <td width="20%"> Received by Daman</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="other_receive_admin" type="checkbox" class="other_doc regular-checkbox" />
                                    <input name="other_receive_admin_date" type="hidden" class="regular-checkbox" />
                                </td>
                                <td width="20%">Sent to client</br>
                                    <input style="opacity: 1; margin-left: 0px; position: relative;" value='1'
                                        name="other_send_admin" type="checkbox" class="other_doc regular-checkbox" />
                                    <input name="other_send_admin_date" type="hidden"
                                        class="other_doc regular-checkbox" /></td>
                            </tr>
                        </table>
                    </div>
                </fieldset>
                <hr>
                <div class="row">
                    <!--<div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="global_btn_info">

          <?php //echo $this->Form->input('files[]', array('style'=>'display:none;','type' => 'file','multiple'=>'multiple', 'class' => 'input_field', 'label' => false));  ?>
          <button class="save" type='button' onclick='javascript:$("#files").trigger("click");' style='float:left;margin-left: 0px;'><i class="glyphicon glyphicon-paperclip"></i>Add Files</button>
          <span style="color:#367FA9;font-size:90%; padding : 0px 149px 0px 0px;" id="count_image"></span> </div>
      </div> -->
                    <?php
							if(isset($emp_id)){
								if(!isset($refere)){
						?>
                    <div class="col-lg-3 col-sm-12 col-xs-12">
                        <div class="global_btn_info"> <a class="save skip"
                                href="/admin/companies/add_transaction/<?php echo base64_encode($company_id); ?>"><i
                                    class="fa fa-floppy-o"></i> SKIP</a> </div>
                    </div>
                    <?php } } ?>
                    <div class="col-lg-3 col-sm-12 col-xs-12 pull-right">
                        <div class="global_btn_info">
                            <button id="submit" class="save" type="submit" name="next" value="next"><i
                                    class="fa fa-floppy-o"></i> Submit</button>
                        </div>
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
<?php echo $this->Html->script('select2.min'); ?> <?php echo $this->Html->css('select2.min'); ?>
<script src="<?php echo BASE_URL; ?>/js/bootstrap-notify.js"></script>
<script>
    $('#files').change(function () {
        var numFiles = $(this, this)[0].files.length;
        $("#count_image").html(numFiles + " File Selected");
    });
    $('.date_expiry').datepicker({
        'dateFormat': 'dd/mm/dd',
        'changeMonth': true,
        'changeYear': true,
        'minDate': 0,
        'onClose': function (dateText, inst) {
            $(this).datepicker('option', 'dateFormat', 'dd/mm/yy');
        }
    });
    $(document).ready(function () {
        $('select').select2();
    });

    $(".person_documents input").change(function () {
        if (this.checked) {
            $(this).parent().append('<span class="documents_date">' + formatDate(new Date()) + '</span>');
            date = new Date()
            $('input[name="' + $(this).attr('name') + '_date"]').val(date.getFullYear() + '/' + (date
                .getMonth() + 1) + '/' + date.getDate()); //$(this).attr('name')
        } else {
            $(this).parent().children('.documents_date').remove();
        }
    });

    /*$(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });*/

    function formatDate(date) {
        var monthNames = [
            "Jan", "Feb", "March",
            "April", "May", "June", "July",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();
        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }
    $('.other_doc').change(function () {
        if (this.checked) {
            var name = $(this).attr('name');
            name = name.replace('_admin', '');
            $(this).parent('td').append('<div  class="other-doc-parent form_block"><input  name="' + name +
                '_value" type="text"  class="input_field" style="width: 90%" required /></div>');
        } else {
            $(this).parent().children('.other-doc-parent').remove();
        }
    });

    var inputs = $("form input, form select , form textarea");
    $('#submit').click(function (event) {
        var i = 0;
        var flag = true;
        event.preventDefault();
        inputs.each(function (index) {
            var input = $(this);
            //console.log(input[0].type.required);
            if (!input.val() && (input[0].required) && (input[0].type != 'hidden') || (input[0].type ===
                    "radio" && !input[0].type.is(':checked'))) {
                $(this).css('border', '1px solid red');
                //console.log(input[0]);
                if (i == 0) {
                    flag = false;
                    window.scrollTo('#' + $(this).attr('id'), 200);
                }
                i++;
                //validForm = false;
            } else {
                $(this).css('border', '1px solid rgba(0,0,0,.15)');
            }
        });

        if (flag) {
            var data = new FormData($('form#fileupload')[0]);
            console.log($(this).html());
            $(this).children('i').removeClass('fa-floppy-o').addClass('fa-spinner fa-spin');
            $.ajax({
                url: $('form').attr('action'),
                type: "POST",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                context: this,
                success: function (result) {
                    $(this).children('i').addClass('fa-floppy-o').removeClass('fa-spinner fa-spin');
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
                }
            });
        }
    });

    jQuery.fn.scrollTo = function (elem, speed) {
        $(this).animate({
            scrollTop: $(this).scrollTop() - $(this).offset().top + $(elem).offset().top
        }, speed == undefined ? 1000 : speed);
        return this;
    };

</script>
