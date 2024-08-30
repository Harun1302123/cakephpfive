<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-building-o"></i> View Center</h2>
      <div class="main_info_sec">
            
            <div class="global_form">
            	<div class="row">

                    <div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="form_block">
                        	<label>Center Name :</label>
                          <?php echo $center['name'];  ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="form_block">
                        	<label>Contact Person Name</label>
                             <?php echo $center['contact_person'];  ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="form_block">
                        	<label>Center Address</label>
                             <?php echo $center['address'];  ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="form_block">
                        	<label>Center Contact Number</label>
                          	 <?php echo $center['phone'];  ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="form_block">
                        	<label>Username</label>
                            <?php echo $center['user']['Username'];  ?>
                        </div>
                    </div>
					
                    	
					 <div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="form_block">
                        	<label>Email</label>
                         <?php echo $center['email'];  ?>
                        </div>
                    </div>
					 <div class="col-lg-12 col-sm-12 col-xs-12">
						<div class="form_block">
							<label>Image</label>
							<?php foreach($center['center_attachments'] as $ca){
								?>
								<div style='float:left;' class='col-lg-2'>
									<?php
							
			if (strpos($ca['name'], '.png') !== false || strpos($ca['name'], '.jpg') !== false || strpos($ca['name'], '.jpeg') !== false ) { ?>
				<img src='<?php echo BASE_URL;?>/attachments/center/<?php echo $ca->name;?>' style='width:100px;height:100px;'>
		
			<?php } else { ?>
				<a href="<?php echo BASE_URL;?>/webroot/attachments/center/<?php echo $ca->name;?>"><img src='<?php echo BASE_URL;?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
				
			<?php } ?>

									<br>
								</div>
								<?php
							}?>
						</div>
					</div>
					
                  
                                        
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                    	<div class="global_btn_info">
						<button class="save" type='button' onclick='javascript:window.history.back();'><i class="glyphicon glyphicon-chevron-left"></i> Back</button>
                        	
                        </div>
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

