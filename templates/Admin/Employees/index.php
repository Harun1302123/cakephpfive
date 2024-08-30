<?php

use Cake\Routing\Router;

 echo $this->element('admin/tabular/title', ['title' => 'Manage Employees', 'faClass' => "fa fa-building"]); ?>

<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <form class="form-horizontal" id="report-form">
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">


                            <!--end::Svg Icon-->
                    <?php echo $this->Form->input(
                        'company_id',
                            [
                                'type' => 'select',
                                'options' => $companies,
                                'label' => false,
                                'div' => false ,
                                'empty'=>'Select Company',
                                'class'=>"form-control form-control-solid w-250px ps-14"
                            ]
                        );
                    ?>
                </div>

                <div class="d-flex align-items-center position-relative my-1">
                    <input
                        type="text"
                        class="form-control form-control-solid w-250px ps-14"
                        name="email_or_name"
                        id="searchQuery"
                        placeholder="Email or Name"
                    />
                </div>
                <!--end::Search-->
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <button type="submit" class="btn btn-sm btn-primary" id="search-reports">
                    <span class="indicator-label">
                        Search
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <!--end::Primary button-->
            </form>
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                <!--begin::Add user-->
                <a href="<?php  echo $this->request->getAttribute('webroot');  ?>admin/employees/add" class="btn btn-primary">
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                        </svg>
                    </span>
                    Add Record
                </a>
            </div>
            <!--end::Toolbar-->

            <!--begin::Modal - Adjust Balance-->
            <div class="modal fade" id="upload-model" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Upload Attachment</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close>
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->

                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                            transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                            transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form
                                id="attac_upload"
                                class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                method="post"
                                action="<?php echo $this->request->getAttribute('webroot'); ?>admin/employees/upload_attachment"
                                autocomplete="off"
                                enctype="multipart/form-data"
                            >
                                <input type="hidden" class="employee-id" name="employee-id" value="">
                                <input type="hidden"  name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">Title:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="attachment-title" id="attachment-title" placeholder="Enter Attachment Title" required>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-semibold form-label mb-2">File</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" class="form-control mb-2" id="attachment-file" name="attachment-file" accept="image/x-png,image/gif,image/jpeg,.pdf" required>
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-users-modal-action="cancel" data-bs-dismiss="modal">Discard</button>
                                    <button type="submit" class="btn btn-primary" id="modal-submit" data-kt-users-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Card-->

        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <div id="table_companies_container" class="dataTables_wrapper dt-bootstrap4 no-footer rep_content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed flip-content" id="kt_table_employees">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="User: activate to sort column ascending"
                                style="width: 277.586px;">
                                <?php echo $this->Paginator->sort('name', 'Name'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Role: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('Companies.id', 'Company'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Last login: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('passport_no', 'Passport No'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('passport_exp_date', 'Passport Expire Date'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('visa_no', 'Visa No'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('visa_exp_date', 'Visa Expire Date'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('emiratesID_no', 'Emirates ID No'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('emiratesID_exp_date', 'Emirates ID Expiry Date'); ?>
                            </th>
                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                aria-label="Actions" style="text-align: center !important;width: 130.547px; color: #181c32" >
                                Actions
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
                            if (!$employees->isEmpty()) {
                                foreach ($employees as $employee) {
                                    if ($number % 2 === 0) {
                                        $class = "even";
                                    } else {
                                        $class = "odd";
                                    }
                        ?>
                        <!--end::Table row-->
                        <tr>
                            <td><?php echo $employee->name;?></td>
							<td><?php echo $employee->company->name;?></td>
							<td><?php echo $employee->passport_no;?></td>
							<td><?php echo $this->DateC->DateFormetforView($employee->passport_exp_date); ?></td>

							<!--<td><?php //echo $employee->work_permit_no;?></td>
							<td><?php //echo date('j F,Y',strtotime($employee->work_permit_exp_date));?></td>-->

							<td><?php echo $employee->visa_no;?></td>
							<td><?php //echo $employee->visa_exp_date->format('j F,Y');
							echo $this->DateC->DateFormetforView($employee->visa_exp_date); ?></td>

							<td><?php echo $employee->emiratesID_no;?></td>
							<td><?php echo $this->DateC->DateFormetforView($employee->emiratesID_exp_date );?></td>
                            <!--begin::Action=-->
                            <td class="text-end" style="width:10%">
                                    <?php
                                    	$dependent = '<a href="'.Router::fullBaseUrl().'/admin/dependents/add/'.base64_encode($employee->id).'/emp">
                                        <i class="fa fa-users" title="Add dependent"></i></a>';

                                        echo $dependent.' ';

                                        echo $this->element(
                                                'admin/tabular/actions',
                                                [
                                                    'editLink' => 'admin/employees/edit/',
                                                    'deleteLink' => '/admin/employees/delete/',
                                                    'id' => $employee->id,
                                                    'isAttachement' => true,
                                                ]
                                            )
                                    ?>
                            </td>
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
<?php echo $this->Html->script('admin/employee_attachment', ['block'=>'scriptBottom']); ?>
