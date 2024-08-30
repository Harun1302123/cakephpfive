<?php
$current_controller = 'users';

?>

<!-- Header -->
<header>

<!-- Top Part -->
<div class="top_part">
	<div class="container">
    	<div class="inner">
		<div class="top_info dash-res"><i class="fa fa-dashboard"></i>
		<?php if($this->request->getSession()->check('Auth.User.id')) {
			echo $this->Html->link('Dashboard',array('controller'=>'Users','action'=>'login'));
		} ?>

		 </div>
        	<div class="top_info"><i class="fa fa-phone"></i> 01234-111-225</div>
            <!--div class="top_info"><a href="#"><i class="fa fa-envelope"></i> Info@qualhub.org</a></div-->
        	<?php if($this->request->getSession()->check('Auth.User.id')){
				echo $this->Html->link('Logout',array('controller'=>'Users','action'=>'logout'),array('class'=>'loing_link','style'=> 'background-color:red'));
			} else {
				echo $this->Html->link('Login',array('controller'=>'Users','action'=>'login'),array('class'=>'loing_link'));
			}?>

        </div>
    </div>
</div>

<!-- Navigation -->
<div class="nav_sec sticky">
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE_URL;?>"><img src="<?php echo BASE_URL;?>/images/logo.png" alt=""></a>
            </div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<li <?php if($current_controller == 'users') echo 'class="active"'; ?>><a href="#about">About us</a></li>
                    <li <?php if($current_controller == 'users') echo 'class="active"'; ?>><a href="#our-serv">Our Services</a></li>
                    <!--li <?php if($current_controller == 'Homes') //echo 'class="active"'; ?>><a href="<?php //echo BASE_URL;?>">Home</a></li-->
                    <li <?php if($current_controller == 'Centers') echo 'class="active"'; ?>><a href="<?php echo BASE_URL;?>/Centers/applyCenter">Become A Center </a></li>
                    <li <?php if($current_controller == 'Certificates') echo 'class="active"'; ?>><a href="<?php echo BASE_URL;?>/Certificates/verifyCertificate">Certificate Verification</a></li>
                   <!--li <?php if($current_controller == 'Courses') //echo 'class="active"'; ?>><a href="<?php //echo BASE_URL;?>/Courses/index">Courses</a></li-->

                    <li <?php if($current_controller == 'users') echo 'class="active"'; ?>><a href="<?php echo BASE_URL;?>/Contacts/contact">Contact us</a></li>
                </ul>
			</div>
		</nav>
    </div>
</div>
</header>
<div class="space-h"></div>
