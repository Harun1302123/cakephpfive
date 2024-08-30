<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Edit Employee</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <?php

use Cake\Routing\Router;

            echo $this->Form->create(
                $employee,
                array(
                        'id' => 'fileupload',
                        'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload',
                        'enctype' => 'multipart/form-data',
                    )
            );
        ?>

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <!-- <div class="fv-row w-100 flex-md-root"> -->
            <!--begin::Label-->
            <!-- <label class="required form-label">Image/Profile</label> -->
            <!--end::Label-->
            <!--begin::Input-->
            <!-- <input type="text" class="form-control mb-2" value=""> -->
            <!-- <div style="width:168px; height: 148px;" id="container_photo"></div> -->
            <!--end::Input-->
            <!-- </div> -->
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">

            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Status</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('status', array('type' => 'select', 'options'=>['1'=>'Active','0'=>'Cancelled'], 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Company Name</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('company_id', array('type' => 'select', 'options' => $companies, 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));?>
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
                <label class="required form-label">Employee Name</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('name', array('required' => 'required', 'class' => 'form-control mb-2'  , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Email</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('email', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
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
                <label class="form-label">Mobile No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('mobile_no', array('class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="form-label">Employee Entity</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('employee_entity', array('class' => 'form-control mb-2', 'label' => false,'id'=>'immigra_card_issue_date'));  ?>
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
                <label class="required form-label">Unified No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('unified_no', array('class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">PS Number</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->hidden('user_image', array('class' => 'user_image', 'label' => false, 'id' => 'user_image'));  ?>
                <?php echo $this->Form->input('ps_number', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
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
                <label class="required form-label">Nationality</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('nationality', array('type' => 'select', 'options' => $countries, 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Gender</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'gender',
                        array(
                            'type' => 'select',
                            'options' => ['male'=>'Male','female'=>'Female'],
                            'required' => 'required',
                            'class' => 'form-control mb-2' ,
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
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Passport No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('passport_no', array('required' => 'required', 'class' => 'form-control mb-2' , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Passport Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'passport_exp_date',
                            array(
                                'required' => 'required',
                                'class' => 'form-control mb-2 date_expiry',
                                'placeholder'=>'dd/mm/yy',
                                'label' => false
                            )
                        );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root pt-8">
                <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>
                <!--begin::Input-->
                <div style="float:right;">
                    <?php
                            echo $this->Form->input(
                                'files.passport_files[]',
                                array(
                                    'id' => 'passport-files',
                                    'style'=>'display:none;',
                                    'type' => 'file',
                                    'multiple'=>'multiple',
                                    'label' => false,
                                    'class' => 'form-control mb-2 file'
                                )
                            )
                        ?>

                    <button class="btn btn-primary" type='button'
                        onclick='javascript:$("#passport-files").trigger("click");'
                        style='float:left;margin-left: 0px;'>
                        <i class="fas fa-paperclip"></i>
                        <span class="indicator-label">Upload</span>
                    </button>
                </div>
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
                <label class="required form-label">Visa No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('visa_no', array('required' => 'required', 'class' => 'form-control mb-2' , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">VISA Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'visa_exp_date',
                            array(
                                'required' => 'required',
                                'class' => 'form-control mb-2 date_expiry' ,
                                'placeholder'=>'dd/mm/yy',
                                'label' => false,
                            )
                        );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root pt-8">
                <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>
                <!--begin::Input-->
                <div style="float:right;">
                    <?php
                            echo $this->Form->input(
                                'files.visa_files[]',
                                array(
                                    'id' => 'visa-files',
                                    'style'=>'display:none;',
                                    'type' => 'file',
                                    'multiple'=>'multiple',
                                    'label' => false,
                                    'class' => 'form-control mb-2 file'
                                )
                            )
                        ?>

                    <button class="btn btn-primary" type='button'
                        onclick='javascript:$("#visa-files").trigger("click");' style='float:left;margin-left: 0px;'>
                        <i class="fas fa-paperclip"></i>
                        <span class="indicator-label">Upload</span>
                    </button>
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->


        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="form-label">Emirates ID No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('emiratesID_no', array('class' => 'form-control mb-2' , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="form-label">Emirates ID Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'emiratesID_exp_date',
                        array(
                            'class' => 'form-control mb-2 date_expiry' ,
                            'placeholder' => 'dd/mm/yy',
                            'label' => false
                        )
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root pt-8">
                <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>
                <!--begin::Input-->
                <div style="float:right;">
                    <?php
                            echo $this->Form->input(
                                'files.id_files[]',
                                array(
                                    'id' => 'id-files',
                                    'style'=>'display:none;',
                                    'type' => 'file',
                                    'multiple'=>'multiple',
                                    'label' => false,
                                    'class' => 'form-control mb-2 file'
                                )
                            )
                        ?>

                    <button class="btn btn-primary" type='button' onclick='javascript:$("#id-files").trigger("click");'
                        style='float:left;margin-left: 0px;'>
                        <i class="fas fa-paperclip"></i>
                        <span class="indicator-label">Upload</span>
                    </button>
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->


        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Labor Card No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('labor_card_no', array('required' => 'required', 'class' => 'form-control mb-2' , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Labor Card Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'labor_card_exp_date',
                        array(
                            'required' => 'required',
                            'class' => 'form-control mb-2 date_expiry' ,
                            'placeholder' => 'dd/mm/yy',
                            'label' => false
                        )
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root pt-8">
                <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>
                <!--begin::Input-->
                <div style="float:right;">
                    <?php
                            echo $this->Form->input(
                                'files.lcard_files[]',
                                array(
                                    'id' => 'lcard-files',
                                    'style'=>'display:none;',
                                    'type' => 'file',
                                    'multiple'=>'multiple',
                                    'label' => false,
                                    'class' => 'form-control mb-2 file'
                                )
                            )
                        ?>

                    <button class="btn btn-primary" type='button'
                        onclick='javascript:$("#lcard-files").trigger("click");' style='float:left;margin-left: 0px;'>
                        <i class="fas fa-paperclip"></i>
                        <span class="indicator-label">Upload</span>
                    </button>
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="form-label">Health Care Card No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('health_card_no', array('class' => 'form-control mb-2' , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="form-label">Health Care Card Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php
                    echo $this->Form->input(
                        'health_card_exp_date',
                        array(
                            'class' => 'form-control mb-2 date_expiry' ,
                            'placeholder' => 'dd/mm/yy',
                            'label' => false
                        )
                    );
                ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root pt-8">
                <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>

                <!--begin::Input-->
                <div style="float:right;">
                    <?php
                            echo $this->Form->input(
                                'files.hcard_files[]',
                                array(
                                    'id' => 'hcard-files',
                                    'style'=>'display:none;',
                                    'type' => 'file',
                                    'multiple'=>'multiple',
                                    'label' => false,
                                    'class' => 'form-control mb-2 file'
                                )
                            )
                        ?>

                    <button class="btn btn-primary" type='button'
                        onclick='javascript:$("#hcard-files").trigger("click");' style='float:left;margin-left: 0px;'>
                        <i class="fas fa-paperclip"></i>
                        <span class="indicator-label">Upload</span>
                    </button>
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="form-label">Others</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('others', array('class' => 'form-control mb-2' , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root pt-8">
                <span style="color:#367FA9;padding: 0px 2px 0px 0px; font-size: 11px;" class="count_image"></span>
                <!--begin::Input-->
                <div style="float:right;">
                    <?php
                            echo $this->Form->input(
                                'files.other_files[]',
                                array(
                                    'id' => 'other-files',
                                    'style'=>'display:none;',
                                    'type' => 'file',
                                    'multiple'=>'multiple',
                                    'label' => false,
                                    'class' => 'form-control mb-2 file'
                                )
                            )
                        ?>

                    <button class="btn btn-primary" type='button'
                        onclick='javascript:$("#other-files").trigger("click");' style='float:left;margin-left: 0px;'>
                        <i class="fas fa-paperclip"></i>
                        <span class="indicator-label">Upload</span>
                    </button>
                    <!--end::Input-->
                </div>
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->
        <h4 class="pt-10">Documents verification</h4>

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <div class="person_documents table-responsive">

                    <table class="table table-row-bordered table-row-gray-300 gy-5">
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <td><label class="form-label">Passport:</label></td>
                            <td>
                                <label class="form-label">Received by Daman </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">
                                <?php
                                    echo $this->Form->control(
                                        'clients_document.passport_receive_admin',
                                        array(
                                            'class' => 'form-check-input persnal-doc-check',
                                            'label' => false,
                                            'type'=>'checkbox'
                                        )
                                    );
                                ?>
                                <?php
                                    echo $this->Form->input(
                                        'clients_document.passport_receive_admin_date',
                                        array(
                                            'type'=>'hidden',
                                            'value' => $employee['clients_document']['passport_receive_admin_date'],
                                            "class" => "form-check-input"
                                        )
                                    );
                                ?>

                                <span class="documents_date">
                                    <span class="date">
                                    <?php
                                        if($employee['clients_document']['passport_receive_admin']) {
                                            echo $this->DateC->DateFormetforView($employee['clients_document']['passport_receive_admin_date']);
                                        }
                                    ?>
                                    </span>
                                    <?php
                                        if($employee['clients_document']['passport_send_client']) {
                                            echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send'.(empty($employee['clients_document']['passport_send_client_date']) ? '' : '('. $this->DateC->DateFormetforView($employee['clients_document']['passport_send_client_date']).')</span>' );
                                        }
                                    ?>
                                </span>
                                    <?php if($employee['clients_document']['passport_receive_client']){ ?>

                                    <span class="resend">
                                        <button
                                            type-id="<?php echo base64_encode($employee['clients_document']['id']); ?>"
                                            type="button" data-type="passport"
                                            class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                                    </span>
                                    <?php }?>
                                </div>
                            </td>
                            <td>
                                <label class="form-label">
                                    Sent to Client
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">
                                    <?php
                                        echo $this->Form->control(
                                                'clients_document.passport_send_admin',
                                                array(
                                                    'class' => 'form-check-input persnal-doc-check',
                                                    'label' => false,
                                                    'type'=>'checkbox'
                                                )
                                            );
                                        ?>

                                    <?php
                                        echo $this->Form->input(
                                            'clients_document.passport_send_admin_date',
                                            array(
                                                'type'=>'hidden',
                                                'value' => $employee['clients_document']['passport_send_admin_date']
                                            )
                                        );
                                    ?>

                                    <span class="documents_date">
                                        <span class="date">
                                            <?php
                                                if($employee['clients_document']['passport_send_admin']) {
                                                    echo $this->DateC->DateFormetforView($employee['clients_document']['passport_send_admin_date']);
                                                }
                                            ?>
                                        </span>
                                        <?php
                                            if($employee['clients_document']['passport_receive_client']){
                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received('.$this->DateC->DateFormetforView($employee['clients_document']['passport_receive_client_date']).')</span>';
                                            }
                                        ?>
                                    </span>
                                </div>
                            </td>
                        </tr>

                        <tr class="fw-semibold text-gray-800 border-bottom border-gray-200">
                            <td>
                                <label class="form-label">
                                    Birthday Certificate:
                                </label>
                            </td>
                            <td>
                                <label class="form-label">
                                    Received by Daman
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">
                                    <?php
                                    //echo '<pre>'; print_r($employee['clients_document']); exit;
                                    //echo $employee['clients_document']['bc_receive_admin_date']; exit;
                                    ?>
                                    <?php
                                        echo $this->Form->control(
                                            'clients_document.bc_receive_admin',
                                            array(
                                                'class' => 'form-check-input persnal-doc-check',
                                                'label' => false,
                                                'type' => 'checkbox'
                                            )
                                        );
                                    ?>
                                    <?php
                                        echo $this->Form->input(
                                            'clients_document.bc_receive_admin_date',
                                                array(
                                                    'type'=>'hidden' ,
                                                    'value' => $employee['clients_document']['bc_receive_admin_date']
                                                )
                                            );
                                    ?>
                                    <span class="documents_date">
                                        <span class="date">
                                            <?php if($employee['clients_document']['bc_receive_admin']) {
                                                echo $this->DateC->DateFormetforView($employee['clients_document']['bc_receive_admin_date']);
                                            }
                                            ?>
                                        </span>
                                        <?php
                                            if($employee['clients_document']['bc_send_client']){
                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($employee['clients_document']['bc_send_client_date']).')</span>';
                                            }
                                        ?>
                                    </span>

                                    <?php if($employee['clients_document']['bc_receive_client']){ ?>
                                    <span class="resend">
                                        <button
                                            type-id="<?php echo base64_encode($employee['clients_document']['id']); ?>"
                                            type="button" data-type="bc"
                                            class="btn btn-primary btn-xs re-set-doc">Receive again
                                        </button>
                                    </span>
                                    <?php }?>

                                </div>
                            </td>
                            <td>
                                <label class="form-label">
                                    Sent to Client
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">

                                    <?php
                                        echo $this->Form->control(
                                                'clients_document.bc_send_admin',
                                                array(
                                                    'class' => 'form-check-input persnal-doc-check',
                                                    'label' => false,
                                                    'type'=>'checkbox'
                                                )
                                            );
                                    ?>
                                    <?php
                                        echo $this->Form->input(
                                                'clients_document.bc_send_admin_date',
                                                array(
                                                    'type'=>'hidden',
                                                    'value' => $employee['clients_document']['bc_send_admin_date']
                                                )
                                            );
                                    ?>
                                    <span class="documents_date">
                                        <span class="date">
                                        <?php
                                            if($employee['clients_document']['bc_send_admin']){
                                                echo $this->DateC->DateFormetforView($employee['clients_document']['bc_send_admin_date']);
                                            }
                                        ?>
                                        </span>
                                        <?php
                                            if($employee['clients_document']['bc_receive_client']){
                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($employee['clients_document']['bc_receive_client_date']) .' )</span>';
                                            }
                                        ?>
                                    </span>
                                </div>
                            </td>
                        </tr>

                        <tr class="fw-semibold text-gray-800 border-bottom border-gray-200">
                            <td>
                                <label class="form-label">
                                    Marriage Certificate:
                                </label>
                            </td>
                            <td>
                                <label class="form-label">
                                    Received by Daman
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">

                                    <?php
                                        echo $this->Form->control(
                                                'clients_document.mc_receive_admin',
                                                array(
                                                    'class' => 'form-check-input persnal-doc-check',
                                                    'label' => false,
                                                    'type'=>'checkbox'
                                                )
                                            );
                                    ?>
                                    <?php
                                        echo $this->Form->input(
                                            'clients_document.mc_receive_admin_date',
                                                array(
                                                    'type'=>'hidden',
                                                    'value' => $employee['clients_document']['mc_receive_admin_date']
                                                )
                                            );
                                    ?>
                                    <span class="documents_date">
                                        <span class="date">

                                        <?php if($employee['clients_document']['mc_receive_admin']){
                                                    echo $this->DateC->DateFormetforView($employee['clients_document']['mc_receive_admin_date']);
                                                }
                                        ?>
                                        </span>
                                        <?php
                                            if($employee['clients_document']['mc_send_client']){
                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($employee['clients_document']['mc_send_client_date']) .')</span>';
                                            }
                                        ?>
                                    </span>
                                        <?php if($employee['clients_document']['mc_receive_client']){ ?>
                                    <span class="resend">
                                        <button type-id="<?php echo base64_encode($employee['clients_document']['id']); ?>" type="button" data-type="mc" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                                    </span>
                                    <?php }?>
                                </div>
                            </td>
                            <td>
                                <label class="form-label">
                                    Sent to Client
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">
                                    <?php
                                        echo $this->Form->control(
                                            'clients_document.mc_send_admin',
                                            array(
                                                'class' => 'form-check-input persnal-doc-check',
                                                'label' => false,
                                                'type'=>'checkbox'
                                            )
                                        );
                                    ?>
                                    <?php echo $this->Form->input(
                                            'clients_document.mc_send_admin_date',
                                            array(
                                                'type'=>'hidden',
                                                'value' => $employee['clients_document']['mc_send_admin_date']
                                            )
                                        );
                                    ?>
                                    <span class="documents_date">
                                        <span class="date">
                                        <?php
                                            if($employee['clients_document']['mc_send_admin']) {
                                                echo $this->DateC->DateFormetforView($employee['clients_document']['mc_send_admin_date']);
                                            }
                                        ?>
                                        </span>
                                        <?php
                                            if($employee['clients_document']['mc_receive_client']) {
                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($employee['clients_document']['mc_receive_client_date']).')</span>' ;
                                            }
                                        ?>
                                    </span>

                                </div>
                            </td>
                        </tr>

                        <tr class="fw-semibold text-gray-800 border-bottom border-gray-200">
                            <td>
                                <label class="form-label">

                                    Emirates ID:
                                </label>
                            </td>
                            <td>
                                <label class="form-label">
                                    Received by Daman
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">

                                    <?php
                                        echo $this->Form->control(
                                            'clients_document.eid_receive_admin',
                                                array(
                                                    'class' => 'form-check-input persnal-doc-check',
                                                    'label' => false,
                                                    'type'=>'checkbox'
                                                )
                                            );
                                    ?>
                                    <?php
                                        echo $this->Form->input(
                                            'clients_document.eid_receive_admin_date',
                                            array(
                                                'type'=>'hidden',
                                                'value' => $employee['clients_document']['eid_receive_admin_date']
                                            )
                                        );
                                    ?>
                                    <span class="documents_date">
                                        <span class="date">
                                            <?php
                                                if($employee['clients_document']['eid_receive_admin']) {
                                                    echo $this->DateC->DateFormetforView($employee['clients_document']['eid_receive_admin_date']);
                                                }
                                            ?>
                                    </span>
                                    <?php
                                        if($employee['clients_document']['eid_send_client']){
                                            echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($employee['clients_document']['eid_send_client_date']).')</span>';
                                        }
                                    ?>
                                    </span>
                                    <?php if($employee['clients_document']['eid_receive_client']){ ?>
                                        <span class="resend">
                                            <button type-id="<?php echo base64_encode($employee['clients_document']['id']); ?>" type="button" data-type="eid" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                                        </span>
                                    <?php }?>
                                </div>
                            </td>
                            <td>
                                Sent to Client
                                </br>
                                <div class="form-check form-check-custom form-check-solid">

                                    <?php
                                        echo $this->Form->control(
                                                'clients_document.eid_send_admin',
                                                array(
                                                    'class' => 'form-check-input persnal-doc-check',
                                                    'label' => false,
                                                    'type'=>'checkbox'
                                                )
                                            );
                                    ?>
                                    <?php
                                        echo $this->Form->input(
                                            'clients_document.eid_send_admin_date',
                                            array(
                                                'type'=>'hidden'  ,
                                                'value' => $employee['clients_document']['eid_send_admin_date']
                                            )
                                        );
                                    ?>
                                    <span class="documents_date">
                                        <span class="date">
                                        <?php
                                            if($employee['clients_document']['eid_send_admin']) {
                                                echo $this->DateC->DateFormetforView($employee['clients_document']['eid_send_admin_date']);
                                            }
                                        ?>
                                    </span>
                                    <?php
                                        if($employee['clients_document']['eid_receive_client']) {
                                            echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($employee['clients_document']['eid_receive_client_date']).')</span>';
                                        }
                                    ?>
                                    </span>
                                </div>
                            </td>
                        </tr>

                        <tr class="fw-semibold text-gray-800 border-bottom border-gray-200">
                            <td>
                                <label class="form-label">
                                    Degree Certificate:
                                </label>
                            </td>
                            <td>
                                <label class="form-label">
                                    Received by Daman
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">

                                    <?php
                                        echo $this->Form->control(
                                            'clients_document.dc_receive_admin',
                                            array(
                                                'class' => 'form-check-input persnal-doc-check',
                                                'label' => false,
                                                'type'=>'checkbox'
                                            )
                                        );
                                    ?>
                                    <?php
                                        echo $this->Form->input(
                                            'clients_document.dc_receive_admin_date',
                                                array(
                                                    'type'=> 'hidden' ,
                                                    'value' => $employee['clients_document']['dc_receive_admin_date']
                                                )
                                            );
                                    ?>
                                    <span class="documents_date">
                                        <span class="date">
                                            <?php
                                                if($employee['clients_document']['dc_receive_admin']){
                                                    echo $this->DateC->DateFormetforView($employee['clients_document']['dc_receive_admin_date']);
                                                }
                                            ?>
                                        </span>
                                        <?php
                                            if($employee['clients_document']['dc_send_client']){
                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($employee['clients_document']['dc_send_client_date']).')</span>';
                                            }
                                        ?>
                                    </span>
                                    <?php if($employee['clients_document']['dc_receive_client']){ ?>
                                    <span class="resend">
                                    <button type-id="<?php echo base64_encode($employee['clients_document']['id']); ?>" type="button" data-type="dc" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                                    </span>
                                    <?php }?>

                                </div>
                            </td>
                            <td>
                                <label class="form-label">
                                    Sent to Client
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">
                                    <?php echo $this->Form->control('clients_document.dc_send_admin', array('class' => 'form-check-input persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.dc_send_admin_date', array('type'=>'hidden' , 'value' => $employee['clients_document']['dc_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                                    <?php
                                        if($employee['clients_document']['dc_send_admin']){
                                            echo $this->DateC->DateFormetforView($employee['clients_document']['dc_send_admin_date']);
                                        }
                                    ?>
                                    </span>
                                    <?php
                                        if($employee['clients_document']['dc_receive_client']){
                                            echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($employee['clients_document']['dc_receive_client_date']).')</span>';
                                        }
                                    ?>
                                    </span>
                                </div>
                            </td>
                        </tr>

                        <tr class="fw-semibold text-gray-800 border-bottom border-gray-200">
                            <td>
                                <label class="form-label">
                                    Medical:
                                </label>
                            </td>
                            <td>
                                <label class="form-label">
                                    Received by Daman
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">
                                    <?php
                                        echo $this->Form->control(
                                            'clients_document.medical_receive_admin',
                                            array(
                                                'class' => 'form-check-input persnal-doc-check',
                                                'label' => false,
                                                'type'=>'checkbox'
                                            )
                                        );
                                    ?>
                                    <?php echo $this->Form->input('clients_document.medical_receive_admin_date', array('type'=>'hidden' , 'value' => $employee['clients_document']['medical_receive_admin_date'] ));  ?><span class="documents_date"> <span class="date">
                                    <?php
                                        if($employee['clients_document']['medical_receive_admin']){
                                            echo $this->DateC->DateFormetforView($employee['clients_document']['medical_receive_admin_date']);
                                        }
                                    ?>
                                    </span>
                                    <?php
                                        if($employee['clients_document']['medical_send_client']){
                                            echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($employee['clients_document']['medical_send_client_date']) .')</span>';
                                        }
                                    ?>
                                    </span>
                                    <?php if($employee['clients_document']['medical_receive_client']){ ?>
                                    <span class="resend">
                                    <button type-id="<?php echo base64_encode($employee['clients_document']['id']); ?>" type="button" data-type="medical" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                                    </span>
                                    <?php }?>
                                </div>
                            </td>
                            <td>
                                <label class="form-label">
                                    Sent to Client
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">
                                    <?php echo $this->Form->control('clients_document.medical_send_admin',
                                     array('class' => 'form-check-input persnal-doc-check', 'label' => false, 'type'=>'checkbox'));  ?> <?php echo $this->Form->input('clients_document.medical_send_admin_date', array('type'=>'hidden' , 'value' => $employee['clients_document']['medical_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">
                                    <?php
                                        if($employee['clients_document']['medical_send_admin']){
                                            echo $this->DateC->DateFormetforView($employee['clients_document']['medical_send_admin_date']);
                                        }
                                    ?>
                                    </span>
                                        <?php
                                            if($employee['clients_document']['medical_receive_client']){
                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($employee['clients_document']['medical_receive_client_date']).')</span>';
                                            }
                                        ?>
                                    </span>

                                </div>
                            </td>
                        </tr>

                        <tr class="fw-semibold text-gray-800 border-bottom border-gray-200">
                            <td>
                                <label class="form-label">
                                    Other:
                                </label>
                            </td>
                            <td>
                                <label class="form-label">
                                    Received by Daman
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">
                                    <?php
                                        $class =  ($employee['clients_document']['other_receive_value'] != '') && $employee['clients_document']['other_receive_admin']  ? '' : 'other_doc' ;

                                        echo $this->Form->control(
                                            'clients_document.other_receive_admin',
                                            array(
                                                'class' => "form-check-input persnal-doc-check $class ",
                                                'label' => false,
                                                'type'=>'checkbox'
                                            )
                                        );
                                    ?>
                                    <?php
                                        echo $this->Form->input(
                                            'clients_document.other_receive_admin_date',
                                            array(
                                                'type' => 'hidden',
                                                'value' => $employee['clients_document']['other_receive_admin_date']
                                            )
                                        );
                                    ?>
                                    <span class="documents_date">
                                        <span class="date">
                                    <?php
                                        if($employee['clients_document']['other_receive_admin']){
                                            echo $this->DateC->DateFormetforView($employee['clients_document']['other_receive_admin_date']);
                                        }
                                    ?>
                                    </span>
                                    <?php
                                        if($employee['clients_document']['other_send_client']) {
                                            echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($employee['clients_document']['other_send_client_date']).')</span>';
                                        }
                                    ?>
                                    </span>
                                    <?php
                                        if(
                                            $employee['clients_document']['other_receive_value'] != ''
                                            && (
                                                $employee['clients_document']['other_send_client']
                                                || $employee['clients_document']['other_receive_admin']
                                            )
                                        ) {
                                    ?>
                                        <div  class="other-doc-parent form_block">
                                            <?php
                                                echo $this->Form->input(
                                                    'clients_document.other_receive_value',
                                                    array(
                                                        'class' => "form-control mb-2 input_field",
                                                        "style"=>"width: 90%; margin-top:10px;",
                                                        'required' => 'true',
                                                        'label' => false
                                                    )
                                                );
                                            ?>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <?php if($employee['clients_document']['other_receive_client']){ ?>
                                        <span class="resend">
                                        <button type-id="<?php echo base64_encode($employee['clients_document']['id']); ?>" type="button" data-type="other" class="btn btn-primary btn-xs re-set-doc">Receive again</button>
                                        </span>
                                    <?php }
                                    ?>
                                </div>
                            </td>
                            <td>
                                <label class="form-label">
                                    Sent to Client
                                </label>
                                </br>
                                <div class="form-check form-check-custom form-check-solid">

                                        <?php
                                        $class =  ($employee['clients_document']['other_send_admin'] != '') && $employee['clients_document']['other_send_admin'] ? '' : 'other_doc' ;

                                            echo $this->Form->control(
                                                'clients_document.other_send_admin',
                                                array(
                                                    'class' => "form-check-input persnal-doc-check $class",
                                                    'label' => false,
                                                    'type' => 'checkbox'
                                                )
                                            );
                                        ?>

                                        <?php echo $this->Form->input('clients_document.other_send_admin_date', array('type'=>'hidden' , 'value' => $employee['clients_document']['other_send_admin_date'] ));  ?> <span class="documents_date"> <span class="date">

                                        <?php
                                            if($employee['clients_document']['other_send_admin']){
                                                echo $this->DateC->DateFormetforView($employee['clients_document']['other_send_admin_date']);
                                            }
                                        ?>
                                        </span>
                                        <?php
                                            if($employee['clients_document']['other_receive_client']){
                                                echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($employee['clients_document']['other_receive_client_date']).')</span>' ;
                                            }
                                        ?>
                                        </span>
                                        <?php if($employee['clients_document']['other_send_value'] != '' && ($employee['clients_document']['other_receive_client'] || $employee['clients_document']['other_send_admin'] )){ ?>
                                        <div  class="other-doc-parent form_block">
                                            <?php
                                                echo $this->Form->input(
                                                    'clients_document.other_send_value',
                                                    array(
                                                        'class' => "form-control mb-2 input_field",
                                                        "style"=>"width: 90%; margin-top:10px;" ,
                                                        'required' => 'true',
                                                        'label' => false
                                                    )
                                                );
                                            ?>
                                        </div>
                                        <?php } ?>

                                </div>
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
               <!--begin::Input row-->
        <div class="row py-5">
            <!--begin::Input group-->
            <label class="form-label py-5">Attachment Files</label>
                <?php
                foreach($employee['documents'] as $ca){
                ?>
                <div style='float:left; text-align: center;' class='col-lg-2 attachments'>
                <h5 class='attachment_title'><?php echo $ca['aTitle']; ?></h5>
                <?php
                    if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>
                <a target="_blank" href="<?php echo Router::fullBaseUrl();?>/admin/employees/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo Router::fullBaseUrl();?>/attachments/center/img.png' style='width:100px;height:100px;'>
                <?php } else { ?>
                <a target="_blank" href="<?php echo Router::fullBaseUrl();?>/admin/employees/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo Router::fullBaseUrl();?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
                <?php }	?>
                <br>
                <a   href='<?php echo Router::fullBaseUrl()."/admin/employees/deleteEmployeeDocument/".base64_encode($ca->id);?>' onclick="javascript:return confirm('Are you sure you want to delete this, it cannot be undo?');" >Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' class='set_title' id='<?php echo base64_encode($ca->id); ?>' controller='<?php echo $controller; ?>' >Edit</a>

                <a  style='margin-left: 10px;'  href='<?php echo Router::fullBaseUrl()."/admin/employees/DownloadEmployeeDocument/".base64_encode($ca->id);?>' >Download</a>


                </div>
                <?php
                }
                ?>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <input
                    class="btn btn-primary"
                    style="height: 46px;
                    display: inline-block;font-size: 15px;color: #ffffff;text-transform: uppercase;font-weight: 900;border: none;border-radius: 3px;position: relative;"
                    type="button"
                    value="Generate PDF"
                    id="cmd"
                >
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <button style="float: right;" type="submit" id="submit" class="btn btn-primary">
                    <i class="far fa-save"></i>
                    <!--begin::Indicator label-->
                    <span class="indicator-label">Submit</span>
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
        <?php echo $this->Form->end(); ?>

    </div>
    <!--end::Card header-->
</div>
<script src="/jQuery-Picture-Cut-master/src/jquery.picture.cut.js"></script>
<?php $this->Html->script('admin/ajax_save_document',['block'=>'scriptBottom']); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

<script>
$(window).load(function () {
    $("select").select2();

    var dateFormat = "d/m/Y";

    flatpickr(".date_expiry", {
        dateFormat: dateFormat,
    });

    $("input.file").change(function () {
        var numFiles = $(this, this)[0].files.length;

        $(this)
            .parent()
            .siblings("span.count_image")
            .html(numFiles + " File Selected");
    });


    img = "<?php echo $employee['user_image'] ?>";

    if (img != 0) {
        $(".picture-element-image").attr(
            "src",
            "<?php echo Router::fullBaseUrl(); ?>/img/emp/<?php echo $employee['user_image']; ?>"
        );
    }

    var doc = new jsPDF();
    var specialElementHandlers = {
        "#editor": function (element, renderer) {
            return true;
        },
    };

    $("#cmd").click(function () {
        // getDataUri($(".picture-element-image").attr("src"), function (dataUri) {
            // logo = dataUri;
            //console.log(document.getElementsByClassName("picture-element-image"));return false;
            // doc.setFontSize(12);
            // doc.addImage(logo, "JPEG", 10, 15, 50, 50);

            doc.text(
                65,
                20,
                "PS Number:   " + $("input[name=ps_number]").val()
            );
            doc.text(
                65,
                30,
                "Company Name:   " +
                    $("select[name=company_id] option:selected").text()
            );
            doc.text(65, 40, "Employee Name:   " + $("input[name=name]").val());
            doc.text(65, 50, "Email:   " + $("input[name=email]").val());
            doc.text(
                65,
                60,
                "Gender:   " + $("select[name=gender] option:selected").val()
            );
            doc.text(
                10,
                72,
                "Nationality:   " +
                    $("select[name=nationality] option:selected").text()
            );
            doc.text(
                120,
                72,
                "Mobile No:   " + $("input[name=mobile_no]").val()
            );

            doc.text(
                10,
                80,
                "Employee Entity:   " + $("input[name=employee_entity]").val()
            );
            doc.text(
                120,
                80,
                "Passport No :   " + $("input[name=passport_no]").val()
            );

            doc.text(
                10,
                90,
                "Passport Expiry Date:   " +
                    $("input[name=passport_exp_date]").val()
            );
            doc.text(
                120,
                90,
                "Work Permit No:   " + $("input[name=work_permit_no]").val()
            );

            doc.text(
                10,
                100,
                "Work Permit Expiry Date:   " +
                    $("input[name=work_permit_exp_date]").val()
            );
            doc.text(
                120,
                100,
                "Entry Permit No:   " + $("input[name=entry_permit_no]").val()
            );

            doc.text(
                10,
                110,
                "Entry Permit Expiry Date:   " +
                    $("input[name=entry_permit_exp_date]").val()
            );
            doc.text(
                120,
                110,
                "Change Status Date:   " +
                    $("input[name=status_change_date]").val()
            );

            doc.text(10, 120, "VISA No.:   " + $("input[name=visa_no]").val());
            doc.text(
                120,
                120,
                "VISA Expiry Date:   " + $("input[name=visa_exp_date]").val()
            );

            doc.text(
                10,
                130,
                "Emirates ID No:   " + $("input[name=emiratesID_no]").val()
            );
            doc.text(
                120,
                130,
                "Emirates ID Expiry Date:   " +
                    $("input[name=emiratesID_exp_date]").val()
            );

            doc.text(
                10,
                140,
                "Emirates ID No :   " + $("input[name=emiratesID_no]").val()
            );
            doc.text(
                120,
                140,
                "Emirates ID Expiry Date:   " +
                    $("input[name=emiratesID_exp_date]").val()
            );

            doc.text(
                10,
                150,
                "Basic Salary :   " + $("input[name=s_basic]").val()
            );
            doc.text(
                120,
                150,
                "Accommodation :   " + $("input[name=accomodation]").val()
            );

            doc.text(
                10,
                160,
                "Transportion:   " + $("input[name=transportion]").val()
            );
            doc.text(120, 160, "Others :   " + $("input[name=others]").val());

            doc.text(
                10,
                170,
                "Labor Card No.:   " + $("input[name=labor_card_no]").val()
            );
            doc.text(
                120,
                170,
                "Labor Card Expiry Date :   " +
                    $("input[name=labor_card_exp_date]").val()
            );
            doc.text(
                10,
                180,
                "Health Care Card No.:   " +
                    $("input[name=health_card_no]").val()
            );
            doc.text(
                120,
                180,
                "Health Care Card Expiry Date:   " +
                    $("input[name=health_card_exp_date]").val()
            );

            doc.save("profile-" + $("input[name=name]").val() + ".pdf");
        // });
    });

    function getDataUri(url, cb) {
        var image = new Image();
        image.setAttribute("crossOrigin", "anonymous"); //getting images from external domain

        image.onload = function () {
            var canvas = document.createElement("canvas");
            canvas.width = this.naturalWidth;
            canvas.height = this.naturalHeight;

            //next three lines for white background in case png has a transparent background
            var ctx = canvas.getContext("2d");
            ctx.fillStyle = "#fff"; /// set white fill style
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            canvas.getContext("2d").drawImage(this, 0, 0);

            cb(canvas.toDataURL("image/jpeg"));
        };

        image.src = url;
    }

    // $(".person_documents input").change(function () {
    //     if (this.checked) {
    //         //console.log($(this).parent().parent().children('.documents_date').children('.date').html());
    //         $(this)
    //             .parent()
    //             .parent()
    //             .children(".documents_date")
    //             .children(".date")
    //             .html(formatDate(new Date()));
    //         date = new Date();
    //         $("input#" + $(this).attr("id") + "-date").val(
    //             date.getDate() +
    //                 "/" +
    //                 (date.getMonth() + 1) +
    //                 "/" +
    //                 date.getFullYear()
    //         );
    //     } else {
    //         $('input[name="' + $(this).attr("name") + '_date"]').val("");
    //         $(this)
    //             .parent()
    //             .parent()
    //             .children(".documents_date")
    //             .children(".date")
    //             .html("");
    //     }
    // });

    $(".person_documents input").change(function() {
            let element = $(this).parent().parent().children('span.documents_date').children('span.date');
            let elementName = $(this).attr('name');
            let elementNameLength = elementName.length;
            let hiddenElementName = elementName.substring(0, elementNameLength-1) + "_date" + elementName.substring(elementNameLength-1);
			if(this.checked) {
                // console.log($('input:hidden[name="clients_document[mc_receive_admin_date]"]').val('test'))
				//console.log($(this).parent().parent().children('.documents_date').children('.date').html());
				element.html(formatDate(new Date()));
				date = new Date()
				$('input:hidden[name="'+hiddenElementName+'"]').val(date.getDate()+'/'+ (date.getMonth()+1) +'/'+ date.getFullYear());
			}else{
                // $(this).attr('checked', false)
				$('input:hidden[name="'+hiddenElementName+'"]').val('');
                element.empty();
			}
		});

    /*$(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });*/

    function formatDate(date) {
        var monthNames = [
            "Jan",
            "Feb",
            "March",
            "April",
            "May",
            "June",
            "July",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();
        return day + " " + monthNames[monthIndex] + " " + year;
    }

    $(".other_doc").change(function () {
        if (this.checked) {
            var name = $(this).attr("name");
            name = name.replace("_admin", "_value");
            $(this)
                .parent()
                .parent()
                .parent("td")
                .append(
                    '<div  class="other-doc-parent form_block"><input  name="' +
                        name +
                        '" type="text"  class="input_field form-control mb-2" style="width: 90%; margin-top:10px" required /></div>'
                );
        } else {
            $(this)
                .parent()
                .parent()
                .parent()
                .children(".other-doc-parent")
                .remove();
        }
    });
    //$('#passport-exp-date-cus').attr('readonly' , 'true');

    $(".re-set-doc").click(function () {
        type_id = $(this).attr("type-id");
        data_type = $(this).attr("data-type");
        data = { type_id: type_id, data_type: data_type };

        $.ajax({
            url: webroot + "/admin/employees/re_set",
            data: data,
            cache: false,
            type: "POST",
            context: this,
            success: function (html) {
                html = JSON.parse(html);
                if (html.status == true) {
                    if (data_type == "other") {
                        $(this)
                            .parent()
                            .parent("td")
                            .parent("tr")
                            .find(".input_field")
                            .remove();
                    }
                    $(this)
                        .parent()
                        .parent("td")
                        .next()
                        .children(".documents_date")
                        .children()
                        .html("");
                    $(this)
                        .parent()
                        .siblings(".documents_date")
                        .children()
                        .html("");
                    $("#clients-document-" + data_type + "-send-admin").attr(
                        "checked",
                        false
                    );
                    $("#clients-document-" + data_type + "-receive-admin").attr(
                        "checked",
                        false
                    );
                    $(
                        "#clients-document-" + data_type + "-send-admin-date"
                    ).val("");
                    $(
                        "#clients-document-" + data_type + "-receive-admin-date"
                    ).val("");
                    $(this)
                        .parent()
                        .parent("td")
                        .next()
                        .children(".documents_date")
                        .children()
                        .html("");
                    $(this).parent().remove();

                    $(
                        "#clients-document-" + data_type + "-receive-admin"
                    ).trigger("click");
                }
            },
        });
    });

    var inputs = $("form input, form select , form textarea");
    $("#submit").click(function (event) {
        var i = 0;
        var flag = true;
        event.preventDefault();
        inputs.each(function (index) {
            var input = $(this);
            //console.log(input[0].type.required);
            if (
                (!input.val() &&
                    input[0].required &&
                    input[0].type != "hidden") ||
                (input[0].type === "radio" && !input[0].type.is(":checked"))
            ) {
                $(this).css("border", "1px solid red");
                //console.log(input[0]);
                if (i == 0) {
                    flag = false;
                    window.scrollTo("#" + $(this).attr("id"), 200);
                }
                i++;
                //validForm = false;
            } else {
                $(this).css("border", "1px solid rgba(0,0,0,.15)");
            }
        });

        if (flag) {
            var data = new FormData($("form#fileupload")[0]);
            console.log($(this).html());
            const o = document.getElementById("submit");
            o.setAttribute("data-kt-indicator", "on")

            $.ajax({
                url: $("form").attr("action"),
                type: "POST",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                context: this,
                success: function (result) {
                    o.removeAttribute("data-kt-indicator")

                    var result = JSON.parse(result);
                    if (result.status) {
                        toastr.success(result.message);

                        setTimeout(function () {
                            //window.location.href = document.referrer == '' ? result.url : window.history.back();
                            if (document.referrer == "") {
                                console.log("heree");
                                window.location.href = result.url;
                            } else {
                                console.log("heree22");
                                window.history.back();
                            }
                        }, 2000);
                    } else {
                        toastr.error(result.message);
                        //window.location.href =result.url;
                    }
                },
            });
        }
    });

    jQuery.fn.scrollTo = function (elem, speed) {
        $(this).animate(
            {
                scrollTop:
                    $(this).scrollTop() -
                    $(this).offset().top +
                    $(elem).offset().top,
            },
            speed == undefined ? 1000 : speed
        );
        return this;
    };
});

</script>
