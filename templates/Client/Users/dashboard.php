<div class="content-wrapper">
    <!-- Main content -->
	<?php echo $this->Flash->render();?>
    <section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-dashboard"></i> Admin Dashboard</h2>
      <div class="main_info_sec"  ng-app='iconApp'  ng-controller="iconController">
           
             <div class="course_info_sec">
            	<div class="row" >
					<div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="course_block">
                        	<span>{{courses}}</span>
                            <p>Total Course</p>
                        </div>
                    </div>

					<div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="course_block block_2">
                        	<span>{{centers}}</span>
                            <p>Total Centers</p>
                        </div>
                    </div>
					
					
					<div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="course_block block_3">
                        	<span>{{trainees}}</span>
                            <p>Total Candidates</p>
                        </div>
                    </div>
					
					<div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="course_block block_4">
                        	<span>{{trainers}}</span>
                            <p>Total Trainers</p>
                        </div>
                    </div>
                    
                </div>
            </div>
			<div class='col-lg-12 col-sm-12 col-xs-12' ng-controller="centersCtrl">
			 <h2 class="global_title">Recently Added Centers</h2>
				<div class="table_listing">
					<div class="table-responsive">
						<table id="trainers" class="table table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th align="left">Name</th>
									<th align="left">Contact Person</th>
									<th align="left">Phone</th>
									<th align="left">Email</th>
									<th align="left">Address</th>
									<th align="left">Created</th>
									<th align="left">Status</th>
									<th align="left">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="x in names">
									<td>{{ x.name }}</td>
									<td>{{ x.contact_person }}</td>
									<td>{{ x.phone }}</td>
									<td>{{ x.email }}</td>
									<td>{{ x.address }}</td>
									<td>{{ x.created }}</td>
									<td title='Click to change'><a href='javascript:void(0);' id="{{ x.id }}" status="{{ x.status }}" class='centerStatus download_report'><i class="glyphicon glyphicon-pencil"></i> {{ x.status }}</td>
									<td><a href="<?php echo BASE_URL;?>/admin/Centers/view/{{x.encodeId}}" class="download_report"><i class="fa fa-eye"></i> View details</a></td>			
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class='col-lg-12 col-sm-12 col-xs-12' ng-controller="traineesCtrl">
				<h2 class="global_title">Recently Added Candidates</h2>
				<div class="table_listing">
					<div class="table-responsive">
						<table id="trainers" class="table table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th align="left">First Name</th>
									<th align="left">Last Name</th>
									<th align="left">Location</th>
									<th align="left">Mobile</th>
									<th align="left">Email</th>
									<th align="left">Start Date</th>
									<th align="left">Registration Date</th>
									<th align="left">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="x in names">
									<td>{{ x.fname }}</td>
									<td>{{ x.lname }}</td>
									<td>{{ x.location }}</td>
									<td>{{ x.mobile }}</td>
									<td>{{ x.email }}</td>
									<td>{{ x.start_date }}</td>
									<td>{{ x.created }}</td>
									<td><a href="<?php echo BASE_URL;?>/admin/Trainees/view/{{x.encodeId}}" class="download_report"><i class="fa fa-eye"></i> View details</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
            
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  <script>
  var app = angular.module('iconApp', []);
	app.controller('iconController', function($scope, $http,$interval) {
		var base_url = "<?php echo BASE_URL;?>";
			$http({
				url: base_url+ '/admin/Users/getIconData',
			})
			.then(function(response) {
					// success
					//console.log(response.data);
					$scope.courses = response.data.courses;
					$scope.centers = response.data.centers;
					$scope.trainers = response.data.trainers;
					$scope.trainees = response.data.trainees;
					$scope.verifiers = response.data.verifiers;
			}, 
			function(response) {
					// failed
					alert('Something went wrong, please refresh page');
			});
		
		$interval(function(){
			var base_url = "<?php echo BASE_URL;?>";
			$http({
				url: base_url+ '/admin/Users/getIconData',
			})
			.then(function(response) {
					// success
					//console.log(response.data);
					$scope.courses = response.data.courses;
					$scope.centers = response.data.centers;
					$scope.trainers = response.data.trainers;
					$scope.trainees = response.data.trainees;
					$scope.verifiers = response.data.verifiers;
			}, 
			function(response) {
					// failed
					alert('Something went wrong, please refresh page');
			});
		 },60000);
	});
	
	// get center data
	app.controller('centersCtrl', function($scope, $http) {
		$http.get("<?php echo BASE_URL;?>/admin/Centers/getCentersData")
		.then(function (response) {$scope.names = response.data.data;
		});
	});
	
	// get trainees data
	app.controller('traineesCtrl',function($scope,$http){
		$http.get("<?php echo BASE_URL;?>/admin/Centers/getTraineesData")
		.then(function(response){
			$scope.names = response.data.data;
		})
	});
	
	
	
	// jquery code
	$('body').delegate('.centerStatus','click',function(){
		var status = $(this).attr('status');
		var id = $(this).attr('id');
		var obj = $(this);
		$(this).html('<i class="glyphicon glyphicon-refresh"></i> Please wait...')
			$.ajax({
				url: '<?php echo BASE_URL; ?>/admin/Centers/changeStatus/'+id+'/'+status,
				success: function (data) {
					var data = $.parseJSON(data);
					obj.attr('status',data['status']);
					obj.html('<i class="glyphicon glyphicon-pencil"></i> '+data['status']);
				}
			});
	});
	
  </script>