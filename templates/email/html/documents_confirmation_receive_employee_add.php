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
                  <td class="content-block"><b>Dear <?php echo $information['name'] ?>,</b><br></td>
                </tr>
                <tr>
                  <td class="content-block"><br>This is to confirm that we received the below documents:<br>
<?php
$doc = '';
$doc .= (isset($information['passport_receive_admin']) && ($information['passport_receive_admin']  ==1) ) ? 'Passport, ': '';
 $doc .=  (isset($information['bc_receive_admin']) && ($information['bc_receive_admin']  ==1) ) ? 'Birthday Certificate, ': '';
 $doc .= (isset($information['mc_receive_admin']) && ($information['mc_receive_admin']  ==1) ) ? 'Marriage Certificate, ': '';
 $doc .= (isset($information['eid_receive_admin']) && ($information['eid_receive_admin']  ==1) ) ? 'Emirates ID, ': '';
 $doc .= (isset($information['dc_receive_admin']) && ($information['dc_receive_admin']  ==1) ) ? 'Degree Certificate, ': '';
 $doc .= (isset($information['medical_receive_admin']) && ($information['medical_receive_admin']  ==1) ) ? 'Medical, ': '';
 $doc .= (isset($information['other_receive_admin']) && ($information['other_receive_admin']  ==1) ) ? $information['other_receive_value'] : '';

if($doc !=''){
$doc = trim($doc);
echo rtrim($doc , ',');
}
 ?>
                    </br>
                    <br>
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
