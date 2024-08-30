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

                .table_listing {
                    position: relative;
                }
            </style>
            <!--- for searching ----->
            <?php if(!$full_trans_records->isEmpty()){ ?>
            <div class="clearfix"></div>
            <div class="for-search">
                <form class="form-inlin" id="report-form">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form_block">
                                <label for="company_id">Company:</label>
                                <?php echo $this->Form->input('company_id', ['type' => 'select', 'id' => 'company-id', 'type' => 'select', 'options'=>$companies,'label'=>false,'div'=>false ,'empty'=>'Select Company','class'=>"form-control"]); ?>
                            </div>
                        </div>
                        <div class="col-md-3 hide">
                            <div class="form_block">
                                <label for="for_whom">Category:</label>
                                <?php echo $this->Form->input('for_whom', ['id' => 'for-whom', 'type' => 'select', 'options'=>['1'=>'Employees','2'=>'Dependent'],'label'=>false,'div'=>false ,'empty'=>'Select Category','class'=>"form-control"]); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form_block">
                                <label class="nitin">Select Employee<span class="clor"> * </span> :</label>
                                <?php
							  echo $this->Form->input('employee_id', array('id' => 'employee-id', 'type' => 'select', 'options'=>[],'required' => 'required', 'class' => 'input_field','label' => false ));  ?>
                            </div>
                        </div>
                        <div class="col-md-3 hide dependet-textbox">
                            <div class="form_block">
                                <label class="nitin">Select Dependent<span class="clor"> * </span> :</label>
                                <?php
							  echo $this->Form->input('dependet_id', array('id' => 'dependet-id', 'type' => 'select', 'options'=>[], 'class' => 'input_field','label' => false ));  ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <fieldset>
                            <div class="col-md-3">
                                <div class="form_block">
                                    <label class="nitin">Expired Type :</label>
                                    <?php
					 echo $this->Form->input('expired_type',array('type' => 'select', 'options'=>[''=>'Select Type','passport_expired'=>'Passport Expired','visa_expired'=>'Visa Expired' , 'emirates_id_expired' => 'Emirates ID Expired', 'labor_card_expired' => 'Labor Card Expired' , 'health_card_exp_date' => 'Insurance'], 'class' => 'input_field','label' => false ));  ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form_block">
                                    <label for="company_id">Start Date:</label>
                                    <?php echo $this->Form->input('start_date_ex_type', ['label'=>false,'div'=>false ,'class'=>"form-control date_picker date_picker_type"]); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form_block">
                                    <label for="company_id">End Date:</label>
                                    <?php echo $this->Form->input('end_date_ex_type', ['label'=>false,'div'=>false ,'class'=>"form-control date_picker date_picker_type"]); ?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="col-md-3">
                            <div class="form_block">
                                <label class="" for="searchQuery">Email or Name</label>
                                <input type="text" class="form-control" name="email_or_name" id="searchQuery"
                                    placeholder="Email or Name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form_block">
                                <label class="" for="searchQuery">Status</label>
                                <?php
					 echo $this->Form->input('status',array('type' => 'select', 'options'=>[''=>'Select Status','0'=>'Canceled' , 1 => 'Active'], 'class' => 'input_field','label' => false ));  ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form_block">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-large btn-block btn-info"
                                    id="search-reports-exp">Search</button>
                            </div>
                        </div>
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
                <div class="text-center overlape" id="loader" style="display:none"> <img src="/img/loading.gif"
                        width="60px" height="60px"> </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th align='left'><?php echo $this->Paginator->sort('company_id', 'COMPANY');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('name', 'NAME');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('email', 'EMAIL');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('mobile_no', 'MOBILE NO.');?></th>

                                <th align='left'>
                                    <?php echo $this->Paginator->sort('employee_entity', 'Employee Entity');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('unified_no', 'Unified No');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('ps_number', 'PS Number');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('Nationality', 'nationality');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('gender', 'Gender');?></th>

                                <th align='left'><?php echo 'PASSPORT NO';?></th>
                                <th align='left'><?php echo 'PASSPORT EXPIRE DATE';?></th>
                                <th align='left'><?php echo 'VISA NO';?></th>
                                <th align='left'><?php echo 'VISA EXPIRE DATE';?></th>
                                <th align='left'><?php echo 'EMIRATES ID NO';?></th>
                                <th align='left'><?php echo 'EMIRATES ID EXPIRE DATE';?></th>
                                <th align='left'><?php echo 'HEALTH CARD EXPIRE DATE';?></th>
                                <th align='left'><?php echo 'Other'; ?></th>


                                <th align='center'><?php echo $this->Paginator->sort('status', 'STATUS');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('created', 'CREATED');?></th>
                                <!-- <th align='left'>Action</th> -->
                            </tr>
                            <?php if(!$full_trans_records->isEmpty()){
				foreach($full_trans_records as $full_trans_record){
					//echo '<pre>'; print_r($full_trans_record); exit;
				?>
                            <tr>
                                <td><?php echo (isset($_GET['for_whom']) && $_GET['for_whom'] == 2) ? $full_trans_record['employee']['company']['name'] : $full_trans_record['company']['name'];?>
                                </td>
                                <td><?php echo ucfirst($full_trans_record['name']);?></td>

                                <?php echo (isset($_GET['for_whom']) && $_GET['for_whom'] == 2) ? '<td>'.$full_trans_record['employee']['name'].'</td>' : ''?>



                                <td><?php echo (isset($_GET['for_whom']) && $_GET['for_whom'] == 2) ? $full_trans_record->employee->email : $full_trans_record['email'];?>
                                </td>
                                <td><?php echo (isset($_GET['for_whom']) && $_GET['for_whom'] == 2) ? $full_trans_record->employee->mobile_no : $full_trans_record['mobile_no']; ?>
                                </td>

                                <td align='left'><?php echo $full_trans_record['employee_entity'];?></td>
                                <td align='left'><?php echo $full_trans_record['unified_no'];?></td>
                                <td align='left'><?php echo $full_trans_record['ps_number'];?></td>
                                <td align='left'><?php echo $full_trans_record['nationality'];?></td>
                                <td align='left'><?php echo $full_trans_record['gender'];?></td>


                                <td align='left'><?php echo $full_trans_record['passport_no']; ?></td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($full_trans_record['passport_exp_date']);?>
                                </td>
                                <td align='left'><?php echo $full_trans_record['visa_no'];?></td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($full_trans_record['visa_exp_date']);?>
                                </td>
                                <td align='left'><?php echo $full_trans_record['emiratesID_no'];?></td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($full_trans_record['emiratesID_exp_date']);?>
                                </td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($full_trans_record['health_card_exp_date']);?>
                                </td>

                                <td align='left'><?php echo $full_trans_record['others']; ?></td>

                                <td><?php echo $full_trans_record['status'] == 1 || is_null($full_trans_record['status'])  ? 'Active' : 'Canceled' ?>
                                </td>
                                <td><?php echo $this->DateC->DateFormetforView($full_trans_record['created']);?></td>

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
                            <p> <?php echo $this->Paginator->counter('Showing {{ start }} to {{ end }} of {{ count }}');?>
                            </p>
                        </div>
                        <div class="col-lg-7 col-sm-7 col-xs-12">
                            <ul class="pagination">
                                <?php echo $this->Paginator->prev('  ' . __('Previous'));?>
                                <?php echo $this->Paginator->numbers();?>
                                <?php echo $this->Paginator->next('  ' . __('Next'));?>
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

    function company_emp() {
        var company_id = $('#company-id').val();
        $.ajax({
            url: webroot + "/admin/companies/getEmployees",
            cache: false,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                'company_id': company_id
            },
            success: function (html) {
                //$('#employee-id').html('').trigger('change');
                var obj = $.parseJSON(html);
                option = '';
                option = '<option value="">Select Employee</option>'
                $.each(obj, function (key, value) {
                    option += '<option value="' + key + '" >' + value + '</option>'
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

    $('#company-id').change(function () {
        company_emp();
    });

    $('#employee-id').change(function () {
        emp_dep();
    });

    function emp_dep() {
        var dependent_id = $('#employee-id').val();
        $.ajax({
            url: webroot + "/admin/companies/getdependent",
            cache: false,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                'dependent_id': dependent_id
            },
            success: function (html) {
                var obj = $.parseJSON(html);
                option = '';
                $('#dependet-id').html('').trigger('change');
                $.each(obj, function (key, value) {
                    option += '<option  value="' + key + '" >' + value + '</option>';
                });
                $('#dependet-id').html(option);
                $.each(obj, function (key, value) {
                    $('#dependet-id').val(key).trigger('change');
                    return false;
                });
            }
        });
    }

    $('#for-whom').change(function () {
        if ($(this).val() == 2) {
            $('.dependet-textbox').removeClass('hide');
            $("#expired-type option[value='labor_card_expired']").remove();
            $("#expired-type option[value='work_permit_exp_date']").remove();

            emp_dep();
        } else {
            $('.dependet-textbox').addClass('hide');
            $("#expired-type option[value='labor_card_expired']").remove();
            $('#expired-type').append($("<option></option>").attr("value", "labor_card_expired").text(
                'Labor Card Expired'));
            $('#expired-type').append($("<option></option>").attr("value", "work_permit_exp_date").text(
                'Work Permit'));
        }
    });

    $('.date_picker_type').datepicker({
        'dateFormat': 'dd/mm/yy',
    });

    $('select').select2();
    $('.date_picker').datepicker({
        'dateFormat': 'dd/mm/yy'
    });
    $(document).on('click', '#create-xl-employe-exp', function (e) {
        e.preventDefault();
        //check if no search query
        var searchQuery = $('#report-form').serialize();
        if (!searchQuery)
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
        if (flag) {
            //set current location
            var target = webroot + '/admin/reports/employee_excel_report';

            //make seach query as query string
            target = target + '?' + searchQuery;
            window.open(target);
            return false;
        }

    });
    $(document).on('click', '#search-reports-exp', function (e) {
        e.preventDefault();

        //check if no search query
        var searchQuery = $('#report-form').serialize();
        if (!searchQuery)
            return false;

        //get current location & check empty
        var target = window.location.href;
        if (!target)
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
        if (flag) {

            //make seach query as query string
            target = target + '?' + searchQuery;
            $('#loader').css('display', 'block');
            $.get(target, function (data) {
                // alert(data);
                $('#loader').css('display', 'none');
                $('.rep_content').html(jQuery(data).find('.rep_content').html());
            }, 'html');
            return false;
        }

    });
</script>
<style>
    .for-search {
        padding: 0 20px 20px 20px;
        margin-bottom: 20px;
    }

    fieldset .col-md-3 {
        background-color: rgba(204, 204, 204, 0.16);
    }

    .form_block {
        margin: 0 0 11px 0;
    }
</style>
