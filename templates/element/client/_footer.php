<div id="ChangePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-app="myApp" ng-controller="changePass">
    <div class="modal-dialog" role="document" style="width:336px;">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close sty_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">�</span></button>
                <h4 class="modal-title color_heding" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body">


                <div id="visibilityFamily-form" style="text-align: center;">
                    <div class="form_block">
						<span style='color:{{color}};'>{{message}}</span>
						<input type='password' placeholder='Old Password' name='password' id='oldPassword' ng-model="oldPassword" class='input_field'>
						<input type='password' placeholder='New Password' name='password' id='newPassword' ng-model="newPassword" class='input_field' style='margin-top:20px;'>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <button ng-click="changePass();" type="button" class="btn btn-success btn_suss" id="login-submit" style="background-color: #E7AB35 ! important; border: medium none #E7AB35;">Submit</button>
                    </div>

                </div>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="ChangeImage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:336px;">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close sty_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">�</span></button>
                <h4 class="modal-title color_heding" id="myModalLabel">Change Image</h4>
            </div>
            <div class="modal-body">


                <div id="visibilityFamily-form" style="text-align: center;">
                    <div class="form_block">
						<?php echo $this->Form->create('Users',['url'=>BASE_URL.'/admin/Users/changeImage','enctype'=>'multipart/form-data','id'=>'formImage']);
								if(empty($this->request->getSession()->read('Auth.User.image'))){
									echo $this->Html->image('admin/user2-160x160.jpg',['class'=>'img-circle','style'=>'width:200px']);
								} else {
									echo $this->Html->image('admin/'.$this->request->getSession()->read('Auth.User.image'),['class'=>'img-circle','style'=>'width:200px;']);
								}
								echo $this->Form->input('image',['type'=>'file','div'=>FALSE,'label'=>FALSE]);
								echo $this->Form->end();
						?>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <button type="button" class="btn btn-success btn_suss" id="login-submit" style="background-color: #E7AB35 ! important; border: medium none #E7AB35;" onclick='javascript:$("#formImage").submit();'>Submit</button>
                    </div>

                </div>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="viewProfile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:336px;">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close sty_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">�</span></button>
                <h4 class="modal-title color_heding" id="myModalLabel">View Profile</h4>
            </div>
            <div class="modal-body">


                <div id="visibilityFamily-form" style="text-align: center;">
                    <div class="form_block">

						<?php if(empty($this->request->getSession()->read('Auth.User.image'))){
									echo $this->Html->image('admin/user2-160x160.jpg',['class'=>'img-circle','style'=>'width:200px']);
								} else {
									echo $this->Html->image('admin/'.$this->request->getSession()->read('Auth.User.image'),['class'=>'img-circle','style'=>'width:200px;']);
								}?><br>
								#ID : <?php echo $this->request->getSession()->read('Auth.User.id');?><br>
								Username : <?php echo $this->request->getSession()->read('Auth.User.Username');?><br>
								Created : <?php echo date('j F, Y',strtotime($this->request->getSession()->read('Auth.User.created')));?><br>
								Last Modified : <?php echo date('j F, Y',strtotime($this->request->getSession()->read('Auth.User.modified')));?><br>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <button type="button" class="btn btn-success btn_suss" id="login-submit" style="background-color: #E7AB35 ! important; border: medium none #E7AB35;" onclick='javascript:$(".close").trigger("click");'>Close</button>
                    </div>

                </div>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
var app = angular.module('myApp', []);
	app.controller('changePass', function($scope, $http) {
		//$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
		$scope.changePass = function() {
			var base_url = "<?php echo BASE_URL;?>";

			$http({
				url: base_url+ '/admin/Users/changePassword',
				method: "POST",
				data: { 'password' : $scope.newPassword,'old_password':$scope.oldPassword }
			})
			.then(function(response) {
					// success
					//console.log(response.data);
					if(response.data == 1){
						$scope.color = 'green';
						$scope.message = 'Password changed successfully';
						setTimeout(function() { $('#ChangePassword').modal('hide'); }, 1500);
					} else if(response.data == 2){
						$scope.color = 'red';
						$scope.message = 'Current password incorrect!';
					} else {
						$scope.color = 'red';
						$scope.message = 'Unable to update password, please try again';
					}
			},
			function(response) {
					// failed
					$scope.color = 'red';
					$scope.message = 'Unable to update password, please try again';
			});
		}

	});
	angular.bootstrap(document.getElementById("ChangePassword"), ['myApp']);
</script>
