<link rel="stylesheet" href="/css/full-slider.css"/>

<!-- Slider Sec -->
<div class="slider_sec" style="height:58%;">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
   
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
		  <div class="fill" style="background-image:url('<?php echo BASE_URL;?>/images/b2.jpg');"></div>	
          <!--img src="<?php //echo BASE_URL;?>/images/b2.jpg" alt=""-->
          <div class="caption">
				<div class="container">
                	<h2>Welcome to <strong>Qual Hub</strong> </h2>
                </div>
          </div>
        </div>
        
        <div class="item">
			<div class="fill" style="background-image:url('<?php echo BASE_URL;?>/images/b1.jpg');"></div>
          <!--img src="<?php //echo BASE_URL;?>/images/b1.jpg" alt=""-->
          <div class="caption">
				<div class="container">
                	<h2>INTERNAL <strong>QUALITY</strong> <br> ASSURANCE</h2>
                </div>
          </div>
        </div>
		<div class="item">
			<div class="fill" style="background-image:url('<?php echo BASE_URL;?>/images/b3.jpg');"></div>
          <!--img src="<?php //echo BASE_URL;?>/images/b3.jpg" alt=""-->
          <div class="caption">
				<div class="container">
                	<h2>Welcome to <strong>Qual Hub</strong> </h2>
                </div>
          </div>
        </div>
        
      </div>
    
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
    </div>
</div>
<!-- Section -->
<section>
<!-- Welcome Sec -->
<div class="welcome_sec page" id="about">  
	<div class="container">
    	<h2 class="global_title">About Our <strong>Company</strong></h2>
        <div class="row">
        	<div class="col-lg-8 col-sm-7 col-xs-12">
            	<p>Qualhub is an Internal Quality Assurance consultancy service for education and training providers. We founded Qualhub take the pain away from training providers who constantly juggle between delivering high quality training, quality assurance, and day to day centre management. </p>
                <p>We have an in-house team on experienced assessors, verifiers and quality assurance specialists who can help you run your trainings always making sure that you remain compliant with any legislation. </p>
				<p>Our team includes many industry experts who have gone through the experience of running regulated training courses. We understand the difficulty small providers face with compliance, record keeping and data management and provide solutions catered to the courses you run. Our quality assurance systems are easy to use and designed with course compliance in mind.</p>
            </div>
            <div class="col-lg-4 col-sm-5 col-xs-12">
            	<figure><img src="webroot/images/welcome_image.png" alt=""></figure>
            </div>
        </div>
    </div>
</div>


<!-- Course Sec -->
<div class="course_sec page" id="our-serv">
	<div class="container">
    	<div class="course_inn">
	    	<h2 class="global_title">Our <strong>Services</strong></h2>
            <div class="row">
            	<div class="col-lg-7 col-sm-7 col-xs-12">
                	<ul>
                    	<li>Quality Assurance Services for small training providers.</li>
                        <li>Quality Monitoring for Independent First Aid training providers.</li>
                        <li>Certificate Printing and Validation.</li>
                        <li>Fulfilment Services.</li>
                        <li>Course Content Development.</li>
                        <li>Bespoke Consultancy.</li>
                    </ul>
                </div>
                <div class="col-lg-5 col-sm-5 col-xs-12">
                	<figure><img src="webroot/images/course_img.png" alt=""></figure> 
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Client Sec -->
<!--div class="client_sec">
	<div class="container">
    	<h2 class="global_title">Our <strong>Clients</strong></h2>
        
        <div class="client_slider">
        	<div id="owl-demo" class="owl-carousel">
            	<div class="item">
                	<figure><img src="webroot/images/client_logo_1.png" alt=""></figure>
                </div>
                
                <div class="item">
                	<figure><img src="webroot/images/client_logo_2.png" alt=""></figure>
                </div>
                
                <div class="item">
                	<figure><img src="webroot/images/client_logo_3.png" alt=""></figure>
                </div>
                
                <div class="item">
                	<figure><img src="webroot/images/client_logo_4.png" alt=""></figure>
                </div>
                
                <div class="item">
                	<figure><img src="webroot/images/client_logo_5.png" alt=""></figure>
                </div>
			</div>
		</div>
        
    </div>
</div-->

</section>

 <?php 
		echo $this->Html->script('owl.carousel.js', array('block' => 'scriptBottom'));  
		echo $this->Html->script('home.js', array('block' => 'scriptBottom'));  
?>