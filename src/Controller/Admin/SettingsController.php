<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Exception;

class SettingsController extends AppController
{
    public $paginate = [
        'limit' => 20,
        'order' => [
            'Settings.id' => 'DESC',
        ],
    ];

    public function initialize(): void
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('admin');
        $this->Auth->allow('scduleSMS');
    }

    /**
     * Function name     : index
     * Description         : list setting
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function index($id = null)
    {
        $settingTable = tableRegistry::get('Settings');
        $seetings = $this->paginate($settingTable->find());

        $this->set('seetings', $seetings);

    }

    /**
     * Function name     : add
     * Description         : add setting
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */
    public function add()
    {
        $settingTable = tableRegistry::get('Settings');
        $setting = $settingTable->newEntity();

        if ($this->request->is('post')) {
            $settingTable->patchEntity($setting, $this->request->data);
            if ($settingTable->save($setting)) {
                $this->Flash->success(__('Setting has been saved'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Setting could not be save'));
            return $this->redirect(['action' => 'add']);

        }

        $this->set('setting', $setting);
    }

    /**
     * Function name     : edit
     * Description         : edit setting
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */
    public function edit($id = null)
    {
        $id = base64_decode($id);
        $settingTable = tableRegistry::get('Settings');
        $setting = $settingTable->get($id);

        if (!empty($this->request->getData())) {
            $settingTable->patchEntity($setting, $this->request->getData());
            if ($settingTable->save($setting)) {
                $this->Flash->success(__('Setting has been saved'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Setting could not be save'));
            return $this->redirect(['action' => 'edit', base64_decode($id)]);

        }

        $this->set('setting', $setting);
    }

    /**
     * Function name     : delete
     * Description         : delete setting
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function delete($id = null)
    {
        $id = base64_decode($id);
        $settingTable = TableRegistry::get('Settings');
        $setting = $settingTable->find('all')->where(['Settings.id' => $id])->first();
        //pr($transData); die;
        if (!empty($setting)) {
            if ($settingTable->delete($setting)) {
                $this->Flash->success(__('Setting has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Setting could not be deleted. Please, try again.'));
            }

        }
        return $this->redirect($this->referer());
    }

    /**
     * Function name     : alert
     * Description         : list alert
     * Author             : Wepro
     * Created by         : Wepro 26-Apr-2017
     */
    public function alerts()
    {
        $alertSettingTable = tableRegistry::get('AlertSettings');
        $alerts = $this->paginate($alertSettingTable->find()->contain(['AlertTypes']));

        $this->set('alerts', $alerts);
    }

    /**
     * Function name     : alert
     * Description         : alert setting
     * Author             : Wepro
     * Created by         : Wepro 26-Apr-2017
     */

    /* public function add_alert(){
    $alertSettingTable     = tableRegistry::get('AlertSettings');
    $alertTypeTable     = tableRegistry::get('AlertTypes');
    $alert         = $alertSettingTable->newEntity();

    if ($this->request->is('post')) {
    $dependents = TableRegistry::get('dependents');
    $employees = TableRegistry::get('employees');

    $this->request->data['created'] = date('Y-m-d h:i:s');
    $alertSettingTable->patchEntity($alert, $this->request->data);
    try{

    if($alertSettingTable->save($alert)){
    echo 'hereee555'; exit;
    $this->Flash->success(__('Alert has been saved'));
    require_once(ROOT .DS. "Vendor" . DS  . "SMS" . DS . "experttexting_sms.php");
    // Creating an object of ExpertTexting SMS Class.
    $expertTexting = new experttexting_sms();

    if($this->request->data['delivery'] == 0){
    if($this->request->data['alert_type_id'] == 6){
    $days = 30;
    $dependentsEx = $dependents->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Dependents.passport_exp_date)) =' => $days)
    )
    )->contain('Employees');
    $employeesEx = $employees->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.passport_exp_date)) =' => $days)
    )
    );
    }else if($this->request->data['alert_type_id'] == 5){
    $days = 30;
    $dependentsEx = $dependents->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Dependents.passport_exp_date)) =' => $days)
    )
    )->contain('Employees');
    $employeesEx = $employees->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.passport_exp_date)) =' => $days)
    )
    );
    }else if($this->request->data['alert_type_id'] == 4){
    $days = 30;
    $dependentsEx = $dependents->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Dependents.visa_exp_date)) =' => $days)
    )
    )->contain('Employees');
    $employeesEx = $employees->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.visa_exp_date)) =' => $days)
    )
    );

    }else if($this->request->data['alert_type_id'] == 3){
    $days = 30;
    $dependentsEx = $dependents->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Dependents.emiratesID_exp_date)) =' => $days)
    )
    )->contain('Employees');
    $employeesEx = $employees->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.emiratesID_exp_date)) =' => $days)
    )
    );
    }else if($this->request->data['alert_type_id'] == 2){
    $days = 30;
    $dependentsEx = $dependents->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(),DATE(Dependents.entry_permit_exp_date)) =' => $days)
    )
    )->contain('Employees');
    $employeesEx = $employees->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.entry_permit_exp_date)) =' => $days)
    )
    );
    }else if($this->request->data['alert_type_id'] == 1){
    $days = 30;
    $dependentsEx = array();
    $employeesEx = $employees->find('all', array(
    'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.work_permit_exp_date)) =' => $days)
    )
    );
    }
    if(count($dependentsEx) > 0){
    foreach ($dependentsEx as $row) {
    if(!empty($row->employee->mobile_no)){
    $expertTexting->from= 'KAPNFO';
    $expertTexting->to= $row->employee->mobile_no;
    $expertTexting->msgtext= $this->request->data['alert_text'];
    //$expertTexting->send(); // Send SMS method.
    }
    }
    }

    if(count($employeesEx) > 0){
    foreach ($employeesEx as $row) {
    if(!empty($row->mobile_no)){
    $expertTexting->from= 'KAPNFO';
    $expertTexting->to= $row->mobile_no;
    $expertTexting->msgtext= $this->request->data['alert_text'];
    //$expertTexting->send(); // Send SMS method.
    }
    }
    }
    }else if($this->request->data['delivery'] == 1){

    //$expertTexting->ESTScheduleDatetime = $this->request->data['delivery'] ;
    //$expertTexting->send(); // Send SMS method.
    }
    return $this->redirect(['action' => 'alerts']);
    }

    }catch (Exception $e) {
    echo $e->getMessage(); exit;
    }
    echo 'heree588'; exit;
    $this->Flash->error(__('Alert could not be save'));
    return $this->redirect(['action' => 'add_alert']);

    }

    $alert_types  = $alertTypeTable->find('list')->order(['id' => 'DESC']);
    //pr($alert_type->toArray());die('�okk');
    $this->set('alert',$alert);
    $this->set('alert_types',$alert_types);
    }
     */
    public function add_alert()
    {
        $alertSettingTable = tableRegistry::get('AlertSettings');
        $alertTypeTable = tableRegistry::get('AlertTypes');
        $alert = $alertSettingTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $dependents = TableRegistry::get('dependents');
            $employees = TableRegistry::get('employees');

            $requestPayload = $this->request->getData();
            $requestPayload['created'] = date('Y-m-d h:i:s');
            $requestPayload['schduleday'] = '';
            $requestPayload['schdulewhen'] = '';
            $alertSettingTable->patchEntity($alert, $requestPayload);
            try {

                if ($alertSettingTable->save($alert)) {
                    //echo 'hereee555'; exit;
                    $this->Flash->success(__('Alert has been saved'));
                    //require_once(ROOT .DS. "Vendor" . DS  . "SMS" . DS . "experttexting_sms.php");
                    // Creating an object of ExpertTexting SMS Class.
                    //$expertTexting = new experttexting_sms();

                    if ($this->request->getData('delivery') == 0) {
                        if ($this->request->getData('alert_type_id') == 6) {
                            $days = 30;
                            $dependentsEx = $dependents->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Dependents.passport_exp_date)) =' => $days),
                            )
                            )->contain('Employees');
                            $employeesEx = $employees->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.passport_exp_date)) =' => $days),
                            )
                            );
                        } else if ($this->request->getData('alert_type_id') == 5) {
                            $days = 30;
                            $dependentsEx = $dependents->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Dependents.passport_exp_date)) =' => $days),
                            )
                            )->contain('Employees');
                            $employeesEx = $employees->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.passport_exp_date)) =' => $days),
                            )
                            );
                        } else if ($this->request->getData('alert_type_id') == 4) {
                            $days = 30;
                            $dependentsEx = $dependents->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Dependents.visa_exp_date)) =' => $days),
                            )
                            )->contain('Employees');
                            $employeesEx = $employees->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.visa_exp_date)) =' => $days),
                            )
                            );

                        } else if ($this->request->getData('alert_type_id') == 3) {
                            $days = 30;
                            $dependentsEx = $dependents->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Dependents.emiratesID_exp_date)) =' => $days),
                            )
                            )->contain('Employees');
                            $employeesEx = $employees->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.emiratesID_exp_date)) =' => $days),
                            )
                            );
                        } else if ($this->request->getData('alert_type_id') == 2) {
                            $days = 30;
                            $dependentsEx = $dependents->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(),DATE(Dependents.entry_permit_exp_date)) =' => $days),
                            )
                            )->contain('Employees');
                            $employeesEx = $employees->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.entry_permit_exp_date)) =' => $days),
                            )
                            );
                        } else if ($this->request->getData('alert_type_id') == 1) {
                            $days = 30;
                            $dependentsEx = array();
                            $employeesEx = $employees->find('all', array(
                                'conditions' => array('DATEDIFF(CURDATE(), DATE(Employees.work_permit_exp_date)) =' => $days),
                            )
                            );
                        }

                        if (is_array($dependentsEx) && count($dependentsEx) > 0) {
                            foreach ($dependentsEx as $row) {
                                if (!empty($row->employee->mobile_no)) {
                                    $expertTexting->from = 'KAPNFO';
                                    $expertTexting->to = $row->employee->mobile_no;
                                    //$expertTexting->msgtext= $this->request->data['alert_text'];
                                    //$expertTexting->send(); // Send SMS method.
                                }
                            }
                        }

                        if (is_array($employeesEx) && count($employeesEx) > 0) {
                            foreach ($employeesEx as $row) {
                                if (!empty($row->mobile_no)) {
                                    $expertTexting->from = 'KAPNFO';
                                    $expertTexting->to = $row->mobile_no;
                                    //$expertTexting->msgtext= $this->request->data['alert_text'];
                                    //$expertTexting->send(); // Send SMS method.
                                }
                            }
                        }
                    } else if ($this->request->getData('delivery') == 1) {

                        //$expertTexting->ESTScheduleDatetime = $this->request->data['delivery'] ;
                        //$expertTexting->send(); // Send SMS method.
                    }
                    return $this->redirect(['action' => 'alerts']);
                }

            } catch (Exception $e) {
                echo $e->getMessage();exit;
            }
            echo 'heree588';exit;
            $this->Flash->error(__('Alert could not be save'));
            return $this->redirect(['action' => 'add_alert']);

        }

        $alert_types = $alertTypeTable->find('list')->order(['id' => 'DESC']);

        $this->set('alert', $alert);
        $this->set('alert_types', $alert_types);
    }

    public function add_alert_type()
    {
        if ($this->request->params['isAjax']) {
            if (!empty($this->request->data['alert_name'])) {
                $alertTypeTable = tableRegistry::get('AlertTypes');
                $alert_type = $alertTypeTable->newEntity();
                $slug = Inflector::slug(strtolower($this->request->data['alert_name']));
                $alert_type->name = $this->request->data['alert_name'];
                $alert_type->slug = $slug;

                if ($alertTypeTable->save($alert_type)) {
                    echo 'success';
                    die;
                }
                echo 'error';
                die;
            }
            echo 'error';
            die;
        }
    }

    /**
     * Function name     : edit
     * Description         : edit alert
     * Author             : Wepro
     * Created by         : Wepro 26-Apr-2017
     */
    public function edit_alert($id = null)
    {
        $id = base64_decode($id);
        $alertSettingTable = tableRegistry::get('AlertSettings');
        $alertTypeTable = tableRegistry::get('AlertTypes');
        $alert = $alertSettingTable->get($id, ['contain' => ['AlertTypes']]);

        if (!empty($this->request->getData())) {
            $alertSettingTable->patchEntity($alert, $this->request->getData());

            if ($alertSettingTable->save($alert)) {
                $this->Flash->success(__('Alert has been saved'));
                return $this->redirect(['action' => 'alerts']);
            }

            $this->Flash->error(__('Alert could not be save'));
            return $this->redirect(['action' => 'edit_alert', base64_decode($id)]);

        }

        $alertTypes = $alertTypeTable->find('list')->order(['id' => 'DESC']);
        //echo '<pre>';print_r($alert); exit;
        $this->set('alert_types', $alertTypes);
        $this->set('alert', $alert);
    }

    public function scduleSMSNow()
    { //echo 'hreree'; exit;
        $alertSettingTable = tableRegistry::get('AlertSettings');
        $alertSettingTable = $alertSettingTable->find('all')->where(['enable' => 1]);
        $dependents = TableRegistry::get('dependents');
        $employees = TableRegistry::get('employees');
        $this->render(false);

        //echo ROOT .DS. "Vendor" . DS  . "SMS" . DS . "experttexting_sms.php"; exit;
        //require_once(ROOT .DS. "vendor" . DS  . "SMS" . DS . "experttexting_sms.php");
        // Creating an object of ExpertTexting SMS Class.
        //$expertTexting = new experttexting_sms();

        $SendAlertTable = TableRegistry::get('SendAlert');

        //echo '<pre>'; print_r('Heree '); exit;
        foreach ($alertSettingTable as $rowAlert) {
            //echo '<pre>'; print_r($rowAlert); exit;
            $days = $rowAlert->schdulecount;
            if ($days == 0 || $days == '') {
                $days = 30;
            }

            if ($rowAlert->alert_type_id == 6) {
                $dependentsEx = $dependents->find('all', array(
                    'conditions' => array('DATEDIFF(DATE(Dependents.passport_exp_date), CURDATE()) <' => $days, 'DATEDIFF(DATE(Dependents.passport_exp_date), CURDATE()) >' => 0, 'dependents.status' => 1),
                )
                )->contain('Employees');
                $employeesEx = $employees->find('all', array(
                    'conditions' => array('DATEDIFF(DATE(employees.passport_exp_date), CURDATE()) <' => $days, 'DATEDIFF(DATE(employees.passport_exp_date), CURDATE()) >' => 0, 'employees.status' => 1),
                )
                );

                //echo '<pre>';print_r($employeesEx); exit;
                /*$players = $dependents->find('all' , array(
                'conditions' => array('dependents.passport_exp_date >' => 'curdate()' )
                )
                );

                echo '<pre>';print_r($players); //exit;

                echo $players->count();

                foreach($players as $player) {
                echo '<pre>'; print_r($player); exit;
                }

                echo 's';     exit;    */
//echo '<pre>'; print_r($employeesEx); exit;
                //echo $employeesEx->count(); //exit;
                if ($dependentsEx->count()) { //echo '<pre>'; continue; exit;
                    foreach ($dependentsEx as $key => $row) {continue; //echo '<pre>';print_r($row); continue;  //exit;
                        //echo '<pre>'; print_r($row); exit;
                        if (!empty($row['employee']['email'])) {
                            $settingTable = tableRegistry::get('Settings');
                            $Row = $settingTable->find('all');
                            foreach ($Row as $key => $value) {
                                $CCemails = explode(",", $value['cc_emails']);
                            }
                            /**/
                            //$row['employee']['email'] = 'adnan.shoukat786@yahoo.com';
                            //$CCemails = array('adnan.shoukat786@yahoo.com');
                            /**/

                            $email = new Email('default');
                            $email->from(['portal@enjazsys.com' => 'Daman portal'])
                                ->to($row->employee->email)
                                ->cc($CCemails)

                            //->cc('Naser.Shahrour@trane.com')
                            //->cc('badry@damanservices.ae')
                            //->bcc('adnan.shoukat786@yahoo.com')
                            //->Bcc('adnan.shoukat786@yahoo.com')

                                ->template('passportExpiryDep')
                                ->emailFormat('html')
                                ->subject("Passport expiry notification of " . $row->name)
                                ->viewVars(array('row' => $row))
                                ->send(); /**/
                            //echo 'heree'; exit;
                            $SendAlert = $SendAlertTable->newEntity();
                            $SendAlert->alert_types_id = $rowAlert->alert_type_id;
                            $SendAlert->employee_id = $row->id;
                            $SendAlert->dependet_id = $row->id;
                            $SendAlert->for_whom = 2;
                            $SendAlertTable->save($SendAlert); //echo 'Done'; exit;
                            /*$expertTexting->from= 'KAPNFO';
                            $expertTexting->to= $row->employee->mobile_no;
                            $expertTexting->msgtext= $this->request->data['alert_text']; */
                            //$expertTexting->send(); // Send SMS method.
                        }
                    } //echo 'Not Done inner'; exit;
                }
                //echo '<pre>'; echo 'hereee'; print_r($employeesEx); exit;
                if ($employeesEx->count()) {
                    foreach ($employeesEx as $row) {
                        if (!empty($row['email'])) {
                            $settingTable = tableRegistry::get('Settings');
                            $Row = $settingTable->find('all');
                            foreach ($Row as $key => $value) {
                                $CCemails = explode(",", $value['cc_emails']);
                            }
                            /**/
                            //$row['employee']['email'] = 'adnan.shoukat786@yahoo.com';
                            //$CCemails = array('adnan.shoukat786@yahoo.com');
                            /**/

                            $email = new Email('default');
                            $email->from(['portal@enjazsys.com' => 'Daman portal'])
                                ->to($row->employee->email)
                            //->cc('Naser.Shahrour@trane.com')
                            //->to('badry@damanservices.ae')
                            //->Bcc('adnan.shoukat786@yahoo.com')
                            //->Bcc('adnan.shoukat786@yahoo.com')
                                ->cc($CCemails)

                                ->template('passportExpiryEmp')
                                ->emailFormat('html')
                                ->subject("Passport expiry notification of " . $row->name)
                                ->viewVars(array('row' => $row))
                                ->send(); /**/

                            $SendAlert = $SendAlertTable->newEntity();
                            $SendAlert->alert_types_id = $rowAlert->alert_type_id;
                            $SendAlert->employee_id = $row->id;
                            $SendAlert->dependet_id = $row->id;
                            $SendAlert->for_whom = 1;
                            $SendAlertTable->save($SendAlert); //exit;
                            /*$expertTexting->from= 'KAPNFO';
                            $expertTexting->to= $row->employee->mobile_no;
                            $expertTexting->msgtext= $this->request->data['alert_text']; */
                            //$expertTexting->send(); // Send SMS method.
                        }
                    } /**/
                }
            } else if ($rowAlert->alert_type_id == 4) { //exit;
                $dependentsEx = $dependents->find('all', array(
                    'conditions' => array('DATEDIFF(DATE(Dependents.visa_exp_date), CURDATE()) <' => $days, 'DATEDIFF(DATE(Dependents.passport_exp_date), CURDATE()) >' => 0, 'dependents.status' => 1),
                )
                )->contain('Employees');
                $employeesEx = $employees->find('all', array(
                    'conditions' => array('DATEDIFF(DATE(employees.visa_exp_date), CURDATE()) <' => $days, 'DATEDIFF(DATE(employees.passport_exp_date), CURDATE()) >' => 0, 'employees.status' => 1),
                )
                );
                //echo '<pre>'; print_r($dependentsEx); exit;
                if (count($dependentsEx) > 0) {
                    foreach ($dependentsEx as $row) { //echo '<pre>';print_r($row); exit;
                        //echo '<pre>'; print_r($dependentsEx); exit;
                        if (!empty($row['employee']['email'])) {
                            $settingTable = tableRegistry::get('Settings');
                            $Row = $settingTable->find('all');
                            foreach ($Row as $key => $value) {
                                $CCemails = explode(",", $value['cc_emails']);
                            }
                            /**/
                            //$row['employee']['email'] = 'adnan.shoukat786@yahoo.com';
                            //$CCemails = array('adnan.shoukat786@yahoo.com');
                            /**/

                            $email = new Email('default');
                            $email->from(['portal@enjazsys.com' => 'Daman portal'])
                                ->to($row->employee->email)
                                ->cc($CCemails)

                            //->cc('Naser.Shahrour@trane.com')
                            //->to('badry@damanservices.ae')
                            //->bcc('adnan.shoukat786@yahoo.com')
                            //->Bcc('adnan.shoukat786@yahoo.com')

                                ->template('renewalExpiryDep')
                                ->emailFormat('html')
                                ->subject("Visa expiry notification of " . $row->name)
                                ->viewVars(array('row' => $row))
                                ->send(); /**/
                            $SendAlert = $SendAlertTable->newEntity();
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
                if (count($employeesEx) > 0) {
                    foreach ($employeesEx as $row) {
                        if (!empty($row['email'])) {
                            $settingTable = tableRegistry::get('Settings');
                            $Row = $settingTable->find('all');
                            foreach ($Row as $key => $value) {
                                $CCemails = explode(",", $value['cc_emails']);
                            }
                            /**/
                            //$row['employee']['email'] = 'adnan.shoukat786@yahoo.com';
                            //$CCemails = array('adnan.shoukat786@yahoo.com');
                            /**/

                            $email = new Email('default');
                            $email->from(['portal@enjazsys.com' => 'Daman portal'])
                                ->to($row->employee->email)
                                ->cc($CCemails)

                            //->cc('Naser.Shahrour@trane.com')
                            //->to('badry@damanservices.ae')
                            //->Bcc('adnan.shoukat786@yahoo.com')

                                ->template('renewalExpiryEmp')
                                ->emailFormat('html')
                                ->subject("Visa expiry notification of " . $row->name)
                                ->viewVars(array('row' => $row))
                                ->send(); /**/
                            $SendAlert = $SendAlertTable->newEntity();
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
        echo '<pre>';
        print_r('Done');exit;
        $email = new Email('default');
        $email->from(['portal@enjazsys.com' => 'My report daman'])
            ->subject('My report daman')
            ->send($_SERVER); /**/
        //mail("adnan.shoukat786@yahoo.com","Daman",$_REQUEST);
        echo 'Done';exit;
    }

    public function scduleSMS()
    {
        $alertSettingTable = tableRegistry::get('AlertSettings');
        $alertSettingTable = $alertSettingTable->find('all')->where(['enable' => 1]);
        $dependents = TableRegistry::get('Dependents');
        $employees = TableRegistry::get('Employees');
        $this->render(false);

        //echo ROOT .DS. "Vendor" . DS  . "SMS" . DS . "experttexting_sms.php"; exit;
        //require_once(ROOT .DS. "vendor" . DS  . "SMS" . DS . "experttexting_sms.php");
        // Creating an object of ExpertTexting SMS Class.
        //$expertTexting = new experttexting_sms();

        $SendAlertTable = TableRegistry::get('SendAlert');
        $email = new Mailer();

        foreach ($alertSettingTable as $rowAlert) {

            $days = $rowAlert->schdulecount;
            /*if(empty($days)){
            $days = 30;
            }*/
            //echo $days ; exit;
            //echo 'Here 456'; exit;
            //echo date("l jS \of F Y h:i:s A"); exit;
            if ($rowAlert->alert_type_id == 6) {
                $dependentsEx = $dependents
                ->find('all', array(
                    'conditions' => array('DATEDIFF(DATE(Dependents.passport_exp_date), CURDATE()) =' => $days, 'Dependents.status' => 1),
                )
                )->contain('Employees.Companies');

                $employeesEx = $employees->find('all', array(
                    'conditions' => array('DATEDIFF(DATE(employees.passport_exp_date), CURDATE()) =' => $days, 'employees.status' => 1),
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
                            ($emailToSend = (clone $email))
                                ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
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

                            $emailToSend->deliver($mailMessage); /**/

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

                            $CCemails = array_filter(array_merge($CCemails, explode(",", $row['employee']['cc_emails'])));

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
                            ($emailToSend = (clone $email))
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

                              $emailToSend->deliver($mailMessage); /**/

                            $SendAlert = $SendAlertTable->newEntity();
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
            } else if ($rowAlert->alert_type_id == 4) {
                $dependentsEx = $dependents->find('all', array(
                    'conditions' => array('DATEDIFF(DATE(dependents.visa_exp_date), CURDATE()) =' => $days, 'dependents.status' => 1),
                )
                )->contain('Employees.Companies');
                $employeesEx = $employees->find('all', array(
                    'conditions' => array('DATEDIFF(DATE(employees.visa_exp_date), CURDATE()) =' => $days, 'employees.status' => 1),
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

                            ($emailToSend = (clone $email))
                                ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                                ->setTo($row->employee->email)
                                ->setCc($CCemails)

                              //->to('badry@damanservices.ae')
                              //->Bcc('adnan.shoukat786@yahoo.com')

                              //->message($mailMessage)
                                  ->setEmailFormat('html')
                                  ->setSubject("Visa expiry notification of " . $row->name)
                                  ->setViewVars(array('row' => $row))
                                  ->viewBuilder();

                              $emailToSend->deliver($mailMessage); /**/

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

                            $CCemails = array_filter(array_merge($CCemails, explode(",", $row['employee']['cc_emails'])));
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

                            ($emailToSend = (clone $email))
                                ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                                ->setTo($row->email)
                                ->setCc($CCemails)

                              //->to('badry@damanservices.ae')
                              //->Bcc('adnan.shoukat786@yahoo.com')

                              //->message($mailMessage)
                                  ->setEmailFormat('html')
                                  ->setSubject("Visa expiry notification of " . $row->name)
                                  ->setViewVars(array('row' => $row))
                                  ->viewBuilder();

                              $emailToSend->deliver($mailMessage); /**/

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
        echo '<pre>';
        print_r($_SERVER);exit;
        $email = new Email('default');
        $email->from(['portal@enjazsys.com' => 'My report daman'])
            ->Bcc('adnan.shoukat786@yahoo.com')
            ->subject('My report daman')
            ->send($_SERVER); /**/
        //mail("adnan.shoukat786@yahoo.com","Daman",$_REQUEST);
        echo 'Done';exit;
    }
}
