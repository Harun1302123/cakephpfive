<style>
	.isdeleted{
		white-space: nowrap;
		padding: 5px 10px;
		margin: 0 3px;
		font-size: 13px;
		color: #fff!important;
		font-weight: 600;
		background: #a94242;
		border-radius: 3px;
	}
	.table_listing .download_report{
		margin: 0 3px 5px;
		display: inline-block;
	}
	.cus{
		font-size: small;
	}
</style>
<div class="content-wrapper">
<?php echo  $this->Flash->render();?>
    <!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <h2 class="global_title"><i class="fa fa-building-o"></i> Manage user</h2>
   <div class="main_info_sec">
	   <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
		   <div class="col-lg-12">
			   <a href="<?php echo BASE_URL; ?>/admin/users/add" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
		   </div>
	   </div>
		<style>
		   .text-center.overlape {
					position: absolute;
					width: 100%;
					z-index: 9999;
					left: 0;
					top: 39%;
			}
		   .table_listing{
			   position:relative;}
	   </style>

            <!-- Table -->

	<div class="table_listing rep_content">
		<div class="text-center overlape" id="loader" style="display:none">
		   <img src ="/img/loading.gif" width="60px" height="60px">
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>

						<th align='left'><?php echo $this->Paginator->sort('username', 'User Name');?></th>
						<th align='left'><?php echo $this->Paginator->sort('fullName', 'Name');?></th>
						<th align='left'><?php echo $this->Paginator->sort('email', 'Email');?></th>
						<th align='left'><?php echo $this->Paginator->sort('mobile', 'Mobile No');?></th>
						<th align='left'><?php echo $this->Paginator->sort('created', 'Created');?></th>
						<th align='left'>Action</th>
					</tr>
					<?php
					//pr($user);
					if($users){
							foreach($users as $user){
						?>
						<tr class="TrClass_<?php echo $user->id; ?>">

							<td><?php echo $user['Username'];?></td>
							<td><?php echo $user['fullName'];?></td>
							<td><?php echo $user['email'];?></td>
							<td><?php echo $user['mobile'];?></td>
							<td><?php echo date('j F,Y',strtotime($user['created']));?></td>
							<td>
							<?php

								$edit = '<a href="'.BASE_URL.'/admin/users/edit/'.base64_encode($user->id).'">
								<i class="fa fa-edit" title="Edit"></i></a>';

								$delete = '<a href="'.BASE_URL.'/admin/users/delete/'.base64_encode($user->id).'" onclick="return confirm('."'Are you sure you want to delete?'".');">
								<i class="fa fa-remove" title="Delete" ></i></a>';

								$passwordChange = '<a data-id="'.$user->id.'" data-toggle="modal" class="userpasswordChange" >
								<i class="fa fa-key" aria-hidden="true"></i></a>';
								//ChangePasswordOfUser
								echo $passwordChange.' '.$edit.'  '.$delete;
							?>
							</td>
						</tr>
						<?php }		}else{ ?>
					   <tr><td colspan="6" class="no_record">No Record Found</td></tr>
					  <?php } ?>
				</thead>
			</table>
		</div>
		<div class="table_page_info">
			<div class="row">
				<div class="col-lg-5 col-sm-5 col-xs-12">
					<p>
						<?php echo $this->Paginator->counter('Showing {{start}} to {{end}} of {{count}}');?>
					</p>
				</div>

				<div class="col-lg-7 col-sm-7 col-xs-12">
					<ul class="pagination">
					<?php echo $this->Paginator->prev('  ' . __('Previous'));?>
					  <?php echo $this->Paginator->numbers();?>
					  <?php echo $this->Paginator->next('  ' . __('Next'));?>
					</ul>
				</div>
			</div>
		</div>
	</div>
        </div>
    </section>

    <div id="ChangePasswordOfUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-app="myApp" ng-controller="changePass">
    <div class="modal-dialog" role="document" style="width:336px;">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close sty_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <h4 class="modal-title color_heding" id="myModalLabel">Please put new password for user <b class="paswordusername"></b></h4>
            </div>
            <div class="modal-body">


                <div id="visibilityFamily-form" style="text-align: center;">
                    <div class="form_block">
						<span style='color:{{color}};'>{{message}}</span>
						<input type='password' placeholder='New Password' name='password' id='newPassworduser' class='input_field'>
						<input type='password' placeholder='confirm Password' name='password' id='confirmPassword' class='input_field' style='margin-top:20px;'>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <button  type="button" class="btn btn-success btn_suss" id="userPasswordsubmit" style="background-color: #E7AB35 ! important; border: medium none #E7AB35;">Submit</button>
                    </div>

                </div>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!---------------- / course------------->
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
				url: webroot+"/admin/users/ChangeUserPassword",
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
