<?php
namespace App\Controller\Client;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\Event\Event;
use Cake\Http\Exception\NotFoundException as ExceptionNotFoundException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Centers Controller
 *
 * @property \App\Model\Table\CentersTable $Centers
 */
class CompaniesController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');

    }

    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        $this->viewBuilder()->setLayout('client');
        parent::beforeFilter($event);

    }

    /**
     * Function name     : index
     * Description         : list Companies
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function index()
    {
        $this->paginate = [
            'limit' => 10,
            'order' => ['id' => 'DESC'],
            'contain' => ['Documents'],
        ];

        $conditions = [];
        $client_id = $this->Auth->user('id');

        $company_query = $this->Companies->find('all')
        ->join([
            'Clients' => [
                'table' => 'clients',
                'aliase' => 'Clients',
                'conditions' => ['Companies.id = Clients.company_id', 'Clients.id' => $client_id],
            ],
        ]);

        if ($this->request->is('ajax')) {
            if ($this->request->getQuery('searchQuery')) {
                $searchQuery = $this->request->getQuery('searchQuery');
                $company_query->where(['Companies.name LIKE' => '%' . ltrim($searchQuery) . '%']);
                // array_push($conditions, ['Companies.name LIKE' => '%' . ltrim($searchQuery) . '%']);
            }
        }


        $company = $this->paginate($company_query);
        $this->set(compact('company'));
    }

    /**
     * Function name     : add
     * Description         : Add Companies related Information
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function add()
    {
        exit;
        $companyTable = TableRegistry::get('Companies');
        $company = $companyTable->newEntity();
        // Add the Company data and Save
        if ($this->request->is('post')) {
            $error_mesaage = '';
            if (date('Y-m-d', strtotime($this->request->data['trade_license_issue_date_cus'])) != '1970-01-01' && date('Y-m-d', strtotime($this->request->data['trade_license_expiry_date_cus'])) != '1970-01-01' && date('Y-m-d', strtotime($this->request->data['trade_license_issue_date_cus'])) > date('Y-m-d', strtotime($this->request->data['trade_license_expiry_date_cus']))) {
                $error_mesaage = 'Trade license issue date should be less than expiry date!!';
            }

            if (date('Y-m-d', strtotime($this->request->data['immigration_card_issue_date_cus'])) != '1970-01-01' && date('Y-m-d', strtotime($this->request->data['immigration_card_expiry_date_cus'])) != '1970-01-01' && date('Y-m-d', strtotime($this->request->data['immigration_card_issue_date_cus'])) > date('Y-m-d', strtotime($this->request->data['immigration_card_expiry_date_cus']))) {
                $error_mesaage = 'Immigration card issue date should be less than expiry date!!';
            }

            if (date('Y-m-d', strtotime($this->request->data['contract_start_date_cus'])) != '1970-01-01' && date('Y-m-d', strtotime($this->request->data['contract_end_date_cus'])) != '1970-01-01' && date('Y-m-d', strtotime($this->request->data['contract_start_date_cus'])) > date('Y-m-d', strtotime($this->request->data['contract_end_date_cus']))) {
                $error_mesaage = 'Ejari contract start date should be less than end date!!';
            }

            if (!empty($error_mesaage)) {
                $this->Flash->error(__($error_mesaage));
                return $this->redirect(['action' => 'add']);
            }
            $this->request->data['trade_license_issue_date'] = $this->request->data['trade_license_issue_date_cus'];
            $this->request->data['trade_license_expiry_date'] = $this->request->data['trade_license_expiry_date_cus'];

            $this->request->data['immigration_card_issue_date'] = $this->request->data['immigration_card_issue_date_cus'];
            $this->request->data['immigration_card_expiry_date'] = $this->request->data['immigration_card_expiry_date_cus'];

            $this->request->data['dubai_chember_expiry_date'] = $this->request->data['dubai_chember_expiry_date_cus'];
            $this->request->data['contract_start_date'] = $this->request->data['contract_start_date_cus'];
            $this->request->data['contract_end_date'] = $this->request->data['contract_end_date_cus'];

            // upload Docuent into Document table
            $companyTable->patchEntity($company, $this->request->data);
            //    $company->user_id = $this->Auth->user('id');

            if ($companyTable->save($company)) {

                $cmpnyId = $company->id;
                $documents = TableRegistry::get('Documents');
                if (isset($this->request->data['files'][0]['tmp_name']) && !empty($this->request->data['files'][0]['tmp_name'])) {
                    foreach ($this->request->data['files'] as $file) {

                        $data = pathinfo($file['name']);
                        $ext = $data['extension'];
                        $tmp_name = $file['tmp_name'];
                        $newName = 'company_' . uniqid() . '.' . $ext;

                        $cimage = $documents->newEmptyEntity();
                        $cimage->related_id = $cmpnyId;
                        $cimage->eTitle = 'company';
                        $cimage->sectionName = 'company';
                        $cimage->file = $newName;

                        if ($documents->save($cimage)) {
                            // now upload file
                            move_uploaded_file($tmp_name, "documents/company/" . $newName);
                        }
                    }
                }

                $this->Flash->success(__('Company Information  added successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Company Information could not be deleted. Please, try again.'));
            return $this->redirect(['action' => 'add']);

        }

        $this->set('company', $company);
    }

    /**
     * Function name     : edit
     * Description         : edit Companies related Information
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function edit($id = null)
    {
        exit;
        if (empty($id)) {
            return $this->redirect(['action' => 'index']);
            //    throw new NotFoundException(__('Article not found'));
        }

        $id = base64_decode($id);
        $company_id = $this->Auth->user('company_id');
        if ($id != $company_id) {
            $this->Flash->error(__('You are not authorized.'));
            return $this->redirect('/client/companies/');
        }

        try {
            $company = $this->Companies->get($id, [
                'contain' => ['Documents'],
            ]);
        } catch (\Exception $e) {
            throw new ExceptionNotFoundException(__('Company not found'));
        }

        if ($this->request->getData()) {

            /*$this->request->data['trade_license_issue_date']     = $this->request->data['trade_license_issue_date_cus'];
            $this->request->data['trade_license_expiry_date']     = $this->request->data['trade_license_expiry_date_cus'];

            $this->request->data['immigration_card_issue_date']  = $this->request->data['immigration_card_issue_date_cus'];
            $this->request->data['immigration_card_expiry_date'] = $this->request->data['immigration_card_expiry_date_cus'];

            $this->request->data['dubai_chember_expiry_date']    = $this->request->data['dubai_chember_expiry_date_cus'];
            $this->request->data['contract_start_date']             = $this->request->data['contract_start_date_cus'];
            $this->request->data['contract_end_date']             = $this->request->data['contract_end_date_cus'];
            $this->request->data['created']                         = date('Y-m-d h:i:s');

             */
            // upload Docuent into Document table
            $this->Companies->patchEntity($company, $this->request->getData());

            if ($this->Companies->save($company)) {
                $cmpnyId = $company->id;
                $documents = TableRegistry::get('Documents');

                if (isset($this->request->data['files'][0]['tmp_name']) && !empty($this->request->data['files'][0]['tmp_name'])) {
                    foreach ($this->request->data['files'] as $file) {
                        $data = pathinfo($file['name']);
                        $ext = $data['extension'];
                        $tmp_name = $file['tmp_name'];
                        $newName = 'company_' . uniqid() . '.' . $ext;

                        $cimage = $documents->newEmptyEntity();
                        $cimage->related_id = $cmpnyId;
                        $cimage->eTitle = 'company';
                        $cimage->sectionName = 'company';
                        $cimage->file = $newName;

                        if ($documents->save($cimage)) {
                            move_uploaded_file($tmp_name, "documents/company/" . $newName);
                        }
                    }
                }

                $this->Flash->success(__('Company Information  added successfully'));
                return $this->redirect(['action' => 'index']);
            }

        }

        $this->set('company', $company);
        $this->set('controller', $this->request->params['controller']);

    }

    /*
     * Function name     : Manage (1.0)
     * Description         :
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function manage()
    {
        exit;
        $this->paginate = [
            'limit' => 2,
            'order' => ['id' => 'DESC'],

        ];

        $company = $this->paginate($this->Companies);
        $this->set(compact('company'));

    }

    /**
     * Function name     : Delete
     * Description         : Delete functionality for Company also its documents
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */
    public function delete($id = null)
    {
        $id = base64_decode($id);
        $companyTable = TableRegistry::get('Companies');
        $company = $companyTable->find('all')->where(['Companies.id' => $id])->first();

        if (!empty($company)) {
            if ($this->Companies->delete($company)) {

                $documentTable = TableRegistry::get('Documents');
                $documents = $documentTable->find('all')
                    ->where(['Documents.related_id' => $id, 'Documents.sectionName' => 'company'])
                    ->toArray();

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

                $this->Flash->success(__('The company has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The course could not be deleted. Please, try again.'));
            }

        }
        return $this->redirect($this->referer());
    }

    /**
     * Function name     : Delete company documents
     * Description         : Delete functionality for Company  documents
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function deleteComapnyDocument($id = null)
    {
        exit;
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
            'contain' => ['Companies', 'TransactionTypes'],
        ];

        $companyTransactionTable = tableRegistry::get('CompanyTransactions');
        $query = $companyTransactionTable
            ->find('all')
            ->enableAutoFields(true);
        // array_push($conditions, array(['CompanyTransactions.company_id' => $this->Auth->user('company_id')]));
        $query->where(['CompanyTransactions.company_id' => $this->Auth->user('company_id')]);

        if ($this->request->is('ajax')) {
            if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
                // array_push($conditions, array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
                $query->where(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]);
            }

            if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
                // array_push($conditions, array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
                $query->where(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]);
            }

            if ($this->request->getQuery('email_or_name')) {
                $searchQuery = $this->request->getQuery('email_or_name');
                // array_push($conditions, ['OR' => [['CompanyTransactions.email LIKE' => '%' . trim($searchQuery) . '%'], ['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']]]);
                $query->where(
                    function (QueryExpression $expression, Query $query) use($searchQuery) {
                        $query->newExpr()
                            ->or(['CompanyTransactions.email LIKE' => '%' . trim($searchQuery) . '%'])
                            ->add(['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']);
                    }
                );
            }

        }

        $company_transactions = $this->paginate($query);

        //echo '<pre>'; print_r($company_transactions); exit;
        $companyTable = tableRegistry::get('Companies');
        $transactionTypesTable = tableRegistry::get('TransactionTypes');
        $transactionsTable = tableRegistry::get('Transactions');

        $companies = $companyTable->find('list')->where(['id' => $this->Auth->user('company_id')]);
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
        exit;
        $id = base64_decode($id);

        $companyTransactionTable = tableRegistry::get('CompanyTransactions');
        $transStatusTable = tableRegistry::get('StatusTransactions');
        $company_transaction = $companyTransactionTable->get($id, [
            'contain' => ['Companies', 'Transactions', 'TransactionTypes'],
        ]);

        if (!empty($this->request->getData())) {
            $requestPayload = $this->request->getData();

            $requestPayload['starting_date'] = $this->request->getData('starting_date_cus');
            $requestPayload['completion_date'] = $this->request->getData('completion_date_cus');

            $companyTransactionTable->patchEntity($company_transaction, $requestPayload);
            if ($companyTransactionTable->save($company_transaction)) {
                $this->Flash->success(__('Company Transaction  updated successfully'));
                return $this->redirect(['action' => 'transactions']);
            }

            $this->Flash->error(__('Company Transaction  could not be deleted. Please, try again.'));
            return $this->redirect(['action' => 'edit_transaction', base64_encode($id)]);

        }

        $companies = $companyTransactionTable->Companies->find('list')->where(['id' => $this->Auth->User('company_id')]);

        $transactions = $companyTransactionTable->Transactions->find('list');
        $transactions_type_ids = $companyTransactionTable->TransactionTypes->find('list');
        $transaction_status = $transStatusTable->find('list');

        $this->set('transaction_status', $transaction_status);
        $this->set('company_transaction', $company_transaction);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transactions_type_ids', $transactions_type_ids);
    }

    /**
     * Function name     : add company transaction
     * Description         : add Company  Transactions
     * Author             : Wepro
     * Created by         : Wepro 17-Apr-2017
     */
    public function add_transaction($comp_id = null)
    {
        exit;
        $companyTransactionTable = tableRegistry::get('CompanyTransactions');
        $transStatusTable = tableRegistry::get('StatusTransactions');
        $company_transaction = $companyTransactionTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $requestPayload = $this->request->getData();

            $requestPayload['starting_date'] = $this->request->getData('starting_date_cus');

            if ($this->request->getData('trans_finish') == 1) {
                $requestPayload['completion_date'] = date('Y-m-d');
            }

            $requestPayload['created'] = date('Y-m-d h:i:s');

            $companyTransactionTable->patchEntity($company_transaction, $requestPayload);

            if ($companyTransactionTable->save($company_transaction)) {
                $this->Flash->success(__('Company Transaction  added successfully'));
                return $this->redirect(['action' => 'transactions']);
            }

            $this->Flash->error(__('Company Transaction  could not be deleted. Please, try again.'));
            return $this->redirect(['action' => 'add_transaction', $comp_id]);

        }
        if (!empty($comp_id)) {
            $companies = $companyTransactionTable->Companies->find('list')->where(['Companies.id' => base64_decode($comp_id)]);
        } else {
            $companies = $companyTransactionTable->Companies->find('list')->where(['id' => $this->Auth->user('company_id')]);
        }

        $transactions = $companyTransactionTable->Transactions->find('list');
        $transactions_type_ids = $companyTransactionTable->TransactionTypes->find('list');
        $transaction_status = $transStatusTable->find('list');

        $this->set('transaction_status', $transaction_status);
        $this->set('company_transaction', $company_transaction);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transactions_type_ids', $transactions_type_ids);
    }

    /**
     * Function name     : delete company transaction
     * Description         : delete Company  Transactions
     * Author             : Wepro
     * Created by         : Wepro 17-Apr-2017
     */

    public function delete_transaction($id = null)
    {
        exit;
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
        exit;
        $data = '';
        if ($this->request->is('ajax')) {
            if ($this->request->getData('forWhom') == 1 && !empty($this->request->getData('keyword'))) {
                $employeeTable = TableRegistry::get('Employees');
                $employees = $employeeTable->find('all')->where(['Employees.name LIKE' => '%' . $this->request->getData('keyword') . '%']);
                $data = '<ul id="name-list">';
                foreach ($employees as $employee) {
                    $data .= '<li  data-name="' . $employee->name . '" >' . $employee->name . '</li>';
                }
                $data .= '</ul>';
            }

            if ($this->request->data['forWhom'] == 2 && !empty($this->request->getData('keyword'))) {
                $dependentTable = TableRegistry::get('Dependents');
                $dependents = $dependentTable->find('all')->where(['Dependents.name LIKE' => '%' . $this->request->getData('keyword') . '%']);
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

    public function save_title()
    {
        exit;
        if ($this->request->params['isAjax']) {

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
     * Description         : upload_attachment is used for upload file from "Manage Companies" file
     * Author             : Wepro
     * Created by         : Wepro 6-May-2017
     */

    public function upload_attachment($cmpnyId = null)
    {
        exit;
        if ($this->request->is('post')) {
            $cmpnyId = base64_decode($this->request->getData('company-id'));

            if (empty($cmpnyId)) {
                $this->Flash->error(__('Something went wrong. Please, try again.'));
                return $this->redirect(['action' => 'index']);
            }
            if (!empty($this->request->data['attachment-title'])) {

                $title = $this->request->data['attachment-title'];
                $documents = TableRegistry::get('Documents');

                if (isset($this->request->data['attachment-file']['tmp_name']) && !empty($this->request->data['attachment-file']['tmp_name'])) {

                    $data = pathinfo($this->request->data['attachment-file']['name']);
                    $ext = $data['extension'];
                    $tmp_name = $this->request->data['attachment-file']['tmp_name'];
                    $newName = 'company_' . uniqid() . '.' . $ext;

                    $cimage = $documents->newEmptyEntity();
                    $cimage->related_id = $cmpnyId;
                    $cimage->eTitle = 'company';
                    $cimage->aTitle = $title;
                    $cimage->sectionName = 'company';

                    $cimage->file = $newName;

                    if ($documents->save($cimage)) {
                        // now upload file
                        move_uploaded_file($tmp_name, "documents/company/" . $newName);

                        $this->Flash->success(__('File Uploaded Successfully'));
                        return $this->redirect(['action' => 'edit', base64_encode($cmpnyId)]);
                    }
                    $this->Flash->error(__('Document couldnot be saved'));
                    return $this->redirect(['action' => 'index']);

                } else {
                    $this->Flash->error(__('Please choose file. Please, try again.'));
                    return $this->redirect(['action' => 'index']);
                }

            } else {
                $this->Flash->error(__('Please fill attachment title. Please, try again.'));
                return $this->redirect(['action' => 'index']);
            }

        }
        die;

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

        $conditions = [];
        array_push($conditions, array(['CompanyTransactions.company_id' => $this->Auth->user('company_id')]));
        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            array_push($conditions, array(['CompanyTransactions.company_id' => $_GET['company_id']]));
        }

        if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
            array_push($conditions, array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
        }

        if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
            array_push($conditions, array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
        }
        if ($this->request->query('email_or_name')) {
            $searchQuery = $this->request->query('email_or_name');
            array_push($conditions, ['OR' => [['CompanyTransactions.email LIKE' => '%' . trim($searchQuery) . '%'], ['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']]]);
        }

        $companyTransactionTable = tableRegistry::get('CompanyTransactions');

        $company_transactions = $companyTransactionTable->find('all')->where($conditions)->contain(['Companies', 'Transactions', 'TransactionTypes']);

        $this->set(compact('company_transactions', 'output_type', 'file'));
        $this->viewBuilder()->setLayout('xls/default');
        $this->viewBuilder()->setTemplate('xls/spreadsheet_transaction');
        $this->RequestHandler->respondAs('xlsx');
        $this->render();
    }

    public function getEmployees()
    {
        $employeeTable = TableRegistry::get('Employees');
        $employees = $employeeTable->find('list')->where(['Employees.company_id' => $this->Auth->user('company_id')]);
        echo json_encode($employees);exit;
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
        $dependentres = $dependent->find('list')->where(['Dependents.employee_id' => $this->request->data['dependent_id']]);
        echo json_encode($dependentres);exit;
    }
    public function files($link)
    {
        $this->layout = false;
        $documentTable = TableRegistry::get('Documents');
        $documents = $documentTable->get(base64_decode($link), [
            'contain' => ['Companies'],
        ]); //;

        if ($documents['related_id'] == $this->Auth->user('company_id')) {
            //echo '<pre>'; print_r($documents); exit;
            // $URL = BASE_URL . "/documents/company/" . $documents['file'];

            $file_path = WWW_ROOT. "/documents/company/" . $documents['file'];

            $response = $this->response
            ->withFile($file_path, array(
                '‘download’' => true,
                'name' => $documents['file']
            ))
            ->withDownload($documents['file']);

            return $response;

            //echo $URL; exit;
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
        } else {
            echo "<center style='margin-top:30px;'><h3>you don't have permission to access this file</h3></center>";
            exit;
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
}
