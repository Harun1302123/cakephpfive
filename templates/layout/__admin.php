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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset('ISO-8859-1') ?>
    <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo 'Daman System'; ?>
    </title>
    <?= $this->Html->meta('icon') ?>

	<!------------------------ include css here ------------------------------>
	<?= $this->Html->css('admin/bootstrap') ?>
	<?= $this->Html->css('admin/jquery-ui') ?>
	<?= $this->Html->css('admin/font-awesome') ?>
	<?= $this->Html->css('admin/style') ?>
	<?= $this->Html->css('admin/theme') ?>
	<?= $this->Html->css('admin/sumoselect') ?>

	<?= $this->Html->css('admin/responsive') ?>
	<?= $this->Html->css('admin/jquery.dataTables.min') ?>
	<?= $this->Html->script('admin/angular.min') ?>
	<!--------------------------------- end include css here ----------------------->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

	<?= $this->Html->script('admin/jQuery-2.2.0.min') ?>
	<?= $this->Html->script('admin/jquery-ui') ?>
	<?= $this->Html->script('admin/bootstrap.min') ?>
	<?= $this->Html->script('admin/app') ?>
	<?= $this->Html->script('admin/ajax-pagination') ?>
	<?= $this->Html->script('admin/jquery.sumoselect.min') ?>
	<?= $this->Html->script('admin/bootstrap-select.min') ?>
	<?= $this->Html->script('admin/jquery.dataTables.min') ?>
	<?= $this->Html->script('admin/parsley.min') ?>
	<?= $this->Html->script('admin/search') ?>

	<script src="<?php echo $this->request->getAttribute('webroot'); ?>ckeditor/ckeditor.js"></script>


	<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADumOfMw02TT210Mt5vA3KF7sYedMtDHs&libraries=places"></script> -->

    <!-- <script type = "text/javascript">
        function initialize() {
            var address = document.getElementById('location');
            var addressAuto = new google.maps.places.Autocomplete(address);

        }
        google.maps.event.addDomListener(window, 'load', initialize);

    </script> -->

    <!--<script>(function (a, c, b, e) {
    a[b] = a[b] || {}; a[b].initial = { accountCode: "PROLI11117", host: "PROLI11117.pcapredict.com" };
    a[b].on = a[b].on || function () { (a[b].onq = a[b].onq || []).push(arguments) }; var d = c.createElement("script");
    d.async = !0; d.src = e; c = c.getElementsByTagName("script")[0]; c.parentNode.insertBefore(d, c)
})(window, document, "pca", "//PROLI11117.pcapredict.com/js/sensor.js");</script>-->

<script>(function (a, c, b, e) {
 a[b] = a[b] || {}; a[b].initial = { accountCode: "INDIV37895", host: "INDIV37895.pcapredict.com" };
 a[b].on = a[b].on || function () { (a[b].onq = a[b].onq || []).push(arguments) }; var d = c.createElement("script");
 d.async = !0; d.src = e; c = c.getElementsByTagName("script")[0]; c.parentNode.insertBefore(d, c)
 })(window, document, "pca", "//INDIV37895.pcapredict.com/js/sensor.js");
 var csrfToken = $("meta[name='csrfToken']").attr("content");

 </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
		<?= $this->Flash->render() ?>
		<?= $this->element('admin/header'); ?>
		<?= $this->element('admin/sidebar'); ?>
        <?= $this->fetch('content') ?>
		<?= $this->element('admin/footer'); ?>
</div>

<!------------------------- include javascript here ------------------------------>
<?= $this->fetch('scriptBottom') ?>
<!-------------------------------------  include javascript end here------------------------------>

</body>
</html>
