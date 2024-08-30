<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1"><?= date('Y'); ?></span>
            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Daman</a>
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Footer container-->
</div>



<div class="modal fade" tabindex="-1" id="viewProfile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">View Profile</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                <div class="card mb-5 mb-xl-10">
                    <div style="align-self: center;" class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <?php
                                if(empty($this->request->getSession()->read('Auth.User.image'))){
                                    echo $this->Html->image('admin/user2-160x160.jpg');
                                } else {
                                    echo $this->Html->image('admin/'.$this->request->getSession()->read('Auth.User.image'),['class'=>'img-circle','style'=>'width:200px;']);
                                }
                            ?>
                            <div
                                class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                            </div>
                        </div>
                    </div>
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Row-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted">#ID</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span
                                    class="fw-bold fs-6 text-gray-800"><?php echo $this->request->getSession()->read('Auth.User.id');?></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted">UserName</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span
                                    class="fw-semibold text-gray-800 fs-6"><?php echo $this->request->getSession()->read('Auth.User.Username');?></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted">Created At</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <a href="#"
                                    class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?php echo date('j F, Y',strtotime($this->request->getSession()->read('Auth.User.created')));?></a>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted">Modified At</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span
                                    class="fw-bold fs-6 text-gray-800"><?php echo date('j F, Y',strtotime($this->request->getSession()->read('Auth.User.modified')));?></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="ChangeImage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Change Image</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="card mb-5 mb-xl-10">
                    <div style="align-self: center;" class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <?php
                                echo $this->Form->create(
                                    null,
                                    [
                                        'url'=>'/admin/Users/changeImage',
                                        'enctype'=>'multipart/form-data',
                                        'id'=>'formImage',
                                    ]
                                );
                            ?>
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                                <?php
                                if(empty($this->request->getSession()->read('Auth.User.image'))){
                                    $path = '/img/admin/user2-160x160.jpg';
								} else {
                                    $path = '/img/admin/'.$this->request->getSession()->read('Auth.User.image');
								}
                               ?>
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url(<?php echo $path ?>)"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>

                                    <!--begin::Inputs-->

                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <button style="margin-left: 20px;" type="submit" class="btn btn-warning"
                                    id="login-submit" onclick='javascript:$("#formImage").submit();'>
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Submit</span>
                                    <!--end::Indicator label-->
                                </button>
                                <!--begin::Cancel button-->
                                <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel button-->

                            </div>
                            <!--end::Image input-->
                            <?php

								echo $this->Form->end();
						    ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="ChangePassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Change Password</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                <div class="card mb-5 mb-xl-10">
                    <div style="align-self: center;" class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <!--begin::Input group-->
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon1"></span>
                                <input type="password" class="form-control" placeholder="Old Password" name='password' id='oldPassword' aria-label="OldPassword" aria-describedby="basic-addon1"/>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon1"></span>
                                <input type="password" class="form-control" placeholder="New Password" name='password' id='newPassword' aria-label="NewPassword" aria-describedby="basic-addon1"/>
                            </div>
                            <!--end::Input group-->

                            <div class="form-group" style="text-align: center;">
                                <button ng-click="changePass();" type="button" class="btn btn-success btn_suss"
                                    id="login-submit"
                                    style="background-color: #E7AB35 ! important; border: medium none #E7AB35;">Submit</button>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    var app = angular.module('myApp', []);
    app.controller('changePass', function ($scope, $http) {
        //$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
        $scope.changePass = function () {
            //var base_url = "<?php echo BASE_URL;?>";

            $http({
                    url: '/admin/Users/changePassword',
                    method: "POST",
                    data: {
                        'password': $scope.newPassword,
                        'old_password': $scope.oldPassword
                    }
                })
                .then(function (response) {
                        // success
                        //console.log(response.data);
                        if (response.data == 1) {
                            $scope.color = 'green';
                            $scope.message = 'Password changed successfully';
                            setTimeout(function () {
                                $('#ChangePassword').modal('hide');
                            }, 1500);
                        } else if (response.data == 2) {
                            $scope.color = 'red';
                            $scope.message = 'Current password incorrect!';
                        } else {
                            $scope.color = 'red';
                            $scope.message = 'Unable to update password, please try again';
                        }
                    },
                    function (response) {
                        // failed
                        $scope.color = 'red';
                        $scope.message = 'Unable to update password, please try again';
                    });
        }

    });
    /*angular.bootstrap(document.getElementById("ChangePassword"), ['myApp']);*/

</script>
