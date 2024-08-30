<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2><i style="font-size: 20px;" class="fa fa-user"></i> Add Role</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <?php
            echo $this->Form->create(
                $user_role,
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
                <label class="required form-label">Role Name</label>
                <!--end::Label-->
                <!--begin::Input-->
                <!-- <input type="text" class="form-control mb-2" value=""> -->
                <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Role View</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->input('role_view', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'], 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));?>
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
                <label class="required form-label">Role Add</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('role_add', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'], 'required' => 'required', 'class' => 'form-control mb-2'  , 'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Role Edit</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('role_edit', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'], 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
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
                <label class="required form-label">Role Delete</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('role_del', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'],  'required' => 'required', 'class' => 'form-control mb-2',  'label' => false));  ?>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row w-100 flex-md-root">
                <!--begin::Label-->
                <label class="required form-label">Role RPT</label>
                <!--end::Label-->
                <!--begin::Input-->
                <?php echo $this->Form->text('role_rpt', array('type' => 'select', 'options'=>['1'=>'Yes','2'=>'No'], 'required' => 'required', 'class' => 'form-control mb-2', 'label' => false));  ?>
                <!--end::Input-->
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
