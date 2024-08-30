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

    <?=  $this->Html->meta('icon') ?>



	<!------------------------ include css here ------------------------------>

	<?= $this->Html->css('style.css') ?>

	<!--------------------------------- end include css here ----------------------->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body>

		<?= $this->Flash->render(); ?>

        <?= $this->fetch('content'); ?>


		<!------------------------- include javascript here ------------------------------>


		<?= $this->fetch('scriptBottom') ?>

</body>
</html>
