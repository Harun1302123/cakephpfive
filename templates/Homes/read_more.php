
<style>
	.gallery_reg_link{
		margin-left: -11px !important;;
    padding-bottom: 10px !important;;
    padding-left: 10px !important;;
    padding-right: 10px !important;;
    padding-top: 10px !important;;
    width: 100%;
	}
	.btn.btn-xl1.gal_reg_btn {
    width: 352px !important;
}
	.modal-dialog{left:0% !important;}
    .img-responsive {
        max-height: 300px !important;
        width: 100% !important;
    }
    .portfolio-link {
        background-color: white;
        height: 300px;
    }
    .portfolio-caption {
        height: 120px;
    }
	.about_bg{ background-image:url(https://d1wli5mq9yq9mw.cloudfront.net/static/images/bg_main.gif); background-attachment: fixed;  width:100%}
	.color_white{color: #333;
    text-shadow: 1px 1px 3px rgba(255, 255, 255, 0.5);}
	.about_blockquote{padding:0; border:0;}
	.about_block{ float:left; wiadth:100%;}
	 
	#irc_mi {width: auto !important;}
	.irc_mut{width: auto !important;}
	.css_ic{padding: 70px;}

 @media (min-width: 280px) and (max-width:780px ) {
	 .css_ic {
    padding: 0 !important;
}
.shade {
    background: hsl(0, 0%, 91%) none repeat scroll 0 0;
    box-shadow: 2px 2px 2px hsl(0, 0%, 53%);
    margin-bottom: 10px;
    margin-left: 1.3%;
    min-height: 427px;
    padding-top: 20px;
    width: 100% !important;
}

#content {
    border-radius: 2px;
    height: auto !important;
    padding: 20px;
}
.shadehtml {
    background: hsl(0, 0%, 91%) none repeat scroll 0 0;
    box-shadow: 2px 2px 2px hsl(0, 0%, 53%);
    box-sizing: border-box;
    float: left;
    margin-left: 0 !important;
    margin-top: 10px;
    padding: 20px 0;
    width: 100% !important;
}
	 }
</style>

<!--<div style='text-align:center; padding:60px;'>Featured Galleries</div> -->

<section id="portfolio" class="about_bg pdng_about_less css_ic" style="">

<?php echo  $this->Flash->render();?>
   

    <div class="container cl_mar_t ">
        
		
        <div class="col-lg-12 text-center">
         
		 
		 <div>
		   <h2 class="section-heading" style="text-align:center;color:#4fafc2;text-shadow:1px 1px 1px rgba(0, 0, 0, 0.4);"><?php echo @$readmore->subject;?></h2>
		 <blockquote style="text-align: justify;" class="color_white about_blockquote about_block">
		 <?php echo @$readmore->description;?>
		 </blockquote>
		 </div>
        </div>
	</div>
</section>

