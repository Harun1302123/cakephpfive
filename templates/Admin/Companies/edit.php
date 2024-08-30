<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Edit Company</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <?php

use Cake\Routing\Router;

            echo $this->Form->create(
                $company,
                array(
                        'id' => 'fileupload',
                        'class' => 'form-horizontal form-request check-form add-property {is_required:"false"}  js-normal-fileupload',
                        'enctype' => 'multipart/form-data'
                    )
            );
        ?>

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Company Name</label>
                <!--end::Label-->
                <!--begin::Input-->
                <!-- <input type="text" class="form-control mb-2" value=""> -->
                <?php echo $this->Form->input('name', array('type' => 'text', 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Trade License Number</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('trade_license_no', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));?>
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
                <label class="required form-label">Trade License Issue Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('trade_license_issue_date', array('required' => 'required', 'class' => 'form-control mb-2'  , 'label' => false, 'id'=>'trade_lic_issue_date'));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Trade License Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('trade_license_expiry_date', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false,'id'=>'trade_lic_expire_date'));  ?>
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
                <label class="required form-label">Immigration Card Number</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('immigration_card_no', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Immigration Card Issue Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('immigration_card_issue_date', array('required' => 'required', 'class' => 'form-control mb-2', 'placeholder'=>'dd/mm/yy' ,  'label' => false,'id'=>'immigra_card_issue_date'));  ?>
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
                <label class="required form-label">Immigration Card Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('immigration_card_expiry_date', array('required' => 'required', 'class' => 'form-control mb-2', 'placeholder'=>'dd/mm/yy' , 'label' => false,'id'=>'immigra_card_expiry_date'));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Establishment Card No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('estblishment_card_no', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
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
                <label class="required form-label">Dubai Chamber No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('dubai_chember_no', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Dubai Chamber Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('dubai_chember_expiry_date', array('required' => 'required', 'class' => 'form-control mb-2' , 'placeholder'=>'dd/mm/yy' , 'label' => false,'id'=>'dubai_chamber_expire_date'));  ?>
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
                <label class="required form-label">Ejari Contract Start Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('contract_start_date', array('required' => 'required', 'class' => 'form-control mb-2' , 'placeholder'=>'dd/mm/yy' ,  'label' => false,'id'=>'contract_start_date'));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Ejari Contract End Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('contract_end_date', array('required' => 'required', 'class' => 'form-control mb-2' , 'placeholder'=>'dd/mm/yy'  , 'label' => false,'id'=>'contract_end_date'));  ?>
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
                <label class="required form-label">MOE Certificate No</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('moe_certificate', array('required' => 'required', 'class' => 'form-control mb-2'  , 'label' => false,'id'=>'moe_certificate'));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">MOE Certificate Expiry Date</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('moe_end_date', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false  ,'id'=>'moe_end_date'));  ?>
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
                <label class="required form-label">Responsible Person</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('responsible_person', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false,'id'=>'responsible_person'));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">CC e-mails:</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('cc_emails', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

         <!--begin::Input row-->
        <div class="row py-5">
            <!--begin::Input group-->
            <label class="form-label py-5">Attachment Files</label>
                <?php //pr($center['center_attachments']);die;
                foreach($company['documents'] as $ca){
                    ?>
                    <div style='float:left;' class='col-lg-2 attachments'>
                    <h6 class='attachment_title'><?php echo $ca['aTitle']; ?></h6>
                    <?php
                    if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>
                        <a target="_blank" href="<?php echo Router::fullBaseUrl();?>/admin/companies/files/<?php echo base64_encode($ca->id); ?>">
                        <img src='<?php echo Router::fullBaseUrl();?>/attachments/center/img.png' style='width:100px;height:100px;'>
                        </a>

                    <?php } else { ?>
                        <a target="_blank" href="<?php echo Router::fullBaseUrl();?>/admin/companies/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo Router::fullBaseUrl();?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
                        <?php }	?>
                        <br>
                        <a href='<?php echo Router::fullBaseUrl()."/admin/Companies/deleteComapnyDocument/".base64_encode($ca->id);?>' onclick="javascript:return confirm('Are you sure you want to delete this, it cannot be undo?');" >Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href='#' class='set_title' id='<?php echo base64_encode($ca->id); ?>' controller='<?php echo $controller; ?>' >Edit</a>
                    </div>
                    <?php
                }?>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--<label>Files</label>-->
                <!--<label>Files</label>-->
                <?php
                    echo $this->Form->input(
                        'files[]',
                        array(
                            'id' => 'files',
                            'style'=>'display:none;',
                            'type' => 'file',
                            'multiple'=>'multiple',
                            'label' => false,
                            'class' => 'form-control mb-2'
                        )
                    );

                ?>
                <button class="btn btn-primary" type='button' onclick='javascript:$("#files").trigger("click");' style='float:left;margin-left: 0px;'>
                    <i class="fas fa-paperclip"></i>
                        <span id="count_image" class="indicator-label">Add More Files</span>
                </button>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <button style="float: right;" type="submit" id="submit" class="btn btn-primary">
                    <i class="far fa-save"></i>
                    <!--begin::Indicator label-->
                    <span class="indicator-label">Save Changes</span>
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

<!-- /.content-wrapper -->
<?php $this->Html->script('admin/ajax_save_document',['block'=>'scriptBottom']); ?>
<?php echo $this->Html->script('admin/check_issue_and_expiry.js', ['block'=>'scriptBottom']); ?>
