<?php

use Cake\Routing\Router;

 echo $this->element('admin/tabular/title', ['title' => 'Manage Companies', 'faClass' => "fa fa-building"]); ?>

<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
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
                            <td class="text-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#documents-view_<?php echo $companys->id; ?>" >
                            <span class="icon-stack"> <i class="fa fa-file-o icon-stack-2x"></i> <i class="fa fa-eye icon-stack-1x"></i> </span></i> </a>

                            <div class="modal fade" id="documents-view_<?php echo $companys->id; ?>" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Modal header-->
                                            <div class="modal-header">
                                                <!--begin::Modal title-->
                                                <h2 class="fw-bold">Attached Documents</h2>
                                                <!--end::Modal title-->
                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close" >
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
                                            <div class="modal-body person_documents">
                                                <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                                                    <?php
                                                        if(count($companys['documents']) > 0) {
                                                            foreach($companys['documents'] as $ca) {
                                                                ?>
                                                            <!--begin::Col-->
                                                            <div class="col-md-6 col-lg-4 col-xl-4">
                                                                <!--begin::Card-->
                                                                <div class="card h-100">
                                                                    <!--begin::Card body-->
                                                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                                                            <h5 class='attachment_title'><?php echo $ca['aTitle']; ?></h5>
                                                                            <?php
                                                                            if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>

                                                                            <a target="_blank" href="<?php echo Router::fullBaseUrl();?>/client/companies/files/<?php echo base64_encode($ca->id); ?>">
                                                                            <img src='<?php echo Router::fullBaseUrl();?>/attachments/center/img.png' style='width:100px;height:100px;'>
                                                                            </a>

                                                                            <?php } else { ?>
                                                                            <a target="_blank" href="<?php echo Router::fullBaseUrl();?>/client/companies/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo Router::fullBaseUrl();?>/attachments/center/text.png' style='width:100px;height:100px;'></a>

                                                                            <?php }	?>
                                                                    </div>
                                                                    <!--end::Card body-->
                                                                </div>
                                                                <!--end::Card-->
                                                            </div>
                                                            <!--end::Col-->

                                                                <?php
                                                            }
                                                        }else{
                                                            echo '<h5>No Documents Attached</h5>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <!--end::Modal body-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                            </div>

                                        </div>
                                        <!--end::Modal content-->
                                    </div>
                                    <!--end::Modal dialog-->
                                </div>


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
