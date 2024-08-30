<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2><i style="font-size: 20px;" class="fa fa-user"></i> Edit User</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <?php
            echo $this->Form->create(
                $user,
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
                <label class="required form-label">Select User Role</label>
                <!--end::Label-->
                <!--begin::Input-->
                <!-- <input type="text" class="form-control mb-2" value=""> -->
                <?php echo $this->Form->input('user_role_id', array('type' => 'select', 'options'=> $user_roles, 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Username</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('Username', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));?>
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
                <label class="required form-label">Name</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('fullName', array('required' => 'required', 'class' => 'form-control mb-2'  , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Email Address</label>
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
                <label class="required form-label">Mobile</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('mobile', array('required' => 'required', 'class' => 'form-control mb-2',  'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Status</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('status', array('type' => 'select', 'options' => $status, 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
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
                <label class="required form-label">Recieve Alert</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('recieve_alert', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
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
        <div class="d-flex flex-wrap gap-5">
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--<label>Files</label>-->
                <!--<label>Files</label>-->
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
