<?php echo $this->element('admin/tabular/title', ['title' => 'Employee Report', 'faClass' => "fa fa-building"]); ?>

<div class="card">
        <!--begin::Card body-->
    <div class="p-10">
        <form class="form-horizontal" id="report-form">
        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
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
                <label class="required form-label">Expired Type</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'expired_type',
                        array(
                            'type' => 'select',
                            'options'=>[
                                '' => 'Select Type',
                                'passport_expired' => 'Passport Expired',
                                'visa_expired' => 'Visa Expired' ,
                                'emirates_id_expired' => 'Emirates ID Expired',
                                'labor_card_expired' => 'Labor Card Expired' ,
                                'health_card_exp_date' => 'Insurance'
                            ],
                            'class' => 'form-control mb-2 input_field','label' => false
                        )
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <label class="required form-label">Start Date</label>
                <?php
                    echo $this->Form->input(
                        'start_date_ex_type',
                        [
                            'label' => false,
                            'div' => false,
                            'class'=>"form-control mb-2 date_picker date_picker_type"
                        ]
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
                <!--begin::Label-->
                <label class="required form-label">End Date</label>
                <?php
                    echo $this->Form->text(
                        'end_date_ex_type',
                        [
                            'label' => false,
                            'div' => false,
                            'empty' => 'Select Transaction Type',
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
                <label class="required form-label">Email or Name</label>
                <?php
                    echo $this->Form->input(
                        'email_or_name',
                        [
                            'label' => false,
                            'div' => false,
                            'id' => "searchQuery",
                            "class" => 'form-control mb-2'
                        ]
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Status</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'status',
                        array(
                            'type' => 'select',
                            'options' => [''=>'Select Status','0'=>'Canceled' , 1 => 'Active'],
                            'class' => 'form-control mb-2 input_field',
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
        <div class="d-flex flex-wrap gap-5 pt-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <button type="submit" id="search-reports-exp" class="btn btn-primary">
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
                <button class="btn btn-primary" id="create-xl-employe-exp">
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
                                <?php echo $this->Paginator->sort('email', 'EMAIL'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('mobile_no', 'MOBILE NO'); ?>
                            </th>

                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('employee_entity', 'Employee Entity'); ?>
                            </th>

                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('unified_no', 'Unified No'); ?>
                            </th>

                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('ps_number', 'PS Number'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('Nationality', 'nationality'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('gender', 'Gender'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                PASSPORT NO
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                PASSPORT EXPIRE DATE
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                VISA NO
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                VISA EXPIRE DATE
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                EMIRATES ID NO
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                EMIRATES ID EXPIRE DATE
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                HEALTH CARD EXPIRE DATE
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                Other
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('status', 'STATUS'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('created', 'CREATED'); ?>
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

                        ?>
                        <!--end::Table row-->
                        <tr>
                                <td><?php echo (isset($_GET['for_whom']) && $_GET['for_whom'] == 2) ? $full_trans_record['employee']['company']['name'] : $full_trans_record['company']['name'];?>
                                </td>
                                <td><?php echo ucfirst($full_trans_record['name']);?></td>

                                <?php echo (isset($_GET['for_whom']) && $_GET['for_whom'] == 2) ? '<td>'.$full_trans_record['employee']['name'].'</td>' : ''?>

                                <td>
                                    <?php echo (isset($_GET['for_whom']) && $_GET['for_whom'] == 2) ? $full_trans_record->employee->email : $full_trans_record['email'];?>
                                </td>
                                <td>
                                    <?php echo (isset($_GET['for_whom']) && $_GET['for_whom'] == 2) ? $full_trans_record->employee->mobile_no : $full_trans_record['mobile_no']; ?>
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

                                <td>
                                    <?php echo $full_trans_record['status'] == 1 || is_null($full_trans_record['status'])  ? 'Active' : 'Canceled' ?>
                                </td>
                                <td><?php echo $this->DateC->DateFormetforView($full_trans_record['created']);?></td>
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

<script>
$(document).ready(function () {
    console.log('tst')
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

                $('#dependet-id').html('').trigger('change');

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
    $('select').select2();

    flatpickr(".date_picker", {
        dateFormat: dateFormat,
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
            // $('#loader').css('display', 'block');
            const o = document.getElementById("search-reports-exp");
            o.setAttribute("data-kt-indicator", "on")
            $.get(target, function (data) {
                // alert(data);
                // $('#loader').css('display', 'none');
                o.removeAttribute("data-kt-indicator")
                $('.rep_content').html(jQuery(data).find('.rep_content').html());
            }, 'html');
            return false;
        }

    });

});
</script>

