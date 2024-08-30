<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Edit Record</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <?php
            echo $this->Form->create(
                $alert,
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
                <label class="required form-label">Alert for</label>
                <!--end::Label-->
                <!--begin::Input-->
                <!-- <input type="text" class="form-control mb-2" value=""> -->
                <?php echo $this->Form->input('alert_type_id', array('type' => 'select', 'options' => $alert_types,'required' => 'required',  'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap py-5 gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Alert Message for Employee</label>
                <!--end::Label-->
                <!--begin::Input-->
                <b> _employee_name, _passport_expiry ,  _visa_exp_date</b>

                <?php echo $this->Form->textarea('alert_text_emp', array('cols'=>"80", 'rows' =>"10", 'type' => 'select', 'options' => $alert_types, 'id' => 'alert_text_emp' , 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

        <!--begin::Input row-->
        <div class="d-flex flex-wrap py-5 gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Alert Message for Dependent</label>
                <!--end::Label-->
                <!--begin::Input-->
                <b> _employee_name, _dep_name, _passport_expiry ,  _visa_exp_date</b>
                <?php echo $this->Form->textarea('alert_text_dep', array('cols'=>"80", 'rows' =>"10",  'type' => 'select', 'options' => $alert_types, 'id' => 'alert_text_dep' , 'required' => 'required', 'style' => 'height: 200px;', 'class' => 'form-control mb-2', 'label' => false));  ?>
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
                <label class="required form-label">Delivery</label>
                <!--end::Label-->

                <div class="form-check form-check-custom form-check-solid">
                    <input name="delivery" class="form-check-input" type="radio" value="0" id="flexRadioChecked" checked="checked" />
                    <label class="form-check-label" for="flexRadioChecked">
                        schedule
                    </label>
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
                <!--begin::Label-->
                <label class="required form-label">Schedule</label>
                <!--end::Label-->
                <?php echo $this->Form->input('schdulecount', array('type'=>'number', 'min'=>0, 'value'=>0, 'class' => 'form-control mb-2', 'label' => false));  ?>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input row-->

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

<?php echo $this->Html->script('admin/save_alert',['block'=>'scriptBottom']); ?>
 <script>
$(document).ready(function(){
	CKEDITOR.replace('alert_text_dep');
	CKEDITOR.replace('alert_text_emp');
});
 </script>
