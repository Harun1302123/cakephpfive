<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../"/>
		<title>Daman</title>
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="<?php

use Cake\Routing\Router;

 echo $this->request->getAttribute('webroot'). 'img/media/logos/favicon.ico';?>" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
        <?= $this->html->css('metronic/plugins/global/plugins.bundle.css'); ?>
        <?= $this->html->css('metronic/style.bundle.css'); ?>

		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank app-blank">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <?php echo  $this->Flash->render(); ?>
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10">
							<!--begin::Form-->
                            <?php echo $this->Form->create(null, ['id' =>"kt_sign_in_form", "class" => "form w-100"]); ?>

                            <!--begin::Heading-->
								<div class="text-center mb-11">
									<!--begin::Title-->
									<h1 class="text-dark fw-bolder mb-3">Sign In</h1>
									<!--end::Title-->
								</div>
								<!--begin::Heading-->

								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::Email-->
                                    <?php
                                        echo $this->Form->input(
                                            'Username',
                                            [
                                                'type' => 'text',
                                                'div' => false,
                                                'label' => false,
                                                'class' => 'form-control bg-transparent',
                                                'placeholder' => 'Username'
                                            ]
                                        );
                                    ?>
                                    <!--end::Email-->
								</div>
								<!--end::Input group=-->
								<div class="fv-row mb-3">
									<!--begin::Password-->
                                    <?php
                                        echo $this->Form->input(
                                            'Password',
                                            [
                                                "autocomplete" => "off",
                                                'type' => 'password',
                                                'div' => false,
                                                'label' => false,
                                                'class' => 'form-control bg-transparent',
                                                'placeholder' => 'Password'
                                            ]
                                            );
                                        ?>
                                    <!--end::Password-->
								</div>
								<!--end::Input group=-->
                                <!--end::Input group=-->
								<div class="fv-row mb-3">
                                    <div class="captcha" id="html_element"></div>
                                    <div class="g-recaptcha" data-sitekey="<?php echo google_recatpcha_site_key; ?>"></div>
								</div>
								<!--end::Input group=-->
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
								</div>
								<!--end::Wrapper-->
								<!--begin::Submit button-->
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">Sign In</span>
										<!--end::Indicator label-->
										<!--begin::Indicator progress-->
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										<!--end::Indicator progress-->
									</button>
								</div>
								<!--end::Submit button-->
                                <?php echo $this->Form->end(); ?>

							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap px-5">
						<!--begin::Links-->
						<div class="d-flex fw-semibold text-primary fs-base">

						</div>
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(img/media/misc/auth-bg.png)">

				</div>
				<!--end::Aside-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script>
            var base_url = "<?php echo Router::fullbaseUrl();?>";

            $(document).ready(function () {

                var onloadCallback = function () {
                    grecaptcha.render('html_element', {
                        'sitekey': '6LekJRsUAAAAAB4NTHPTeU4YoAd_5KG4ONBkTrq2'
                    });
                };

                $('#RecipesAdd').on('submit', function (e) {

                    var response = grecaptcha.getResponse();

                    if (response.length == 0 || response == '' || response === false) {
                        alert('Please validate captcha.');
                        e.preventDefault();
                    }
                });

            });
        </script>
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->

		<script src="js/metronic/plugins/global/plugins.bundle.js"></script>
		<script src="js/metronic/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used by this page)-->
		<script src="js/metronic/custom/authentication/sign-in/general.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
