<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Exception;

class DependentsController extends AppController
{
    public $paginate = [
        'limit' => 20,
        'order' => [
            'Dependents.id' => 'DESC',
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
    }

    /**
     * Function name     : index
     * Description         : list Dependents
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function index($id = null)
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],
            'contain' => ['Employees'],
        ];

        $companyTable = tableRegistry::get('Companies');
        $companies = $companyTable->find('list');
        $dependents = $this->Dependents->find('all');

        if ($this->request->is('ajax')) {

            if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
                // array_push($conditions, array(['Dependents.employee_id' => $_GET['employee_id']]));
                $dependents->where(['Dependents.employee_id' => $_GET['employee_id']]);
            }

            if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
                // array_push($conditions, array(['Employees.company_id' => $_GET['company_id']]));
                // $dependents->where(['Dependents.company_id' => $_GET['company_id']]);
                $dependents->matching(
                    'Employees',
                    function (Query $query): Query {
                        return $query->where(['Employees.company_id' => $_GET['company_id']]);
                    }
                );
            }

            if ($this->request->getQuery('email_or_name')) {
                $searchQuery = $this->request->getQuery('email_or_name');
                // array_push($conditions, array(['Dependents.name LIKE' => '%' . trim($searchQuery) . '%']));
                $dependents->where(
                    function (QueryExpression $queryExpression, Query $query) use ($searchQuery): QueryExpression {
                        return $query
                            ->newExpr()
                            ->or(['Dependents.name LIKE' => '%' . trim($searchQuery) . '%']);
                    }
                );
            }
        }

        $companies = $this->set('companies', $companies);

        $dependents = $this->paginate($dependents);
        $employeeTable = tableRegistry::get('Employees');
        $employees = $employeeTable->find('list');
        $this->set('dependents', $dependents);
        $this->set('employees', $employees);

    }

    /**
     * Function name     : add
     * Description         : Add Dependents related Information
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function add($emp_id = null, $refere = null)
    {
        $dependent = $this->Dependents->newEmptyEntity();
        if ($this->request->is('post')) {

            //echo '<pre>';print_r(json_encode($this->request->data)); exit;
            /*if(isset($this->request->data['skip'])){
            return $this->redirect('/admin/companies/add_transaction');
            }*/

            //$this->request->data['created']                    = date('Y-m-d h:i:s');
            $requestData = $this->request->getData();

            $dependent = $this->Dependents->patchEntity($dependent, $requestData);
            $dependent->user_id = $this->Auth->user('id');
            try {
                if ($this->Dependents->save($dependent)) {
                    $documents = TableRegistry::get('Documents');
                    /*if(isset($this->request->data['files'][0]['tmp_name']) && !empty($this->request->data['files'][0]['tmp_name'])){
                    foreach($this->request->data['files'] as $file){
                    $data = pathinfo($file['name']);
                    $ext = $data['extension'];
                    $tmp_name = $file['tmp_name'];
                    $newName = 'dependent_'.uniqid().'.'.$ext;

                    $cimage = $documents->newEntity();
                    $cimage->related_id = $dependent->id;
                    $cimage->eTitle      = 'dependent';
                    $cimage->sectionName = 'dependent';
                    $cimage->file = $newName;

                    if($documents->save($cimage)){
                    move_uploaded_file($tmp_name, "documents/dependent/".$newName);
                    }
                    }
                    }*/

                    /*Files Names*/
                    $filesName = array('passport_files' => 'Passport', 'visa_files' => 'Visa', 'id_files' => 'Emirates ID', 'lcard_files' => 'Labor Card', 'hcard_files' => 'Health Care', 'other_files' => 'Other Files');
                    // foreach ($this->request->data['files'] as $fileKey => $file) {
                    //     foreach ($file as $innerFileKey => $innerFileValue) {
                    //         if (isset($innerFileValue['tmp_name']) && !empty($innerFileValue['tmp_name'])) {

                    //             $data = pathinfo($innerFileValue['name']);
                    //             $ext = $data['extension'];
                    //             $tmp_name = $innerFileValue['tmp_name'];
                    //             $newName = 'dependent_' . uniqid() . '.' . $ext;

                    //             $cimage = $documents->newEntity();
                    //             $cimage->related_id = $dependent->id;
                    //             $cimage->eTitle = 'dependent';
                    //             $cimage->sectionName = 'dependent';
                    //             $cimage->aTitle = $data['filename']; //$filesName[$fileKey];
                    //             $cimage->file = $newName;

                    //             if ($documents->save($cimage)) {
                    //                 move_uploaded_file($tmp_name, "documents/dependent/" . $newName);
                    //             }
                    //         }
                    //     }

                    // }
                    foreach ($requestData['files'] as $file) {
                        foreach ($file as $key => $value) {
                            if (!empty($value) && $value->getSize()) {

                                $data = pathinfo($value->getClientFilename());
                                $ext = $data['extension'];
                                $newName = 'dependent_' . uniqid() . '.' . $ext;

                                $cimage = $documents->newEmptyEntity();
                                $cimage->related_id = $dependent->id;
                                $cimage->eTitle = 'dependent';
                                $cimage->aTitle = $value->getClientFilename(); //$filesName[$fileKey];
                                $cimage->sectionName = 'dependent';
                                $cimage->file = $newName;
                                $documents->save($cimage);
                                $targetPath = WWW_ROOT . 'documents' . DS . 'dependent' . DS . $newName;
                                $value->moveTo($targetPath);
                            }
                        }
                    }

                    unset($requestData['files']);
                    $ClientsDocuments = TableRegistry::get('ClientsDocuments');
                    $Cdoc = $ClientsDocuments->newEntity(
                        array_merge(
                            $requestData,
                            [
                                'person_id' => $dependent->id,
                                'section_name' => 'dependent',
                            ]
                        )
                    );
                    // $Cdoc->person_id = $dependent->id;
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
                    // $Cdoc->section_name = $this->request->data['section_name'];
                    // $Cdoc->other_receive_admin_date = $this->request->data['other_receive_admin_date'];
                    // $Cdoc->other_send_admin_date = $this->request->data['other_send_admin_date'];
                    // $Cdoc->other_send_admin_date = $this->request->data['other_send_admin_date'];
                    $ClientsDocuments->save($Cdoc);
                    //echo '<pre>';print_r($this->request->data); exit;
                    //$this->request->data['employee_id'];
                    $employeeTable = TableRegistry::get('Employees');
                    $companyTable = TableRegistry::get('Companies');

                    // $employeeS = $employeeTable->find('all')->where(['Employees.id' => $this->request->data['employee_id']])->first();
                    $employee = $employeeTable
                        ->find(
                            'all',
                            ['Employees.id' => $requestData['employee_id']]
                        )
                        ->first();

                    // $compnay = $companyTable->find('all')->where(['id' => $employeeS['company_id']])->first();
                    $compnay = $companyTable->find('all', ['id' => $employee->company_id])
                        ->first()
                        ->toArray();

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

                        $settingTable = tableRegistry::get('Settings');
                        $Row = $settingTable->find('all');
                        foreach ($Row as $key => $value) {
                            $CCemails = explode(",", $value['cc_emails']);
                        }

                        $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));
                        $employee->email = $employee->email ? $employee->email : $CCemails[0];

                        // $email = new Email('default');

                        ($emailDocRec = (clone $email))
                            ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            ->setTo($employee->email)
                            ->setCc($CCemails)
                            ->setEmailFormat('html')
                            ->setSubject("Delivery note of " . $requestData['name'])
                            ->setViewVars(array('information' => $this->request->getData(), 'employeeS' => $employee))
                            ->viewBuilder()
                            ->setTemplate('documentsConfirmationReceiveDependentAdd');

                        $emailDocRec->send(); /**/
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

                        $settingTable = tableRegistry::get('Settings');
                        $Row = $settingTable->find('all');
                        foreach ($Row as $key => $value) {
                            $CCemails = explode(",", $value['cc_emails']);
                        }
                        $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));
                        $employee->email = $employee->email != '' ? $employee->email : $CCemails[0];

                        ($emailDocSend = (clone $email))
                            ->setSubject("Delivery note of " . $this->request->getData('name'))
                            ->setEmailFormat('html')
                            ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            ->setTo($employee->email)
                            ->setCc($CCemails)
                            ->setViewVars(array('information' => $this->request->getData(), 'employeeS' => $employee))
                            ->viewBuilder()
                            ->setTemplate('documentsConfirmationSendDependentAdd');

                        $emailDocSend->send(); /**/

                    }
                    if (!empty($emp_id)) {
                        $response['status'] = true;
                        $response['url'] = Router::url(['controller' => 'companies', 'action' => 'add_transaction'], true);
                        $response['message'] = 'Dependent has been saved successfully';
                        $this->Flash->success(__('Dependent has been saved successfully'));
                        //return $this->redirect('/admin/companies/add_transaction');
                    }
                    $response['status'] = true;
                    $response['url'] = Router::url(['controller' => 'dependents', 'action' => 'index'], true);
                    $response['message'] = 'Dependent has been saved successfully';
                    $this->Flash->success(__('Dependent has been saved successfully'));
                    //return $this->redirect(['action' => 'index']);
                }
            } catch (Exception $e) {
                $response['status'] = false;
                $response['message'] = $e->getMessage();
                //$this->Flash->error(__('Dependent could not be save'));
                //return $this->redirect(['action' => 'add']);
            }
            echo json_encode($response);exit;
        }
        if (!empty($emp_id)) {
            $employees = $this->Dependents->Employees->find('list')->where(['Employees.id' => base64_decode($emp_id)]);
            $employee = $this->Dependents->Employees->find('all')->where(['Employees.id' => base64_decode($emp_id)])->first();

            $this->set('company_id', $employee->company_id);
            $this->set('emp_id', $emp_id);

        } else {
            $employees = $this->Dependents->Employees->find('list');
        }

        if (!empty($refere)) {
            $this->set('refere', $refere);
        }

        $dropDownTable = TableRegistry::get('DropdownValues');
        $relations = $dropDownTable->find('list', ['keyField' => 'keyID', 'valueField' => 'value'])->where(['name' => 'relation'])->toArray();

        $countries = TableRegistry::get('Countries')->find('list', ['keyField' => 'name', 'valueField' => 'name']);
        $this->set('countries', $countries);
        $this->set('employees', $employees);
        $this->set('relations', $relations);
        $this->set('dependent', $dependent);
    }

    /**
     * Function name     : edit
     * Description         : edit Dependents related Information
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */
    public function edit($id = null)
    {

        $id = base64_decode($id);
        $dependent = $this->Dependents->get($id, ['contain' => ['Documents', 'ClientsDocuments']]);
        if (!empty($this->request->getData())) {
            $clientDocumentRequestPayload = $this->request->getData('clients_document');
            $ClientsDocuments = TableRegistry::get('ClientsDocuments');
            //$Cdoc = $ClientsDocuments->newEntity();
            //$this->request->data['clients_document']['id'] = $employee->clients_document->id;

            //$ClientsDocuments->patchEntity($Cdocs, $this->request->data['clients_document']);
            //echo '<pre>';print_r($this->request->data['clients_document']); exit;
            if (isset($dependent->clients_document->id)) {
                // dd($this->request->getData('clients_document'));
                $Cdocs = $ClientsDocuments->get($dependent->clients_document->id);
                $ClientsDocuments->patchEntity($Cdocs, $clientDocumentRequestPayload);
                $ClientsDocuments->save($Cdocs);
            }
            $oldValues = $dependent->clients_document;
            $oldValues = json_decode(json_encode($oldValues), true);
            $changed_fields = array();
            foreach ($clientDocumentRequestPayload as $key => $value) {
                if ($oldValues[$key] != $value && (strpos($key, 'date') == false) && (strpos($key, 'value') == false) && ($value != 0)) {
                    if (strpos($key, 'receive') !== false) {
                        $changed_receive[$key] = $value;
                    }
                    if (strpos($key, 'send') !== false) {
                        $changed_send[$key] = $value;
                    }
                }
            }
            //echo '<pre>'; print_r($changed_receive);
            //echo '<pre>'; print_r($changed_send);
            //exit;
            $requestPayload = $this->request->getData();
            $requestPayload['clients_document']['section_name'] = 'dependent';

            $this->Dependents->patchEntity($dependent, $requestPayload);
            // dd($test);
            try {
                if ($this->Dependents->save($dependent)) {
                    $documents = TableRegistry::get('Documents');

                    /*Files Names*/
                    $filesName = array('passport_files' => 'Passport', 'visa_files' => 'Visa',
                    'id_files' => 'Emirates ID', 'lcard_files' => 'Labor Card',
                    'hcard_files' => 'Health Care', 'other_files' => 'Other Files');
                    // foreach ($this->request->getData('files') as $fileKey => $file) {
                    //     foreach ($file as $innerFileKey => $innerFileValue) {
                    //         if (isset($innerFileValue['tmp_name']) && !empty($innerFileValue['tmp_name'])) {

                    //             $data = pathinfo($innerFileValue['name']);
                    //             $ext = $data['extension'];
                    //             $tmp_name = $innerFileValue['tmp_name'];
                    //             $newName = 'dependent_' . uniqid() . '.' . $ext;

                    //             $cimage = $documents->newEmptyEntity();
                    //             $cimage->related_id = $dependent->id;
                    //             $cimage->eTitle = 'dependent';
                    //             $cimage->sectionName = 'dependent';
                    //             $cimage->aTitle = $data['filename']; //$filesName[$fileKey];
                    //             $cimage->file = $newName;

                    //             if ($documents->save($cimage)) {
                    //                 move_uploaded_file($tmp_name, "documents/dependent/" . $newName);
                    //             }
                    //         }
                    //     }

                    // }

                    foreach ($requestPayload['files'] as $file) {
                        foreach ($file as $key => $value) {
                            if (!empty($value) && $value->getSize()) {

                                $data = pathinfo($value->getClientFilename());
                                $ext = $data['extension'];
                                $newName = 'dependent_' . uniqid() . '.' . $ext;

                                $cimage = $documents->newEmptyEntity();
                                $cimage->related_id = $dependent->id;
                                $cimage->eTitle = 'dependent';
                                $cimage->aTitle = $value->getClientFilename(); //$filesName[$fileKey];
                                $cimage->sectionName = 'dependent';
                                $cimage->file = $newName;
                                $documents->save($cimage);
                                $targetPath = WWW_ROOT . 'documents' . DS . 'dependent' . DS . $newName;
                                $value->moveTo($targetPath);
                            }
                        }
                    }

                    //print_r($changed_fields); exit;
                    $employeeTable = TableRegistry::get('Employees');
                    $companyTable = tableRegistry::get('Companies');
                    $employee = $employeeTable->find('all')->where(['Employees.id' => $this->request->getData('employee_id')])->first();
                    $compnay = $companyTable->find('all')->where(['id' => $employee['company_id']])->first();

                    $email = new Mailer();

                    if (!empty($changed_receive)) {
                        //$employeeS->email
                        $settingTable = tableRegistry::get('Settings');
                        $Row = $settingTable->find('all');
                        foreach ($Row as $key => $value) {
                            $CCemails = explode(",", $value['cc_emails']);
                        }
                        if ($compnay) {
                            $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));
                        }
                        $employee->email = $employee->email != '' ? $employee->email : $CCemails[0];
                        $changed_receive['name'] = $this->request->getData('name');

                        if (isset($clientDocumentRequestPayload['other_receive_value'])) {
                            $changed_receive['other_receive_value'] = $clientDocumentRequestPayload['other_receive_value'];
                        }


                        ($emailDocConfirmDpd = (clone $email))
                            ->setSubject("Delivery note of " . $changed_receive['name'])
                            ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            ->setTo($employee->email)
                            ->setCc($CCemails) //documentsConfirmationSendDependentAdd
                            ->setEmailFormat('html')
                            ->setViewVars(array('information' => $changed_receive, 'employeeS' => $employee))
                            ->viewBuilder()
                            ->setTemplate('documentsConfirmationReceiveDependentAdd');

                        $emailDocConfirmDpd->send();
                    }

                    if (!empty($changed_send)) {
                        $settingTable = tableRegistry::get('Settings');
                        $Row = $settingTable->find('all');
                        foreach ($Row as $key => $value) {
                            $CCemails = explode(",", $value['cc_emails']);
                        }
                        if ($compnay) {
                            $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));
                        }
                        $employee->email = $employee->email != '' ? $employee->email : $CCemails[0];
                        $changed_send['name'] = $this->request->getData('name');
                        if (isset($clientDocumentRequestPayload['other_send_value'])) {
                            $changed_send['other_send_value'] = $clientDocumentRequestPayload['other_send_value'];
                        }

                        ($emailDocConfirmSendDpd = (clone $email))
                            ->setSubject("Delivery note of " . $changed_send['name'])
                            ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                            ->setTo($employee->email)
                            ->setCc($CCemails) //documentsConfirmationSendDependentAdd
                            ->setEmailFormat('html')
                            ->setViewVars(array('information' => $changed_send, 'employeeS' => $employee))
                            ->viewBuilder()
                            ->setTemplate('documentsConfirmationSendDependentAdd');

                        $emailDocConfirmSendDpd->send();
                    }
                    $response['status'] = true;
                    $response['url'] = Router::url(['controller' => 'dependents', 'action' => 'index', base64_encode($employee->id)], true);
                    $response['message'] = 'Dependent has been saved updated';
                    $this->Flash->success(__('Dependent has been saved updated'));

                }
            } catch (\PDOException $e) {
                $response['status'] = false;
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);exit;
        }
        $employees = $this->Dependents->Employees->find('list');
        $dropDownTable = TableRegistry::get('DropdownValues');
        $relations = $dropDownTable->find('list', ['keyField' => 'keyID', 'valueField' => 'value'])
            ->where(['name' => 'relation'])
            ->toArray();

        $countries = TableRegistry::get('Countries')->find('list', ['keyField' => 'name', 'valueField' => 'name']);
        $this->set('countries', $countries);
        $this->set('relations', $relations);
        $this->set('employees', $employees);
        $this->set('dependent', $dependent);
        $this->set('controller', $this->request->getParam('controller'));
    }

    /**
     * Function name     : Delete
     * Description         : Delete functionality for Dependent
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function delete($id = null)
    {
        $id = base64_decode($id);
        $dependent = $this->Dependents->find('all')->where(['Dependents.id' => $id])->first();
        if (!empty($dependent)) {
            if ($this->Dependents->delete($dependent)) {
                $documentTable = TableRegistry::get('Documents');
                $documents = $documentTable->find('all')->where(['Documents.related_id' => $id, 'Documents.sectionName' => 'dependent'])->toArray();

                if (!empty($documents)) {
                    foreach ($documents as $document) {
                        $path = WWW_ROOT . 'documents/dependent/' . $document->file;
                        if ($documentTable->delete($document)) {
                            unlink($path);
                        }
                    }
                }
                $this->Flash->success(__('Dependent has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Dependent could not be deleted. Please, try again.'));
            }

        }
        return $this->redirect($this->referer());
    }

    /**
     * Function name     : Delete dependent documents
     * Description         : Delete functionality for dependent  documents
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function deleteDependentDocument($id = null)
    {
        $id = base64_decode($id);
        $documentTable = TableRegistry::get('Documents');
        $document = $documentTable->find('all')->where(['Documents.id' => $id, 'Documents.sectionName' => 'dependent'])->first();

        if (!empty($document)) {
            $path = WWW_ROOT . 'documents/dependent/' . $document->file;
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

    public function DownloadDependentDocument($id = null)
    {
        $id = base64_decode($id);
        $documentTable = TableRegistry::get('Documents');
        $document = $documentTable->find('all')->where(['Documents.id' => $id, 'Documents.sectionName' => 'dependent'])->first();

        if (!empty($document)) {

            $path = WWW_ROOT . 'documents/dependent/' . $document->file;

            //echo $path; exit;
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . basename($path));
            readfile($path);
            exit();

        }
        return $this->redirect($this->referer());
    }

    /**
     * Function name     : save dependents attachment title
     * Description         : save dependents attachment title
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
     * Description         : upload_attachment is used for upload file from "Manage Dependent" file
     * Author             : Wepro
     * Created by         : Wepro 8-May-2017
     */

    public function upload_attachment($deptId = null)
    {
        if (!$this->request->is('post')) {
            die;
        }

        $requestData = $this->request->getData();
        $deptId = base64_decode($requestData['dependent-id']);

        if (empty($deptId)) {
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
        $newName = 'dependent_' . uniqid() . '.' . $ext;

        $cimage = $documents->newEmptyEntity();
        $cimage->related_id = $deptId;
        $cimage->eTitle = 'dependent';
        $cimage->aTitle = $requestData['attachment-title'];
        $cimage->sectionName = 'dependent';

        $cimage->file = $newName;

        if (!$documents->save($cimage)) {
            $this->Flash->error(__('Document couldnot be saved'));
            return $this->redirect(['action' => 'index']);
        }

        $targetPath = WWW_ROOT . 'documents' . DS . 'dependent' . DS . $newName;
        $file->moveTo($targetPath);

        $this->Flash->success(__('File Uploaded Successfully'));
        return $this->redirect(['action' => 'edit', base64_encode($deptId)]);
    }

    public function xls()
    {
        $output_type = 'D';
        $file = 'dependents.xlsx';
        $conditions = [];

        if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
            array_push($conditions, array(['Dependents.employee_id' => $_GET['employee_id']]));
        }

        if ($this->request->getQuery('email_or_name')) {
            $searchQuery = $this->request->getQuery('email_or_name');
            array_push($conditions, array(['Dependents.name LIKE' => '%' . trim($searchQuery) . '%']));

        }

        //$depend = TableRegistry::get('Dependents');

        $dependents = $this->Dependents->find('all')->where($conditions)->contain('Employees');

        //    die('nitin');
        $this->set(compact('dependents', 'output_type', 'file'));
        $this->viewBuilder()->setLayout('xls/default');
        $this->viewBuilder()->setTemplate('xls/spreadsheet_dependents');
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

        // $URL = BASE_URL . "/documents/dependent/" . $documents['file'];
        $file_path = WWW_ROOT. "/documents/dependent/" . $documents['file'];


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

        $exploded = explode('.', $filename);

        $ext = strtolower(array_pop($exploded));

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
        $id = base64_decode($this->request->getData('type_id'));
        $type = $this->request->getData('data_type');
        $ClientsDocuments_table = TableRegistry::get('ClientsDocuments');
        $ClientsDocuments = $ClientsDocuments_table->find('all')->where(['ClientsDocuments.id' => $id])->first();

        //print_r($ClientsDocuments); exit;

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
