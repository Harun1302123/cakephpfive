<?php 
    use Cake\Routing\Router;
    echo $this->element('admin/tabular/title', ['title' => 'Manage Dependents', 'faClass' => "fa fa-building"]); 
?>

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
                        'employee_id',
                            [
                                'type' => 'select',
                                'options' => $employees,
                                'label' => false,
                                'div' => false ,
                                'empty'=>'Select Employee',
                                'class'=>"form-control form-control-solid w-250px ps-14"
                            ]
                        );
                    ?>
                    </div>

                    <div class="d-flex align-items-center position-relative my-1">
                        <input type="text" class="form-control form-control-solid w-250px ps-14" name="email_or_name"
                            id="searchQuery" placeholder="Email or Name" />
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
            <button class="btn btn-primary" id="create-xls-dependents">
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
            <table class="table table-bordered table-striped table-condensed flip-content" id="kt_table_dependents">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                            colspan="1" aria-label="User: activate to sort column ascending" style="width: 277.586px;">
                            <?php echo $this->Paginator->sort('name', 'Name'); ?>
                        </th>
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
                        <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1" aria-label="Actions"
                            style="text-align: center !important;width: 130.547px; color: #181c32">
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
                            if (!$dependents->isEmpty()) {
                                foreach ($dependents as $dependent) {
                                    if ($number % 2 === 0) {
                                        $class = "even";
                                    } else {
                                        $class = "odd";
                                    }
                        ?>
                    <!--begin::Modal - Adjust Balance-->

        </div>
        <!--end::Modal - New Card-->
        <!--end::Table row-->
        <tr>
            <td><?php echo $dependent->name;?></td>
            <td><?php echo $dependent->passport_no;?></td>
            <td><?php echo $this->DateC->DateFormetforView($dependent->passport_exp_date); ?></td>

            <!--<td><?php //echo $employee->work_permit_no;?></td>
							<td><?php //echo date('j F,Y',strtotime($employee->work_permit_exp_date));?></td>-->

            <td><?php echo $dependent->visa_no;?></td>
            <td><?php //echo $employee->visa_exp_date->format('j F,Y');
							echo $this->DateC->DateFormetforView($dependent->visa_exp_date); ?></td>

            <td><?php echo $dependent->emiratesID_no;?></td>
            <td><?php echo $this->DateC->DateFormetforView($dependent->emiratesID_exp_date );?></td>
            <!--begin::Action=-->
            <td class="text-center" style="width:10%">
                <a href="#" data-bs-toggle="modal"
                    data-bs-target="#documents-verifcation_<?php echo $dependent->id; ?>">
                    <i class="fa fa-file " aria-hidden="true"></i>
                </a>

                <a href="#" data-bs-toggle="modal" data-bs-target="#documents-view_<?php echo $dependent->id; ?>">
                    <span class="icon-stack">
                        <i class="fa fa-file-o icon-stack-2x"></i>
                        <i class="fa fa-eye icon-stack-1x"></i>
                    </span>
                </a>

                <div class="modal fade" id="documents-verifcation_<?php echo $dependent->id; ?>" tabindex="-1"
                    aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px" role="document">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Documents Verification</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                                    aria-label="Close">
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
                            <?php
                                $indexloop = 0;
                                echo $this->Form->create(
                                    $dependent,
                                    array('url' => '/client/dependents/edit/'.base64_encode($dependent->id))
                                );
                            ?>

                            <div class="modal-body person_documents scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Input row-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <div class=" table-responsive">

                                        <table class="table borderless">
                                            <tr>
                                                <td width="10%">Passport:</td>
                                                <td width="45%"> Sent</br>
                                                    <?php 
                                                        echo $this->Form->control(
                                                            'clients_document.passport_receive_client', 
                                                            array(
                                                                'class' => 'regular-checkbox persnal-doc-check form-check-input', 
                                                                'label' => false, 
                                                                'type' => 'checkbox',
                                                                'id' =>  'clients_document_passport_receive_client_'.$indexloop,
                                                                'disabled' => $dependent['clients_document']['passport_receive_client'] == 1 ? 'disabled' : false  
                                                            )
                                                        );

                                                        echo $this->Form->input(
                                                            'clients_document.passport_receive_client_date', 
                                                            array(
                                                                'type'=>'hidden',  
                                                                'value' => $dependent['clients_document']['passport_receive_client_date'] 
                                                            )
                                                        );  
                                                    ?>

                                                    <span class="documents_date">
                                                        <span class="date">
                                                            <?php 
                                                                if($dependent['clients_document']['passport_receive_client']) {
                                                                    echo $this->DateC->DateFormetforView($dependent['clients_document']['passport_receive_client_date']);
                                                                }
                                                            ?>
                                                        </span>
                                                        <?php
                                                            if($dependent['clients_document']['passport_send_admin']){
                                                                echo '<span class="doc-status" >
                                                                    <i class="btn btn-primary btn-sm fa fa-check" aria-hidden="true"></i> 
                                                                    Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['passport_send_admin_date']).')</span>'; 
                                                            }
                                                        ?>
                                                    </span>
                                                    <?php 
                                                        if($dependent['clients_document']['passport_receive_client']){ 
                                                    ?>
                                                        <span class="resend">
                                                            <button
                                                                type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>"
                                                                type="button" data-type="passport"
                                                                class="btn btn-primary btn-xs re-set-doc">
                                                                Send again
                                                            </button>
                                                        </span>
                                                    <?php 
                                                        }
                                                    ?>
                                                </td>
                                                <td width="45%">Received</br>
                                                    <?php 
                                                        echo $this->Form->control(
                                                            'clients_document.passport_send_client', 
                                                            array(
                                                                'class' => 'regular-checkbox persnal-doc-check form-check-input', 
                                                                'label' => false, 
                                                                'type'=>'checkbox', 
                                                                'disabled' => $dependent['clients_document']['passport_send_client'] == 1 ? 'disabled' : false )
                                                        ); 
                                                    
                                                        echo $this->Form->input(
                                                            'clients_document.passport_send_client_date', 
                                                            array(
                                                                'type'=>'hidden' ,  
                                                                'value' => $dependent['clients_document']['passport_send_client_date'] 
                                                            )
                                                        );   
                                                    ?>

                                                    <span class="documents_date"> 
                                                        <span class="date">
                                                            <?php 
                                                                if($dependent['clients_document']['passport_send_client']){
                                                                    echo $this->DateC->DateFormetforView($dependent['clients_document']['passport_send_client_date']);
                                                                }
                                                            ?>
                                                        </span>
                                                        <?php
                                                            if($dependent['clients_document']['passport_receive_admin']){
                                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['passport_receive_admin_date']).')</span>'; 
                                                            }	
                                                        ?>
                                                    </span>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td width="10%">Birthday Certificate: </td>
                                                <td width="45%">Sent</br>
                                                    <?php echo $this->Form->control('clients_document.bc_send_client', 
                                array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['bc_send_client'] == 1 ? 'disabled' : false ));
								
								echo $this->Form->input('clients_document.bc_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['bc_send_client_date'] ));  ?>
                                                    <span class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['bc_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['bc_send_client_date']);
                                }
                                ?>
                                                        </span>
                                                        <?php 
						if($dependent['clients_document']['bc_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['bc_receive_admin_date']).')</span>'; 
							}	
					?>
                                                    </span>
                                                    <?php if($dependent['clients_document']['bc_receive_client']){ ?>
                                                    <span class="resend">
                                                        <button
                                                            type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>"
                                                            type="button" data-type="bc"
                                                            class="btn btn-primary btn-xs re-set-doc">Send
                                                            again</button>
                                                    </span>
                                                    <?php }?>
                                                </td>
                                                <td width="45%"> Received</br>
                                                    <?php echo $this->Form->control('clients_document.bc_receive_client', 
                                array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['bc_receive_client'] == 1 ? 'disabled' : false  ));  ?>
                                                    <?php echo $this->Form->input('clients_document.bc_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['bc_receive_client_date'] ));  ?>
                                                    <span class="documents_date"> <span class="date">

                                                            <?php if($dependent['clients_document']['bc_receive_client']){
                                    echo $this->DateC->DateFormetforView($dependent['clients_document']['bc_receive_client_date']);
                                }
                                ?>
                                                        </span>
                                                        <?php 
                                    if($dependent['clients_document']['bc_send_admin']){
                                        echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Sent</span> ('.$this->DateC->DateFormetforView($dependent['clients_document']['bc_receive_admin_date']).')'; 
                                    }
					            ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Marriage Certificate: </td>
                                                <td width="45%">Sent</br>
                                                    <?php echo $this->Form->control('clients_document.mc_send_client', 
                                array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 
                                'type'=>'checkbox' , 'disabled' => $dependent['clients_document']['mc_send_client'] == 1 ? 'disabled' : false ));
								
								echo $this->Form->input('clients_document.mc_send_client_date', 
                                array('type'=>'hidden' , 'value' => $dependent['clients_document']['mc_send_client_date'] ));  ?>
                                                    <span class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['mc_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['mc_send_client_date']);
						}
						?>
                                                        </span>
                                                        <?php  
						if($dependent['clients_document']['mc_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['mc_receive_admin_date']).')</span>' ; 
							}	
					        ?>
                                                    </span>
                                                    <?php if($dependent['clients_document']['mc_receive_client']){ ?>
                                                    <span class="resend">
                                                        <button
                                                            type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>"
                                                            type="button" data-type="mc"
                                                            class="btn btn-primary btn-xs re-set-doc">Send
                                                            again</button>
                                                    </span>
                                                    <?php }?>
                                                </td>
                                                <td width="45%"> Received</br>
                                                    <?php echo $this->Form->control('clients_document.mc_receive_client', 
                                                    array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 'type'=>'checkbox', 
                                                    'disabled' => $dependent['clients_document']['mc_receive_client'] == 1 ? 'disabled' : false  ));
								
								echo $this->Form->input('clients_document.mc_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['mc_receive_client_date'] ));  ?>
                                                    <span class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['mc_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['mc_receive_client_date']);
						}
						?>
                                                        </span>
                                                        <?php 
						if($dependent['clients_document']['mc_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Sent ('.$this->DateC->DateFormetforView($dependent['clients_document']['mc_send_admin_date']).')</span>'; 
							}
					?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Emirates ID: </td>
                                                <td width="45%">Sent</br>
                                                    <?php echo $this->Form->control('clients_document.eid_send_client',
                                                     array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 'type'=>'checkbox', 
                                                     'disabled' => $dependent['clients_document']['eid_send_client'] == 1 ? 'disabled' : false  )); 
								
								echo $this->Form->input('clients_document.eid_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['eid_send_client_date'] ));  ?>
                                                    <span class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['eid_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['eid_send_client_date']);
						}
						?>
                                                        </span>
                                                        <?php 
						if($dependent['clients_document']['eid_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['eid_receive_admin_date']).')</span>'; 
							}	
					?>
                                                    </span>
                                                    <?php if($dependent['clients_document']['eid_receive_client']){ ?>
                                                    <span class="resend">
                                                        <button
                                                            type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>"
                                                            type="button" data-type="eid"
                                                            class="btn btn-primary btn-xs re-set-doc">Send
                                                            again</button>
                                                    </span>
                                                    <?php }?>
                                                </td>
                                                <td width="45%"> Received</br>
                                                    <?php echo $this->Form->control('clients_document.eid_receive_client', 
                                                    array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 'type'=>'checkbox' , 'disabled' => $dependent['clients_document']['eid_receive_client'] == 1 ? 'disabled' : false ));
								echo $this->Form->input('clients_document.eid_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['eid_receive_client_date'] ));  ?><span
                                                        class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['eid_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['eid_receive_client_date']);
						}
						?>
                                                        </span>
                                                        <?php 
						if($dependent['clients_document']['eid_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['eid_receive_admin_date']).')</span>'; 
							}
					?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Degree Certificate: </td>
                                                <td width="45%">Sent</br>
                                                    <?php echo $this->Form->control('clients_document.dc_send_client', 
                                                    array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['dc_send_client'] == 1 ? 'disabled' : false)); 
								
								echo $this->Form->input('clients_document.dc_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['dc_send_client_date'] ));  ?>
                                                    <span class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['dc_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['dc_send_client_date']);
						}
						?>
                                                        </span>
                                                        <?php 
						if($dependent['clients_document']['dc_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['dc_receive_admin_date']).')</span>'; 
							}	
					?>
                                                    </span>
                                                    <?php if($dependent['clients_document']['dc_receive_client']){ ?>
                                                    <span class="resend">
                                                        <button
                                                            type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>"
                                                            type="button" data-type="dc"
                                                            class="btn btn-primary btn-xs re-set-doc">Send
                                                            again</button>
                                                    </span>
                                                    <?php }?>
                                                </td>
                                                <td width="45%"> Received</br>
                                                    <?php echo $this->Form->control('clients_document.dc_receive_client', 
                                                    array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['dc_receive_client'] == 1 ? 'disabled' : false )); 
								echo $this->Form->input('clients_document.dc_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['dc_receive_client_date'] ));  ?><span
                                                        class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['dc_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['dc_receive_client_date']);
						}
						?>
                                                        </span>
                                                        <?php 
						if($dependent['clients_document']['dc_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Sent ('.$this->DateC->DateFormetforView($dependent['clients_document']['dc_send_admin_date']).')</span>'; 
							}
					?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Medical: </td>
                                                <td width="45%">Sent</br>
                                                    <?php echo $this->Form->control('clients_document.medical_send_client',
                                                     array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['medical_send_client'] == 1 ? 'disabled' : false )); 
								echo $this->Form->input('clients_document.medical_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['medical_send_client_date']) );  ?>
                                                    <span class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['medical_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['medical_send_client_date']);
						}
						?>
                                                        </span>
                                                        <?php  
						if($dependent['clients_document']['medical_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['medical_receive_admin_date']).')</span>'; 
							}		
					?>
                                                    </span>
                                                    <?php if($dependent['clients_document']['medical_receive_client']){ ?>
                                                    <span class="resend">
                                                        <button
                                                            type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>"
                                                            type="button" data-type="medical"
                                                            class="btn btn-primary btn-xs re-set-doc">Send
                                                            again</button>
                                                    </span>
                                                    <?php }?></td>
                                                <td width="45%"> Received</br>
                                                    <?php echo $this->Form->control('clients_document.medical_receive_client', 
                                                    array('class' => 'regular-checkbox persnal-doc-check form-check-input', 'label' => false, 
                                                    'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['medical_receive_client'] == 1 ? 'disabled' : false )); 
								echo $this->Form->input('clients_document.medical_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['medical_receive_client_date'] ));  ?><span
                                                        class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['medical_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['medical_receive_client_date']);
						}
						?>
                                                        </span>
                                                        <?php 
						if($dependent['clients_document']['medical_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Sent</span> ('.$this->DateC->DateFormetforView($dependent['clients_document']['medical_receive_admin_date']).')' ; 
							}
					?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Other: </td>
                                                <td width="45%">Sent</br>
                                                    <?php 
								 $class =  $dependent['clients_document']['other_receive_value'] != ''? '' : 'other_doc' ;
								  echo $this->Form->control('clients_document.other_send_client', 
                                  array('class' => "regular-checkbox persnal-doc-check form-check-input $class", 'label' => false, 'type'=>'checkbox', 
                                  'disabled' => $dependent['clients_document']['other_send_client'] == 1 ? 'disabled' : false ));  

								  echo $this->Form->input('clients_document.other_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['other_send_client_date'] ));  ?>
                                                    <span class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['other_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['other_send_client_date']);
						}
						?>
                            </span>
                            <?php 
                                if($dependent['clients_document']['other_receive_admin']){
                                    echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['other_receive_admin_date']).')</span>'; 
                                }	
					        ?>
                                                    </span>
                                                    <?php if($dependent['clients_document']['other_send_client'] || $dependent['clients_document']['other_receive_admin'] ){ ?>
                                                    <div class="other-doc-parent form_block">
                                                        <input 
                                                            readonly type="text" 
                                                            class="input_field form-control mb-2"
                                                            style="width: 90%; margin-top:10px"
                                                            value="<?php echo $dependent['clients_document']['other_receive_value'] ?>" 
                                                        />
                                                    </div>
                                                    <?php } ?>
                                                    <?php if($dependent['clients_document']['other_receive_client']){ ?>
                                                    <span class="resend">
                                                        <button
                                                            type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>"
                                                            type="button" data-type="other"
                                                            class="btn btn-primary btn-xs re-set-doc">Send
                                                            again</button>
                                                    </span>
                                                    <?php }?>
                                                </td>
                                                <td width="45%"> Received</br>
                                                    <?php
								$class =  $dependent['clients_document']['other_send_admin'] != ''? '' : 'other_doc' ;
								 echo $this->Form->control('clients_document.other_receive_client', 
                                 array('class' => "regular-checkbox persnal-doc-check form-check-input $class", 'label' => false, 
                                 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['other_receive_client'] == 1 ? 'disabled' : false ));  
								 echo $this->Form->input('clients_document.other_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['other_receive_client_date'] ));  ?><span
                                                        class="documents_date"> <span class="date">
                                                            <?php if($dependent['clients_document']['other_receive_client']){
								echo $this->DateC->DateFormetforView($dependent['clients_document']['other_receive_client_date']);
								}
							?>
                                                        </span>
                                                        <?php 
						if($dependent['clients_document']['other_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send</span> ('.$this->DateC->DateFormetforView($dependent['clients_document']['other_send_admin_date']).')'; 
							}
					?>
                                                    </span>
                                                    <?php 
								if($dependent['clients_document']['other_send_admin'] || $dependent['clients_document']['other_receive_client'] ){
									?>
                                                    <div class="other-doc-parent form_block">
                                                        <input readonly type="text" class="input_field"
                                                            style="width: 90%; margin-top:10px;"
                                                            value="<?php echo $dependent['clients_document']['other_send_value'] ?>"
                                                            required />
                                                    </div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Modal body-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            <?php $indexloop++; echo $this->Form->end(); ?>

                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>


                <div class="modal fade" id="documents-view_<?php echo $dependent->id; ?>" tabindex="-1" aria-hidden="true">
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
                        
                            <div class="modal-body person_documents scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Input row-->
                                <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                                    <?php
                                        if(count($dependent['documents']) > 0){
                                            foreach($dependent['documents'] as $ca) {
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
                                                        <a target="_blank" href="<?php echo Router::fullBaseUrl();?>/client/dependents/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo Router::fullBaseUrl();?>/attachments/center/text.png' style='width:100px;height:100px;'>
                                                        <?php } else { ?>
                                                        <a target="_blank" href="<?php echo Router::fullBaseUrl();?>/client/dependents/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo Router::fullBaseUrl();?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
                                                        <?php }	?>
                                                        
                                                        <br>
                                                        <a style="color: #3c8dbc;"  href='<?php echo Router::fullBaseUrl()."/client/dependents/DownloadDependentDocument/".base64_encode($ca->id);?>' >Download</a>
                                                
                                                    </div>
                                                </div>
                                            </div>
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
<?php echo $this->Html->script('client/dependent_attachment',['block'=>'scriptBottom']); ?>
<script>
    $(".person_documents input").change(function () {
        if (this.checked) {
            //console.log($(this).parent().parent().children('.documents_date').children('.date').html());
            $(this).parent().parent().children('.documents_date').children('.date').html(formatDate(
        new Date()));
            date = new Date()
            $('input#' + $(this).attr('id') + '-date').val(date.getFullYear() + '-' + (date.getMonth() + 1) +
                '-' + date.getDate());
        } else {
            $('input[name="' + $(this).attr('name') + '_date"]').val('');
            $(this).parent().parent().children('.documents_date').children('.date').html('');
        }
    });

    function formatDate(date) {
        var monthNames = [
            "Jan", "Feb", "March",
            "April", "May", "June", "July",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();
        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }
    $('.other_doc').change(function () {
        if (this.checked) {
            var name = $(this).attr('name');
            name = name.replace('_client', '_value');
            //console.log($(this).parent().parent('td').html());
            $(this).parent().parent('td').append('<div  class="other-doc-parent form_block"><input  name="' +
                name +
                '" type="text"  class="input_field" style="width: 90%; margin-top:10px" required /></div>');
        } else {
            $(this).parent().parent().children('.other-doc-parent').remove();
        }
    });
    $('.re-set-doc').click(function () {
        type_id = $(this).attr('type-id');
        data_type = $(this).attr('data-type');
        data = {
            'type_id': type_id,
            'data_type': data_type
        };
        //console.log(data); return false;
        $.ajax({
            url: webroot + '/client/dependents/re_set',
            data: data,
            cache: false,
            type: 'POST',
            context: this,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            success: function (html) {
                html = JSON.parse(html);
                if (html.status == true) {
                    if (data_type == 'other') {
                        $(this).parent().parent('td').parent('tr').find('.input_field').remove();
                        //$('.other-doc-parent input').attr('readonly' , false).val('');
                    }
                    $(this).parent().parent('td').next().children('.documents_date').children()
                        .html('');
                    $(this).parent().siblings('.documents_date').children().html('');
                    $('#clients-document-' + data_type + '-send-client').attr('checked', false);
                    $('#clients-document-' + data_type + '-receive-client').attr('checked', false);

                    $('#clients-document-' + data_type + '-send-client').attr('disabled', false);
                    $('#clients-document-' + data_type + '-receive-client').attr('disabled', false);

                    $('#clients-document-' + data_type + '-send-client-date').val('');
                    $('#clients-document-' + data_type + '-receive-client-date').val('');
                    $(this).parent().parent('td').next().children('.documents_date').children()
                        .html('');
                    $(this).parent().remove();
                    $('#clients-document-' + data_type + '-send-client').trigger('click');
                }
            }
        });
    });

</script>
