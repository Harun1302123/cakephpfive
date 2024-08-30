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
        <h2 class="global_title"><i class="fa fa-building-o"></i>Trasection Report</h2>
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
                                <label for="for_whom">Category:</label>
                                <?php echo $this->Form->input('for_whom',['id' => 'for-whom', 'type' => 'select', 'options'=>['1'=>'Employees','2'=>'Dependent'],'label'=>false,'div'=>false ,'empty'=>'Select Category','class'=>"form-control"]); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form_block">
                                <label for="company_id">Company:</label>
                                <?php echo $this->Form->input('company_id',['type' => 'select', 'id' => 'company-id', 'options'=>$companies,'label'=>false,'div'=>false ,'empty'=>'Select Company','class'=>"form-control"]); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form_block">
                                <label class="nitin">Select Employee<span class="clor"> * </span> :</label>
                                <?php
							  echo $this->Form->input('employee_id',array('type' => 'select', 'id' => 'employee-id', 'options'=>[],'required' => 'required', 'class' => 'input_field','label' => false ));  ?>
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


                        <div class="col-md-3">
                            <div class="form_block">
                                <label for="company_id">Transaction:</label>
                                <?php echo $this->Form->input('transaction_id',['type' => 'select', 'options'=>$transactions_type_ids,'label'=>false,'div'=>false ,'empty'=>'Select Transaction','class'=>"form-control" ,'id'=>'type']); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form_block">
                                <label for="company_id">Transaction Type:</label>
                                <?php echo $this->Form->input('transaction_type_id',['id' => 'transaction-type-id', 'type' => 'select', 'options' => $transactions,'label'=>false,'div'=>false ,'empty'=>'Select Transaction Type','class'=>"form-control" ]); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form_block">
                                <label for="company_id">Start Date:</label>
                                <?php echo $this->Form->input('starting_date',['label'=>false,'div'=>false ,'class'=>"form-control date_picker"]); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form_block">
                                <label for="company_id">Complition Date:</label>
                                <?php echo $this->Form->input('completion_date',['label'=>false,'div'=>false, 'class'=>"form-control date_picker"]); ?>
                            </div>
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
                <div class="text-center overlape" id="loader" style="display:none"> <img src="/img/loading.gif"
                        width="60px" height="60px"> </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th align='left'><?php echo $this->Paginator->sort('company_id', 'COMPANY');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('name', 'NAME');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('transaction_id', 'TRANSACTION');?>
                                </th>
                                <th align='left'><?php echo $this->Paginator->sort('transaction_type_id', 'TYPE');?>
                                </th>
                                <th align='left'><?php echo $this->Paginator->sort('starting_date', 'STARTED DATE');?>
                                </th>
                                <th align='left'><?php echo $this->Paginator->sort('status', 'STATUS');?></th>
                                <th align='left'>
                                    <?php echo $this->Paginator->sort('completion_date', 'COMPLETED DATE');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('note', 'NOTE');?></th>
                                <th align='left'>USER</th>
                                <!-- <th align='left'>Action</th> -->
                            </tr>
                            <?php //echo '<pre>'; print_r($full_trans_records); exit;
			  		if(!$full_trans_records->isEmpty()){
						foreach($full_trans_records as $full_trans_record){
						//echo '<pre>'; print_r($full_trans_record); exit;
						//if($full_trans_record->starting_date == ''){continue;}
						if($full_trans_record->_matchingData['CompanyTransactions']->for_whom == 1){
							if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 1) {
								$optionsV =array(0 =>'Quota', 1 =>'Job Offer', 2 =>'Work permit', 3 =>'Pre Aprovel',  4 =>'Bank guarantee', 5 =>'E Visa', 6=>'Change status', 7 =>'Medical fitness',  8 =>'Emirates ID', 9 =>'Typing labour card' , 10 =>'Submit labour card',  11 =>'Visa stamp', 12=>'Send to Employee');
							} else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 2) {
								$optionsV =array(0 =>'Medical fitness',  1 =>'Emirates ID', 2=>'Visa stamp');
							} else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 3) {
								$optionsV =array(0 =>'Offer Letter',  1 =>'Send to Employee', 2=>'Submisstion');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 4){
								$optionsV =array(0 =>'Type Application', 1 =>'Send Signature',  2 =>'Submit in MOL');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 5){
								$optionsV =array(0 =>'Type Application', 1 =>'Approved by EDNRD');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 6){
								$optionsV =array(0 =>'Send to Employee', 1 =>'Submit to MOL');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 7){
								$optionsV =array(0 =>'Type Application', 1 =>'Send VISA in EDNRD');
							}
						}else{
							if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 1) {
								$optionsV =array(0 =>'Entry Permint', 1 =>'Change status', 2 =>'Medical', 3 =>'Emirates ID',  4 =>'Visa stamp');
							} else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 2) {
								$optionsV =array(0 =>'Medical', 1 =>'Emirates ID',  2 =>'Visa stamp');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 3) {
								$optionsV =array(0 =>'Type Application', 1 =>'Approved by EDNRD');
							}else if ($full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id == 4) {
								$optionsV =array(0 =>'Type Application' , 1 =>'Submit VISA in EDNRD');
							}
						}
						//echo '<pre>'; print_r($transaction_status); exit;
			  ?>
                            <tr>
                                <td><?php echo $full_trans_record->_matchingData['Companies']->name;?></td>
                                <td><?php echo $full_trans_record->_matchingData['CompanyTransactions']->name;?></td>
                                <td><?php echo $transactions_type_ids[$full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id];?>
                                </td>
                                <td><?php echo isset($optionsV[$full_trans_record->transaction_type_id]) ? $optionsV[$full_trans_record->transaction_type_id] : null;?></td>
                                <td><?php echo $this->DateC->DateFormetforViewReport($full_trans_record->starting_date);?>
                                </td>
                                <td><?php echo $transaction_status[$full_trans_record->status];?></td>
                                <td><?php echo $full_trans_record->status == 3 ? $this->DateC->DateFormetforViewReport($full_trans_record->completion_date) : 'NULL'; ?>
                                </td>
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
<?php echo $this->Html->script('admin/search_report',['block'=>'scriptBottom']); ?>
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
            $('select[name="transaction_type_id"]').select2('destroy');
            //$('select[name="transaction_type_id"]').
            $('select[name="transaction_type_id"]').html(
                "<option value='1'>Family New Visa</option><option value='2'>Family Visa renewal</option><option value='3'>Cancellation</option>"
                );
            emp_dep();
        } else {
            $('select[name="transaction_type_id"]').html(
                "<option value='1'>New Visa</option><option value='2'>Visa renewal</option><option value='3'>Labour card renewal</option><option value='4'>Labour cancellation</option><option value='5'>Immigration cancellation</option>"
                );
            $('.dependet-textbox').addClass('hide');
        }
    });

    $('.date_picker_type').datepicker({
        'dateFormat': 'dd/mm/yy',
    });

    $('select').select2();
    $('.date_picker').datepicker({
        'dateFormat': 'dd/mm/yy',
    });

    $("#type").change(function () {
        <?php $i = 0; ?>
        var type = $(this).val();
        var for_whom = $('#for-whom').val();
        webroot = '<?php echo BASE_URL; ?>';
        $.ajax({
            url: webroot + "/admin/companies/getOptions",
            cache: false,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                'type': type,
                'for_whom': for_whom
            },
            success: function (htmlD) {
                var obj = $.parseJSON(htmlD);
                option = '';
                $.each(obj, function (key, value) {
                    option += '<option value="' + key + '" >' + value + '</option>'
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
