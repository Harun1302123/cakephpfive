<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Router;

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
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
	<head>
    <base href=""/>
    <?= $this->Html->charset('ISO-8859-1') ?>
    <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo 'Daman System'; ?>
    </title>
		<script src="https://cdn.ckeditor.com/4.20.0/standard-all/ckeditor.js"></script>

        <?= $this->Html->meta('icon') ?>
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
        <link rel="shortcut icon" href="<?php echo $this->request->getAttribute('webroot'). 'img/media/logos/favicon.ico';?>" />

		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used by this page)-->
	    <?= $this->Html->css('metronic/plugins/custom/fullcalendar/fullcalendar.bundle.css') ?>
	    <?= $this->Html->css('metronic/plugins/custom/datatables/datatables.bundle.css') ?>
        <?= $this->Html->css('admin/jquery-ui') ?>


		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
	    <?= $this->Html->css('metronic/plugins/global/plugins.bundle.css') ?>
	    <?= $this->Html->css('metronic/style.bundle.css') ?>
		<!--end::Global Stylesheets Bundle-->
        <?= $this->Html->script('admin/angular.min') ?>

	    <?= $this->Html->script('admin/jQuery-2.2.0.min') ?>
        <?= $this->Html->script('admin/jquery-ui') ?>


        <script>
	        var webroot = '<?php echo Router::fullBaseUrl();?>';
        </script>

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>
            var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }
        </script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->

		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">

                <?= $this->element('client/header'); ?>

				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
						<!--end::Logo-->
						<!--begin::sidebar menu-->
						<?= $this->element('client/sidebar') ?>
                        <!--end::sidebar menu-->
					<!--end::Sidebar-->
					<!--begin::Main-->

					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<?= $this->Flash->render() ?>

						<!--begin::Content wrapper-->
						<div style="margin-top: 15px;" class="d-flex flex-column flex-column-fluid">
							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-fluid">
                                    <?= $this->fetch('content') ?>
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
                        <?= $this->element('client/footer'); ?>
						</div>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->


		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->

    	<?= $this->Html->script('metronic/plugins/global/plugins.bundle.js') ?>
    	<?= $this->Html->script('metronic/scripts.bundle.js') ?>

		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used by this page)-->
    	<?= $this->Html->script('metronic/plugins/custom/fullcalendar/fullcalendar.bundle.js') ?>

		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    	<?= $this->Html->script('metronic/plugins/custom/datatables/datatables.bundle.js') ?>

		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used by this page)-->
    	<?= $this->Html->script('metronic/widgets.bundle.js') ?>
    	<?= $this->Html->script('metronic/custom/widgets.js') ?>
    	<?= $this->Html->script('metronic/custom/apps/chat/chat.js') ?>
    	<?= $this->Html->script('metronic/custom/utilities/modals/upgrade-plan.js') ?>
    	<?= $this->Html->script('metronic/custom/utilities/modals/create-app.js') ?>
    	<?= $this->Html->script('metronic/custom/utilities/modals/new-target.js') ?>
    	<?= $this->Html->script('metronic/custom/utilities/modals/users-search.js') ?>
    	<?= $this->Html->script('admin/common') ?>
    	<?= $this->Html->script('admin/ajax-pagination') ?>
    	<?= $this->Html->script('admin/search') ?>

        <script>(function (a, c, b, e) {
        a[b] = a[b] || {}; a[b].initial = { accountCode: "INDIV37895", host: "INDIV37895.pcapredict.com" };
        a[b].on = a[b].on || function () { (a[b].onq = a[b].onq || []).push(arguments) }; var d = c.createElement("script");
        d.async = !0; d.src = e; c = c.getElementsByTagName("script")[0]; c.parentNode.insertBefore(d, c)
        })(window, document, "pca", "//INDIV37895.pcapredict.com/js/sensor.js");
        var csrfToken = $("meta[name='csrfToken']").attr("content");
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        var baseUrl = "<?php echo Router::fullBaseUrl();?>";
        // console.log(window.location.href)
        $('a.menu-link').each(
            function (index, value) {
                if (window.location.href === value.href) {
                    let element = $(value).parent().parent().parent();
                    $(element).attr('class', 'menu-item here menu-accordion show')
                    $(value).attr('class', 'menu-link active');
                }
            }
        )

        function onMenuItemClick(event) {
            $('div.here').attr('class', 'menu-item menu-accordion');
        }
        </script>

        <!------------------------- include javascript here ------------------------------>
        <?= $this->fetch('scriptBottom') ?>
        <!-------------------------------------  include javascript end here------------------------------>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
