<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\Http\Exception\NotFoundException as ExceptionNotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Mailer;

class CompaniesController extends AppController
{

    /**
     * initialize function
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    /**
     * beforeFilter function
     *
     * @param \Cake\Event\EventInterface $event
     * @return void
     */
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        $this->viewBuilder()->setLayout('admin');
        parent::beforeFilter($event);
    }

    /**
     * index function
     *
     * @return void
     */
    public function index(): void
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],

        ];

        $conditions = [];
        if ($this->request->is('ajax')) {
            if ($this->request->getQuery('searchQuery')) {
                $searchQuery = $this->request->getQuery('searchQuery');
                array_push($conditions, ['Companies.name LIKE' => '%' . ltrim($searchQuery) . '%']);
            }
        }
        $company = $this->paginate($this->Companies->find('all')->where($conditions));
        $this->set(compact('company'));
    }

    /**
     * add function
     *
     * @return void
     */
    public function add(): void
    {
        $companyTable = TableRegistry::get('Companies');
        // $company = $companyTable->newEntity();
        $company = $companyTable->newEmptyEntity();
        // Add the Company data and Save
        if (!$this->request->is('post')) {
            $this->set('company', $company);
            return;
        }
        $requestData = $this->request->getData();

        $error_mesaage = '';
        /*if(date('Y-m-d',strtotime($this->request->data['trade_license_issue_date_cus'])) !='1970-01-01' && date('Y-m-d',strtotime($this->request->data['trade_license_expiry_date_cus'])) !='1970-01-01' && date('Y-m-d',strtotime($this->request->data['trade_license_issue_date_cus'])) > date('Y-m-d',strtotime($this->request->data['trade_license_expiry_date_cus']))){
        $error_mesaage = 'Trade license issue date should be less than expiry date!!';
        }

        if(date('Y-m-d',strtotime($this->request->data['immigration_card_issue_date_cus'])) !='1970-01-01' && date('Y-m-d',strtotime($this->request->data['immigration_card_expiry_date_cus'])) !='1970-01-01' && date('Y-m-d',strtotime($this->request->data['immigration_card_issue_date_cus'])) > date('Y-m-d',strtotime($this->request->data['immigration_card_expiry_date_cus']))){
        $error_mesaage = 'Immigration card issue date should be less than expiry date!!';
        }

        if(date('Y-m-d',strtotime($this->request->data['contract_start_date_cus'])) !='1970-01-01' && date('Y-m-d',strtotime($this->request->data['contract_end_date_cus'])) !='1970-01-01' && date('Y-m-d',strtotime($this->request->data['contract_start_date_cus'])) > date('Y-m-d',strtotime($this->request->data['contract_end_date_cus']))){
        $error_mesaage = 'Ejari contract start date should be less than end date!!';
        }

        if(!empty($error_mesaage)){
        $this->Flash->error(__($error_mesaage));
        return $this->redirect(['action' => 'add']);
        }*/
        // $this->request->data['created'] = date();
        $requestData['created'] = date('Y-m-d H:i:s');
        /*$this->request->data['trade_license_issue_date']     = $this->request->data['trade_license_issue_date_cus'];
        $this->request->data['trade_license_expiry_date']     = $this->request->data['trade_license_expiry_date_cus'];

        $this->request->data['immigration_card_issue_date']  = $this->request->data['immigration_card_issue_date_cus'];
        $this->request->data['immigration_card_expiry_date'] = $this->request->data['immigration_card_expiry_date_cus'];

        $this->request->data['dubai_chember_expiry_date']= $this->request->data['dubai_chember_expiry_date_cus'];
        $this->request->data['contract_start_date']             = $this->request->data['contract_start_date_cus'];
        $this->request->data['contract_end_date']             = $this->request->data['contract_end_date_cus'];*/

        // upload Docuent into Document table
        $companyTable->patchEntity($company, $requestData);
        $company->user_id = $this->Auth->user('id');
        try {

            if ($companyTable->save($company)) {
                $cmpnyId = $company->id;
                $documents = TableRegistry::get('Documents');

                // if (isset($this->request->data['files'][0]['tmp_name']) && !empty($this->request->data['files'][0]['tmp_name'])) {
                //     foreach ($this->request->data['files'] as $file) {

                //         $data = pathinfo($file['name']);
                //         $ext = $data['extension'];
                //         $tmp_name = $file['tmp_name'];
                //         $newName = 'company_' . uniqid() . '.' . $ext;

                //         $cimage = $documents->newEntity();
                //         $cimage->related_id = $cmpnyId;
                //         $cimage->eTitle = 'company';
                //         $cimage->sectionName = 'company';
                //         $cimage->file = $newName;

                //         if ($documents->save($cimage)) {
                //             // now upload file
                //             move_uploaded_file($tmp_name, "documents/company/" . $newName);
                //         }
                //     }
                // }
                if (!empty($requestData['files']) && $requestData['files'][0]->getSize()) {
                    foreach ($requestData['files'] as $file) {
                        $data = pathinfo($file->getClientFilename());
                        $ext = $data['extension'];
                        $newName = 'company_' . uniqid() . '.' . $ext;

                        $cimage = $documents->newEmptyEntity();
                        $cimage->related_id = $cmpnyId;
                        $cimage->eTitle = 'company';
                        $cimage->sectionName = 'company';
                        $cimage->file = $newName;
                        $documents->save($cimage);
                        $targetPath = WWW_ROOT . 'documents' . DS . 'company' . DS . $newName;
                        $file->moveTo($targetPath);
                    }
                }

                $response['status'] = true;
                $response['url'] = Router::url(['controller' => 'companies', 'action' => 'index'], true);
                $response['message'] = 'Company Information  added successfully';
                $this->Flash->success(__('Company Information  added successfully'));
            } else {
                $response['status'] = false;
                $response['message'] = 'Company could not be save';

            }
        } catch (\Exception $e) {
            $response['status'] = false;
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
        exit;
        $this->set('company', $company);
    }

    /**
     * Function name     : edit
     * Description         : edit Companies related Information
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function edit($id = null)
    {
        if (empty($id)) {
            return $this->redirect(['action' => 'index']);
            //    throw new NotFoundException(__('Article not found'));
        }

        $id = base64_decode($id);

        try {
            $company = $this->Companies->get($id, [
                'contain' => ['Documents'],
            ]);
        } catch (\Exception $e) {
            throw new ExceptionNotFoundException(__('Company not found'));
        }

        if ($this->request->getData()) {
            $requestData = $this->request->getData();
            /*$this->request->data['trade_license_issue_date']     = $this->request->data['trade_license_issue_date_cus'];
            $this->request->data['trade_license_expiry_date']     = $this->request->data['trade_license_expiry_date_cus'];

            $this->request->data['immigration_card_issue_date']  = $this->request->data['immigration_card_issue_date_cus'];
            $this->request->data['immigration_card_expiry_date'] = $this->request->data['immigration_card_expiry_date_cus'];

            $this->request->data['dubai_chember_expiry_date']    = $this->request->data['dubai_chember_expiry_date_cus'];
            $this->request->data['contract_start_date']             = $this->request->data['contract_start_date_cus'];
            $this->request->data['contract_end_date']             = $this->request->data['contract_end_date_cus'];*/
            //$this->request->data['created']                         = date('Y-m-d h:i:s');

            // upload Docuent into Document table

            $this->Companies->patchEntity($company, $this->request->getData());
            try {
                if ($this->Companies->save($company)) {
                    $cmpnyId = $company->id;
                    $documents = TableRegistry::get('Documents');
                    // if (isset($this->request->data['files'][0]['tmp_name']) && !empty($this->request->data['files'][0]['tmp_name'])) {
                    //     foreach ($this->request->data['files'] as $file) {
                    //         $data = pathinfo($file['name']);
                    //         $ext = $data['extension'];
                    //         $tmp_name = $file['tmp_name'];
                    //         $newName = 'company_' . uniqid() . '.' . $ext;

                    //         $cimage = $documents->newEntity();
                    //         $cimage->related_id = $cmpnyId;
                    //         $cimage->eTitle = 'company';
                    //         $cimage->sectionName = 'company';
                    //         $cimage->file = $newName;

                    //         if ($documents->save($cimage)) {
                    //             move_uploaded_file($tmp_name, "documents/company/" . $newName);
                    //         }
                    //     }
                    // }
                    if (!empty($requestData['files']) && $requestData['files'][0]->getSize()) {

                        foreach ($requestData['files'] as $file) {
                            $data = pathinfo($file->getClientFilename());
                            $ext = $data['extension'];
                            $newName = 'company_' . uniqid() . '.' . $ext;

                            $cimage = $documents->newEmptyEntity();
                            $cimage->related_id = $cmpnyId;
                            $cimage->eTitle = 'company';
                            $cimage->sectionName = 'company';
                            $cimage->file = $newName;
                            $documents->save($cimage);
                            $targetPath = WWW_ROOT . 'documents' . DS . 'company' . DS . $newName;
                            $file->moveTo($targetPath);
                        }
                    }

                    $response['status'] = true;
                    $response['url'] = Router::url(['controller' => 'companies', 'action' => 'index', base64_encode($id)], true);
                    $response['message'] = 'Company Information updated successfully';
                    $this->Flash->success(__('Company Information updated successfully'));
                } else {
                    $response['status'] = true;
                    $response['message'] = 'Company could not be save!';
                }
            } catch (PDOException $err) {
                $response['status'] = false;
                $response['message'] = $exception->getMessage();
            }
            echo json_encode($response);exit;
        }
        $this->set('company', $company);
        $this->set('controller', $this->request->getParam('controller'));
    }

    /*
     * Function name     : Manage (1.0)
     * Description         :
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function manage()
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],

        ];
        $company = $this->paginate($this->Companies);
        $this->set(compact('company'));
    }

    /**
     * Function name     : Delete
     * Description         : Delete functionality for Company also its documents
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */
    public function delete($id = null): \Cake\Http\Response
    {

        $id = base64_decode($id);
        $companyTable = TableRegistry::get('Companies');
        $company = $companyTable->find('all')->where(['Companies.id' => $id])->first();

        if (empty($company)) {
            return $this->response->withStatus(404);
        }

        if (!$this->Companies->delete($company)) {
            return $this->response->withStatus(400);
        }

        $documentTable = TableRegistry::get('Documents');
        $documents = $documentTable->find('all')->where(['Documents.related_id' => $id, 'Documents.sectionName' => 'company'])->toArray();

        if (!empty($documents)) {
            foreach ($documents as $document) {
                $path = WWW_ROOT . 'documents/company/' . $document->file;
                if ($documentTable->delete($document)) {
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
        }

        return $this->response->withStatus(200);
    }

    /**
     * Function name     : Delete company documents
     * Description         : Delete functionality for Company  documents
     * Author             : Wepro
     * Created by         : Wepro 14-Apr-2017
     */

    public function deleteComapnyDocument($id = null)
    {
        $id = base64_decode($id);
        $documentTable = TableRegistry::get('Documents');
        $document = $documentTable->find('all')->where(['Documents.id' => $id, 'Documents.sectionName' => 'company'])->first();

        if (!empty($document)) {
            $path = WWW_ROOT . 'documents/company/' . $document->file;
            if ($documentTable->delete($document)) {
                if (file_exists($path)) {
                    unlink($path);
                    $this->Flash->success(__('The Document has been deleted.'));
                    return $this->redirect($this->referer());
                }

                $this->Flash->error(__('There is no Document exists.'));
            } else {
                $this->Flash->error(__('The Document could not be deleted. Please, try again.'));
            }

        }
        return $this->redirect($this->referer());
    }

    /**
     * Function name     : transactions
     * Description         : list Company  Transactions
     * Author             : Wepro
     * Created by         : Wepro 17-Apr-2017
     */

    public function transactions()
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],
            'contain' => ['Companies', 'TransactionTypes', 'TrasectionsRelation'],
        ];


        $companyTransactionTable = tableRegistry::get('CompanyTransactions');
        $query = $companyTransactionTable->find('all');

        if ($this->request->is('ajax')) {

            if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
                // array_push($conditions, array(['CompanyTransactions.company_id' => $_GET['company_id']]));
                $query->where(['CompanyTransactions.company_id' => $_GET['company_id']]);
            }

            if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
                // array_push($conditions, array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
                $query->where(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]);

            }

            if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
                // array_push($conditions, array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
                $query->where(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]);

            }

            if ($this->request->getQuery('email_or_name')) {
                $searchQuery = $this->request->getQuery('email_or_name');
                // array_push($conditions, ['OR' => [['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']]]);
                $query->where(
                    function (QueryExpression $expression, Query $query) use($searchQuery): QueryExpression {
                        return $query
                            ->newExpr()
                            ->or(['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']);
                    }
                );
            }

        }

        $company_transactions = $this->paginate($query);

        //echo '<pre>'; print_r($company_transactions); exit;
        $companyTable = tableRegistry::get('Companies');
        $transactionTypesTable = tableRegistry::get('TransactionTypes');
        $transactionsTable = tableRegistry::get('Transactions');

        $companies = $companyTable->find('list');
        $transactions_type_ids = $transactionTypesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'transaction_name',
        ]);
        $transactions = $transactionsTable->find('list');

        $this->set('company_transactions', $company_transactions);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transactions_type_ids', $transactions_type_ids);

    }

    /**
     * Function name     : edit transactions
     * Description         : edit Company  Transactions
     * Author             : Wepro
     * Created by         : Wepro 17-Apr-2017
     */

    public function edit_transaction($id = null)
    {
        $id = base64_decode($id);
        $companyTransactionTable = tableRegistry::get('CompanyTransactions');
        $transStatusTable = tableRegistry::get('StatusTransactions');
        $TransactionTypes = tableRegistry::get('TransactionTypes');
        $company_transaction = $companyTransactionTable->get($id, [
            ///'contain' => ['Companies','Transactions','TransactionTypes']
            'contain' => ['Companies', 'TransactionTypes', 'TrasectionsRelation'],
        ]);

        if (!empty($this->request->getData('for_whom'))) {
            $name = null;
            if ($this->request->getData('for_whom') == 1) {
                $employeeTable = TableRegistry::get('Employees');
                $employeeTable = $employeeTable->get($this->request->getData('employee_id'));
                $name = $employeeTable['name'];
                $eid = $this->request->getData('employee_id');
            } else {
                //echo '<pre>';    print_r($this->request->data['dependet_id']); exit;
                $dependent = TableRegistry::get('Dependents');
                $dependentres = $dependent->get($this->request->getData('dependet_id'));
                $name = $dependentres['name'];
                $did = $this->request->getData('dependet_id');
            }
            $requestPayload = $this->request->getData();
            $requestPayload['name'] = $name;
            $requestPayload['user_id'] = $this->Auth->user('id');

            /*$result = array_diff_assoc($this->old[$this->alias],$this->data[$this->alias]);
            echo '<pre>'; print_r($company_transaction['trasections_relation']); exit;*/
            foreach ($company_transaction['trasections_relation'] as $key => $value) {
                if ($value['starting_date'] != $requestPayload['trasections_relation'][$key]['starting_date']) {
                    $requestPayload['trasections_relation'][$key]['user_id'] = $this->Auth->user('id');
                }
            }

            if (!$this->request->getData('dependet_id')) {
                $requestPayload['dependet_id'] = 0;
            }

            //$this->request->data['type'] = json_encode($this->request->data['type']);
            $companyTransactionTable->patchEntity($company_transaction, $requestPayload);
            //echo '<pre>'; print_r($company_transaction); exit;
            try {

                if ($companyTransactionTable->save($company_transaction)) {
                    //echo '<pre>';print_r($this->request->data); exit;
                    $val = $company_transaction->transaction_type_id;
                    if ($this->request->getData('for_whom') == 1) {
                        if ($val == 1) {
                            $optionsV = array(0 => 'Quota', 1 => 'Job Offer', 2 => 'Work permit', 3 => 'Pre Aprovel', 4 => 'Bank guarantee', 5 => 'E Visa', 6 => 'Change status', 7 => 'Medical fitness', 8 => 'Emirates ID', 9 => 'Typing labour card', 10 => 'Submit labour card', 11 => 'Visa stamp', 12 => 'Send to Employee');
                        } else if ($val == 2) {
                            $optionsV = array(0 => 'Medical fitness', 1 => 'Emirates ID', 2 => 'Visa stamp');
                        } else if ($val == 3) {
                            $optionsV = array(0 => 'Offer Letter', 1 => 'Send to Employee', 2 => 'Submisstion');
                        } else if ($val == 4) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Send Signature', 2 => 'Submit in MOL');
                        } else if ($val == 5) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Approved by EDNRD');
                        } else if ($val == 6) {
                            $optionsV = array(0 => 'Send to Employee', 1 => 'Submit to MOL');
                        } else if ($val == 7) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Send VISA in EDNRD');
                        }
                    } else {

                        if ($val == 1) {
                            $optionsV = array(0 => 'Entry Permint', 1 => 'Change status', 2 => 'Medical', 3 => 'Emirates ID', 4 => 'Visa stamp');
                        } else if ($val == 2) {
                            $optionsV = array(0 => 'Medical', 1 => 'Emirates ID', 2 => 'Visa stamp');
                        } else if ($val == 3) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Approved by EDNRD');
                        } else if ($val == 4) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Submit VISA in EDNRD');
                        }
                    }

                    // foreach ($this->request->data['trasections_relation'] as $key_ => $value_) {
                    //     //$companyTransactionTable->patchEntity($company_transaction, $this->request->data);
                        $documents = TableRegistry::get('Documents');
                    //     foreach ($value_['_files'] as $fileKey => $innerFileValue) {
                    //         //echo '<pre>'; print_r($innerFileValue);exit; continue;
                    //         //echo '<pre>';print_r($innerFileValue); exit;
                    //         if (isset($innerFileValue['tmp_name']) && !empty($innerFileValue['tmp_name'])) {
                    //             $data = pathinfo($innerFileValue['name']);
                    //             $ext = $data['extension'];
                    //             $tmp_name = $innerFileValue['tmp_name'];
                    //             $newName = isset($did) == '' ? 'employee_' . uniqid() . '.' . $ext : 'dependent_' . uniqid() . '.' . $ext;
                    //             //echo '<pre>'; print_r($key_); exit;
                    //             $cimage = $documents->newEntity();
                    //             $cimage->related_id = isset($did) == '' ? $eid : $did; //$dependent->id;
                    //             $cimage->eTitle = isset($did) == '' ? 'employee' : 'dependent';
                    //             $cimage->sectionName = isset($did) == '' ? 'employee' : 'dependent';
                    //             $cimage->aTitle = $optionsV[++$key_];
                    //             $cimage->file = $newName;
                    //             //$key = $key_++;
                    //             //echo '<pre>';print_r($cimage); exit;;
                    //             if ($documents->save($cimage)) {
                    //                 if (isset($did)) {
                    //                     move_uploaded_file($tmp_name, "documents/dependent/" . $newName);
                    //                 } else {
                    //                     move_uploaded_file($tmp_name, "documents/employee/" . $newName);
                    //                 }

                    //             }
                    //             //echo '<pre>';print_r('hereee'); exit;
                    //         }
                    //     }
                    // }
                    foreach ($this->request->getData('trasections_relation') as $key_ => $value_) {
                        foreach ($value_['_files'] as $key => $value) {
                            if (!empty($value) && $value->getSize()) {

                                $data = pathinfo($value->getClientFilename());
                                $ext = $data['extension'];
                                $newName = isset($did) == '' ? 'employee_' . uniqid() . '.' . $ext : 'dependent_' . uniqid() . '.' . $ext;

                                $cimage = $documents->newEmptyEntity();
                                $cimage->related_id = isset($did) == '' ? $eid : $did; //$dependent->id;
                                $cimage->eTitle = isset($did) == '' ? 'employee' : 'dependent';
                                $cimage->sectionName = isset($did) == '' ? 'employee' : 'dependent';
                                $cimage->aTitle = $optionsV[$key_]; //$filesName[$fileKey];
                                $cimage->file = $newName;
                                $documents->save($cimage);
                                if (isset($did)) {
                                    $targetPath = WWW_ROOT . 'documents' . DS . 'dependent' . DS . $newName;
                                } else {
                                    $targetPath = WWW_ROOT . 'documents' . DS . 'employee' . DS . $newName;
                                }
                                $value->moveTo($targetPath);
                            }
                    }
                }

                    $response['status'] = true;
                    $response['url'] = Router::url(['action' => 'transactions'], true);
                    $response['message'] = 'Company Transaction  Updated successfully.';
                    $this->Flash->success(__('Company Transaction  Updated successfully.'));
                } else {
                    $response['status'] = false;
                    $response['url'] = Router::url(['action' => 'edit_transaction', $id], true);
                    $response['message'] = 'Company Transaction  could not be save. Please, try again.';
                    $this->Flash->error(__('Company Transaction  could not be save. Please, try again.'));
                }
            } catch (\PDOException $e) {
                $response['status'] = false;
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);exit;
        }
        $transactions_type_ids = $TransactionTypes->find('list', [
            'keyField' => 'id',
            'valueField' => 'transaction_name',
        ]);
        $transaction_status = $transStatusTable->find('list');

        //echo '<pre>';print_r($company_transaction); exit;

        $companies = $companyTransactionTable->Companies->find('list');
        $this->set('transaction_status', $transaction_status);
        $this->set('company_transaction', $company_transaction);

        if ($company_transaction->for_whom == 1) {
            if ($company_transaction->transaction_type_id == 1) {
                $optionsV = array(0 => 'Quota', 1 => 'Job Offer', 2 => 'Work permit', 3 => 'Pre Aprovel', 4 => 'Bank guarantee', 5 => 'E Visa', 6 => 'Change status', 7 => 'Medical fitness', 8 => 'Emirates ID', 9 => 'Typing labour card', 10 => 'Submit labour card', 11 => 'Visa stamp', 12 => 'Send to Employee');
            } else if ($company_transaction->transaction_type_id == 2) {
                $optionsV = array(0 => 'Medical fitness', 1 => 'Emirates ID', 2 => 'Visa stamp');
            } else if ($company_transaction->transaction_type_id == 3) {
                $optionsV = array(0 => 'Offer Letter', 1 => 'Send to Employee', 2 => 'Submisstion');
            } else if ($company_transaction->transaction_type_id == 4) {
                $optionsV = array(0 => 'Type Application', 1 => 'Send Signature', 2 => 'Submit in MOL');
            } else if ($company_transaction->transaction_type_id == 5) {
                $optionsV = array(0 => 'Type Application', 1 => 'Approved by EDNRD');
            } else if ($company_transaction->transaction_type_id == 6) {
                $optionsV = array(0 => 'Send to Employee', 1 => 'Submit to MOL');
            } else if ($company_transaction->transaction_type_id == 7) {
                $optionsV = array(0 => 'Type Application', 1 => 'Send VISA in EDNRD');
            }
        } else {

            if ($company_transaction->transaction_type_id == 1) {
                $optionsV = array(0 => 'Entry Permint', 1 => 'Change status', 2 => 'Medical', 3 => 'Emirates ID', 4 => 'Visa stamp');
            } else if ($company_transaction->transaction_type_id == 2) {
                $optionsV = array(0 => 'Medical', 1 => 'Emirates ID', 2 => 'Visa stamp');
            } else if ($company_transaction->transaction_type_id == 3) {
                $optionsV = array(0 => 'Type Application', 1 => 'Approved by EDNRD');
            } else if ($company_transaction->transaction_type_id == 4) {
                $optionsV = array(0 => 'Type Application', 1 => 'Submit VISA in EDNRD');
            }
        }
        $this->set('companies', $companies);
        $this->set('transactions', $optionsV);
        $this->set('transactions_type_ids', $transactions_type_ids);
        //$this->set('transactionstypes',$transactionstypes);
    }

    /**
     * Function name     : add company transaction
     * Description         : add Company  Transactions
     * Author             : Wepro
     * Created by         : Wepro 17-Apr-2017
     */
    public function add_transaction($comp_id = null)
    {
        $companyTransactionTable = tableRegistry::get('CompanyTransactions');
        $TransactionTypes = tableRegistry::get('TransactionTypes');
        $transStatusTable = tableRegistry::get('StatusTransactions');
        $company_transaction = $companyTransactionTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $name = null;
            if ($this->request->getData('for_whom') == 1) {
                $employeeTable = TableRegistry::get('Employees');
                $eid = $this->request->getData('employee_id');
                $employeeTable = $employeeTable->get($eid);
                $name = $employeeTable['name'];
            } else {
                $dependent = TableRegistry::get('Dependents');
                $dependentres = $dependent->get($this->request->getData('dependet_id'));
                $name = $dependentres['name'];
                $did = $this->request->getData('dependet_id');
            }

            foreach ($this->request->getData('trasections_relation') as $key => $value) {
                if ($value['starting_date'] != '') {
                    $this->request->getData('trasections_relation')[$key]['user_id'] = $this->Auth->user('id');
                } else {
                    $this->request->getData('trasections_relation')[$key]['user_id'] = '';
                }
            }

            $requestPayload = $this->request->getData();
            $requestPayload['user_id'] = $this->Auth->user('id');

            if (!$this->request->getData('dependet_id')) {
                $requestPayload['dependet_id'] = 0;
            }

            $companyTransactionTable->patchEntity(
                $company_transaction,
                array_merge(
                    $requestPayload,
                    [
                        'name' => $name,
                    ]
                )
            );

            try {
                if ($companyTransactionTable->save($company_transaction)) {
                    //echo '<pre>'; print_r($company_transaction); exit;
                    $val = $company_transaction->transaction_type_id;
                    if ($this->request->getData('for_whom') == 1) {
                        if ($val == 1) {
                            $optionsV = array(1 => 'Quota', 2 => 'Job Offer', 3 => 'Work permit', 4 => 'Pre Aprovel', 5 => 'Bank guarantee', 6 => 'E Visa', 7 => 'Change status', 8 => 'Medical fitness', 9 => 'Emirates ID', 10 => 'Typing labour card', 11 => 'Submit labour card', 12 => 'Visa stamp', 13 => 'Send to Employee');
                        } else if ($val == 2) {
                            $optionsV = array(1 => 'Medical fitness', 2 => 'Emirates ID', 3 => 'Visa stamp');
                        } else if ($val == 3) {
                            $optionsV = array(1 => 'Offer Letter', 2 => 'Send to Employee', 3 => 'Submisstion');
                        } else if ($val == 4) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Send Signature', 2 => 'Submit in MOL');
                        } else if ($val == 5) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Approved by EDNRD');
                        } else if ($val == 6) {
                            $optionsV = array(0 => 'Send to Employee', 1 => 'Submit to MOL');
                        } else if ($val == 7) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Send VISA in EDNRD');
                        }
                    } else {
                        if ($val == 1) {
                            $optionsV = array(1 => 'Entry Permint', 2 => 'Change status', 3 => 'Medical', 4 => 'Emirates ID', 5 => 'Visa stamp');
                        } else if ($val == 2) {
                            $optionsV = array(1 => 'Medical', 2 => 'Emirates ID', 3 => 'Visa stamp');
                        } else if ($val == 3) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Approved by EDNRD');
                        } else if ($val == 4) {
                            $optionsV = array(0 => 'Type Application', 1 => 'Submit VISA in EDNRD');
                        }
                    }

                    foreach ($this->request->getData('trasections_relation') as $key_ => $value_) {
                        //$companyTransactionTable->patchEntity($company_transaction, $this->request->data);
                        $documents = TableRegistry::get('Documents');
                        // foreach ($value_['_files'] as $fileKey => $innerFileValue) {
                        //     //echo '<pre>';print_r($innerFileValue); continue;
                        //     if (isset($innerFileValue['tmp_name']) && !empty($innerFileValue['tmp_name'])) {
                        //         //echo '<pre>'; print_r($innerFileValue); continue;
                        //         $data = pathinfo($innerFileValue['name']);
                        //         $ext = $data['extension'];
                        //         $tmp_name = $innerFileValue['tmp_name'];
                        //         $newName = isset($did) == '' ? 'employee_' . uniqid() . '.' . $ext : 'dependent_' . uniqid() . '.' . $ext;
                        //         //echo '<pre>'; print_r($key_); exit;
                        //         $cimage = $documents->newEmptyEntity();
                        //         $cimage->related_id = isset($did) == '' ? $eid : $did; //$dependent->id;
                        //         $cimage->eTitle = isset($did) == '' ? 'employee' : 'dependent';
                        //         $cimage->sectionName = isset($did) == '' ? 'employee' : 'dependent';
                        //         $cimage->aTitle = $optionsV[$key_];
                        //         $cimage->file = $newName;
                        //         if ($documents->save($cimage)) {
                        //             if (isset($did)) {
                        //                 move_uploaded_file($tmp_name, "documents/dependent/" . $newName);
                        //             } else {
                        //                 move_uploaded_file($tmp_name, "documents/employee/" . $newName);
                        //             }

                        //         }
                        //     }
                        // }
                        foreach ($value_['_files'] as $key => $value) {
                            if (!empty($value) && $value->getSize()) {

                                $data = pathinfo($value->getClientFilename());
                                $ext = $data['extension'];
                                $newName = isset($did) == '' ? 'employee_' . uniqid() . '.' . $ext : 'dependent_' . uniqid() . '.' . $ext;

                                $cimage = $documents->newEmptyEntity();
                                $cimage->related_id = isset($did) == '' ? $eid : $did; //$dependent->id;
                                $cimage->eTitle = isset($did) == '' ? 'employee' : 'dependent';
                                $cimage->sectionName = isset($did) == '' ? 'employee' : 'dependent';
                                $cimage->aTitle = $optionsV[$key_]; //$filesName[$fileKey];
                                $cimage->file = $newName;
                                $documents->save($cimage);
                                if (isset($did)) {
                                    $targetPath = WWW_ROOT . 'documents' . DS . 'dependent' . DS . $newName;
                                } else {
                                    $targetPath = WWW_ROOT . 'documents' . DS . 'employee' . DS . $newName;
                                }
                                $value->moveTo($targetPath);
                            }
                        }

                    }
                    $response['status'] = true;
                    $response['url'] = Router::url(['action' => 'transactions'], true);
                    $response['message'] = 'Company Transaction  added successfully.';
                    $this->Flash->success(__('Company Transaction  added successfully.'));
                } else {
                    $response['status'] = false;
                    $response['url'] = Router::url(['action' => 'add_transaction'], true);
                    $response['message'] = 'Company Transaction  could not be save. Please, try again.';
                    $this->Flash->error(__('Company Transaction  could not be save. Please, try again.'));
                }
            } catch (\PDOException $e) {
                $response['status'] = false;
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);exit;
            //return $this->redirect(['action' => 'add_transaction',$comp_id]);
        }
        if (!empty($comp_id)) {
            $companies = $companyTransactionTable->Companies->find('list')->where(['Companies.id' => base64_decode($comp_id)]);
        } else {
            $companies = $companyTransactionTable->Companies->find('list');
        }

        $transactions_type_ids = $TransactionTypes->find('list', [
            'keyField' => 'id',
            'valueField' => 'transaction_name',
        ]);
        $transaction_status = $transStatusTable->find('list');
        //echo '<pre>'; print_r($transactions_type_ids); exit;
        $transactions = array(1 => 'Quota', 2 => 'Job Offer', 3 => 'Work permit', 4 => 'Pre Aprovel', 5 => 'Bank guarantee', 6 => 'E Visa', 7 => 'Change status', 8 => 'Medical fitness', 9 => 'Emirates ID', 10 => 'Typing labour card', 11 => 'Submit labour card', 12 => 'Visa stamp', 13 => 'Send to Employee');

        $this->set('transaction_status', $transaction_status);
        $this->set('company_transaction', $company_transaction);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transactions_type_ids', $transactions_type_ids);
    }

    /**
     * Function name     : CheckTrasectionAlready
     * Description         : Check if trasection is already in process
     * Author             : Wepro
     * Created by         : Wepro 17-Apr-2017
     */
    public function CheckTrasectionAlready()
    {
        $conditions = array();
        $transaction_type_id = $this->request->getData('transaction_type_id');
        $employee_id = $this->request->getData('employee_id');
        //echo '<pre>'; print_r($this->request->data); exit;
        if ($employee_id != '') {
            if ($this->request->getData('for_whom') == 1) {
                $conditions = array(
                    "CompanyTransactions.employee_id" => $employee_id,
                    "CompanyTransactions.transaction_type_id" => $transaction_type_id,
                );
            } else if ($this->request->getData('for_whom') == 2) {
                $employee_id = $this->request->getData('employee_id');
                $dependet_id = $this->request->getData('dependet_id');
                $conditions = array(
                    "CompanyTransactions.employee_id" => $employee_id,
                    "CompanyTransactions.dependet_id" => $dependet_id,
                    "CompanyTransactions.transaction_type_id" => $transaction_type_id,
                );
            }

            $companyTransactionTable = TableRegistry::get('CompanyTransactions');
            dd($employee_id);
            $query = $companyTransactionTable->find('all')
                ->where($conditions)
                ->contain(
                    array('TrasectionsRelation' => array('conditions' => array('TrasectionsRelation.status !=' => 3)))
                );

            foreach ($query as $key => $value) {
                foreach ($value->trasections_relation as $innerKey => $innerValue) {
                    if ($innerValue->status == 1) {
                        echo json_encode($response = 1);exit;
                    }
                }
            }
        }
        echo json_encode($response = 0);exit;
    }

    /**
     * Function name     : delete company transaction
     * Description         : delete Company  Transactions
     * Author             : Wepro
     * Created by         : Wepro 17-Apr-2017
     */

    public function delete_transaction($id = null)
    {
        $id = base64_decode($id);
        $companyTransactionTable = TableRegistry::get('CompanyTransactions');
        $company_transaction = $companyTransactionTable->find('all')->where(['CompanyTransactions.id' => $id])->first();

        if (!empty($company_transaction)) {
            if ($companyTransactionTable->delete($company_transaction)) {
                $this->Flash->success(__('Company transaction has been deleted.'));
                return $this->redirect(['action' => 'transactions']);
            }

            $this->Flash->error(__('Company transaction could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * Function name     : suggestions for name in company transaction
     * Description         : suggestions for name in company transaction
     * Author             : Wepro
     * Created by         : Wepro 20-Apr-2017
     */

    public function suggestions()
    {
        $data = '';
        if ($this->request->params['isAjax']) {
            if ($this->request->data['forWhom'] == 1 && !empty($this->request->data['keyword'])) {
                $employeeTable = TableRegistry::get('Employees');
                $employees = $employeeTable->find('all')->where(['Employees.name LIKE' => '%' . $this->request->data['keyword'] . '%']);
                $data = '<ul id="name-list">';
                foreach ($employees as $employee) {
                    $data .= '<li  data-name="' . $employee->name . '" >' . $employee->name . '</li>';
                }
                $data .= '</ul>';
            }

            if ($this->request->data['forWhom'] == 2 && !empty($this->request->data['keyword'])) {
                $dependentTable = TableRegistry::get('Dependents');
                $dependents = $dependentTable->find('all')->where(['Dependents.name LIKE' => '%' . $this->request->data['keyword'] . '%']);
                $data = '<ul id="name-list">';
                foreach ($dependents as $dependent) {
                    $data .= '<li data-name="' . $dependent->name . '">' . $dependent->name . '</li>';
                }
                $data .= '</ul>';
            }

        }

        echo $data;
        die;
    }

    /**
     * Function name     : save company attachment title
     * Description         : save company attachment title
     * Author             : Wepro
     * Created by         : Wepro 4-May-2017
     */

    public function save_title(): ?\Cake\Http\Response
    {
        if ($this->request->is('ajax')) {
            $id = base64_decode($this->request->getData('id'));
            $title = $this->request->getData('title');
            $documentsTable = $this->getTableLocator()->get('Documents');
            $document = $documentsTable->get($id); // Return article with id 12

            $document->aTitle = $title;
            $documentsTable->save($document);
            return $this->response->withStatus(204);
        }
    }

    /**
     * Function name     : upload_attachment
     * Description         : upload_attachment is used for upload file from "Manage Companies" file
     * Author             : Wepro
     * Created by         : Wepro 6-May-2017
     */

    public function upload_attachment($cmpnyId = null)
    {
        if (!$this->request->is('post')) {
            die;
        }

        $requestData = $this->request->getData();
        $cmpnyId = base64_decode($requestData['company-id']);

        if (empty($cmpnyId)) {
            $message = __('Something went wrong. Please, try again.');
            if ($this->request->is('ajax')) {
                return $this->response->withStatus(422)
                    ->withStringBody($message);
            }
            $this->Flash->error(__('Something went wrong. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        if (empty($requestData['attachment-title'])) {
            $message = __('Please fill attachment title. Please, try again.');
            if ($this->request->is('ajax')) {
                return $this->response->withStatus(422, $message);
            }
            $this->Flash->error($message);
            return $this->redirect(['action' => 'index']);
        }

        if (empty($requestData['attachment-file'])) {
            $message = __('Please choose file. Please, try again.');
            if ($this->request->is('ajax')) {
                return $this->response->withStatus(422, $message);
            }
            $this->Flash->error(__('Please choose file. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        if (!($requestData['attachment-file'] instanceof \Laminas\Diactoros\UploadedFile)) {
            $message = __('Please choose valid file. Please, try again.');
            if ($this->request->is('ajax')) {
                return $this->response->withStatus(422, $message);
            }
            $this->Flash->error($message);
            return $this->redirect(['action' => 'index']);
        }

        $documents = TableRegistry::get('Documents');

        $file = $requestData['attachment-file'];
        $data = pathinfo($file->getClientFilename());
        $ext = $data['extension'];
        $tmp_name = $file->getStream()->getMetadata('uri');
        $newName = 'company_' . uniqid() . '.' . $ext;

        $cimage = $documents->newEmptyEntity();
        $cimage->related_id = $cmpnyId;
        $cimage->eTitle = 'company';
        $cimage->aTitle = $requestData['attachment-title'];
        $cimage->sectionName = 'company';

        $cimage->file = $newName;

        if (!$documents->save($cimage)) {
            $message =__('Document couldnot be saved');
            if ($this->request->is('ajax')) {
                return $this->response->withStatus(422, $message);
            }
            $this->Flash->error($message);
            return $this->redirect(['action' => 'index']);
        }

        $targetPath = WWW_ROOT . 'documents' . DS . 'company' . DS . $newName;
        $file->moveTo($targetPath);

        if ($this->request->is('ajax')) {
            return $this->response->withStatus(204)
                ->withStringBody(__('file uploaded successfully.'));
        }

        $this->Flash->success(__('File Uploaded Successfully'));
        return $this->redirect(['action' => 'edit', base64_encode($cmpnyId)]);
    }

    /**
     * Function name     : xsl data
     * Description         : get company transaction data in excel
     * Author             : Wepro
     * Created by         : Wepro 16-May-2017
     */

    public function xls_transaction()
    {
        $output_type = 'D';
        $file = 'transaction.xlsx';

        $companyTransactionTable = tableRegistry::get('CompanyTransactions');

        $company_transactions = $companyTransactionTable
            ->find('all')
            ->contain(['Companies', 'Transactions', 'TransactionTypes']);

        $conditions = [];

        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            // array_push($conditions, array(['CompanyTransactions.company_id' => $_GET['company_id']]));
            $company_transactions->where(['CompanyTransactions.company_id' => $_GET['company_id']]);
        }

        if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
            // array_push($conditions, array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
            $company_transactions->where(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]);

        }

        if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
            // array_push($conditions, array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
            $company_transactions->where(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]);

        }
        if ($this->request->getQuery('email_or_name')) {
            $searchQuery = $this->request->getQuery('email_or_name');
            // array_push($conditions, ['OR' => [['CompanyTransactions.email LIKE' => '%' . trim($searchQuery) . '%'],
            // ['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']]]);

            $company_transactions->where(
                function(QueryExpression $expression, Query $query) use($searchQuery): QueryExpression {
                        return $query
                            ->newExpr()
                            ->or(['CompanyTransactions.email LIKE' => '%' . ltrim($searchQuery) . '%'])
                            ->add(['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']);
                }
            );
        }

        $this->set(compact('company_transactions', 'output_type', 'file'));
        // $this->viewBuilder()->layout('xls/default');
        $this->viewBuilder()->setLayout('xls/default');
        // $this->viewBuilder()->template('xls/spreadsheet_transaction');
        $this->viewBuilder()->setTemplate('xls/spreadsheet_transaction');
        $this->RequestHandler->respondAs('xlsx');
        $this->render();
        $this->layout = false;
    }

    public function getEmployees()
    {
        $employeeTable = TableRegistry::get('Employees');

        $employees = $employeeTable->find('list');

        if ($this->request->getData('company_id')) {
            $employees->where(['Employees.company_id' => $this->request->getData('company_id')]);
        }
        echo json_encode($employees);
        exit;
    }

    public function takeemailandnumber()
    {
        $employeeTable = TableRegistry::get('Employees');
        $employeesata = $employeeTable->get($this->request->data['employee_id']);
        echo json_encode(array('email' => $employeesata->email, 'mobile_no' => $employeesata->mobile_no));exit;
    }

    public function getdependent()
    {
        //echo '<pre>'; print_r($this->request->data['dependent_id']); exit;
        $dependent = TableRegistry::get('Dependents');
        $dependentres = $dependent->find('list')->where(['Dependents.employee_id' => $this->request->getData('dependent_id')]);
        echo json_encode($dependentres);exit;
    }

    public function files($link)
    {
        // $this->layout = false;
        // $this-> = false;

        $documentTable = TableRegistry::get('Documents');
        $documents = $documentTable->get(base64_decode($link), [
            'contain' => ['Companies'],
        ]); //;

        // $URL = Router::fullBaseUrl() . "/documents/company/" . $documents['file'];
         // Initialize a file URL to the variable
        $file_path = WWW_ROOT. "/documents/company/" . $documents['file'];

        $response = $this->response
        ->withFile($file_path, array(
            '‘download’' => true,
            'name' => $documents['file']
        ))
        ->withDownload($documents['file']);

        return $response;
        // $ch = curl_init($URL);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // if ($this->_mime_content_type($documents['file']) == 'image/jpeg' || $this->_mime_content_type($documents['file']) == 'image/png') {
        //     $output = curl_exec($ch);
        //     dd($output);
        //     curl_close($ch);
        //     $this->set('type', $this->_mime_content_type($documents['file']));
        //     $this->set('file', 'data: ' . $this->_mime_content_type($documents['file']) . ';base64,' . base64_encode($output));

        // } else {
        //     header('Content-type: ' . $this->_mime_content_type($documents['file']));
        //     $output = curl_exec($ch);
        //     curl_close($ch);
        //     echo $output;
        //     exit;
        // }
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
    public function getOptions()
    {
        $val = $this->request->getData('type');
        if ($this->request->getData('for_whom') == 2) {
            if ($val == 1) {
                $optionsV = array(0 => 'Entry Permint', 1 => 'Change status', 2 => 'Medical', 3 => 'Emirates ID', 4 => 'Visa stamp');
            } else if ($val == 2) {
                $optionsV = array(0 => 'Medical', 1 => 'Emirates ID', 2 => 'Visa stamp');
            } else if ($val == 3) {
                $optionsV = array(0 => 'Type Application', 1 => 'Approved by EDNRD');
            } else if ($val == 4) {
                $optionsV = array(0 => 'Type Application', 1 => 'Submit VISA in EDNRD');
            }
        } else {

            if ($val == 1) {
                $optionsV = array(0 => 'Quota', 1 => 'Job Offer', 2 => 'Work permit', 3 => 'Pre Aprovel', 4 => 'Bank guarantee', 5 => 'E Visa', 6 => 'Change status', 7 => 'Medical fitness', 8 => 'Emirates ID', 9 => 'Typing labour card', 10 => 'Submit labour card', 11 => 'Visa stamp', 12 => 'Send to Employee');
            } else if ($val == 2) {
                $optionsV = array(0 => 'Medical fitness', 1 => 'Emirates ID', 2 => 'Visa stamp');
            } else if ($val == 3) {
                $optionsV = array(0 => 'Offer Letter', 1 => 'Send to Employee', 2 => 'Submisstion');
            } else if ($val == 4) {
                $optionsV = array(0 => 'Type Application', 1 => 'Send Signature', 2 => 'Submit in MOL');
            } else if ($val == 5) {
                $optionsV = array(0 => 'Type Application', 1 => 'Approved by EDNRD');
            } else if ($val == 6) {
                $optionsV = array(0 => 'Send to Employee', 1 => 'Submit to MOL');
            } else if ($val == 7) {
                $optionsV = array(0 => 'Type Application', 1 => 'Send VISA in EDNRD');
            }

        }
        //$optionsV = $this->setOption($val);
        echo json_encode($optionsV);exit;
    }
    public function getTrasectionDetails()
    {
        //echo '<pre>';print_r($this->request->data['trasection_id']); exit;
        $id = base64_decode($this->request->getData('trasection_id'));
        $companyTransactionTable = tableRegistry::get('CompanyTransactions');
        $company_transaction = $companyTransactionTable->get($id, [
            ///'contain' => ['Companies','Transactions','TransactionTypes']
            'contain' => ['Companies', 'TransactionTypes', 'TrasectionsRelation', 'Users'],
        ]);
        echo json_encode($company_transaction);exit;
    }
}
