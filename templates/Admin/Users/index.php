<?php echo $this->element('admin/tabular/title', ['title' => 'Manage Users', 'faClass' => "fa fa-building"]); ?>

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
                <a href="<?php  echo $this->request->getAttribute('webroot');  ?>admin/users/add" class="btn btn-primary">
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
                                <?php echo $this->Paginator->sort('username', 'User Name'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Role: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('fullName', 'Name'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Role: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('email', 'Email'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                    <?php echo $this->Paginator->sort('mobile', 'Mobile No');?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Joined Date: activate to sort column ascending"
                                style="width: 211.086px;">
                                    <?php echo $this->Paginator->sort('created', 'Created');?>
                            </th>
                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                aria-label="Actions" style="width: 130.547px; color: #181c32" >
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
                            if (!$users->isEmpty()) {
                                foreach ($users as $user) {
                                    if ($number % 2 === 0) {
                                        $class = "even";
                                    } else {
                                        $class = "odd";
                                    }
                        ?>
                        <!--end::Table row-->
                        <tr class="TrClass_<?php echo $user->id; ?>">
                            <!--begin::User=-->
                            <td>
                                <!--begin::User details-->
                                <?php echo $user ? $user->Username : null;?>
                                <!--begin::User details-->
                            </td>
                            <!--end::User=-->
                            <!--begin::Role=-->
                            <td><?php echo $user->fullName; ?></td>
                            <!--end::Role=-->
                            <td><?php echo $user->email; ?></td>
                            <!--begin::Joined-->
                            <td><?php echo $user->mobile; ?></td>
                            <td>
                                <?php
                                    if (isset($user['created'])) {
                                        echo date('j F,Y', strtotime($user['created']));
                                    }
                                ?>
                            </td>
                            <!--begin::Joined-->
                            <!--begin::Action=-->
                            <td class="text-end">
                                    <?php
                                        $changePassword = '<a data-bs-toggle="modal"  data-attach-cmpny="'.base64_encode($user->id).'" data-id="'.$user->id.'"
                                                class="userpasswordChange btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" href="javascript:void(0)">
                                                <span class="svg-icon svg-icon-3">
                                                <?xml version="1.0" encoding="iso-8859-1"?>
                                                <!-- Generator: Adobe Illustrator 18.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 240.035 240.035" style="enable-background:new 0 0 240.035 240.035;" xml:space="preserve">
                                                <g>
                                                    <path d="M234.035,99.261H102.667c-8.117-19.182-27.13-32.676-49.235-32.676C23.97,66.585,0,90.555,0,120.018
                                                        s23.97,53.432,53.433,53.432c21.369,0,39.84-12.615,48.38-30.785l8.94,9.633c2.368,2.552,6.406,2.552,8.775,0l10.412-11.218
                                                        l10.412,11.218c2.368,2.552,6.406,2.552,8.775,0l10.412-11.218l10.412,11.218c2.368,2.552,6.406,2.552,8.775,0l10.412-11.218
                                                        l10.412,11.218c2.368,2.552,6.406,2.552,8.775,0l10.695-11.523h0.692c11.208,0,20.326-9.118,20.326-20.326v-15.187
                                                        C240.035,101.948,237.349,99.261,234.035,99.261z M53.433,161.45C30.587,161.45,12,142.863,12,120.018s18.587-41.432,41.433-41.432
                                                        s41.432,18.586,41.432,41.432S76.278,161.45,53.433,161.45z M228.035,120.448c0,4.591-3.735,8.326-8.326,8.326H106.135
                                                        c0.472-2.851,0.729-5.774,0.729-8.756s-0.257-5.905-0.729-8.756h121.9V120.448z"/>
                                                    <path d="M41.718,102.105c-9.877,0-17.912,8.035-17.912,17.912s8.035,17.912,17.912,17.912s17.912-8.035,17.912-17.912
                                                        S51.595,102.105,41.718,102.105z M41.718,125.93c-3.26,0-5.912-2.652-5.912-5.912s2.652-5.912,5.912-5.912s5.912,2.652,5.912,5.912
                                                        S44.978,125.93,41.718,125.93z"/>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                </svg>

                                                </span>
                                            </a>';


                                        echo $changePassword. ' ';

                                        echo $this->element(
                                                'admin/tabular/actions',
                                                [
                                                    'editLink' => 'admin/users/edit/',
                                                    'deleteLink' => '/admin/users/delete/',
                                                    'isAttachement' => false,
                                                    'id' => $user->id
                                                ]
                                            );


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

<div class="modal fade" tabindex="-1" id="ChangePasswordOfUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Please put new password for user <b class="paswordusername"></b></h3>

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
                                <input type="password" class="form-control" placeholder="New Password" id='newPassworduser' name='password' aria-label="NewPassword" aria-describedby="basic-addon1"/>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon1"></span>
                                <input type="password" class="form-control" placeholder="Confirm Password" id='confirmPassword' name='password' aria-label="ConfirmPassword" aria-describedby="basic-addon1"/>
                            </div>
                            <!--end::Input group-->

                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-success btn_suss"
                                    id="userPasswordsubmit"
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
	data_id = 0;
	$(document).on('click','.userpasswordChange', function () {
		data_id = $(this).attr('data-id');
		$('.paswordusername').html($('tr.TrClass_'+data_id+' td:eq(1)').text());
		$('#ChangePasswordOfUser').modal('show');
	});

	$(document).on('click','#userPasswordsubmit' ,  function () {
		if(($('#newPassworduser').val() == $('#confirmPassword').val()) && ($('#newPassworduser').val() != '') && ($('#confirmPassword').val() != '') ){
			data = {
				'id' 				: data_id,
				'password' 			: $('#newPassworduser').val(),
			};
			$.ajax({
				url: webroot + "/admin/users/ChangeUserPassword",
				cache: false,
				type:'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
				data: data,
				success: function(data){
					console.log(data);
					if(data == 1){
						$('#ChangePasswordOfUser').modal('hide');
						$('tr.TrClass_'+data_id+' td:eq(5) a i').removeClass('fa fa-key').addClass('fa fa-check');
						//$('tr.TrClass_'+data_id+' td:eq(5) a i').animate({height: '100'});
					}
				}

			});
		}else{
			$('#newPassworduser').css('border','1px solid red');
			$('#confirmPassword').css('border','1px solid red');
		}

		console.log(data);
	});

</script>
