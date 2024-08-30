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
 //echo '<pre>'; print_r($information); exit;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Daman Documents</title>
<link href="styles.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body itemscope itemtype="http://schema.org/EmailMessage">
<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" width="600"><div class="content">
        <table class="main" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="content-wrap"><table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block"><!--<div class="aligncenter"><img src="<?php echo $this->request->getAttribute('webroot'); ?>img/daman-logo-OL.png" width="250" height="70"></div> --></td>
                </tr>
                <tr>
				 
                  <td class="content-block"><b>Dear <?php echo $row->name ?>,</b><br></td>
                </tr>
                <tr>
                   <td class="content-block"><br>
                   Please be notified that your passport is due for renewal on or before <?php echo $row->passport_exp_date; ?>. As you may already be aware, most travel requirement mandates a minimum of 6 months validity on your passport. Hence please contact your embassy and process the renewal at the earliest. Once done please make sure to send us back a clear renewed copy of your passport.
                    <br>
					<br>
                    <br>
                    Thank you.<br>
                    Daman Businessmen Services </td>
                </tr>
                <tr>
                  <td class="content-block alignleft"><a target="_blank" href="http://www.damanservices.ae">View in browser</a>
                <br>
                <br>
                <br>
                    </td>
                </tr>
              </table></td>
          </tr>
        </table>
        <div class="footer">
          <table width="100%">
            <tr>
              <td class="aligncenter content-block">Questions? Email <a href="mailto:info@enjazsys.com">info@enjazsys.com</a></td>
            </tr>
          </table>
        </div>
      </div></td>
    <td></td>
  </tr>
</table>
</body>
</html>
<?php //echo 'sddd'; exit; ?>
<style></style>
