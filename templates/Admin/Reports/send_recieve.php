<?php echo $this->element('admin/tabular/title', ['title' => 'Send and Recieve Report', 'faClass' => "fa fa-building"]); ?>

<div class="card">
        <!--begin::Card body-->
    <div class="p-10">
        <form class="form-horizontal" id="report-form">

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
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
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                 <!--begin::Label-->
                 <label class="required form-label">End Date</label>
                <?php
                    echo $this->Form->input(
                        'end_date_ex_type',
                        [
                            'label' => false,
                            'div' => false,
                            'class'=>"form-control mb-2 date_picker date_picker_type"
                        ]
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
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                COMPANY
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                EMPLOYEE NAME
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                DOCUMENTS
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                DATE OF RECEIVE
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                DATE OF SENT
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
                            if (!$documents->isEmpty()) {
                                foreach ($documents as $documents_dataRow) {
                                    if ($number % 2 === 0) {
                                        $class = "even";
                                    } else {
                                        $class = "odd";
                                    }
                                    if(
                                        (isset($documents_dataRow->dependent) && $documents_dataRow->dependent)
                                        ||  (isset($documents_dataRow->employee) && $documents_dataRow->employee->id)
                                    ) {

                                    if(isset($_GET['start_date_ex_type'])){
                                        $start_date = explode('/',$_GET['start_date_ex_type']);
                                        if (isset($start_date[2]) && isset($start_date[1]) && isset($start_date[0])) {
                                            $_GET['start_date_ex_type'] = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];
                                        }
                                    }
                                    if(isset($_GET['end_date_ex_type'])){
                                        $end_date_ex_type = explode('/',$_GET['end_date_ex_type']);
                                        if (isset($end_date_ex_type[2]) && isset($end_date_ex_type[1]) && isset($end_date_ex_type[0])) {
                                            $_GET['end_date_ex_type'] =$end_date_ex_type[2].'-'.$end_date_ex_type[1].'-'.$end_date_ex_type[0];
                                        }
                                    }
                                    $flag = true;
                                    if(isset($_GET['start_date_ex_type']) && isset($_GET['end_date_ex_type'])){
                                        $flag = false;
                                        if($documents_dataRow->passport_receive_admin_date >= $_GET['start_date_ex_type'] && $documents_dataRow->passport_receive_admin_date >= $_GET['end_date_ex_type']){
                                            $flag = true;
                                        }
                                    }
                                    //echo '<pre>'; print_r($documents_dataRow); exit;
                                    if($documents_dataRow->passport_receive_admin == 1 && $flag){
                        ?>
                        <!--end::Table row-->
                        <tr>
                                <td align='left'>
                                    <?php
                                    if (isset($documents_dataRow->employee->company)) {
                                        echo $documents_dataRow->employee->company->name;
                                    } elseif(isset($documents_dataRow->dependent->employee->company)) {
                                        echo $documents_dataRow->dependent->employee->company->name;
                                    }
                                ?>
                                </td>

                                <td align='left'>
                                    <?php

                                    if (isset($documents_dataRow->employee->name)) {
                                        echo $documents_dataRow->employee->name;
                                    } elseif ($documents_dataRow->dependent->employee) {
                                        echo $documents_dataRow->dependent->employee->name .' (<b>'. $documents_dataRow->dependent->name .'</b>)';
                                    }
                                ?>
                                </td>
                                <td align='left'>Passport</td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->passport_receive_admin_date) ?>
                                </td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->passport_send_admin_date) ?>
                                </td>
                            </tr>
                            <?php }?>

                            <?php

				$flag = true;
				if(isset($_GET['start_date_ex_type']) && isset($_GET['end_date_ex_type'])){
					$flag = false;
					if($documents_dataRow->bc_receive_admin >= $_GET['start_date_ex_type'] && $documents_dataRow->bc_receive_admin >= $_GET['end_date_ex_type']){
						$flag = true;
					}
				}

				 if($documents_dataRow->bc_receive_admin == 1 && $flag){?>
                            <tr>
                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?>
                                </td>

                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .' (<b>'. $documents_dataRow->dependent->name .'</b>)'; ?>
                                </td>
                                <td align='left'>Birthday Certificate:</td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->bc_receive_admin_date) ?>
                                </td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->bc_send_admin_date) ?>
                                </td>
                            </tr>
                            <?php }?>

                            <?php
				$flag = true;
				if(isset($_GET['start_date_ex_type']) && isset($_GET['end_date_ex_type'])){
					$flag = false;
					if($documents_dataRow->mc_receive_admin >= $_GET['start_date_ex_type'] && $documents_dataRow->mc_receive_admin >= $_GET['end_date_ex_type']){
						$flag = true;
					}
				}
				 if($documents_dataRow->mc_receive_admin == 1 && $flag){?>
                            <tr>
                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?>
                                </td>

                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .' (<b>'. $documents_dataRow->dependent->name .'</b>)'; ?>
                                </td>
                                <td align='left'>Marriage Certificate</td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->mc_receive_admin_date) ?>
                                </td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->mc_send_admin_date) ?>
                                </td>
                            </tr>
                            <?php }?>

                            <?php

				$flag = true;
				if(isset($_GET['start_date_ex_type']) && isset($_GET['end_date_ex_type'])){
					$flag = false;
					if($documents_dataRow->eid_receive_admin >= $_GET['start_date_ex_type'] && $documents_dataRow->eid_receive_admin >= $_GET['end_date_ex_type']){
						$flag = true;
					}
				}

				  if($documents_dataRow->eid_receive_admin == 1 && $flag){?>
                            <tr>
                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?>
                                </td>

                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .' (<b>'. $documents_dataRow->dependent->name .'</b>)'; ?>
                                </td>
                                <td align='left'>Emirates ID</td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->eid_receive_admin_date) ?>
                                </td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->eid_send_admin_date) ?>
                                </td>
                            </tr>
                            <?php }?>


                            <?php

				$flag = true;
				if(isset($_GET['start_date_ex_type']) && isset($_GET['end_date_ex_type'])){
					$flag = false;
					if($documents_dataRow->dc_receive_admin >= $_GET['start_date_ex_type'] && $documents_dataRow->dc_receive_admin >= $_GET['end_date_ex_type']){
						$flag = true;
					}
				}

				if($documents_dataRow->dc_receive_admin == 1 && $flag){?>
                            <tr>
                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?>
                                </td>

                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .' (<b>'. $documents_dataRow->dependent->name .'</b>)'; ?>
                                </td>
                                <td align='left'>Degree Certificate</td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->dc_receive_admin_date) ?>
                                </td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->dc_send_admin_date) ?>
                                </td>
                            </tr>
                            <?php }?>


                            <?php
				$flag = true;
				if(isset($_GET['start_date_ex_type']) && isset($_GET['end_date_ex_type'])){
					$flag = false;
					if($documents_dataRow->medical_receive_admin >= $_GET['start_date_ex_type'] && $documents_dataRow->medical_receive_admin >= $_GET['end_date_ex_type']){
						$flag = true;
					}
				}

				 if($documents_dataRow->medical_receive_admin == 1 && $flag){?>
                            <tr>
                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?>
                                </td>

                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .' (<b>'. $documents_dataRow->dependent->name .'</b>)'; ?>
                                </td>
                                <td align='left'>Medical</td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->medical_receive_admin_date) ?>
                                </td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->medical_send_admin_date) ?>
                                </td>
                            </tr>
                            <?php }?>


                            <?php
				 $flag = true;
				if(isset($_GET['start_date_ex_type']) && isset($_GET['end_date_ex_type'])){
					$flag = false;
					if($documents_dataRow->other_receive_admin >= $_GET['start_date_ex_type'] && $documents_dataRow->other_receive_admin >= $_GET['end_date_ex_type']){
						$flag = true;
					}
				}

				   if($documents_dataRow->other_receive_admin == 1 && $flag){?>
                            <tr>
                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->company->name : $documents_dataRow->dependent->employee->company->name ?>
                                </td>

                                <td align='left'>
                                    <?php echo isset($documents_dataRow->employee->id) ? $documents_dataRow->employee->name : $documents_dataRow->dependent->employee->name .' (<b>'. $documents_dataRow->dependent->name .'</b>)'; ?>
                                </td>
                                <td align='left'>Other</td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->other_receive_admin_date) ?>
                                </td>
                                <td align='left'>
                                    <?php echo $this->DateC->DateFormetforView($documents_dataRow->other_send_admin_date) ?>
                                </td>
                            </tr>
                            <?php }?>

                            <?php  }
			     }
			  }else{ ?>
                            <tr>
                                <td colspan="9" class="no_record">No Record Found</td>
                            </tr>
                            <?php } ?>
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
    var dateFormat = "d/m/y";

    function company_emp() {
        var company_id = $('#company-id').val();
        $.ajax({
            url: webroot + "/admin/companies/getEmployees",
            cache: false,
            type: 'POST',
            data: {
                'company_id': company_id
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken,
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
            data: {
                'dependent_id': dependent_id
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken,
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
            const o = document.getElementById("search-reports-exp");
            o.setAttribute("data-kt-indicator", "on")
            //make seach query as query string
            target = target + '?' + searchQuery;
            // $('#loader').css('display', 'block');
            $.get(target, function (data) {
                // alert(data);
                // $('#loader').css('display', 'none');
                o.removeAttribute("data-kt-indicator")

                $('.rep_content').html(jQuery(data).find('.rep_content').html());
            }, 'html');
            return false;
        }

    });

    $(document).on('click', '#create-xl-employe-exp', function (e) {
        e.preventDefault();
        //check if no search query
        var searchQuery = $('#report-form').serialize();
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

        if (flag) {
            //set current location
            var target = webroot + '/admin/reports/send_recieve_report';

            //make seach query as query string
            target = target + '?' + searchQuery;
            window.open(target);
            return false;
        }

    });
});
</script>

