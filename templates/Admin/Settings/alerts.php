<?php echo $this->element('admin/tabular/title', ['title' => 'Manage Settings', 'faClass' => "fa fa-building"]); ?>

<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                <!--begin::Add user-->
                <a href="<?php  echo $this->request->getAttribute('webroot');  ?>admin/settings/add_alert" class="btn btn-primary">
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
                                <?php echo $this->Paginator->sort('AlertTypes.name', 'Alert For'); ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Role: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo 'Delivery'; ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Role: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo 'Days'; ?></th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;"><?php echo $this->Paginator->sort('created', 'Created'); ?>
                            </th>
                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                aria-label="Actions" style="width: 130.547px; color: #181c32" >Actions</th>

                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        <?php
                            $number = 0;
                            $class = null;
                            if (!$alerts->isEmpty()) {
                                foreach ($alerts as $alert) {
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
                                    <?php echo $alert->alert_type->name;?>
                                <!--begin::User details-->
                            </td>
                            <!--end::User=-->
                            <!--begin::Role=-->
                            <td><?php echo "scheduled";?></td>
                            <!--end::Role=-->
                            <td><?php echo $alert->schdulecount;?></td>
                            <!--begin::Joined-->
                            <td>
                                <?php echo $this->DateC->DateFormetforView($alert->created);?>
                            </td>
                            <!--begin::Joined-->
                            <!--begin::Action=-->
                            <td class="text-end">
                                    <?php
                                        echo $this->element(
                                                'admin/tabular/actions',
                                                [
                                                    'editLink' => 'admin/settings/edit_alert/',
                                                    'isAttachement' => false,
                                                    'id' => $alert->id
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
