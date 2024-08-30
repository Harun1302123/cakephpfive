<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Log\Log;
use Cake\Mailer\Mailer;

class TestShell extends Shell
{
    public function main()
    {
        $email = new Mailer();
        $email->setFrom(['portal@enjazsys.com' => 'Daman portal'])
            // ->setTo('Naser.Shahrour@trane.com')
            ->setTo('muhmd.sulman@gmail.com')
            // ->setCc(['highwatt11000@gmail.com', 'muhmd.sulman@gmail.com'])

            //->to('badry@damanservices.ae')
            //->Bcc('adnan.shoukat786@yahoo.com')

            //->message($mailMessage)
            ->setEmailFormat('html')
            ->setSubject("Test notification")
            // ->setViewVars(array('row' => $row))
            ->viewBuilder();
            // ->setTemplate('passportExpiryDep');

        $email->deliver("Test content"); /**/

        $owner = "damanservices";
        $group = "damanservices";
        $folder = "/home/damanservices/public_html/enjazsys.com/tmp/";

        exec("chown -R ".$owner.":".$group." ".$folder);
    }
}
