
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6Lcwjg8UAAAAACG56z5XZx3FyP0jfqKXT_FxVdIY'
        });
      };
	  </script>

	<div class="container">
		<div class="login-container">
				<div id="output"></div>
				<div class="avatar"><img src="/img/daman-logo-OL.png"></div>
				<div class="form-box">
					<?php echo  $this->Flash->render('auth'); ?>
					 <?php echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'login'),'id' => 'RecipesAdd')); ?>
						<?php echo $this->Form->input('Username',['type'=>'text','div'=>false,'label'=>false,'class'=>'input_field','placeholder'=>'Username']); ?>
						<?php echo $this->Form->input('Password',['type'=>'password','div'=>false,'label'=>false,'class'=>'input_field','placeholder'=>'Password']); ?>
						<!--<div class="captcha" id="html_element"></div>-->
						<div class="g-recaptcha" data-sitekey="<?php echo google_recatpcha_site_key; ?>"></div>
						<button class="btn btn-info btn-block login" type="submit">Login</button>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>

	</div>
	    <!--<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>-->
<style>
body {
background-image: url("/img/business.jpg");
background-repeat: no-repeat;
background-size: cover;
}
</style>
<script>
 $(document).ready(function(){
 $('#RecipesAdd').on('submit', function (e) {

                    var response = grecaptcha.getResponse();

                    if(response.length == 0 ||  response == '' || response ===false ) {
                        alert('Please validate captcha.');
                        e.preventDefault();
                    }
                });

 });
</script>
