<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
	<?php echo $this->Flash->render();?>
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
                            <p>Total Trainees</p>
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
			<div class='col-lg-6 col-sm-6 col-xs-6' ng-controller="centersCtrl">
			<h3>Latest Center</h3>
            	<div class="table-responsive">
					<table id="trainers" class="table table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Created</th>
								<th>status</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="x in names">
								<td>{{ x.name }}</td>
								<td>{{ x.created }}</td>
								<td id="{{ x.id }}" class='centerStatus' title='Click to change'>{{ x.status }}</td>
							</tr>
						</tbody>
					</table>
                </div>
			</div>
			<div class='col-lg-6 col-sm-6 col-xs-6' ng-controller="traineesCtrl">
				<h3>Latest Trainees</h3>
						<table id="trainers" class="table table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Name</th>
									<th>Start Date</th>
									<th>Created</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="x in names">
									<td>{{ x.name }}</td>
									<td>{{ x.start_date }}</td>
									<td>{{ x.created }}</td>
								</tr>
							</tbody>
						</table>
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
	app.controller('iconController', function($scope, $http) {
		
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
		var status = $(this).html();
		var id = $(this).attr('id');
		var obj = $(this);
		$(this).html('Please wait...')
			$.ajax({
				url: '<?php echo BASE_URL; ?>/admin/Centers/changeStatus/'+id+'/'+status,
				success: function (data) {
					obj.html(data);
				}
			});
	});
	
  </script>