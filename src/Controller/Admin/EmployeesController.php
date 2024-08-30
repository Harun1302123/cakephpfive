<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Exception;

//use App\View\Helper;
//App::uses('DateHelper', 'View/Helper');

class EmployeesController extends AppController
{
    // public $components = array('RequestHandler');
    //public $helpers = array('Html' => array('className' => 'DateCHelper'));
    public $paginate = [
        'limit' => 20,
        'order' => [
            'Employees.id' => 'DESC',
        ],
    ];

    public function initialize(): void
    {
        $this->loadComponent('RequestHandler');
        parent::initialize();
        //$this->loadHelper('DateC');
        //$this->DateC->DateFormetCake('here');
        //echo $getresponse = $this->DateC->DateFormetCake('Date'); exit;
        //$yourHelper = new DateHelper(new View());
        //echo $yourHelper->DateFormetCake();

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('admin');
    }

    /**
     * Function name     : index
     * Description         : list Employees
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function index($id = null)
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],
            'contain' => ['Companies'],
        ];

        $conditions = [];
        $employeeTable = tableRegistry::get('Employees');
        $query = $employeeTable
            ->find('all')
            ->enableAutoFields(true);

        if ($this->request->is('ajax')) {

            if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
                // array_push($conditions, array(['Employees.company_id' => $_GET['company_id']]));
                $query->where(['Employees.company_id' => $_GET['company_id']]);
            }

            if ($this->request->getQuery('email_or_name')) {
                $searchQuery = $this->request->getQuery('email_or_name');
                // array_push($conditions, ['OR' => [['Employees.email LIKE' => '%' . ltrim($searchQuery) . '%'], ['Employees.name LIKE' => '%' . trim($searchQuery) . '%']]]);
                $query->where(
                    function(QueryExpression $expression, Query $query) use($searchQuery): QueryExpression {
                            return $query
                                ->newExpr()
                                ->or(['Employees.email LIKE' => '%' . ltrim($searchQuery) . '%'])
                                ->add(['Employees.name LIKE' => '%' . trim($searchQuery) . '%']);
                    }
                );
            }
        }

        $employees = $this->paginate($query);
        $companyTable = tableRegistry::get('Companies');
        $companies = $companyTable->find('list');

        $this->set('companies', $companies);
        $this->set('employees', $employees);

    }

    /**
     * Function name     : add
     * Description         : Add Employees related Information
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function add($referer = null): void
    {
        $employeeTable = tableRegistry::get('Employees');
        $companyTable = tableRegistry::get('Companies');
        $employee = $employeeTable->newEmptyEntity();
        //echo '<pre>'; print_r($this->request); exit;

        //$settingsTable     = tableRegistry::get('Settings'); //cc_emails
        //$settingsTable->find('all');

        if ($this->request->is('post')) {
            //echo '<pre>'; print_r($this->request->data); exit;
            $requestData = $this->request->getData();
            unset($requestData['image']);
            /*if(isset($this->request->data['skip'])){
            $referer = null;
            }*/
            //
            /*$this->request->data['passport_exp_date']        = $this->request->data['passport_exp_date_cus'];
            $this->request->data['work_permit_exp_date']    = $this->request->data['work_permit_exp_date_cus'];
            $this->request->data['entry_permit_exp_date']    = $this->request->data['entry_permit_exp_date_cus'];
            $this->request->data['visa_exp_date']            = $this->request->data['visa_exp_date_cus'];
            $this->request->data['emiratesID_exp_date']        = $this->request->data['emiratesID_exp_date_cus'];
            $this->request->data['labor_card_exp_date']        = $this->request->data['labor_card_exp_date_cus'];
            $this->request->data['health_card_exp_date']    = $this->request->data['health_card_exp_date_cus'];*/
            // $this->request->data['created'] = date();
            $this->request->withData('created', date('Y-m-d H:i:s'));
            //print_r($this->request->data); exit;
            $employeeTable->patchEntity($employee, $requestData);
            $employee->user_id = $this->Auth->user('id');
            try {
                if ($employeeTable->save($employee)) {
                    // $compnay = $companyTable->find('all')->where(['id' => $employee['company_id']])->first();
                    $compnay = $companyTable->find('all', ['id' => $employee['company_id']])
                        ->first()
                        ->toArray();

                    $documents = TableRegistry::get('Documents');
                    /*if(isset($this->request->data['files'][0]['tmp_name']) && !empty($this->request->data['files'][0]['tmp_name'])){
                    foreach($this->request->data['files'] as $file){
                    $data = pathinfo($file['name']);
                    $ext = $data['extension'];
                    $tmp_name = $file['tmp_name'];
                    $newName = 'employee_'.uniqid().'.'.$ext;

                    $cimage = $documents->newEntity();
                    $cimage->related_id = $employee->id;
                    $cimage->eTitle      = 'employee';
                    $cimage->sectionName = 'employee';
                    $cimage->file = $newName;

                    if($documents->save($cimage)){
                    move_uploaded_file($tmp_name, "documents/employee/".$newName);
                    }
                    }
                    }*/
                    /*Files Names*/
                    $filesName = array('passport_files' => 'Passport', 'visa_files' => 'Visa', 'id_files' => 'Emirates ID', 'lcard_files' => 'Labor Card', 'hcard_files' => 'Health Care', 'other_files' => 'Other Files');
                    // if (isset($requestData['files']) && count($requestData['files'])) {
                    //     foreach ($requestData['files'] as $fileKey => $file) {
                    //         foreach ($file as $innerFileKey => $innerFileValue) {
                    //             if (isset($innerFileValue['tmp_name']) && !empty($innerFileValue['tmp_name'])) {
                    //                 $data = pathinfo($innerFileValue['name']);
                    //                 $ext = $data['extension'];
                    //                 $tmp_name = $innerFileValue['tmp_name'];
                    //                 $newName = 'employee_' . uniqid() . '.' . $ext;

                    //                 $cimage = $documents->newEntity();
                    //                 $cimage->related_id = $employee->id;
                    //                 $cimage->eTitle = 'employee';
                    //                 $cimage->sectionName = 'employee';
                    //                 $cimage->aTitle = $data['filename']; //$filesName[$fileKey];
                    //                 $cimage->file = $newName;
                    //                 if ($documents->save($cimage)) {
                    //                     move_uploaded_file($tmp_name, "documents/employee/" . $newName);
                    //                 }
                    //             }
                    //         }
                    //     }
                    // }

                    if (isset($requestData['files']) && count($requestData['files'])) {
                        foreach ($requestData['files'] as $file) {
                            foreach ($file as $key => $value) {
                                if (!empty($value) && $value->getSize()) {

                                    $data = pathinfo($value->getClientFilename());
                                    $ext = $data['extension'];
                                    $newName = 'employee_' . uniqid() . '.' . $ext;

                                    $cimage = $documents->newEmptyEntity();
                                    $cimage->related_id = $employee->id;
                                    $cimage->eTitle = 'employee';
                                    $cimage->aTitle = $value->getClientFilename(); //$filesName[$fileKey];
                                    $cimage->sectionName = 'employee';
                                    $cimage->file = $newName;
                                    $documents->save($cimage);
                                    $targetPath = WWW_ROOT . 'documents' . DS . 'employee' . DS . $newName;
                                    $value->moveTo($targetPath);
                                }
                            }
                        }
                    }

                    unset($requestData['files']);
                    $ClientsDocuments = TableRegistry::get('ClientsDocuments');
                    $Cdoc = $ClientsDocuments->newEntity(
                        array_merge(
                            $requestData,
                            [
                                'person_id' => $employee->id,
                                'section_name' => 'employee',
                            ]
                        )
                    );
                    // $Cdoc->person_id = $employee->id;
                    // $Cdoc->passport_receive_admin = $this->request->data['passport_receive_admin'];
                    // $Cdoc->passport_send_admin = $this->request->data['passport_send_admin'];
                    // $Cdoc->passport_receive_admin_date = $this->request->data['passport_receive_admin_date'];
                    // $Cdoc->passport_send_admin_date = $this->request->data['passport_send_admin_date'];
                    // $Cdoc->bc_receive_admin = $this->request->data['bc_receive_admin'];
                    // $Cdoc->bc_send_admin = $this->request->data['bc_send_admin'];
                    // $Cdoc->bc_receive_admin_date = $this->request->data['bc_receive_admin_date'];
                    // $Cdoc->bc_send_admin_date = $this->request->data['bc_send_admin_date'];
                    // $Cdoc->mc_receive_admin = $this->request->data['mc_receive_admin'];
                    // $Cdoc->mc_send_admin = $this->request->data['mc_send_admin'];
                    // $Cdoc->mc_receive_admin_date = $this->request->data['mc_receive_admin_date'];
                    // $Cdoc->mc_send_admin_date = $this->request->data['mc_send_admin_date'];
                    // $Cdoc->eid_receive_admin = $this->request->data['eid_receive_admin'];
                    // $Cdoc->eid_send_admin = $this->request->data['eid_send_admin'];
                    // $Cdoc->eid_receive_admin_date = $this->request->data['eid_receive_admin_date'];
                    // $Cdoc->eid_send_admin_date = $this->request->data['eid_send_admin_date'];
                    // $Cdoc->dc_receive_admin = $this->request->data['dc_receive_admin'];
                    // $Cdoc->dc_send_admin = $this->request->data['dc_send_admin'];
                    // $Cdoc->dc_receive_admin_date = $this->request->data['dc_receive_admin_date'];
                    // $Cdoc->dc_send_admin_date = $this->request->data['dc_send_admin_date'];
                    // $Cdoc->medical_receive_admin = $this->request->data['medical_receive_admin'];
                    // $Cdoc->medical_send_admin = $this->request->data['medical_send_admin'];
                    // $Cdoc->medical_receive_admin_date = $this->request->data['medical_receive_admin_date'];
                    // $Cdoc->medical_send_admin_date = $this->request->data['medical_send_admin_date'];
                    // $Cdoc->other_receive_admin = $this->request->data['other_receive_admin'];
                    // $Cdoc->other_send_admin = $this->request->data['other_send_admin'];
                    // $Cdoc->other_receive_value = $this->request->data['other_receive_value'];
                    // $Cdoc->other_send_value = $this->request->data['other_send_value'];

                    // $Cdoc->other_receive_admin_date = $this->request->data['other_receive_admin_date'];
                    // $Cdoc->other_send_admin_date = $this->request->data['other_send_admin_date'];
                    // $Cdoc->section_name = 'employee';
                    $ClientsDocuments->save($Cdoc);
                    $email = new Mailer();

                    if (
                        isset($requestData['passport_receive_admin'])
                        || isset($requestData['bc_receive_admin'])
                        || isset($requestData['mc_receive_admin'])
                        || isset($requestData['eid_receive_admin'])
                        || isset($requestData['dc_receive_admin'])
                        || isset($requestData['medical_receive_admin'])
                        || isset($requestData['other_receive_admin'])
                    ) {
                        $emailTo = $this->request->getData('email');
                        //$this->request->data['email']
                        $settingTable = tableRegistry::get('Settings');
                        $Row = $settingTable->find('all');

                        foreach ($Row as $key => $value) {
                            $CCemails = explode(",", $value['cc_emails']);
                        }

                        $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));

                        // $this->request->data['email'] = $this->request->data['email'] != '' ? $this->request->data['email'] : $CCemails[0];
                        if (!$emailTo) {
                            $emailTo = trim($CCemails[0]);
                        }

                        ($emailReceviedDoc = (clone $email))
                            ->setSubject("Delivery note of " . $this->request->getData('name'))
                            ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            ->setTo($emailTo)
                            ->setEmailFormat('html')
                            ->setCc($CCemails)
                            ->setViewVars(array('information' => $this->request->getData()))
                                ->viewBuilder()
                                    ->setTemplate('documentsConfirmationReceiveEmployeeAdd');

                        $emailReceviedDoc->deliver(); /**/

                    }

                    if (
                        isset($requestData['passport_send_admin'])
                        || isset($requestData['bc_send_admin'])
                        || isset($requestData['mc_send_admin'])
                        || isset($requestData['eid_send_admin'])
                        || isset($requestData['dc_send_admin'])
                        || isset($requestData['medical_send_admin'])
                        || isset($requestData['other_send_admin'])
                    ) {
                        $emailTo = $this->request->getData('email');

                        $settingTable = tableRegistry::get('Settings');

                        $Row = $settingTable->find('all');

                        foreach ($Row as $key => $value) {
                            $CCemails = explode(",", $value['cc_emails']);
                        }

                        if (!$emailTo) {
                            $emailTo = trim($CCemails[0]);
                        }
                        //  = $this->request->data['email'] != '' ? $this->request->data['email'] : $CCemails[0];
                        //Delivery note of $this->request->data['name']
                        ($emailSendDoc = (clone $email))
                            ->setSubject("Delivery note of " . $this->request->getData('name'))
                            ->setEmailFormat('html')
                            ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            ->setTo($emailTo)
                            ->setCc($CCemails)
                            ->setViewVars(array('information' => $this->request->getData()))
                            ->viewBuilder()
                                ->setTemplate('documentsConfirmationSendEmployeeAdd');

                        $emailSendDoc->send();

                    }
                    $response['status'] = true;
                    $response['url'] = Router::url(['controller' => 'dependents', 'action' => 'add', base64_encode($employee->id)], true);
                    $response['message'] = 'Employee Information saved successfully';
                    $this->Flash->success(__('Employee Information saved successfully'));
                } else {
                    $response['status'] = false;
                    $response['message'] = 'Employee could not be save';
                }
            } catch (Exception $e) {
                $response['status'] = false;
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);exit;
        }

        $companies = $companyTable->find('list');
        $countries = TableRegistry::get('Countries')->find('list', ['keyField' => 'name', 'valueField' => 'name']);

        $this->set('countries', $countries);
        $this->set('employee', $employee);
        $this->set('companies', $companies);
    }

    /**
     * Function name     : edit
     * Description         : edit Employees related Information
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */
    public function edit($id = null)
    {
        $id = base64_decode($id);
        $companyTable = tableRegistry::get('Companies');
        $employeeTable = tableRegistry::get('Employees');
        $employee = $employeeTable->get($id, ['contain' => ['Documents', 'ClientsDocuments']]);

        if (!empty($this->request->getData())) {
            //echo '<pre>'; print_r($this->request->data); exit;

            /*$this->request->data['passport_exp_date']        = $this->request->data['passport_exp_date_cus'];
            $this->request->data['work_permit_exp_date']    = $this->request->data['work_permit_exp_date_cus'];
            $this->request->data['entry_permit_exp_date']    = $this->request->data['entry_permit_exp_date_cus'];
            $this->request->data['visa_exp_date']            = $this->request->data['visa_exp_date_cus'];
            $this->request->data['emiratesID_exp_date']        = $this->request->data['emiratesID_exp_date_cus'];
            $this->request->data['labor_card_exp_date']        = $this->request->data['labor_card_exp_date_cus'];
            $this->request->data['health_card_exp_date']    = $this->request->data['health_card_exp_date_cus'];*/
            $oldValues = $employee->clients_document;
            $oldValues = json_decode(json_encode($oldValues), true);

            $changed_receive = array();
            $changed_send = array();
            $clientDocumentsPayload = $this->request->getData('clients_document');
            foreach ($clientDocumentsPayload as $key => $value) {
                if ($oldValues[$key] != $value && (strpos($key, 'date') == false) && (strpos($key, 'value') == false) && ($value != 0)) {
                    if (strpos($key, 'receive') !== false) {
                        $changed_receive[$key] = $value;
                    }
                    if (strpos($key, 'send') !== false) {
                        $changed_send[$key] = $value;
                    }
                }
            }
            $requestPayload = $this->request->getData();
            $requestPayload['clients_document']['section_name'] = 'employee';
            $employeeTable->patchEntity($employee, $requestPayload);
            //echo '<pre>';print_r($employee['clients_document']['medical_send_admin_date']);
            //echo '<pre>';print_r($this->request->data['clients_document']['medical_send_admin_date']); exit;
            try {
                if ($employeeTable->save($employee)) {
//echo '<pre>'; print_r($this->request->data); exit;
                    $ClientsDocuments = TableRegistry::get('ClientsDocuments');
                    //$Cdoc = $ClientsDocuments->newEntity();
                    //$this->request->data['clients_document']['id'] = $employee->clients_document->id;
                    //$ClientsDocuments->patchEntity($Cdocs, $this->request->data['clients_document']);
                    //echo '<pre>';print_r($this->request->data['clients_document']); exit;
                    $Cdocs = $ClientsDocuments->get($employee->clients_document->id);
                    $ClientsDocuments->patchEntity($Cdocs, $clientDocumentsPayload);
                    $ClientsDocuments->save($Cdocs);
                    $documents = TableRegistry::get('Documents');
                    $filesName = array('passport_files' => 'Passport', 'visa_files' => 'Visa', 'id_files' => 'Emirates ID', 'lcard_files' => 'Labor Card', 'hcard_files' => 'Health Care', 'other_files' => 'Other Files');

                    // foreach ($this->request->getData('files') as $fileKey => $file) {
                    //     foreach ($file as $innerFileKey => $innerFileValue) {
                    //         if (isset($innerFileValue['tmp_name']) && !empty($innerFileValue['tmp_name'])) {

                    //             $data = pathinfo($innerFileValue['name']);
                    //             //echo '<pre>';print_r($data['filename']); exit;
                    //             $ext = $data['extension'];
                    //             $tmp_name = $innerFileValue['tmp_name'];
                    //             $newName = 'employee_' . uniqid() . '.' . $ext;

                    //             $cimage = $documents->newEntity();
                    //             $cimage->related_id = $employee->id;
                    //             $cimage->eTitle = 'employee';
                    //             $cimage->sectionName = 'employee';
                    //             $cimage->aTitle = $data['filename']; //$filesName[$fileKey];
                    //             $cimage->file = $newName;
                    //             if ($documents->save($cimage)) {
                    //                 move_uploaded_file($tmp_name, "documents/employee/" . $newName);
                    //             }
                    //         }
                    //     }

                    // }

                    if (isset($requestPayload['files']) && count($requestPayload['files'])) {
                        foreach ($requestPayload['files'] as $file) {
                            foreach ($file as $key => $value) {
                                if (!empty($value) && $value->getSize()) {

                                    $data = pathinfo($value->getClientFilename());
                                    $ext = $data['extension'];
                                    $newName = 'employee_' . uniqid() . '.' . $ext;

                                    $cimage = $documents->newEmptyEntity();
                                    $cimage->related_id = $employee->id;
                                    $cimage->eTitle = 'employee';
                                    $cimage->aTitle = $value->getClientFilename(); //$filesName[$fileKey];
                                    $cimage->sectionName = 'employee';
                                    $cimage->file = $newName;
                                    $documents->save($cimage);
                                    $targetPath = WWW_ROOT . 'documents' . DS . 'employee' . DS . $newName;
                                    $value->moveTo($targetPath);
                                }
                            }
                        }
                    }

                    $compnay = $companyTable->find('all')->where(['id' => $employee['company_id']])->first();

                    $email = new Mailer();

                    if (!empty($changed_receive)) {
                        $settingTable = tableRegistry::get('Settings');
                        $Row = $settingTable->find('all');
                        foreach ($Row as $key => $value) {
                            $CCemails = explode(",", $value['cc_emails']);
                        }
                        $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));
                        // $this->request->data['email'] = $this->request->data['email'] != '' ? $this->request->data['email'] : $CCemails[0];
                        $emailTo = $CCemails[0];

                        if ($this->request->getData('email')) {
                            $emailTo = $this->request->getData('email');
                        }

                        $changed_receive['name'] = $this->request->getData('name');

                        if (isset($clientDocumentsPayload['other_receive_value'])) {
                            $changed_receive['other_receive_value'] = $clientDocumentsPayload['other_receive_value'];
                        }
                        // $email = new Email('default');
                        //$this->request->data['email']
                        ($emailDocRecEmp = (clone $email))
                            ->setSubject("Delivery note of " . $changed_receive['name'])
                            ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            ->setTo($emailTo)
                            ->setCc($CCemails)
                            ->setEmailFormat('html')
                            ->setViewVars(array('information' => $changed_receive))
                            ->viewBuilder()
                            ->setTemplate('documentsConfirmationReceiveEmployeeAdd');

                        $emailDocRecEmp->send(); /**/
                    }
                    if (!empty($changed_send)) {
                        $settingTable = tableRegistry::get('Settings');
                        $Row = $settingTable->find('all');
                        foreach ($Row as $key => $value) {
                            $CCemails = explode(",", $value['cc_emails']);
                        }

                        $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));
                        // $this->request->data['email'] = $this->request->data['email'] != '' ? $this->request->data['email'] : $CCemails[0];
                        $emailTo = $CCemails[0];

                        if ($this->request->getData('email')) {
                            $emailTo = $this->request->getData('email');
                        }

                        $changed_send['name'] = $this->request->getData('name');

                        if (isset($clientDocumentsPayload['other_send_value'])) {
                            $changed_send['other_send_value'] = $clientDocumentsPayload['other_send_value'];
                        }
                        //echo $this->request->data['email']; exit;
                        ($emailDocConfirm = (clone $email))
                            ->setSubject("Delivery note of " . $changed_send['name'])
                            ->setEmailFormat('html')
                            ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            ->setViewVars(array('information' => $changed_send))
                            ->setTo($emailTo)
                            ->setCc($CCemails)
                            ->viewBuilder()
                            ->setTemplate('documentsConfirmationSendEmployeeAdd');

                        $emailDocConfirm->send();
                    }

                    if ($this->request->getData('status') == 0) {
                        $dependents = TableRegistry::get('dependents')->query();
                        $dependents->update()
                            ->set(['status' => 0])
                            ->where(['employee_id' => $id])
                            ->execute();
                    }
                    $response['status'] = true;
                    $response['url'] = Router::url(['action' => 'index'], true);
                    $response['message'] = 'Employee Information updated successfully';
                    $this->Flash->success(__('Employee Information updated successfully'));
                } else {
                    $response['status'] = false;
                    $response['message'] = 'Employee could not be save';
                }
            } catch (Exception $e) {
                $response['status'] = false;
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);exit;
        }
        $companies = $companyTable->find('list');
        $countries = TableRegistry::get('Countries')->find('list', ['keyField' => 'name', 'valueField' => 'name']);

        $this->set('countries', $countries);
        $this->set('companies', $companies);
        $this->set('employee', $employee);
        $this->set('controller', $this->request->getParam('controller'));
    }

    /**
     * Function name     : Delete
     * Description         : Delete functionality for employee
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function delete($id = null)
    {
        $id = base64_decode($id);
        $employeeTable = TableRegistry::get('Employees');
        $employee = $employeeTable->find('all')->where(['Employees.id' => $id])->first();
        //pr($transData); die;
        if (!empty($employee)) {
            if ($employeeTable->delete($employee)) {
                $documentTable = TableRegistry::get('Documents');
                $documents = $documentTable->find('all')->where(['Documents.related_id' => $id, 'Documents.sectionName' => 'employee'])->toArray();

                if (!empty($documents)) {
                    foreach ($documents as $document) {
                        $path = WWW_ROOT . 'documents/employee/' . $document->file;
                        if ($documentTable->delete($document) && file_exists($path)) {
                            unlink($path);
                        }
                    }
                }
                $this->Flash->success(__('Employee has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Employee could not be deleted. Please, try again.'));
            }

        }
        return $this->redirect($this->referer());
    }

    /**
     * Function name     : Delete employee documents
     * Description         : Delete functionality for Company  documents
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function deleteEmployeeDocument($id = null)
    {
        $id = base64_decode($id);
        $documentTable = TableRegistry::get('Documents');
        $document = $documentTable->find('all')->where(['Documents.id' => $id, 'Documents.sectionName' => 'employee'])->first();

        if (!empty($document)) {
            $path = WWW_ROOT . 'documents/employee/' . $document->file;
            if ($documentTable->delete($document)) {
                unlink($path);
                $this->Flash->success(__('The Document has been deleted.'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('The Document could not be deleted. Please, try again.'));
            }

        }
        return $this->redirect($this->referer());
    }

    public function DownloadEmployeeDocument($id = null)
    {
        $id = base64_decode($id);
        $documentTable = TableRegistry::get('Documents');
        $document = $documentTable->find('all')->where(['Documents.id' => $id, 'Documents.sectionName' => 'employee'])->first();

        if (!empty($document)) {
            $path = WWW_ROOT . 'documents/employee/' . $document->file;

            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . basename($path));
            readfile($path);
            exit();

        }
        return $this->redirect($this->referer());
    }

    /**
     * Function name     : save employee attachment title
     * Description         : save employee attachment title
     * Author             : Wepro
     * Created by         : Wepro 5-May-2017
     */

    public function save_title()
    {
        if ($this->request->is('ajax')) {

            $id = base64_decode($this->request->getData('id'));
            $title = $this->request->getData('title');
            $documents = TableRegistry::get('Documents');
            $query = $documents->query();
            $query->update()->set(['aTitle' => $title])
                ->where(['id' => $id])
                ->execute();
            die;
        }
    }

    /**
     * Function name     : upload_attachment
     * Description         : upload_attachment is used for upload file from "Manage Employees" file
     * Author             : Wepro
     * Created by         : Wepro 8-May-2017
     */

    public function upload_attachment($empId = null)
    {
        if (!$this->request->is('post')) {
            die;
        }

        $requestData = $this->request->getData();
        $empId = base64_decode($requestData['employee-id']);

        if (empty($empId)) {
            $this->Flash->error(__('Something went wrong. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        if (empty($requestData['attachment-title'])) {
            $this->Flash->error(__('Please fill attachment title. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        if (empty($requestData['attachment-file'])) {
            $this->Flash->error(__('Please choose file. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        if (!($requestData['attachment-file'] instanceof \Laminas\Diactoros\UploadedFile)) {
            $this->Flash->error(__('Please choose valid file. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        $documents = TableRegistry::get('Documents');

        $file = $requestData['attachment-file'];
        $data = pathinfo($file->getClientFilename());
        $ext = $data['extension'];
        $tmp_name = $file->getStream()->getMetadata('uri');
        $newName = 'employee_' . uniqid() . '.' . $ext;

        $cimage = $documents->newEmptyEntity();
        $cimage->related_id = $empId;
        $cimage->eTitle = 'employee';
        $cimage->aTitle = $requestData['attachment-title'];
        $cimage->sectionName = 'employee';

        $cimage->file = $newName;

        if (!$documents->save($cimage)) {
            $this->Flash->error(__('Document couldnot be saved'));
            return $this->redirect(['action' => 'index']);
        }

        $targetPath = WWW_ROOT . 'documents' . DS . 'employee' . DS . $newName;
        $file->moveTo($targetPath);

        $this->Flash->success(__('File Uploaded Successfully'));
        return $this->redirect(['action' => 'edit', base64_encode($empId)]);
    }

    public function xls()
    {
        $output_type = 'D';
        $file = 'employees.xlsx';
        $conditions = [];

        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            array_push($conditions, array(['Employees.company_id' => $_GET['company_id']]));
        }

        if ($this->request->query('email_or_name')) {
            $searchQuery = $this->request->query('email_or_name');
            array_push($conditions, ['OR' => [['Employees.email LIKE' => '%' . ltrim($searchQuery) . '%'], ['Employees.name LIKE' => '%' . trim($searchQuery) . '%']]]);
        }

        $employees = $this->Employees->find('all')->where($conditions)->contain('Companies');
        //pr($employees->toArray());
        //die('nitin');
        $this->set(compact('employees', 'output_type', 'file'));
        $this->viewBuilder()->setLayout('xls/default');
        $this->viewBuilder()->setTemplate('xls/spreadsheet_employees');
        $this->RequestHandler->respondAs('xlsx');
        $this->render();
    }

    public function files($link)
    {
        $this->layout = false;
        $documentTable = TableRegistry::get('Documents');
        $documents = $documentTable->get(base64_decode($link), [
            'contain' => ['Employees'],
        ]); //;

        // $URL = BASE_URL . "/documents/employee/" . $documents['file'];
        $file_path = WWW_ROOT. "/documents/employee/" . $documents['file'];

        //echo $URL; exit;
        //echo $this->_mime_content_type($documents['file']); exit;

        $response = $this->response
        ->withFile($file_path, array(
            '‘download’' => true,
            'name' => $documents['file']
        ))
        ->withDownload($documents['file']);
        
        return $response;

        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($this->_mime_content_type($documents['file']) == 'image/jpeg' || $this->_mime_content_type($documents['file']) == 'image/png') {
            $output = curl_exec($ch);
            curl_close($ch);
            $this->set('type', $this->_mime_content_type($documents['file']));
            $this->set('file', 'data: ' . $this->_mime_content_type($documents['file']) . ';base64,' . base64_encode($output));

        } else {
            header('Content-type: ' . $this->_mime_content_type($documents['file']));
            $output = curl_exec($ch);
            curl_close($ch);
            echo $output;exit;
        }

    }

    public function _mime_content_type($filename)
    {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.', $filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }

    public function re_set()
    {
        $id = base64_decode($this->request->data['type_id']);
        $type = $this->request->data['data_type'];
        $ClientsDocuments_table = TableRegistry::get('ClientsDocuments');
        $ClientsDocuments = $ClientsDocuments_table->find('all')->where(['ClientsDocuments.id' => $id])->first();

        $request[$type . '_receive_admin'] = 0;
        $request[$type . '_send_admin'] = 0;
        $request[$type . '_receive_admin_date'] = null;
        $request[$type . '_send_admin_date'] = null;
        $request[$type . '_receive_client'] = 0;
        $request[$type . '_send_client'] = 0;
        $request[$type . '_receive_client_date'] = null;
        $request[$type . '_send_client_date'] = null;

        //echo json_encode(array('status' => true)); exit;

        if ($type == 'other') {
            $request[$type . '_receive_value'] = '';
            $request[$type . '_send_value'] = '';
        }

        $ClientsDocuments_table->patchEntity($ClientsDocuments, $request);

        if ($ClientsDocuments_table->save($ClientsDocuments)) {
            echo json_encode(array('status' => true));
        } else {
            echo json_encode(array('status' => false));
        }
        exit;
    }
}
