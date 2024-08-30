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
                   We would like to notify you that the your visa is due for renewal on or before <?php echo $row->visa_exp_date; ?>. Visa processing approximately takes around 5 working days, hence please ensure you provide us with the below documentation:<br>
                    <ul>
                    <li>Passport copy.</li>
                    <li>Emirates ID copy.</li>
                    <li>Recent Picture with white background.</li>
                    </ul>
					</td>
				</tr>
				 <tr>
                  <td class="content-block">
                    <br>
                    As per Dubai Immigration new rules, there are no visa sticker on the passport anymore, the Emirates ID will be used for instead of the visa page.
                    <br>
                    You are requested to provide us with the above required documents within a week of receiving this email to initiate the visa renewal process. You will receive the renewed Emirates ID after 10 days from completing the medical test. We will be in touch with you through the process to update you on next steps and the relevant government centers you may have to go to. Meanwhile please reach out to the following for any queries:<br>

                    Mr Badry: badry@damanservices.ae<br>
                    Mr. Essam Mousa: sherif@damanservices.ae<br>
                    <br>
                    <br>
                    Thank you.<br>
                    Daman Businessmen Services </td>
                </tr>
                <tr>
                  <td class="content-block alignleft"><a target="_blank" href="http://www.damanservices.ae">View in browser</a> <br>
                    <br>
                    <br></td>
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
