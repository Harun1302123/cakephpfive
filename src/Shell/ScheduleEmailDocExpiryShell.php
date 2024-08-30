<?php

namespace App\Shell;
use Cake\Console\Shell;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;

class ScheduleEmailDocExpiryShell extends Shell
{

    public function main()
    {
        $alertSettingTable = TableRegistry::get('AlertSettings');
        $alertSettingTable = $alertSettingTable->find('all')->where(['enable' => 1]);
        $dependents = TableRegistry::get('Dependents');
        $employees = TableRegistry::get('Employees');

        //echo ROOT .DS. "Vendor" . DS  . "SMS" . DS . "experttexting_sms.php"; exit;
        //require_once(ROOT .DS. "vendor" . DS  . "SMS" . DS . "experttexting_sms.php");
        // Creating an object of ExpertTexting SMS Class.
        //$expertTexting = new experttexting_sms();

        $SendAlertTable = TableRegistry::get('SendAlert');

        foreach ($alertSettingTable as $rowAlert) {
            $days = $rowAlert->schdulecount;
            /*if(empty($days)){
            $days = 30;
            }*/
            //echo $days ; exit;
            //echo 'Here 456'; exit;
            //echo date("l jS \of F Y h:i:s A"); exit;
            if ($rowAlert->alert_type_id == 6) { // passport expiry
                $dependentsEx = $dependents
                    ->find('all', array(
                        'conditions' => array('DATEDIFF(DATE(Dependents.passport_exp_date), CURDATE()) =' => $days, 'Dependents.status' => 1),
                    )
                    )->contain('Employees.Companies');

                $employeesEx = $employees->find('all',
                    array(
                        'conditions' => array('DATEDIFF(DATE(Employees.passport_exp_date), CURDATE()) =' => $days, 'Employees.status' => 1),
                    )
                )->contain('Companies');

                if ($dependentsEx->count() > 0) {
                    foreach ($dependentsEx as $row) {
                        if (!empty($row['employee']['email'])) {
                            $settingTable = tableRegistry::get('Settings');
                            $Row = $settingTable->find('all');
                            foreach ($Row as $key => $value) {
                                $CCemails = explode(",", $value['cc_emails']);
                            }

                            $CCemails = array_filter(array_merge($CCemails, explode(",", $row['employee']['company']['cc_emails'])));
                            /**/
                            //$row['employee']['email'] = 'adnan.shoukat786@yahoo.com';
                            //$CCemails = array('adnan.shoukat786@yahoo.com');
                            /**/

                            $search = array('_employee_name', '_dep_name', '_passport_expiry');
                            $replace = array($row->employee->name, $row->name, $row->passport_exp_date);
                            $mailMessage = str_replace($search, $replace, $rowAlert->alert_text_dep);

                            // rowAlert
                            $email = new Mailer();
                            $email->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                                ->setTo($row->employee->email)
                                ->setCc($CCemails)

                            //->to('badry@damanservices.ae')
                            //->Bcc('adnan.shoukat786@yahoo.com')

                            //->message($mailMessage)
                                ->setEmailFormat('html')
                                ->setSubject("Passport expiry notification of " . $row->name)
                                ->setViewVars(array('row' => $row))
                                ->viewBuilder()
                                ->setTemplate('passportExpiryDep');

                            $email->deliver($mailMessage); /**/

                            $SendAlert = $SendAlertTable->newEmptyEntity();
                            $SendAlert->alert_types_id = $rowAlert->alert_type_id;
                            $SendAlert->employee_id = $row->id;
                            $SendAlert->dependet_id = $row->id;
                            $SendAlert->for_whom = 2;
                            $SendAlertTable->save($SendAlert);
                            /*$expertTexting->from= 'KAPNFO';
                            $expertTexting->to= $row->employee->mobile_no;
                            $expertTexting->msgtext= $this->request->data['alert_text']; */
                            //$expertTexting->send(); // Send SMS method.
                        }
                    }
                }
                if ($employeesEx->count() > 0) {
                    foreach ($employeesEx as $row) {
                        if (!empty($row['email'])) {
                            $settingTable = tableRegistry::get('Settings');

                            $Row = $settingTable->find('all');

                            foreach ($Row as $key => $value) {
                                $CCemails = explode(",", $value['cc_emails']);
                            }
                            $CCemails = array_filter(array_merge($CCemails, explode(",", $row['company']['cc_emails'])));
                            /**/
                            //$row['employee']['email'] = 'adnan.shoukat786@yahoo.com';
                            //$CCemails = array('adnan.shoukat786@yahoo.com');
                            /**/

                            $search = array('_employee_name', '_passport_expiry', '_visa_exp_date');
                            $replace = array($row->name, $row->passport_exp_date, $row->visa_exp_date);
                            $mailMessage = str_replace($search, $replace, $rowAlert->alert_text_emp);

                            // ($emailToSend = (clone $email))
                            //     ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            //     ->setTo($row->email)
                            //     ->setCc($CCemails)
                            // //->to('badry@damanservices.ae')
                            // //->to('adnan.shoukat786@yahoo.com')
                            // //->template('passportExpiryEmp')
                            //     ->setEmailFormat('html')
                            //     ->setSubject("Passport expiry notification of " . $row->name)
                            //     ->viewVars(array('row' => $row));

                            //     ->send($mailMessage);
                            //echo "Done"; exit;

                            // rowAlert
                            $email = new Mailer();
                            $email
                                ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                                ->setTo($row->email)
                                ->setCc($CCemails)

                            //->to('badry@damanservices.ae')
                            //->Bcc('adnan.shoukat786@yahoo.com')

                            //->message($mailMessage)
                                ->setEmailFormat('html')
                                ->setSubject("Passport expiry notification of " . $row->name)
                                ->setViewVars(array('row' => $row))
                                ->viewBuilder();

                            $email->deliver($mailMessage); /**/
                            $SendAlert = $SendAlertTable->newEmptyEntity();
                            $SendAlert->alert_types_id = $rowAlert->alert_type_id;
                            $SendAlert->employee_id = $row->id;
                            $SendAlert->dependet_id = $row->id;
                            $SendAlert->for_whom = 1;
                            $SendAlertTable->save($SendAlert);
                            /*$expertTexting->from= 'KAPNFO';
                            $expertTexting->to= $row->employee->mobile_no;
                            $expertTexting->msgtext= $this->request->data['alert_text']; */
                            //$expertTexting->send(); // Send SMS method.
                        }
                    } /**/
                }
            } else if ($rowAlert->alert_type_id == 4) { //visa expiry

                $dependentsEx = $dependents->find('all',
                    array('conditions' => array('DATEDIFF(DATE(Dependents.visa_exp_date), CURDATE()) =' => $days, 'Dependents.status' => 1),)
                )->contain('Employees.Companies');

                $employeesEx = $employees->find('all',
                    array(
                        'conditions' => array('DATEDIFF(DATE(Employees.visa_exp_date), CURDATE()) =' => $days, 'Employees.status' => 1),
                    )
                )->contain('Companies');

                if ($dependentsEx->count() > 0) {
                    foreach ($dependentsEx as $row) { //echo 'Here 789'; exit;

                        //echo '<pre>';print_r($row); exit;
                        if (!empty($row['employee']['email'])) {
                            $settingTable = tableRegistry::get('Settings');
                            $Row = $settingTable->find('all');
                            foreach ($Row as $key => $value) {
                                $CCemails = explode(",", $value['cc_emails']);
                            }

                            $CCemails = array_filter(array_merge($CCemails, explode(",", $row['employee']['company']['cc_emails'])));
                            /**/
                            //$row['employee']['email'] = 'adnan.shoukat786@yahoo.com';
                            //$CCemails = array('adnan.shoukat786@yahoo.com');
                            /**/

                            $search = array('_employee_name', '_dep_name', '_passport_expiry', '_visa_exp_date');
                            $replace = array($row->employee->name, $row->name, $row->passport_exp_date, $row->visa_exp_date);
                            $mailMessage = str_replace($search, $replace, $rowAlert->alert_text_dep);

                            // $email = new Email('default');
                            // $email->from(['portal@enjazsys.com' => 'Daman portal'])
                            //     ->to($row->employee->email)
                            //     ->cc($CCemails)
                            // //->to('badry@damanservices.ae')
                            // //->Bcc('adnan.shoukat786@yahoo.com')

                            // //->template('renewalExpiryDep')
                            // //->message($mailMessage)

                            //     ->emailFormat('html')
                            //     ->subject("Visa expiry notification of " . $row->name)
                            //     ->viewVars(array('row' => $row))
                            //     ->send($mailMessage); /**/

                            $email = new Mailer();
                                $email->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                                ->setTo($row->employee->email)
                                ->setCc($CCemails)

                            //->to('badry@damanservices.ae')
                            //->Bcc('adnan.shoukat786@yahoo.com')

                            //->message($mailMessage)
                                ->setEmailFormat('html')
                                ->setSubject("Visa expiry notification of " . $row->name)
                                ->setViewVars(array('row' => $row))
                                ->viewBuilder();

                            $email->deliver($mailMessage); /**/

                            $SendAlert = $SendAlertTable->newEmptyEntity();
                            $SendAlert->alert_types_id = $rowAlert->alert_type_id;
                            $SendAlert->employee_id = $row->id;
                            $SendAlert->dependet_id = $row->id;
                            $SendAlert->for_whom = 2;
                            $SendAlertTable->save($SendAlert);
                            /*$expertTexting->from= 'KAPNFO';
                            $expertTexting->to= $row->employee->mobile_no;
                            $expertTexting->msgtext= $this->request->data['alert_text']; */
                            //$expertTexting->send(); // Send SMS method.
                        }
                    }
                }

                if ($employeesEx->count() > 0) {
                    foreach ($employeesEx as $row) { //echo 'hreree 101112';  exit;
                        if (!empty($row['email'])) {

                            $settingTable = tableRegistry::get('Settings');

                            $Row = $settingTable->find('all');

                            foreach ($Row as $key => $value) {
                                $CCemails = explode(",", $value['cc_emails']);
                            }
                            $CCemails = array_filter(array_merge($CCemails, explode(",", $row['company']['cc_emails'])));
                            /**/
                            //$row['employee']['email'] = 'adnan.shoukat786@yahoo.com';
                            //$CCemails = array('adnan.shoukat786@yahoo.com');
                            /**/
                            //echo '<pre>'; print_r($row->email); exit;
                            $search = array('_employee_name', '_passport_expiry', '_visa_exp_date');
                            $replace = array($row->name, $row->passport_exp_date, $row->visa_exp_date);
                            $mailMessage = str_replace($search, $replace, $rowAlert->alert_text_emp);
                            //echo '<pre>'; print_r($mailMessage);  exit;
                            // $email = new Email('default');
                            // $email->from(['portal@enjazsys.com' => 'Daman portal'])
                            //     ->to($row->email)
                            //     ->cc($CCemails)
                            // //->to('badry@damanservices.ae')
                            // //->to('adnan.shoukat897@yahoo.com')
                            // //->template('renewalExpiryEmp')
                            // //->message($mailMessage)
                            //     ->emailFormat('html')
                            //     ->subject("Visa expiry notification of " . $row->name)
                            //     ->viewVars(array('row' => $row))
                            //     ->send($mailMessage); /**/

                            $email = new Mailer();
                                $email->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                                ->setTo($row->email)
                                ->setCc($CCemails)

                            //->to('badry@damanservices.ae')
                            //->Bcc('adnan.shoukat786@yahoo.com')

                            //->message($mailMessage)
                                ->setEmailFormat('html')
                                ->setSubject("Visa expiry notification of " . $row->name)
                                ->setViewVars(array('row' => $row))
                                ->viewBuilder();

                            $email->deliver($mailMessage); /**/

                            $SendAlert = $SendAlertTable->newEmptyEntity();
                            $SendAlert->alert_types_id = $rowAlert->alert_type_id;
                            $SendAlert->employee_id = $row->id;
                            $SendAlert->dependet_id = $row->id;
                            $SendAlert->for_whom = 1;
                            $SendAlertTable->save($SendAlert);
                            /*$expertTexting->from= 'KAPNFO';
                            $expertTexting->to= $row->employee->mobile_no;
                            $expertTexting->msgtext= $this->request->data['alert_text']; */
                            //$expertTexting->send(); // Send SMS method.
                        }
                    } /**/
                }

            }
            //echo '<pre>'; print_r($employeesEx); exit;
            //echo '<pre>'; print_r($dependentsEx); exit;
            /**/
        }
        // echo '<pre>';
        // print_r($_SERVER);exit;
        // $email = clone $em;
        // $email->from(['portal@enjazsys.com' => 'My report daman'])
        //     ->Bcc('adnan.shoukat786@yahoo.com')
        //     ->subject('My report daman')
        //     ->send($_SERVER); /**/

        $owner = "damanservices";
        $group = "damanservices";
        $folder = "/home/damanservices/public_html/enjazsys.com/tmp/";

        exec("chown -R ".$owner.":".$group." ".$folder);
    }
}
