<?php
$current_controller = 'users';
?>

<!-- Footer -->
<footer>
<!-- Footer Detail -->
<div class="footer_detail">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-6 col-sm-6 col-xs-6 f-div">
				<div style="float:right;padding-right:30px;">
            	<h3>Navigation</h3>
                <ul class="footer_link">
                	<li <?php if($current_controller == 'Homes') echo 'class="active"'; ?> ><a href="<?php echo BASE_URL;?>">Home</a></li>
                    <li <?php if($current_controller == 'Centers') echo 'class="active"'; ?> ><a href="<?php echo BASE_URL;?>/Centers/applyCenter">Apply for Center</a></li>
                    <li <?php if($current_controller == 'Certificates') echo 'class="active"'; ?> ><a href="<?php echo BASE_URL;?>/Certificates/verifyCertificate">Verify Certificate</a></li>
                    <li <?php if($current_controller == 'Courses') echo 'class="active"'; ?> ><a href="<?php echo BASE_URL;?>/Courses/index">Courses</a></li>
                    <li <?php if($current_controller == 'users') echo 'class="active"'; ?> ><a href="<?php echo BASE_URL;?>/Contacts/contact">Contact us</a></li>
                </ul>
            </div>
            </div>
            <!-----
            <div class="col-lg-4 col-sm-6 col-xs-12">
            	<h3>Find us and Say HAI</h3>
                <ul class="social_block">
                	<li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>

            </div>
            ---->
            <div class="col-lg-6 col-sm-6 col-xs-6 f-div">
            <div class="col-lg-12 col-sm-12 col-xs-12" style="padding-left:45px;">
            	<h3>Contact Us</h3>

				<div class="add_block"><i class="fa fa-map-marker"></i><b style="font-size: initial;">QualHub Limited </b><br>North London Business Park
Oakleigh Road South <br>London <br> N11 1NP</div>
                <div class="add_block"><i class="fa fa-phone"></i>  +91 123 456 7890</div>
                <!--div class="add_block"><i class="fa fa-envelope"></i> <a href="#">Info@qualhub.org</a></div-->

            </div>
            </div>

        </div>
    </div>
</div>

<!-- Copyright -->
<div class="copyright">
	<div class="container">Qualhub Limited is a company registered in England and Wales. Registration number: 09913170 <br>
 Registered office: North London Business Park, Oakleigh Road South London N11 1NP</div>
	<div class="container">� Copyright <?php  echo date('Y'); ?> <a href="/">Qualhub Limited.</a> All rights reserved.</div>

</div>
</footer>
