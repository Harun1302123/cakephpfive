<?php echo $this->element('admin/tabular/title', ['title' => 'Reminders Report', 'faClass' => "fa fa-building"]); ?>

<div class="card">
        <!--begin::Card body-->
    <div class="p-10">
        <form class="form-horizontal" id="report-form">

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                 <!--begin::Label-->
                <label class="required form-label">Expired Type</label>
                <?php
                    echo $this->Form->input(
                        'expired_type',
                        array(
                            'type' => 'select', 
                            'options' => $AlertTypesTable,
                            'class' => 'form-control mb-2 input_field',
                            'label' => false 
                        )
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
                                TYPE OF REMINDERS
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
                            if (!$SendAlert_data->isEmpty()) {
                                foreach ($SendAlert_data as $SendAlert_dataRow) {
                                    if ($number % 2 === 0) {
                                        $class = "even";
                                    } else {
                                        $class = "odd";
                                    }
                        ?>
                        <!--end::Table row-->
                        <tr>
                            <td>
                                <?php
                                    if ($SendAlert_dataRow->for_whom == 2) {
                                        if (!empty($SendAlert_dataRow->dependent->employee->company)) {
                                            echo $SendAlert_dataRow->dependent->employee->company->name;
                                        } elseif (!empty($SendAlert_dataRow->employee->company)) {
                                            echo $SendAlert_dataRow->employee->company->name;
                                        } else {
                                            echo null;
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if ($SendAlert_dataRow->for_whom == 2 ) {
                                        if (!empty($SendAlert_dataRow->dependent->employee)) {
                                            echo $SendAlert_dataRow->dependent->employee->name.'('.$SendAlert_dataRow->dependent->name.')';
                                        } elseif (!empty($SendAlert_dataRow->employee)) {
                                            echo $SendAlert_dataRow->employee->name;
                                        }
                                    }
                                ?>
                                </td>
                            <td align='left'><?php echo $SendAlert_dataRow->alert_type->name; ?></td>
                            <td align='left'><?php echo $this->DateC->DateFormetforView($SendAlert_dataRow->created); ?></td>

                                </tr>
                        <?php }		}else{ ?>
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
			url: webroot+"/admin/companies/getEmployees",
			cache: false,
			type:'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
			data: {'company_id':company_id},
			success: function(html){
				//$('#employee-id').html('').trigger('change');
				var obj = $.parseJSON(html);
				option = '';
				option  = '<option value="">Select Employee</option>'
				$.each( obj, function( key, value ) {
					option += '<option value="'+key+'" >'+value+'</option>'
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
			cache: false,
			type:'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
			data: {'dependent_id':dependent_id},
			success: function(html){
				var obj = $.parseJSON(html);
				option = '';
				
                $('#dependet-id').html('').trigger('change');
				
                $.each( obj, function( key, value ) {
					option += '<option  value="'+key+'" >'+value+'</option>';
				});
				
                $('#dependet-id').html(option);

				$.each( obj, function( key, value ) {
					$('#dependet-id').val(key).trigger('change');
					return false;
				});
			}
		});
	}

	$('#for-whom').change(function(){
		if($(this).val() == 2){
			$('.dependet-textbox').removeClass('hide');
			$("#expired-type option[value='labor_card_expired']").remove();
			$("#expired-type option[value='work_permit_exp_date']").remove();

			emp_dep();
		}else{
			$('.dependet-textbox').addClass('hide');
			$("#expired-type option[value='labor_card_expired']").remove();
			$('#expired-type').append($("<option></option>").attr("value","labor_card_expired").text('Labor Card Expired'));
			$('#expired-type').append($("<option></option>").attr("value","work_permit_exp_date").text('Work Permit'));
		}
	});

    flatpickr(".date_picker", {
        dateFormat: dateFormat,
    });

	$('select').select2();

	$(document).on('click', '#search-reports-exp', function(e) {
        e.preventDefault();

        //check if no search query
        var searchQuery = $('#report-form').serialize();
        if(!searchQuery)
        return false;

        //get current location & check empty
        var target = window.location.href;
        if(!target)
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
        if(flag){
            //make seach query as query string
            target = target+'?'+searchQuery;
            // $('#loader').css('display','block');
            const o = document.getElementById("search-reports-exp");
            o.setAttribute("data-kt-indicator", "on")
            $.get(target, function(data) {
            // alert(data);
            // $('#loader').css('display','none');
            o.removeAttribute("data-kt-indicator")

                $('.rep_content').html(jQuery(data).find('.rep_content').html());
            },'html');
            return false;
        }

    });

	$(document).on('click', '#create-xl-employe-exp', function(e) {
        e.preventDefault();
        //check if no search query
        var searchQuery = $('#report-form').serialize();
        if(!searchQuery)
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
        if(flag){
            //set current location
            var target = webroot+'/admin/reports/reminders_report';

            //make seach query as query string
            target = target+'?'+searchQuery;
            window.open(target);
            return false;
        }

    });
});
</script>

