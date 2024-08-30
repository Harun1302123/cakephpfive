<?php

namespace App\Shell;

use App\Model\Entity\Employee;
use Cake\Console\Shell;
use Cake\I18n\FrozenDate;
use Cake\Log\Log;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Mailer\Mailer;

class EmployeeVisaExpiryShell extends Shell
{
    use LocatorAwareTrait;

    public function main()
    {
        $query = $this->fetchTable('AlertSettings')
            ->find()
            ->where(['alert_type_id' => 4])
            ->where(['enable' => 1])
            ->all();

        $whereInSet = [];
        foreach ($query as $key => $row) {
            $whereInSet[] = $row->schdulecount;
        }

        $dateFromat = 'yyyy-MM-dd';

        $now = (new FrozenDate())
            ->i18nFormat($dateFromat);

        $this->fetchTable('Employees')
            ->find()
            ->where(['DATEDIFF(NOW(), visa_exp_date) IN' => $whereInSet])
            ->each(
                function (Employee $employee) use($query, $now, $dateFromat) {
                    foreach ($query as $key => $value) {
                        $start = strtotime($now);
                        $end = strtotime($employee->visa_exp_date->i18nFormat($dateFromat));
                        $days = ceil(abs($end - $start) / 86400);
                        if ((int) $days === (int) $value->schdulecount) {
                            ($emailSendDoc = new Mailer())
                                ->setSubject("Visa expiry notification of " . $employee->name)
                                ->setEmailFormat('html')
                                ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                                ->setTo($employee->email)
                                ->setViewVars(array('row' => $employee))
                                ->viewBuilder()
                                ->setTemplate('renewalExpiryEmp');

                            $emailSendDoc->deliver();

                        }
                    }

                }
            );
    }

}
