<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Add Employee</h2>
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
                        'url'=>'/admin/employees/add/dependent'
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
                <label class="required form-label">Mobile No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('mobile_no', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
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
                        onclick='javascript:$("#visa-files").trigger("click");'
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

                    <button class="btn btn-primary" type='button'
                        onclick='javascript:$("#id-files").trigger("click");'
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
                        onclick='javascript:$("#lcard-files").trigger("click");'
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
                        onclick='javascript:$("#hcard-files").trigger("click");'
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
                        onclick='javascript:$("#other-files").trigger("click");'
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
                        <input value='1' name="passport_receive_admin" type="checkbox" class="form-check-input" />
                        <input  name="passport_receive_admin_date" type="hidden"  class="form-check-input" />
                    </div>
                </td>
                <td>
                    <label class="form-label">
                        Sent to Client
                    </label>
                </br>
                <div class="form-check form-check-custom form-check-solid">
                    <input  value='1' name="passport_send_admin" type="checkbox" class="form-check-input" />
                    <input  name="passport_send_admin_date" type="hidden"  class="form-check-input" />
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
                        <input  value='1' name="bc_receive_admin" type="checkbox"  class="form-check-input" />
                        <input  name="bc_receive_admin_date" type="hidden"  class="form-check-input" />
                    </div>
                </td>
                <td>
                    <label class="form-label">
                        Sent to Client
                    </label>
                    </br>
                    <div class="form-check form-check-custom form-check-solid">
                        <input  value='1' name="bc_send_admin" type="checkbox" class="form-check-input" />
                        <input  name="bc_send_admin_date" type="hidden"  class="form-check-input" />
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
                        <input  value='1' name="mc_receive_admin" type="checkbox"  class="form-check-input" />
                        <input  name="mc_receive_admin_date" type="hidden"  class="form-check-input" />
                    </div>
                </td>
                <td>
                    <label class="form-label">
                        Sent to Client
                    </label>
                    </br>
                    <div class="form-check form-check-custom form-check-solid">
                        <input  value='1' name="mc_send_admin" type="checkbox" class="form-check-input" />
                        <input  name="mc_send_admin_date" type="hidden"  class="form-check-input" />
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
                        <input  value='1' name="eid_receive_admin" type="checkbox"  class="form-check-input" />
                        <input  name="eid_receive_admin_date" type="hidden"  class="form-check-input" />
                    </div>
                </td>
                <td>
                    Sent to Client
                </br>
                    <div class="form-check form-check-custom form-check-solid">
                        <input  value='1' name="eid_send_admin" type="checkbox" class="form-check-input" />
                        <input  name="eid_send_admin_date" type="hidden"  class="form-check-input" />
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
                        <input  value='1' name="dc_receive_admin" type="checkbox"  class="form-check-input" />
                        <input  name="dc_receive_admin_date" type="hidden"  class="form-check-input" />
                    </div>
                </td>
                <td>
                    <label class="form-label">
                        Sent to Client
                    </label>
                    </br>
                    <div class="form-check form-check-custom form-check-solid">
                        <input  value='1' name="dc_send_admin" type="checkbox" class="form-check-input" />
                        <input  name="dc_send_admin_date" type="hidden"  class="form-check-input" />
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
                        <input style="opacity: 1; margin-left: 0px;  position: relative;" value='1' name="medical_receive_admin" type="checkbox"  class="form-check-input" />
                        <input  name="medical_receive_admin_date" type="hidden"  class="form-check-input" />
                    </div>
                </td>
                <td>
                    <label class="form-label">
                        Sent to Client
                    </label>
                    </br>
                    <div class="form-check form-check-custom form-check-solid">
                        <input  value='1' name="medical_send_admin" type="checkbox" class="form-check-input" />
                        <input  name="medical_send_admin_date" type="hidden"  class="form-check-input" />
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
                        <input  value='1' name="other_receive_admin"  type="checkbox"  class="other_doc form-check-input" />
                        <input  name="other_receive_admin_date" type="hidden"  class="form-check-input" />
                    </div>
                </td>
                <td>
                    <label class="form-label">
                        Sent to Client
                    </label>
                    </br>
                    <div class="form-check form-check-custom form-check-solid">
                        <input  value='1' name="other_send_admin"  type="checkbox" class="other_doc form-check-input" />
                        <input  name="other_send_admin_date" type="hidden"  class="form-check-input" />
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
        <!--end::Input row-->
        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">

            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <button style="float: right;" type="submit" id="submit" class="btn btn-primary">
                    <i class="far fa-save"></i>
                    <!--begin::Indicator label-->
                    <span class="indicator-label">Next</span>
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

<?php echo $this->Html->script('admin/employee/employee_add_form', ['block'=>'scriptBottom']); ?>
