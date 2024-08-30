<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo BASE_URL;?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="/img/daman-logo-OL.png" style="height: 45px;margin-top: -6px;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="/img/daman-logo-OL.png" style="height: 45px;margin-top: -6px;"></span>
    </a>
	<script>
        var webroot = '<?php echo BASE_URL;?>';
    </script>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <?php if(empty($this->request->getSession()->read('Auth.User.image'))){
						echo $this->Html->image('admin/user2-160x160.jpg',['class'=>'user-image']);
					 } else {
						echo $this->Html->image('admin/'.$this->request->getSession()->read('Auth.User.image'),['class'=>'user-image']);
				}?>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $this->request->getSession()->read('Auth.User.Username');?></span>            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <?php if(empty($this->request->getSession()->read('Auth.User.image'))){
						echo $this->Html->image('admin/user2-160x160.jpg',['class'=>'img-circle']);
					 } else {
						echo $this->Html->image('admin/'.$this->request->getSession()->read('Auth.User.image'),['class'=>'img-circle']);
				}?>

                <p>

                  <small>Username : <?php echo $this->request->getSession()->read('Auth.User.Username');?></small>                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
					<a data-toggle="modal" data-target="#viewProfile" href="#viewProfile">View Profile</a>
				  </div>
                  <div class="col-xs-4 text-center">
                    <a data-toggle="modal" data-target="#ChangeImage" href="#ChangeImage">Change Image</a>
				  </div>
                  <div class="col-xs-4 text-center">
                    <a data-toggle="modal" data-target="#ChangePassword" href="#ChangePassword">Change Password</a>
				  </div>
                </div>
                <!-- /.row -->
              </li>
            </ul>
          </li>
          <li><a href="/client/users/logout"><i class="fa fa-power-off"></i>&nbsp;&nbsp; Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>
