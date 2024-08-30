<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\ORM\TableRegistry;

/**
 * Centers Controller
 *
 * @property \App\Model\Table\CentersTable $Centers
 */
class ReportsController extends AppController
{

    public function initialize(): void
    {parent::initialize();
        $this->loadComponent('Paginator');

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->viewBuilder()->setLayout('admin');
        parent::beforeFilter($event);
    }

    public function index()
    {

    }

    /*
     * Function name     : Manage
     * Description         : View All Data for Transactions
     * Author             : Wepro
     * Created by         : Wepro 28-Dec-2016
     */

    public function transactionOLD()
    {
        $this->paginate = [
            'limit' => 5,
            'order' => ['name' => 'ASC'],
            'contain' => ['Companies', 'Transactions', 'TransactionTypes'],

        ];

        $followTable = tableRegistry::get('CompanyTransactions');

        $conditions = [];
        if ($this->request->getParam('isAjax')) {
            if (isset($_GET['for_whom']) && !empty($_GET['for_whom'])) {
                array_push($conditions, array(['CompanyTransactions.for_whom' => $_GET['for_whom']]));
            }

            if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
                array_push($conditions, array(['CompanyTransactions.company_id' => $_GET['company_id']]));
            }

            if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
                array_push($conditions, array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
            }

            if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
                array_push($conditions, array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
            }

            if (isset($_GET['starting_date']) && !empty($_GET['starting_date'])) {
                array_push($conditions, array(['CompanyTransactions.starting_date >' => $_GET['starting_date']]));
            }

            if (isset($_GET['completion_date']) && !empty($_GET['completion_date'])) {
                array_push($conditions, array(['CompanyTransactions.completion_date <' => $_GET['completion_date']]));
            }

            if ($this->request->query('email_or_name')) {
                $searchQuery = $this->request->query('email_or_name');
                array_push($conditions, ['OR' => [['CompanyTransactions.email LIKE' => '%' . trim($searchQuery) . '%'], ['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']]]);
            }

        }

        $follows = $followTable->find('all')->where($conditions);
        $follow = $this->paginate($follows);

        $companyTable = tableRegistry::get('Companies');
        $transactionTypesTable = tableRegistry::get('TransactionTypes');
        $transactionsTable = tableRegistry::get('Transactions');

        $companies = $companyTable->find('list');
        $transactions_type_ids = $transactionTypesTable->find('list');
        $transactions = $transactionsTable->find('list');

        $this->set('follow', $follow);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transactions_type_ids', $transactions_type_ids);
    }

    /*
     * Function name     : Employee
     * Description         : View All Data for Employee
     * Author             : Wepro
     * Created by         : Wepro 28-Dec-2016
     */

    public function em7ployeeOLD()
    {

        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],
            'contain' => ['Companies'],
            //'contain' => ['Companies','Transactions','TransactionTypes']

        ];

        $employeeTable = tableRegistry::get('Employees');
        $follow = $this->paginate($employeeTable->find('all'));
        $this->set('follow', $follow);
    }

    /*
     * Function name     : Manage
     * Description         : View All Data for Dependent
     * Author             : Wepro
     * Created by         : Wepro 28-Dec-2016
     */

    public function dependent()
    {

        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],
            'contain' => ['Companies'],
            //'contain' => ['Companies','Transactions','TransactionTypes']

        ];

        $followTable = tableRegistry::get('CompanyTransactions');
        echo '<pre>';
        print_r($followTable->find('all')->where(['CompanyTransactions.for_whom' => 2])->Array());exit;
        $follow = $this->paginate($followTable->find('all')->where(['CompanyTransactions.for_whom' => 2]));
        $this->set('follow', $follow);

    }

    public function trasection_report()
    {
        $this->paginate = [
            'limit' => 20,
            //'order'=>['id'=>'DESC'],
        ];
        $conditions = [];
        $Em_conditions = [];
        $compnyTransTbale = tableRegistry::get('TrasectionsRelation');

        $full_trans_record_data = $compnyTransTbale->find('all')
            ->enableAutoFields(true);

        if ($this->request->is('ajax')) {
            //echo '<pre>'; print_r($_GET); exit;
            /*if(isset($_GET['for_whom']) && !empty($_GET['for_whom'])){
            array_push($conditions,array(['TrasectionsRelation.CompanyTransactions.for_whom' => $_GET['for_whom']]));
            }

            if(isset($_GET['company_id']) && !empty($_GET['company_id'])){
            array_push($conditions,array(['TrasectionsRelation.CompanyTransactions.company_id' => $_GET['company_id']]));
            }

            if(isset($_GET['employee_id']) && !empty($_GET['employee_id'])){
            array_push($conditions,array(['TrasectionsRelation.CompanyTransactions.employee_id' => $_GET['employee_id']]));
            }

            if(isset($_GET['for_whom']) && $_GET['for_whom'] == 2){
            if(isset($_GET['dependet_id']) && !empty($_GET['dependet_id'])){
            array_push($conditions,array(['TrasectionsRelation.CompanyTransactions.dependet_id' => $_GET['dependet_id']]));
            }
            }

            if(isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])){
            array_push($conditions,array(['CompanyTransactions.TrasectionsRelation.transaction_type_id' => $_GET['transaction_type_id']]));
            }transaction_id
             */

            if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
                // array_push($conditions, array(['TrasectionsRelation.transaction_type_id' => $_GET['transaction_type_id']]));
                $full_trans_record_data->where(['TrasectionsRelation.transaction_type_id' => $_GET['transaction_type_id']]);
            }

            if (isset($_GET['starting_date']) && !empty($_GET['starting_date'])) {

                $start_date_ex_type = explode('/', $_GET['starting_date']);
                $_GET['starting_date'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];

                // array_push($conditions, array(['TrasectionsRelation.starting_date >' => $_GET['starting_date']]));
                $full_trans_record_data->where(['TrasectionsRelation.starting_date' => $_GET['starting_date']]);
            }

            if (isset($_GET['completion_date']) && !empty($_GET['completion_date'])) {
                $start_date_ex_type = explode('/', $_GET['completion_date']);
                $_GET['completion_date'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                // array_push($conditions, array(['TrasectionsRelation.completion_date <' => $_GET['completion_date']]));
                $full_trans_record_data->where(['TrasectionsRelation.completion_date' => $_GET['completion_date']]);
            }
        }
        // array_push($conditions, array('not' => array('TrasectionsRelation.starting_date' => null), 'not' => array('TrasectionsRelation.starting_date' => '')));
        // array_push(
        //     $conditions,
        //     array(
        //         'is not' => array('TrasectionsRelation.starting_date' => null)
        //     )
        // );
        //echo '<pre>'; print_r($conditions); exit;
        /*$compnyTransTbale             = tableRegistry::get('CompanyTransactions');
        $full_trans_record_data     = $compnyTransTbale->find('all')
        ->autoFields(true)
        ->where($conditions)
        ->contain(['Employees','Dependents','Companies','TrasectionsRelation']);*/
        //array_push($conditions , array('NOT' => array('TrasectionsRelation.note' => null)));
        // ,  array('not' => array('TrasectionsRelation.starting_date' => NULL))

        $data = $_GET;
        //echo '<pre>'; print_r($conditions); exit;

        // ->where($conditions)
        $full_trans_record_data
            ->order(['CompanyTransactions.id' => 'DESC'])
            ->contain('Users', 'CompanyTransactions.Companies')
            //->where('TrasectionsRelation.starting_date !=' => null)
            ->matching('CompanyTransactions.Companies', function ($q) use ($data) {
                $conditionsInner = array();
                if ($this->request->is('ajax')) {

                    if (isset($data['for_whom']) && !empty($data['for_whom'])) {
                        // array_push($conditionsInner, array(['CompanyTransactions.for_whom' => $data['for_whom']]));
                        $q->where(['CompanyTransactions.for_whom' => $data['for_whom']]);
                    }

                    if (isset($data['company_id']) && !empty($data['company_id'])) {
                        // array_push($conditionsInner, array(['CompanyTransactions.company_id' => $data['company_id']]));
                        $q->where(['CompanyTransactions.company_id' => $data['company_id']]);
                    }

                    if (isset($data['employee_id']) && !empty($data['employee_id'])) {
                        // array_push($conditionsInner, array(['CompanyTransactions.employee_id' => $data['employee_id']]));
                        $q->where(['CompanyTransactions.employee_id' => $data['employee_id']]);
                    }

                    if (isset($data['for_whom']) && $data['for_whom'] == 2) {
                        if (isset($data['dependet_id']) && !empty($data['dependet_id'])) {
                            // array_push($conditionsInner, array(['CompanyTransactions.dependet_id' => $data['dependet_id']]));
                            $q->where(['CompanyTransactions.dependet_id' => $data['dependet_id']]);
                        }
                    }

                    if (isset($data['transaction_id']) && !empty($data['transaction_id'])) {
                        // array_push($conditionsInner, array(['CompanyTransactions.transaction_type_id' => $data['transaction_id']]));
                        $q->where(['CompanyTransactions.transaction_type_id' => $data['transaction_id']]);
                    }
                    //echo '<pre>'; print_r($conditionsInner); exit;
                    //echo '<pre>'; print_r($q->where([$conditionsInner])->toArray()); exit;
                    //return $q->where($conditions);
                }
                //'order' => ['Articles.created' => 'DESC']
                return $q;
                //return $q->where(['username' => $username]);

            });

        //'Employees.name = CompanyTransactions.name',
        //echo '<pre>'; print_r($full_trans_record_data); exit;
        $companyTable = tableRegistry::get('Companies');
        $transactionTypesTable = tableRegistry::get('TransactionTypes');

        $transactionsTable = tableRegistry::get('Transactions');

        $companies = $companyTable->find('list');
        $transactions_type_ids = $transactionTypesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'transaction_name',
        ]);
        $transactions = $transactionsTable->find('list');

        $full_trans_records = $this->paginate($full_trans_record_data);
//echo '<pre>';print_r($full_trans_records); exit;
        $transStatusTable = tableRegistry::get('StatusTransactions');
        $transaction_status = $transStatusTable->find('list');
        $this->set('full_trans_records', $full_trans_records);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transaction_status', $transaction_status->toArray());
        $this->set('transactions_type_ids', $transactions_type_ids->toArray());
    }

    /*
     * Function name     : excel
     * Description         : to generate excel data of the comny transaction
     * Author             : Wepro
     * Created by         : Wepro 28-APR-2017
     */

    public function excel()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->paginate = [
            'limit' => 500,
            'order' => ['id' => 'DESC'],
            'contain' => ['Companies', 'Transactions', 'TransactionTypes'],

        ];

        $followTable = tableRegistry::get('CompanyTransactions');

        $conditions = [];

        if (isset($_GET['for_whom']) && !empty($_GET['for_whom'])) {
            array_push($conditions, array(['CompanyTransactions.for_whom' => $_GET['for_whom']]));
        }

        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            array_push($conditions, array(['CompanyTransactions.company_id' => $_GET['company_id']]));
        }

        if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
            array_push($conditions, array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
        }

        if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
            array_push($conditions, array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
        }

        if (isset($_GET['starting_date']) && !empty($_GET['starting_date'])) {
            array_push($conditions, array(['CompanyTransactions.starting_date >' => $_GET['starting_date']]));
        }

        if (isset($_GET['completion_date']) && !empty($_GET['completion_date'])) {
            array_push($conditions, array(['CompanyTransactions.completion_date <' => $_GET['completion_date']]));
        }

        if ($this->request->getQuery('email_or_name')) {
            $searchQuery = $this->request->getQuery('email_or_name');
            array_push($conditions, ['OR' => [['CompanyTransactions.email LIKE' => '%' . trim($searchQuery) . '%'], ['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']]]);
        }

        $follows = $followTable->find('all')->where($conditions);
        $follow = $this->paginate($follows);

        header("Content-Type: application/xls");
        header("Content-Disposition:attachment;filename=download.xls");
        //pr($follow);die;
        $this->set('follow', $follow);

    }

    /*
     * Function name     : excel_full
     * Description         : to generate excel data of the comny transaction
     * Author             : Wepro
     * Created by         : Wepro 28-APR-2017
     */

    public function excel_full()
    {

        $this->viewBuilder()->setLayout('ajax');

        $this->paginate = [
            'limit' => 500,
            'order' => ['id' => 'DESC'],

        ];

        $conditions = [];
        $Em_conditions = [];
        //echo '<pre>'; print_r($_GET); exit;
        /*if(isset($_GET['for_whom']) && !empty($_GET['for_whom'])){
        array_push($conditions,array(['TrasectionsRelation.CompanyTransactions.for_whom' => $_GET['for_whom']]));
        }

        if(isset($_GET['company_id']) && !empty($_GET['company_id'])){
        array_push($conditions,array(['TrasectionsRelation.CompanyTransactions.company_id' => $_GET['company_id']]));
        }

        if(isset($_GET['employee_id']) && !empty($_GET['employee_id'])){
        array_push($conditions,array(['TrasectionsRelation.CompanyTransactions.employee_id' => $_GET['employee_id']]));
        }

        if(isset($_GET['for_whom']) && $_GET['for_whom'] == 2){
        if(isset($_GET['dependet_id']) && !empty($_GET['dependet_id'])){
        array_push($conditions,array(['TrasectionsRelation.CompanyTransactions.dependet_id' => $_GET['dependet_id']]));
        }
        }

        if(isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])){
        array_push($conditions,array(['CompanyTransactions.TrasectionsRelation.transaction_type_id' => $_GET['transaction_type_id']]));
        }
         */

        if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
            array_push($conditions, array(['TrasectionsRelation.transaction_type_id' => $_GET['transaction_type_id']]));
        }

        if (isset($_GET['starting_date']) && !empty($_GET['starting_date'])) {

            $start_date_ex_type = explode('/', $_GET['starting_date']);
            $_GET['starting_date'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];

            array_push($conditions, array(['TrasectionsRelation.starting_date >' => $_GET['starting_date']]));
        }

        if (isset($_GET['completion_date']) && !empty($_GET['completion_date'])) {
            $start_date_ex_type = explode('/', $_GET['completion_date']);
            $_GET['completion_date'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            array_push($conditions, array(['TrasectionsRelation.completion_date <' => $_GET['completion_date']]));
        }

        // array_push(
        //     $conditions,
        //     array(
        //         'is not' => array('TrasectionsRelation.starting_date' => null)
        //     )
        // );
        // dd('test');

        //echo '<pre>'; print_r($conditions); exit;
        /*$compnyTransTbale             = tableRegistry::get('CompanyTransactions');
        $full_trans_record_data     = $compnyTransTbale->find('all')
        ->autoFields(true)
        ->where($conditions)
        ->contain(['Employees','Dependents','Companies','TrasectionsRelation']);*/
        //array_push($conditions , array('NOT' => array('TrasectionsRelation.note' => null)));
        // ,  array('not' => array('TrasectionsRelation.starting_date' => NULL))
        $data = $_GET;
        $compnyTransTbale = tableRegistry::get('TrasectionsRelation');
        //echo '<pre>'; print_r($conditions); exit;
        $full_trans_record_data = $compnyTransTbale->find('all')
            ->enableAutoFields(true)
            ->where($conditions)
            ->order(['CompanyTransactions.id' => 'DESC'])
            ->contain('Users', 'CompanyTransactions.Companies')
        //->where('TrasectionsRelation.starting_date !=' => null)
            ->matching('CompanyTransactions.Companies', function ($q) use ($data) {
                $conditionsInner = array();

                if (isset($data['for_whom']) && !empty($data['for_whom'])) {
                    array_push($conditionsInner, array(['CompanyTransactions.for_whom' => $data['for_whom']]));
                }

                if (isset($data['company_id']) && !empty($data['company_id'])) {
                    array_push($conditionsInner, array(['CompanyTransactions.company_id' => $data['company_id']]));
                }

                if (isset($data['employee_id']) && !empty($data['employee_id'])) {
                    array_push($conditionsInner, array(['CompanyTransactions.employee_id' => $data['employee_id']]));
                }

                if (isset($data['for_whom']) && $data['for_whom'] == 2) {
                    if (isset($data['dependet_id']) && !empty($data['dependet_id'])) {
                        array_push($conditionsInner, array(['CompanyTransactions.dependet_id' => $data['dependet_id']]));
                    }
                }

                if (isset($data['transaction_id']) && !empty($data['transaction_id'])) {
                    array_push($conditionsInner, array(['CompanyTransactions.transaction_type_id' => $data['transaction_id']]));
                }
                //echo '<pre>'; print_r($conditionsInner); exit;
                //echo '<pre>'; print_r($q->where([$conditionsInner])->toArray()); exit;
                //return $q->where($conditions);

                //'order' => ['Articles.created' => 'DESC']
                return $q->where([$conditionsInner]);
                //return $q->where(['username' => $username]);

            });

        //'Employees.name = CompanyTransactions.name',
        //echo '<pre>'; print_r($full_trans_record_data); exit;
        $companyTable = tableRegistry::get('Companies');
        $transactionTypesTable = tableRegistry::get('TransactionTypes');

        //$transactionsTable     = tableRegistry::get('Transactions');

        $companies = $companyTable->find('list');
        $transactions_type_ids = $transactionTypesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'transaction_name',
        ]);
        //$transactions = $transactionsTable->find('list');

        $full_trans_records = $this->paginate($full_trans_record_data);
//echo '<pre>';print_r($full_trans_records); exit;
        $transStatusTable = tableRegistry::get('StatusTransactions');
        $transaction_status = $transStatusTable->find('list');

        header("Content-Type: application/xls");
        header("Content-Disposition:attachment;filename=trasectionReport.xls");

        $this->set('full_trans_records', $full_trans_records);
        //$this->set('companies',$companies);
        //$this->set('transactions',$transactions);
        $this->set('transaction_status', $transaction_status->toArray());
        $this->set('transactions_type_ids', $transactions_type_ids->toArray());
    }

    public function company_total_fees()
    {
        $this->viewBuilder()->setLayout('ajax');
        $compnyTransTbale = tableRegistry::get('CompanyTransactions');

        $conditions = [];

        if (isset($_GET['for_whom']) && !empty($_GET['for_whom'])) {
            array_push($conditions, array(['CompanyTransactions.for_whom' => $_GET['for_whom']]));
        }

        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            array_push($conditions, array(['CompanyTransactions.company_id' => $_GET['company_id']]));
        }

        if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
            array_push($conditions, array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
        }

        if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
            array_push($conditions, array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
        }

        if (isset($_GET['starting_date']) && !empty($_GET['starting_date'])) {
            array_push($conditions, array(['CompanyTransactions.starting_date >' => $_GET['starting_date']]));
        }

        if (isset($_GET['completion_date']) && !empty($_GET['completion_date'])) {
            array_push($conditions, array(['CompanyTransactions.completion_date <' => $_GET['completion_date']]));
        }

        if ($this->request->query('email_or_name')) {
            $searchQuery = $this->request->getQuery('email_or_name');
            array_push($conditions, ['OR' => [['CompanyTransactions.email LIKE' => '%' . trim($searchQuery) . '%'], ['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']]]);
        }

        $companyTrans = $compnyTransTbale->find()
            ->where($conditions)
            ->select([
                'company_id' => 'CompanyTransactions.company_id',
                'govt_sum' => 'SUM(Transactions.gov_fees)',
                'typing_sum' => 'SUM(Transactions.typing_fees)',
                'total_fees' => 'SUM(Transactions.gov_fees + Transactions.typing_fees)',
                'company_name' => 'Companies.name',
            ])
            ->enableAutoFields(true)
            ->join([
                'transactions' => [
                    'table' => 'transactions',
                    'alias' => 'Transactions',
                    'type' => 'INNER',
                    'conditions' => 'Transactions.id = CompanyTransactions.transaction_id',
                ],
                'company' => [
                    'table' => 'companies',
                    'alias' => 'Companies',
                    'type' => 'INNER',
                    'conditions' => 'Companies.id = CompanyTransactions.company_id',
                ],
            ])
            ->group('CompanyTransactions.company_id')->toArray();

        foreach ($companyTrans as $key => $cmtrans) {
            $companyTrans[$key]['total_expence'] = $cmtrans['govt_sum'] + $cmtrans['typing_sum'];

        }

        header("Content-Type: application/xls");
        header("Content-Disposition:attachment;filename=download.xls");
        $this->set('companyTrans', $companyTrans);

    }
    /****New Reports*****/
    public function employee()
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],

        ];
        $conditions = [];
        $Em_conditions = [];
        $employees = tableRegistry::get('Employees');
        $full_trans_record_data = $employees->find('all')
            ->select(['Employees.id', 'Employees.name', 'Employees.ps_number', 'Employees.email'])
            ->enableAutoFields(true)
            ->contain(['Companies']);

        if ($this->request->is('ajax')) {
            if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
                // array_push($conditions, array(['Employees.company_id' => $_GET['company_id']]));
                $full_trans_record_data->where(['Employees.company_id' => $_GET['company_id']]);
            }
            if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
                // array_push($conditions, array(['Employees.id' => $_GET['employee_id']]));
                $full_trans_record_data->where(['Employees.id' => $_GET['employee_id']]);
            }

            if ($this->request->getQuery('email_or_name')) {
                $searchQuery = $this->request->getQuery('email_or_name');
                // array_push($conditions, ['OR' => [['Employees.email LIKE' => '%' . trim($searchQuery) . '%'], ['Employees.name LIKE' => '%' . trim($searchQuery) . '%']]]);
                $full_trans_record_data
                    ->where(
                        function ($exp, $query) use($searchQuery) {
                            return $query->newExpr()
                                ->or(['Employees.email LIKE' => '%' . trim($searchQuery) . '%'])
                                ->add(['Employees.name LIKE' => '%' . trim($searchQuery) . '%']);
                        }
                    );
            }

            if ($this->request->getQuery('status') != '') {
                // array_push($conditions, array(['Employees.status' => $this->request->getQuery('status')]));
                $full_trans_record_data->where(['Employees.status' => $this->request->getQuery('status')]);
            }
            if ($this->request->getQuery('expired_type')) {
                if (!empty($this->request->getQuery('start_date_ex_type'))) {
                    $start_date_ex_type = explode('/', $this->request->getQuery('start_date_ex_type'));
                    // $this->request->getQuery['start_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                    $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                }
                if (!empty($this->request->getQuery('end_date_ex_type'))) {
                    $end_date_ex_type = explode('/', $this->request->getQuery('end_date_ex_type'));
                    // $this->request->getQuery['end_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                    $end_date_ex_type = $end_date_ex_type[2] . '-' . $end_date_ex_type[1] . '-' . $end_date_ex_type[0];
                }
                //echo '<pre>';print_r($this->request->query); exit;
                if (!empty($start_date_ex_type) || !empty($end_date_ex_type)) {
                    if ($this->request->getQuery('expired_type') == 'passport_expired') {
                        // array_push($conditions, array(['Employees.passport_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                        $full_trans_record_data->where(['Employees.passport_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    } else if ($this->request->getQuery('expired_type') == 'visa_expired') {
                        // array_push($conditions, array(['Employees.visa_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                        $full_trans_record_data->where(['Employees.visa_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    } else if ($this->request->getQuery('expired_type') == 'emirates_id_expired') {
                        // array_push($conditions, array(['Employees.emiratesID_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                        $full_trans_record_data->where(['Employees.emiratesID_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    } else if ($this->request->getQuery('expired_type') == 'health_card_exp_date') {
                        // array_push($conditions, array(['Employees.health_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                        $full_trans_record_data->where(['Employees.health_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    } else if ($this->request->getQuery('expired_type') == 'labor_card_expired') {
                        // array_push($conditions, array(['Employees.labor_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                        $full_trans_record_data->where(['Employees.labor_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    }
                } else {
                    if ($this->request->getQuery('expired_type') == 'passport_expired') {
                        // array_push($conditions, array(['Employees.passport_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Employees.passport_exp_date < CURDATE()']);
                    } else if ($this->request->getQuery('expired_type') == 'visa_expired') {
                        // array_push($conditions, array(['Employees.visa_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Employees.visa_exp_date < CURDATE()']);
                    } else if ($this->request->getQuery('expired_type') == 'emirates_id_expired') {
                        // array_push($conditions, array(['Employees.emiratesID_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Employees.emiratesID_exp_date < CURDATE()']);
                    } else if ($this->request->getQuery('expired_type') == 'health_card_exp_date') {
                        // array_push($conditions, array(['Employees.health_card_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Employees.health_card_exp_date < CURDATE()']);
                    } else if ($this->request->getQuery('expired_type') == 'labor_card_expired') {
                        // array_push($conditions, array(['Employees.labor_card_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Employees.labor_card_exp_date < CURDATE()']);
                    }
                }
            }
            //echo '<pre>';print_r($full_trans_record_data); exit;
        }
        //echo '<pre>'; print_r($full_trans_record_data); exit;
        //'Employees.name = CompanyTransactions.name',
        //echo '<pre>'; print_r($full_trans_record_data); exit;
        $companyTable = tableRegistry::get('Companies');
        $transactionTypesTable = tableRegistry::get('TransactionTypes');
        $transactionsTable = tableRegistry::get('Transactions');
        $companies = $companyTable->find('list');
        $transactions_type_ids = $transactionTypesTable->find('list');
        $transactions = $transactionsTable->find('list');
        $full_trans_records = $this->paginate($full_trans_record_data);
        $this->set('full_trans_records', $full_trans_records);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transactions_type_ids', $transactions_type_ids);
    }

    /**
     * employee_excel_report function
     *
     * @return void
     */
    public function employee_excel_report(): void
    {
        $this->viewBuilder()->setLayout('ajax');

        $this->paginate = [
            'limit' => 500,
            'order' => ['id' => 'DESC'],

        ];

        $conditions = [];
        $employees = tableRegistry::get('Employees');

        $full_trans_record_data = $employees->find('all')
        // ->where($conditions)
        // ->select(['Employees.id','Employees.name','Employees.ps_number','Employees.email'])
        ->enableAutoFields(true)

        ->contain(['Companies']);
        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            // array_push($conditions, array(['Employees.company_id' => $_GET['company_id']]));
            $full_trans_record_data->where(['Employees.company_id' => $_GET['company_id']]);
        }

        if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
            // array_push($conditions, array(['Employees.id' => $_GET['employee_id']]));
            $full_trans_record_data->where(['Employees.id' => $_GET['employee_id']]);
        }

        if ($this->request->getQuery('email_or_name')) {
            $searchQuery = $this->request->getQuery('email_or_name');
            // array_push($conditions, ['OR' => [['Employees.email LIKE' => '%' . trim($searchQuery) . '%'], ['Employees.name LIKE' => '%' . trim($searchQuery) . '%']]]);
            $full_trans_record_data
                ->where(
                    function ($exp, $query) use($searchQuery) {
                        return $query->newExpr()
                            ->or(['Employees.email LIKE' => '%' . trim($searchQuery) . '%'])
                            ->add(['Employees.name LIKE' => '%' . trim($searchQuery) . '%']);
                    }
                );
        }

        if ($this->request->getQuery('status') != '') {
            // array_push($conditions, array(['Employees.status' => $this->request->getQuery('status')]));
            $full_trans_record_data->where(['Employees.status' => $this->request->getQuery('status')]);
        }

        if ($this->request->getQuery('expired_type')) {
            if (!empty($this->request->getQuery('start_date_ex_type'))) {
                $start_date_ex_type = explode('/', $this->request->getQuery('start_date_ex_type'));
                // $this->request->getQuery['start_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];

            }
            if (!empty($this->request->getQuery('end_date_ex_type'))) {
                $end_date_ex_type = explode('/', $this->request->getQuery('end_date_ex_type'));
                // $this->request->getQuery['end_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                $end_date_ex_type = $end_date_ex_type[2] . '-' . $end_date_ex_type[1] . '-' . $end_date_ex_type[0];
            }
            //echo '<pre>';print_r($this->request->query); exit;
            if (!empty($start_date_ex_type) || !empty($end_date_ex_type)) {
                if ($this->request->getQuery('expired_type') == 'passport_expired') {
                    // array_push($conditions, array(['Employees.passport_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                    $full_trans_record_data->where(['Employees.passport_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                } else if ($this->request->getQuery('expired_type') == 'visa_expired') {
                    // array_push($conditions, array(['Employees.visa_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));

                    $full_trans_record_data->where(
                        ['Employees.visa_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']
                    );
                } else if ($this->request->getQuery('expired_type') == 'emirates_id_expired') {
                    // array_push($conditions, array(['Employees.emiratesID_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                    $full_trans_record_data->where(['Employees.emiratesID_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                } else if ($this->request->getQuery('expired_type') == 'health_card_exp_date') {
                    // array_push($conditions, array(['Employees.health_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                    $full_trans_record_data->where(['Employees.health_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                } else if ($this->request->getQuery('expired_type') == 'labor_card_expired') {
                    // array_push($conditions, array(['Employees.labor_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']));
                    $full_trans_record_data->where(['Employees.labor_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                }
            } else {
                if ($this->request->getQuery('expired_type') == 'passport_expired') {
                    // array_push($conditions, array(['Employees.passport_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Employees.passport_exp_date < CURDATE()']);
                } else if ($this->request->getQuery('expired_type') == 'visa_expired') {
                    // array_push($conditions, array(['Employees.visa_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Employees.visa_exp_date < CURDATE()']);
                } else if ($this->request->getQuery('expired_type') == 'emirates_id_expired') {
                    // array_push($conditions, array(['Employees.emiratesID_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Employees.emiratesID_exp_date < CURDATE()']);
                } else if ($this->request->getQuery('expired_type') == 'health_card_exp_date') {
                    // array_push($conditions, array(['Employees.health_card_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Employees.health_card_exp_date < CURDATE()']);
                } else if ($this->request->getQuery('expired_type') == 'labor_card_expired') {
                    // array_push($conditions, array(['Employees.labor_card_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Employees.labor_card_exp_date < CURDATE()']);
                }
            }
        }
        //echo '<pre>'; print_r($full_trans_record_data->toArray()); exit;

        header("Content-Type: application/xls");
        header("Content-Disposition:attachment;filename=employee.xls");
        //$full_trans_records = $this->paginate($full_trans_record_data);
        $this->set('full_trans_records', $full_trans_record_data->order(['Employees.id' => 'DESC']));
    }

    /**
     * dependents function
     *
     * @return void
     */
    public function dependents(): void
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],
        ];

        $dependent = tableRegistry::get('Dependents');

        $full_trans_record_data = $dependent->find('all')
            ->enableAutoFields(true);

        if ($this->request->is('ajax')) {
            if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
                // array_push($conditions, array(['Dependents.employee_id' => $_GET['employee_id']]));
                $full_trans_record_data->where(['Dependents.employee_id' => $_GET['employee_id']]);
            }
            if (isset($_GET['dependet_id']) && !empty($_GET['dependet_id'])) {
                // array_push($conditions, array(['Dependents.id' => $_GET['dependet_id']]));
                $full_trans_record_data->where(['Dependents.id' => $_GET['dependet_id']]);
            }
            if ($this->request->getQuery('email_or_name')) {
                $searchQuery = $this->request->getQuery('email_or_name');
                // array_push($conditions, ['OR' => [['Dependents.email LIKE' => '%' . trim($searchQuery) . '%'], ['Dependents.name LIKE' => '%' . trim($searchQuery) . '%']]]);
                $full_trans_record_data
                    ->matching(
                        'Employees',
                        function(Query $query) use($searchQuery): Query {
                            return $query->where(['email LIKE' => '%' . trim($searchQuery) . '%']);
                        }
                    );

            }

            if ($this->request->getQuery('status') != '') {
                // array_push($conditions, array(['Dependents.status' => $this->request->query('status')]));
                $full_trans_record_data->where(['Dependents.status' => $this->request->getQuery('status')]);
            }

            if ($this->request->getQuery('expired_type')) {
                if (!empty($this->request->getQuery('start_date_ex_type'))) {
                    $start_date_ex_type = explode('/', $this->request->getQuery('start_date_ex_type'));
                    // $this->request->query['start_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                    $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                }
                if (!empty($this->request->getQuery('end_date_ex_type'))) {
                    $start_date_ex_type = explode('/', $this->request->getQuery('end_date_ex_type'));
                    // $this->request->query['end_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                    $end_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                }

                if (!empty($start_date_ex_type) || !empty($end_date_ex_type)) {
                    if ($this->request->getQuery('expired_type') == 'passport_expired') {
                        // array_push($conditions, array(['Dependents.passport_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                        $full_trans_record_data->where(['Dependents.passport_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    } elseif ($this->request->getQuery('expired_type') == 'visa_expired') {
                        // array_push($conditions, array(['Dependents.visa_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                        $full_trans_record_data->where(['Dependents.visa_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    } elseif ($this->request->getQuery('expired_type') == 'emirates_id_expired') {
                        // array_push($conditions, array(['Dependents.emiratesID_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                        $full_trans_record_data->where(['Dependents.emiratesID_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    } elseif ($this->request->getQuery('expired_type') == 'health_card_exp_date') {
                        // array_push($conditions, array(['Dependents.health_card_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                        $full_trans_record_data->where(['Dependents.health_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    }
                } else {
                    if ($this->request->getQuery('expired_type') == 'passport_expired') {
                        // array_push($conditions, array(['Dependents.passport_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Dependents.passport_exp_date < CURDATE()']);
                    } else if ($this->request->getQuery('expired_type') == 'visa_expired') {
                        // array_push($conditions, array(['Dependents.visa_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Dependents.visa_exp_date < CURDATE()']);
                    } else if ($this->request->getQuery('expired_type') == 'emirates_id_expired') {
                        // array_push($conditions, array(['Dependents.emiratesID_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Dependents.emiratesID_exp_date < CURDATE()']);
                    } else if ($this->request->getQuery('expired_type') == 'health_card_exp_date') {
                        // array_push($conditions, array(['Dependents.health_card_exp_date < CURDATE()']));
                        $full_trans_record_data->where(['Dependents.health_card_exp_date < CURDATE()']);
                    }
                }
            }
            // dd($this->request->getQuery('company_id'));
            if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
                $full_trans_record_data
                    ->contain(
                        [
                            // 'Employees.Companies' => array('conditions' => array('Employees.company_id =' => $_GET['company_id'])),
                            'Employees' => function(Query $query) {
                                return $query->where(['company_id' =>  $_GET['company_id']]);
                            },
                            'Employees.Companies'
                        ]
                    );
            } else {
                $full_trans_record_data
                //->select(['Employees.id','Employees.name','Employees.ps_number','Employees.email'])
                ->contain(['Employees.Companies']);
            }
            //echo '<pre>';print_r($full_trans_record_data); exit;

        } else {
            $full_trans_record_data
            //->select(['Employees.id','Employees.name','Employees.ps_number','Employees.email'])
            ->contain(['Employees.Companies']);
        }
        //echo '<pre>'; print_r($full_trans_record_data); exit;

        //'Employees.name = CompanyTransactions.name',
        //echo '<pre>'; print_r($full_trans_record_data); exit;
        $companyTable = tableRegistry::get('Companies');
        $transactionTypesTable = tableRegistry::get('TransactionTypes');
        $transactionsTable = tableRegistry::get('Transactions');

        $companies = $companyTable->find('list');
        $transactions_type_ids = $transactionTypesTable->find('list');
        $transactions = $transactionsTable->find('list');

        $full_trans_records = $this->paginate($full_trans_record_data);

        $dropDownTable = TableRegistry::get('DropdownValues');
        $relations = $dropDownTable->find('list', ['keyField' => 'keyID', 'valueField' => 'value'])->where(['name' => 'relation'])->toArray();
        $this->set('relations', $relations);

        $this->set('full_trans_records', $full_trans_records);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transactions_type_ids', $transactions_type_ids);
    }

    public function dependents_excel_report()
    {
        $this->viewBuilder()->setLayout('ajax');

        $this->paginate = [
            //'limit' => 500,
            'order' => ['id' => 'DESC'],

        ];

        $dependent = tableRegistry::get('Dependents');

        $full_trans_record_data = $dependent->find('all')
            ->enableAutoFields(true);

        $conditions = [];

        if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
            // array_push($conditions, array(['Dependents.employee_id' => $_GET['employee_id']]));
            $full_trans_record_data->where(['Dependents.employee_id' => $_GET['employee_id']]);

        }
        if (isset($_GET['dependet_id']) && !empty($_GET['dependet_id'])) {
            // array_push($conditions, array(['Dependents.id' => $_GET['dependet_id']]));
            $full_trans_record_data->where(['Dependents.id' => $_GET['dependet_id']]);
        }

        if ($this->request->getQuery('status') != '') {
            // array_push($conditions, array(['Dependents.status' => $this->request->getQuery('status')]));
            $full_trans_record_data->where(['Dependents.status' => $this->request->getQuery('status')]);
        }

        if ($this->request->getQuery('email_or_name')) {
            $searchQuery = $this->request->getQuery('email_or_name');
            // array_push(
            //     $conditions,
            //     [
            //         'OR' => [
            //             ['Dependents.email LIKE' => '%' . trim($searchQuery) . '%'],
            //             ['Dependents.name LIKE' => '%' . trim($searchQuery) . '%']
            //         ]
            //     ]
            // );
            $full_trans_record_data
                ->matching(
                    'Employees',
                    function(Query $query) use($searchQuery): Query {
                        return $query->where(['email LIKE' => '%' . trim($searchQuery) . '%']);
                    }
                );
        }

        if ($this->request->getQuery('expired_type')) {
            if (!empty($this->request->getQuery('start_date_ex_type'))) {
                $start_date_ex_type = explode('/', $this->request->getQuery('start_date_ex_type'));
                // $this->request->query['start_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            }
            if (!empty($this->request->getQuery('end_date_ex_type'))) {
                $start_date_ex_type = explode('/', $this->request->getQuery('end_date_ex_type'));
                // $this->request->query['end_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                $end_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            }

            if (!empty($start_date_ex_type) || !empty($end_date_ex_type)) {
                if ($this->request->getQuery('expired_type') == 'passport_expired') {
                    // array_push($conditions, array(['Dependents.passport_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                    $full_trans_record_data->where(['Dependents.passport_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                } elseif ($this->request->getQuery('expired_type') == 'visa_expired') {
                    // array_push($conditions, array(['Dependents.visa_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                    $full_trans_record_data->where(['Dependents.visa_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                } elseif ($this->request->getQuery('expired_type') == 'emirates_id_expired') {
                    // array_push($conditions, array(['Dependents.emiratesID_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                    $full_trans_record_data->where(['Dependents.emiratesID_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                } elseif ($this->request->getQuery('expired_type') == 'health_card_exp_date') {
                    // array_push($conditions, array(['Dependents.health_card_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                    $full_trans_record_data->where(['Dependents.health_card_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                }
            } else {
                if ($this->request->getQuery('expired_type') == 'passport_expired') {
                    // array_push($conditions, array(['Dependents.passport_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Dependents.passport_exp_date < CURDATE()']);
                } else if ($this->request->getQuery('expired_type') == 'visa_expired') {
                    // array_push($conditions, array(['Dependents.visa_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Dependents.visa_exp_date < CURDATE()']);
                } else if ($this->request->getQuery('expired_type') == 'emirates_id_expired') {
                    // array_push($conditions, array(['Dependents.emiratesID_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Dependents.emiratesID_exp_date < CURDATE()']);
                } else if ($this->request->getQuery('expired_type') == 'health_card_exp_date') {
                    // array_push($conditions, array(['Dependents.health_card_exp_date < CURDATE()']));
                    $full_trans_record_data->where(['Dependents.health_card_exp_date < CURDATE()']);
                }
            }
        }

        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            $full_trans_record_data
                ->contain(
                    [
                        // 'Employees.Companies' => array('conditions' => array('Employees.company_id =' => $_GET['company_id'])),
                        'Employees' => function(Query $query) {
                            return $query->where(['company_id' =>  $_GET['company_id']]);
                        },
                        'Employees.Companies'
                    ]
                );
        } else {
            $full_trans_record_data
            //->select(['Employees.id','Employees.name','Employees.ps_number','Employees.email'])
            ->contain(['Employees.Companies']);
        }

        $dropDownTable = TableRegistry::get('DropdownValues');
        $relations = $dropDownTable->find('list', ['keyField' => 'keyID', 'valueField' => 'value'])->where(['name' => 'relation'])
        ->toArray();
        $this->set('relations', $relations);

        header("Content-Type: application/xls");
        header("Content-Disposition:attachment;filename=dependents.xls");
        //$full_trans_records = $this->paginate($full_trans_record_data);
        $this->set('full_trans_records', $full_trans_record_data->order(['Dependents.id' => 'DESC']));
    }

    public function transaction()
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],
            'contain' => ['Companies'],

        ];

        $followTable = tableRegistry::get('CompanyTransactions');

        $conditions = [];
        if ($this->request->is('ajax')) {
            if (isset($_GET['for_whom']) && !empty($_GET['for_whom'])) {
                array_push($conditions, array(['CompanyTransactions.for_whom' => $_GET['for_whom']]));
            }

            if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
                array_push($conditions, array(['CompanyTransactions.company_id' => $_GET['company_id']]));
            }

            if (isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])) {
                array_push($conditions, array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
            }

            if (isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])) {
                array_push($conditions, array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
            }

            if (isset($_GET['starting_date']) && !empty($_GET['starting_date'])) {
                array_push($conditions, array(['CompanyTransactions.starting_date >' => $_GET['starting_date']]));
            }

            if (isset($_GET['completion_date']) && !empty($_GET['completion_date'])) {
                array_push($conditions, array(['CompanyTransactions.completion_date <' => $_GET['completion_date']]));
            }

            if ($this->request->getQuery('email_or_name')) {
                $searchQuery = $this->request->getQuery('email_or_name');
                array_push($conditions, ['OR' => [['CompanyTransactions.email LIKE' => '%' . trim($searchQuery) . '%'], ['CompanyTransactions.name LIKE' => '%' . trim($searchQuery) . '%']]]);
            }

        }

        $follows = $followTable->find('all')->where($conditions);
        $follow = $this->paginate($follows);

        $companyTable = tableRegistry::get('Companies');
        $transactionTypesTable = tableRegistry::get('TransactionTypes');
        $transactionsTable = tableRegistry::get('Transactions');

        $companies = $companyTable->find('list');
        $transactions_type_ids = $transactionTypesTable->find('list');
        $transactions = $transactionsTable->find('list');

        $this->set('follow', $follow);
        $this->set('companies', $companies);
        $this->set('transactions', $transactions);
        $this->set('transactions_type_ids', $transactions_type_ids);

    }

    public function send_recieve()
    {
        $this->paginate = [
            'limit' => 20,
        ];

        $conditions = [];

        $searchQuery = isset($_GET['email_or_name']) ? $_GET['email_or_name'] : null;
        $documentsTable = tableRegistry::get('ClientsDocuments');
        $documents = $documentsTable->find('all')
            ->enableAutoFields(true);

        if (isset($_GET['start_date_ex_type']) && !empty($_GET['start_date_ex_type'])) {
            $start_date_ex_type = explode('/', $_GET['start_date_ex_type']);
            $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            // array_push($conditions, array(
            //     'OR' => array('ClientsDocuments.passport_send_admin >' => $start_date_ex_type
            //         , 'ClientsDocuments.passport_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.passport_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.bc_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.bc_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.mc_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.mc_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.eid_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.dc_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.dc_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.medical_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.medical_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.other_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.other_send_admin_date >' => $start_date_ex_type,
            //     )));

            $documents->where(
                function (QueryExpression $expression, Query $query) use ($start_date_ex_type) {
                    return $this->sendReceiveReportQueryFilters($query, ">", $start_date_ex_type);
                }
            );
            // $documents->where(
            //     function ($query) use($operator, $date) {
            //         $query
            //             ->where(['ClientsDocuments.passport_send_admin '.$operator => $date])
            //             ->orWhere(['ClientsDocuments.passport_send_admin_date '.$operator => $date])
            //             ->orWhere(['ClientsDocuments.bc_receive_admin_date '.$operator => $date])
            //             ->orWhere(['ClientsDocuments.bc_send_admin_date '.$operator => $date])

            //             ->orWhere(['ClientsDocuments.mc_receive_admin_date '.$operator => $date])

            //             ->orWhere(['ClientsDocuments.eid_receive_admin_date '.$operator => $date])
            //             ->orWhere(['ClientsDocuments.dc_receive_admin_date '.$operator => $date])
            //             ->orWhere(['ClientsDocuments.medical_receive_admin_date '.$operator => $date])
            //             ->orWhere(['ClientsDocuments.medical_send_admin_date '.$operator => $date])
            //             ->orWhere(['ClientsDocuments.other_receive_admin_date '.$operator => $date])
            //             ->orWhere(['ClientsDocuments.other_send_admin_date '.$operator => $date]);
            //     }
            // );
            // $documents = $this->sendReceiveReportQueryFilters($documents, '>', $start_date_ex_type);
        }

        if (isset($_GET['end_date_ex_type']) && !empty($_GET['end_date_ex_type'])) {
            $end_date_ex_type = explode('/', $_GET['start_date_ex_type']);
            $end_date_ex_type = $end_date_ex_type[2] . '-' . $end_date_ex_type[1] . '-' . $end_date_ex_type[0];
            $documents->where(
                function (QueryExpression $expression, Query $query) use ($end_date_ex_type) {
                    return $this->sendReceiveReportQueryFilters($query, '<', $end_date_ex_type);
                }
            );
        }
        //array_push($conditions,array('OR' =>array(['SendAlert.created <' => $start_date_ex_type])));
        /*if($_GET['email_or_name'])){
        $searchQuery = $this->request->query('email_or_name');

        array_push($conditions,['OR' =>[['Employees.email LIKE' =>'%'.trim($searchQuery).'%'] , ['Employees.name LIKE' =>'%'.trim($searchQuery).'%']]]);
        }*/

        /*->contain(['Employees.Companies' /*=> function ($q) use($searchQuery) {
        if($searchQuery){
        return $q
        ->select(['name'])
        ->where(['OR' =>array('OR' =>[['Employees.email LIKE' =>'%'.trim($searchQuery).'%'] , ['Employees.name LIKE' =>'%'.trim($searchQuery).'%']])]);
        }else{
        return $q
        ->select(['name']);
        }
        }
        , 'Dependents.Employees.Companies']);*/
        $documents->contain(['Employees' => function ($q) use ($searchQuery) {
            if ($searchQuery != '') {
                return $q
                    ->where(
                        [
                            'OR' => [
                                ['Employees.email LIKE' => '%' . trim($searchQuery) . '%'],
                                ['Employees.name LIKE' => '%' . trim($searchQuery) . '%']
                            ]
                        ]
                    )
                    ->contain('Companies');
            } else {
                return $q
                    ->contain('Companies');
                //->select(['name']);
            }
        }
            , 'Dependents' => function ($q) use ($searchQuery) {
                if ($searchQuery != '') {
                    return $q
                        ->where(['OR' => [['Dependents.name LIKE' => '%' . trim($searchQuery) . '%']]])
                        ->contain('Employees.Companies');
                } else {
                    return $q
                        ->contain('Employees.Companies');
                    //->select(['name']);
                }
            }]);

        //echo '<pre>'; print_r($documents->toArray()); exit;

        // $this->set('SendAlert_data', $SendAlert_data);

        //$AlertTypesTable     = tableRegistry::get('AlertTypes');
        //$AlertTypesTable = $AlertTypesTable->find('list');
        $this->set('documents', $this->paginate($documents));

        //$full_trans_records         = $this->paginate($full_trans_record_data);
        //echo '<pre>'; print_r($SendAlert_data->toArray()); exit;
    }

    /**
     * sendReceiveReportQueryFilters function
     *
     * @param Query $query
     * @param string $operator
     * @param string $date
     * @return QueryExpression
     */
    private function sendReceiveReportQueryFilters(Query $query, string $operator, string $date): QueryExpression
    {
        return $query->newExpr()
            ->or(['ClientsDocuments.passport_send_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.bc_receive_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.bc_send_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.mc_receive_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.eid_receive_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.dc_receive_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.medical_receive_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.medical_receive_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.medical_send_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.other_receive_admin_date ' . $operator => $date])
            ->add(['ClientsDocuments.other_send_admin_date ' . $operator => $date]);
    }

    public function send_recieve_report()
    {
        $this->viewBuilder()->setLayout('ajax');

        $this->paginate = [
            'limit' => 500,
        ];

        $documentsTable = tableRegistry::get('ClientsDocuments');

        $documents = $documentsTable->find('all')
            ->enableAutoFields(true);

        $SendAlert = tableRegistry::get('SendAlert');
        $conditions = [];
        $searchQuery = isset($_GET['email_or_name']) ? $_GET['email_or_name'] : null;

        if (isset($_GET['start_date_ex_type']) && !empty($_GET['start_date_ex_type'])) {
            $start_date_ex_type = explode('/', $_GET['start_date_ex_type']);
            $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            // array_push($conditions, array(
            //     'OR' => array('ClientsDocuments.passport_send_admin >' => $start_date_ex_type
            //         , 'ClientsDocuments.passport_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.passport_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.bc_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.bc_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.mc_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.mc_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.eid_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.dc_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.dc_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.medical_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.medical_send_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.other_receive_admin_date >' => $start_date_ex_type
            //         , 'ClientsDocuments.other_send_admin_date >' => $start_date_ex_type,
            //     )));
            $documents->where(
                function (QueryExpression $expression, Query $query) use ($start_date_ex_type) {
                    return $this->sendReceiveReportQueryFilters($query, ">", $start_date_ex_type);
                }
            );
        }

        if (isset($_GET['end_date_ex_type']) && !empty($_GET['end_date_ex_type'])) {
            $end_date_ex_type = explode('/', $_GET['start_date_ex_type']);
            $end_date_ex_type = $end_date_ex_type[2] . '-' . $end_date_ex_type[1] . '-' . $end_date_ex_type[0];
            // array_push($conditions, array(
            //     'OR' => array('ClientsDocuments.passport_send_admin <' => $end_date_ex_type
            //         , 'ClientsDocuments.passport_receive_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.passport_send_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.bc_receive_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.bc_send_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.mc_receive_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.mc_send_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.eid_receive_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.dc_receive_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.dc_send_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.medical_receive_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.medical_send_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.other_receive_admin_date <' => $end_date_ex_type
            //         , 'ClientsDocuments.other_send_admin_date <' => $end_date_ex_type,
            //     )));
            $documents->where(
                function (QueryExpression $expression, Query $query) use ($end_date_ex_type) {
                    return $this->sendReceiveReportQueryFilters($query, '<', $end_date_ex_type);
                }
            );
        }

        //echo '<pre>'; print_r($conditions); exit;

        $documents->contain(['Employees' => function ($q) use ($searchQuery) {
            if ($searchQuery != '') {
                return $q
                    ->where(['OR' => [['Employees.email LIKE' => '%' . trim($searchQuery) . '%'], ['Employees.name LIKE' => '%' . trim($searchQuery) . '%']]])
                    ->contain('Companies');
            } else {
                return $q
                    ->contain('Companies');
                //->select(['name']);
            }
        }
            , 'Dependents' => function ($q) use ($searchQuery) {
                if ($searchQuery != '') {
                    return $q
                        ->where(['OR' => [['Dependents.name LIKE' => '%' . trim($searchQuery) . '%']]])
                        ->contain('Employees.Companies');
                } else {
                    return $q
                        ->contain('Employees.Companies');
                    //->select(['name']);
                }
            }]);
        //echo '<pre>'; print_r($documents); exit;
        // $this->set('SendAlert_data', $SendAlert_data);
        $AlertTypesTable = tableRegistry::get('AlertTypes');
        $AlertTypesTable = $AlertTypesTable->find('list');

        header("Content-Type: application/xls");
        header("Content-Disposition:attachment;filename=send_recieve.xls");
        $this->set('documents', $this->paginate($documents));

        //$AlertTypesTable     = tableRegistry::get('AlertTypes');
        //$AlertTypesTable = $AlertTypesTable->find('list');
        //$this->set('AlertTypesTable',$AlertTypesTable);
        //echo '<pre>'; print_r($SendAlert_data->toArray()); exit;
    }

    public function reminders()
    {
        $SendAlert = tableRegistry::get('SendAlert');

        $SendAlert_data = $SendAlert->find('all')
            ->enableAutoFields(true);

        if (isset($_GET['expired_type']) && !empty($_GET['expired_type'])) {
            // array_push($conditions, array(['SendAlert.alert_types_id' => $_GET['expired_type']]));
            $SendAlert_data->where(['SendAlert.alert_types_id' => $_GET['expired_type']]);
        }

        if (isset($_GET['start_date_ex_type']) && !empty($_GET['start_date_ex_type'])) {
            $start_date_ex_type = explode('/', $_GET['start_date_ex_type']);
            $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            // array_push($conditions, array(['SendAlert.created >' => $start_date_ex_type]));
            // $SendAlert_data->where(['SendAlert.created > '.$start_date_ex_type]);

            $SendAlert_data->where(function ($exp, $query) use ($start_date_ex_type) {
                return $exp->gt('SendAlert.created', $start_date_ex_type);
            });

        }

        if (
            isset($_GET['end_date_ex_type'])
            && !empty($_GET['end_date_ex_type'])
        ) {
            $end_date_ex_type = explode('/', $_GET['end_date_ex_type']);
            $end_date_ex_type = $end_date_ex_type[2] . '-' . $end_date_ex_type[1] . '-' . $end_date_ex_type[0];
            // array_push($conditions, array(['SendAlert.created <' => $start_date_ex_type]));
            // $SendAlert_data->where(['SendAlert.created < '.$end_date_ex_type]);
            $SendAlert_data->where(function ($exp, $query) use ($end_date_ex_type) {
                return $exp->lt('SendAlert.created', $end_date_ex_type);
            });

        }
        //echo '<pre>'; print_r($conditions); exit;
        $SendAlert_data->contain(['Employees.Companies', 'Dependents.Employees.Companies', 'AlertTypes']);
        $SendAlert_data = $this->paginate($SendAlert_data);

        $this->set('SendAlert_data', $SendAlert_data);

        $AlertTypesTable = tableRegistry::get('AlertTypes');
        $AlertTypesTable = $AlertTypesTable->find('list');
        $this->set('AlertTypesTable', $AlertTypesTable);
        //echo '<pre>'; print_r($SendAlert_data->toArray()); exit;
    }

    public function reminders_report()
    {
        $this->viewBuilder()->setLayout('ajax');
        $SendAlert = tableRegistry::get('SendAlert');

        $conditions = [];

        $SendAlert_data = $SendAlert->find('all')
            ->enableAutoFields(true);

        if (isset($_GET['expired_type']) && !empty($_GET['expired_type'])) {
            // array_push($conditions, array(['SendAlert.alert_types_id' => $_GET['expired_type']]));
            $SendAlert_data->where(['SendAlert.alert_types_id' => $_GET['expired_type']]);
        }

        if (isset($_GET['start_date_ex_type']) && !empty($_GET['start_date_ex_type'])) {
            $start_date_ex_type = explode('/', $_GET['start_date_ex_type']);
            $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            // array_push($conditions, array(['SendAlert.created >' => $start_date_ex_type]));
            $SendAlert_data->where(function ($exp, $query) use ($start_date_ex_type) {
                return $exp->gt('SendAlert.created', $start_date_ex_type);
            });
        }

        if (isset($_GET['end_date_ex_type']) && !empty($_GET['end_date_ex_type'])) {
            // $start_date_ex_type = explode('/', $_GET['end_date_ex_type']);
            // $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            // array_push($conditions, array(['SendAlert.created <' => $start_date_ex_type]));
            $end_date_ex_type = explode('/', $_GET['end_date_ex_type']);
            $end_date_ex_type = $end_date_ex_type[2] . '-' . $end_date_ex_type[1] . '-' . $end_date_ex_type[0];

            $SendAlert_data->where(function ($exp, $query) use ($end_date_ex_type) {
                return $exp->lt('SendAlert.created', $end_date_ex_type);
            });
        }

        //echo '<pre>'; print_r($conditions); exit;
        $SendAlert_data->contain(['Employees.Companies', 'Dependents.Employees.Companies', 'AlertTypes']);
        $SendAlert_data = $this->paginate($SendAlert_data);

        $this->set('SendAlert_data', $SendAlert_data);

        header("Content-Type: application/xls");
        header("Content-Disposition:attachment;filename=Reminders.xls");

        $AlertTypesTable = tableRegistry::get('AlertTypes');
        $AlertTypesTable = $AlertTypesTable->find('list');
        $this->set('AlertTypesTable', $AlertTypesTable);
        //echo '<pre>'; print_r($SendAlert_data->toArray()); exit;
    }
}
