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
	<script src="/ckeditor/ckeditor.js"></script>



</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
		<?= $this->Flash->render() ?>
		<?= $this->element('client/header'); ?>
		<?= $this->element('client/sidebar'); ?>
        <?= $this->fetch('content') ?>
		<?= $this->element('client/footer'); ?>
</div>

<!------------------------- include javascript here ------------------------------>
<?= $this->fetch('scriptBottom') ?>
<!-------------------------------------  include javascript end here------------------------------>

</body>
</html>
