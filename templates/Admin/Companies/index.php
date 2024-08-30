<?php echo $this->element('admin/tabular/title', ['title' => 'Manage Companies', 'faClass' => "fa fa-building"]); ?>

<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <form class="form-horizontal">
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>

                    <!--end::Svg Icon-->
                    <input type="text"
                        class="form-control form-control-solid w-250px ps-14" id="searchQuery" placeholder="Search company">
                </div>
                <!--end::Search-->
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <button type="submit" class="btn btn-sm btn-primary" id="search-query">
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
                <a href="<?php  echo $this->request->getAttribute('webroot');  ?>admin/companies/add" class="btn btn-primary">
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
                                action="<?php echo $this->request->getAttribute('webroot'); ?>admin/companies/upload_attachment"
                                autocomplete="off"
                                enctype="multipart/form-data"
                            >
                                <input type="hidden" class="company-id" name="company-id" value="">
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
                <table class="table table-rounded table-striped border gy-5 gs-5" id="kt_table_companies">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="User: activate to sort column ascending"
                                style="width: 277.586px;">
                                <?php echo $this->Paginator->sort('cmpny_name', 'Company Name'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Role: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('trade_lic_number', 'Trade License Number'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Last login: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('lic_expiry_date', 'Trade License Expiry Date'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('card_number', 'Establishment Card No'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('created', 'Created'); ?>
                            </th>
                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                aria-label="Actions" style="text-align: center !important;width: 130.547px; color: #181c32" >Actions</th>

                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        <?php
                            $number = 0;
                            $class = null;
                            if (!$company->isEmpty()) {
                                foreach ($company as $companys) {
                                    if ($number % 2 === 0) {
                                        $class = "even";
                                    } else {
                                        $class = "odd";
                                    }
                        ?>
                        <!--end::Table row-->
                        <tr>
                            <!--begin::User=-->
                            <td>
                                <!--begin::User details-->
                                    <?php echo $companys->name;?>
                                <!--begin::User details-->
                            </td >
                            <!--end::User=-->
                            <!--begin::Role=-->
                            <td ><?php echo $companys->trade_license_no;?></td>
                            <!--end::Role=-->
                            <!--begin::Last login=-->
                            <td >
                                <?php echo $this->DateC->DateFormetforView($companys->trade_license_expiry_date);?>
                            </td>
                            <!--end::Last login=-->
                            <!--begin::Two step=-->
                            <td>
                                <?php echo $companys->estblishment_card_no;?>
                            </td>
                            <!--end::Two step=-->
                            <!--begin::Joined-->
                            <td>
                                <?php echo $this->DateC->DateFormetforView($companys->created);?>
                            </td>
                            <!--begin::Joined-->
                            <!--begin::Action=-->
                            <td class="text-end">
                                    <?php
                                        echo $this->element(
                                                'admin/tabular/actions',
                                                [
                                                    'editLink' => 'admin/companies/edit/',
                                                    'deleteLink' => '/admin/companies/delete/',
                                                    'id' => $companys->id,
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
<?php echo $this->Html->script('admin/company_attachment', ['block' => 'scriptBottom']); ?>
