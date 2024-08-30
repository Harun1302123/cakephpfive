<?php echo $this->element('admin/tabular/title', ['title' => 'Trasection Report', 'faClass' => "fa fa-building"]); ?>

<div class="card">
        <!--begin::Card body-->
    <div class="p-10">
        <form class="form-horizontal" id="report-form">
        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Category</label>
                <!--end::Label-->
                <!--begin::Input-->
                <!-- <input type="text" class="form-control mb-2" value=""> -->
                <?php
                    echo $this->Form->input(
                        'for_whom',
                        [
                            'id' => 'for-whom',
                            'type' => 'select',
                            'options' => [
                                '1' => 'Employees',
                                '2 '=> 'Dependent'
                            ],
                            'label' => false,
                            'div' => false ,
                            'empty' => 'Select Category',
                            'class'=>"form-control mb-2"
                        ]
                    );
                ?>

                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Company</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'company_id',
                        [
                            'type' => 'select',
                            'id' => 'company-id',
                            'options' => $companies,
                            'label' => false,
                            'div' => false,
                            'empty' => 'Select Company',
                            'class'=>"form-control mb-2"
                        ]
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Employee</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'employee_id',
                            array(
                            'type' => 'select',
                            'id' => 'employee-id',
                            'options'=>[],
                            'required' => 'required',
                            'class' => 'form-control mb-2 input_field',
                            'label' => false
                        )
                    );
                ?>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <div class="hide dependet-textbox">
                    <!--begin::Label-->
                    <label class="required form-label">Dependent</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <!-- <input type="text" class="form-control mb-2" value=""> -->
                    <?php
                        echo $this->Form->input(
                            'dependet_id',
                            [
                                'id' => 'dependet-id',
                                'type' => 'select',
                                'options' => [
                                ],
                                'label' => false,
                                'div' => false ,
                                'empty' => 'Select Dependent',
                                'class'=>"form-control mb-2"
                            ]
                        );
                    ?>
                </div>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Transaction</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'transaction_id',
                        [
                            'type' => 'select',
                            'id' => 'type',
                            'options' => $transactions_type_ids,
                            'label' => false,
                            'div' => false,
                            'empty' => 'Select Transaction',
                            'class'=>"form-control mb-2"
                        ]
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Transaction Type</label>
                <!--end::Label-->
                <!--begin::Input-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'transaction_type_id',
                        [
                            'type' => 'select',
                            'id' => 'transaction-type-id',
                            'options' => $transactions,
                            'label' => false,
                            'div' => false,
                            'empty' => 'Select Transaction Type',
                            'class'=>"form-control mb-2"
                        ]
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
                <label class="required form-label">Start Date</label>
                <?php
                    echo $this->Form->input(
                        'starting_date',
                        [
                            'label' => false,
                            'div' => false,
                            'class'=>"form-control mb-2 date_picker"
                        ]
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Completion Date</label>
                <?php
                    echo $this->Form->input(
                        'completion_date',
                        [
                            'label' => false,
                            'div' => false,
                            'class'=>"form-control mb-2 date_picker"
                        ]
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
        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5 pt-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <button type="submit" id="search-reports" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                    <!--begin::Indicator label-->
                    <span class="indicator-label">Search</span>
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
        </form>

    </div>

    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <!--begin::Add user-->
                <button class="btn btn-primary" id="create-xl-employe">
                    <span class="fas fa-file-export"></span>
                    Export Excel
                </button>
            </div>
            <!--end::Toolbar-->

        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <div id="table_companies_container" class="dataTables_wrapper dt-bootstrap4 no-footer rep_content">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-5 gs-5" id="kt_table_companies">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="User: activate to sort column ascending"
                                style="width: 277.586px;">
                                <?php echo $this->Paginator->sort('company_id', 'COMPANY'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Role: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('name', 'NAME'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Last login: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('transaction_id', 'TRANSACTION'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('transaction_type_id', 'TYPE'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('starting_date', 'STARTED DATE'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('status', 'STATUS'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('completion_date', 'COMPLETED DATE'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('note', 'NOTE'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                User
                            </th>

                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        <?php
                            $number = 0;
                            $class = null;
                            if (!$full_trans_records->isEmpty()) {
                                foreach ($full_trans_records as $full_trans_record) {
                                    if ($number % 2 === 0) {
                                        $class = "even";
                                    } else {
                                        $class = "odd";
                                    }

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
                        ?>
                        <!--end::Table row-->
                        <tr>
                            <!--begin::User=-->
                            <td><?php echo $full_trans_record->_matchingData['Companies']->name;?></td>
                            <td><?php echo $full_trans_record->_matchingData['CompanyTransactions']->name;?></td>
                            <td>
                                <?php echo $transactions_type_ids[$full_trans_record->_matchingData['CompanyTransactions']->transaction_type_id];?>
                            </td>
                            <td>
                                <?php echo isset($optionsV[$full_trans_record->transaction_type_id]) ? $optionsV[$full_trans_record->transaction_type_id] : null;?></td>
                            <td>
                                <?php echo $this->DateC->DateFormetforViewReport($full_trans_record->starting_date);?>
                            </td>
                            <td>
                                <?php echo $transaction_status[$full_trans_record->status];?>
                            </td>
                            <td>
                                <?php echo $full_trans_record->status == 3 ? $this->DateC->DateFormetforViewReport($full_trans_record->completion_date) : 'NULL'; ?>
                            </td>
                            <td><?php echo $full_trans_record->note;?></td>
                            <td><?php echo $full_trans_record->user ? $full_trans_record->user->Username : null; ?></td>
                            <!--begin::Joined-->

                            <!--begin::Action=-->

                        </tr>

                    <?php }
                    } else {?>
                        <tr>
                            <td colspan="6" class="no_record">No Record Found</td>
                        </tr>
                    <?php }?>
            </tbody>
            <!--end::Table body-->
            </table>
        </div>
        <div class="row">
        <?php
            echo $this->element('admin/tabular/pagination')
        ?>
        </div>
    </div>
    <!--end::Table-->
</div>
<!--end::Card body-->
</div>
<?php echo $this->Html->script('admin/search_report', ['block'=>'scriptBottom']); ?>
<script>
$(document).ready(
    function () {
    var dateFormat = "d/m/y";

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
                option = null;
                // $('#dependet-id').html('<option  value="" >Select Dependent</option>').trigger('change');
                $.each(obj, function (key, value) {
                    option += '<option  value="' + key + '" >' + value + '</option>';
                });

                if (!option) {
                    option = '<option  value="" >Select Dependent</option>';
                }

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

    $('select').select2();

    flatpickr(".date_picker", {
        dateFormat: dateFormat,
    });


    $("#type").change(function () {
        <?php $i = 0; ?>
        var type = $(this).val();
        var for_whom = $('#for-whom').val();
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
    }
);

</script>
