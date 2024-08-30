<?php

namespace App\Controller\Client;

use App\Controller\AppController;
use Cake\Database\Query;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
/**
 * ReportsController class
 */
class ReportsController extends AppController
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
     * @param EventInterface $event
     * @return void
     */
	public function beforeFilter(EventInterface $event): void
    {
		$this->viewBuilder()->setLayout('client');
		parent::beforeFilter($event);

    }

    public function index()
    {

    }


	public function employee()
    {
		$this->paginate = [
            'limit' => 20,
			'order'=>['id'=>'DESC'],

        ];
		$conditions = [];
		$Em_conditions = [];
        $employees = tableRegistry::get('Employees');
        $full_trans_record_data = $employees->find('all')
            ->select(['Employees.id', 'Employees.name', 'Employees.ps_number', 'Employees.email'])
            ->enableAutoFields(true)
            ->contain(['Companies'])
            ->where(['Employees.company_id' => $this->Auth->user('company_id')]);

		//echo '<pre>'; print_r($_GET);
		// array_push($conditions,array(['Employees.company_id' => $this->Auth->user('company_id')]));

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
                    $start_date_ex_type = explode('/', $this->request->getQuery('end_date_ex_type'));
                    // $this->request->getQuery['end_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                    $end_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
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
		$companyTable 	= tableRegistry::get('Companies');
		$transactionTypesTable 	= tableRegistry::get('TransactionTypes');
		$transactionsTable 	= tableRegistry::get('Transactions');
		$companies = $companyTable->find('list');
		$transactions_type_ids = $transactionTypesTable->find('list');
		$transactions = $transactionsTable->find('list');
		$full_trans_records 		= $this->paginate($full_trans_record_data);


		$this->set('full_trans_records',$full_trans_records);
		$this->set('companies',$companies);
		$this->set('transactions',$transactions);
		$this->set('transactions_type_ids',$transactions_type_ids);

	}
	public function employee_excel_report()
    {
		$this->viewBuilder()->setLayout('ajax');

		$this->paginate = [
            'limit' => 500,
			'order'=>['id'=>'DESC'],

        ];

        $conditions = [];

        $employees = tableRegistry::get('Employees');

        $full_trans_record_data = $employees ->find('all')
            ->where(['Employees.company_id' => $this->Auth->user('company_id')])
            //->select(['Employees.id','Employees.name','Employees.ps_number','Employees.email'])
            ->enableAutoFields(true)
            ->contain(['Companies']);

        // array_push($conditions,array(['Employees.company_id' => $this->Auth->user('company_id')]));

        if(isset($_GET['employee_id']) && !empty($_GET['employee_id'])){
            // array_push($conditions,array(['Employees.id' => $_GET['employee_id']]));
            $full_trans_record_data->where(['Employees.id' => $_GET['employee_id']]);
        }

        if($this->request->getQuery('status') != ''){
            // array_push($conditions,array(['Employees.status' => $this->request->query('status')]));
            $full_trans_record_data->where(['Employees.status' => $this->request->getQuery('status')]);
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

        if($this->request->getQuery('expired_type')){
            // $start_date_ex_type = explode('/',$this->request->query['start_date_ex_type']);
            // $this->request->query['start_date_ex_type'] = $start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
            // $start_date_ex_type = explode('/',$this->request->query['end_date_ex_type']);
            // $this->request->query['end_date_ex_type'] = $start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];

            // if($this->request->query('expired_type') == 'passport_expired'){
            //     array_push($conditions,array(['Employees.passport_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type').'"' ]));
            // }else if($this->request->query('expired_type') == 'visa_expired'){
            //     array_push($conditions,array(['Employees.visa_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type') .'"' ]));
            // }else if($this->request->query('expired_type') == 'emirates_id_expired'){
            //     array_push($conditions,array(['Employees.emiratesID_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type') .'"' ]));
            // }else if($this->request->query('expired_type') == 'labor_card_expired'){
            //     array_push($conditions,array(['Employees.labor_card_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type').'"' ]));
            // }
            if (!empty($this->request->getQuery('start_date_ex_type'))) {
                $start_date_ex_type = explode('/', $this->request->getQuery('start_date_ex_type'));
                // $this->request->getQuery['start_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                $start_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            }
            if (!empty($this->request->getQuery('end_date_ex_type'))) {
                $start_date_ex_type = explode('/', $this->request->getQuery('end_date_ex_type'));
                // $this->request->getQuery['end_date_ex_type'] = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
                $end_date_ex_type = $start_date_ex_type[2] . '-' . $start_date_ex_type[1] . '-' . $start_date_ex_type[0];
            }

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
        }


		//echo '<pre>'; print_r($full_trans_record_data->toArray()); exit;

		header("Content-Type: application/xls");
		header("Content-Disposition:attachment;filename=employee.xls");
		$full_trans_records 		= $this->paginate($full_trans_record_data);
		$this->set('full_trans_records',$full_trans_records);
	}

	public function dependents()
    {
		$this->paginate = [
            'limit' => 20,
			'order'=>['id'=>'DESC'],

        ];
		$conditions = [];

        $dependent = tableRegistry::get('Dependents');
        $full_trans_record_data = $dependent->find('all')
            ->where($conditions)
            ->enableAutoFields(true)
            ->contain(
                [
                    'Employees.Companies' => array(
                        'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
                    )
                ]
            );

		if($this->request->is('ajax')) {
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

            if($this->request->getQuery('expired_type')){
					// $start_date_ex_type = explode('/',$this->request->query['start_date_ex_type']);
					// $this->request->query['start_date_ex_type'] = $start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
					// $start_date_ex_type = explode('/',$this->request->query['end_date_ex_type']);
					// $this->request->query['end_date_ex_type'] = $start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];

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

					// if($this->request->query('expired_type') == 'passport_expired'){
					// 	array_push($conditions,array(['Dependents.passport_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type').'"' ]));
					// }else
					// if($this->request->query('expired_type') == 'visa_expired'){
					// 	array_push($conditions,array(['Dependents.visa_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type').'"']));
					// }else
					// if($this->request->query('expired_type') == 'emirates_id_expired'){
					// 	array_push($conditions,array(['Dependents.emiratesID_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type').'"']));
					// }else
					// if($this->request->query('expired_type') == 'labor_card_expired'){
					// 	array_push($conditions,array(['Dependents.labor_card_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type').'"']));
					// }else
					// if($this->request->query('expired_type') == 'entry_permit_exp_date'){
					// 	array_push($conditions,array(['Dependents.entry_permit_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type').'"']));
					// }else
					// if($this->request->query('expired_type') == 'health_card_exp_date'){
					// 	array_push($conditions,array(['Dependents.health_card_exp_date BETWEEN "'.$this->request->query('start_date_ex_type').'" AND "'.$this->request->query('end_date_ex_type').'"']));
					// }

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
                    } elseif ($this->request->getQuery('expired_type') == 'labor_card_expired') {
                        // array_push($conditions, array(['Dependents.emiratesID_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                        $full_trans_record_data->where(['Dependents.labor_card_expired BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    } elseif ($this->request->getQuery('expired_type') == 'entry_permit_exp_date') {
                        // array_push($conditions, array(['Dependents.health_card_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                        $full_trans_record_data->where(['Dependents.entry_permit_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
                    }

				}

				//echo '<pre>';print_r($full_trans_record_data); exit;

		}
		//echo '<pre>'; print_r($full_trans_record_data); exit;

		//'Employees.name = CompanyTransactions.name',
		//echo '<pre>'; print_r($full_trans_record_data); exit;
		$companyTable 	= tableRegistry::get('Companies');
		$transactionTypesTable 	= tableRegistry::get('TransactionTypes');
		$transactionsTable 	= tableRegistry::get('Transactions');

		$companies = $companyTable->find('list');
		$transactions_type_ids = $transactionTypesTable->find('list');
		$transactions = $transactionsTable->find('list');

		$full_trans_records 		= $this->paginate($full_trans_record_data);

		$dropDownTable = TableRegistry::get('DropdownValues');
		$relations = $dropDownTable->find('list',['keyField' => 'keyID','valueField' => 'value'])->where(['name' =>'relation'])->toArray();
		$this->set('relations',$relations);

		$this->set('full_trans_records',$full_trans_records);
		$this->set('companies',$companies);
		$this->set('transactions',$transactions);
		$this->set('transactions_type_ids',$transactions_type_ids);
	}
	public function dependents_excel_report()
    {
		$this->viewBuilder()->setlayout('ajax');
		$this->paginate = [
            'limit' => 500,
			'order'=>['id'=>'DESC'],

        ];

        $dependent = tableRegistry::get('Dependents');
        $full_trans_record_data = $dependent->find('all')
        ->enableAutoFields(true)
        ->contain(
            [
                'Employees.Companies' => array(
                    'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
                )
            ]
        );

		$conditions = [];

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

		if($this->request->query('expired_type')){
			if($this->request->query('expired_type') == 'passport_expired'){
			}else
			if($this->request->query('expired_type') == 'passport_expired'){
			}
		}

        if($this->request->getQuery('expired_type')) {

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
            } elseif ($this->request->getQuery('expired_type') == 'labor_card_expired') {
                // array_push($conditions, array(['Dependents.emiratesID_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                $full_trans_record_data->where(['Dependents.labor_card_expired BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
            } elseif ($this->request->getQuery('expired_type') == 'entry_permit_exp_date') {
                // array_push($conditions, array(['Dependents.health_card_exp_date BETWEEN "' . $this->request->query('start_date_ex_type') . '" AND "' . $this->request->query('end_date_ex_type') . '"']));
                $full_trans_record_data->where(['Dependents.entry_permit_exp_date BETWEEN "' . $start_date_ex_type . '" AND "' . $end_date_ex_type . '"']);
            }

        }

		$dropDownTable = TableRegistry::get('DropdownValues');
		$relations = $dropDownTable->find('list',['keyField' => 'keyID','valueField' => 'value'])->where(['name' =>'relation'])->toArray();
		$this->set('relations',$relations);

		header("Content-Type: application/xls");
		header("Content-Disposition:attachment;filename=dependents.xls");
		$full_trans_records 		= $this->paginate($full_trans_record_data);
		$this->set('full_trans_records',$full_trans_records);
	}

	public function transaction(){
		$this->paginate = [
            'limit' => 20,
			'order'=>['name'=>'ASC'],
			'contain' => ['Companies']

        ];

		$followTable 	= tableRegistry::get('CompanyTransactions');

		$conditions = [];
		array_push($conditions,array(['CompanyTransactions.company_id' => $this->Auth->user('company_id')]));

		//'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'));

		if($this->request->params['isAjax']){
			if(isset($_GET['for_whom']) && !empty($_GET['for_whom'])){
				array_push($conditions,array(['CompanyTransactions.for_whom' => $_GET['for_whom']]));
			}

			if(isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])){
				array_push($conditions,array(['CompanyTransactions.transaction_id' => $_GET['transaction_id']]));
			}

			if(isset($_GET['transaction_type_id']) && !empty($_GET['transaction_type_id'])){
				array_push($conditions,array(['CompanyTransactions.transaction_type_id' => $_GET['transaction_type_id']]));
			}

			if(isset($_GET['starting_date']) && !empty($_GET['starting_date'])){
				array_push($conditions,array(['CompanyTransactions.starting_date >' => $_GET['starting_date']]));
			}

			if(isset($_GET['completion_date']) && !empty($_GET['completion_date'])){
				array_push($conditions,array(['CompanyTransactions.completion_date <' => $_GET['completion_date']]));
			}

			if($this->request->query('email_or_name')){
				$searchQuery = $this->request->query('email_or_name');
				array_push($conditions,['OR' =>[['CompanyTransactions.email LIKE' =>'%'.trim($searchQuery).'%'] , ['CompanyTransactions.name LIKE' =>'%'.trim($searchQuery).'%']]]);
			}

		}

		$follows = $followTable->find('all')->where($conditions);
		$follow 		= $this->paginate($follows);

		//$companyTable 	= tableRegistry::get('Companies');
		$transactionTypesTable 	= tableRegistry::get('TransactionTypes');
		$transactionsTable 	= tableRegistry::get('Transactions');

		$companies = $companyTable->find('list');
		$transactions_type_ids = $transactionTypesTable->find('list');
		$transactions = $transactionsTable->find('list');

		$this->set('follow',$follow);
		$this->set('transactions',$transactions);
		$this->set('transactions_type_ids',$transactions_type_ids);

	}

	public function send_recieve(){

		$this->paginate = [
            'limit' => 20,
		];
		$documents 		= tableRegistry::get('ClientsDocuments');
		$conditions = [];

		if(isset($_GET['expired_type']) && !empty($_GET['expired_type'])){
			array_push($conditions,array(['SendAlert.alert_types_id' => $_GET['expired_type']]));
		}

		if(isset($_GET['start_date_ex_type']) && !empty($_GET['start_date_ex_type'])){
			$start_date_ex_type = explode('/',$_GET['start_date_ex_type']);
			$start_date_ex_type =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
			array_push($conditions,array(['SendAlert.created >' => $start_date_ex_type]));
		}

		if(isset($_GET['end_date_ex_type']) && !empty($_GET['end_date_ex_type'])){
			$start_date_ex_type = explode('/',$_GET['end_date_ex_type']);
			$start_date_ex_type =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
			array_push($conditions,array(['SendAlert.created <' => $start_date_ex_type]));
		}
		//array_push($conditions,array('OR' =>array(['SendAlert.created <' => $start_date_ex_type])));

		$Employees  	= $documents->find('all')
		//->where($conditions)
		->autoFields(true)
		->contain(array('Employees.Companies' => array(
						'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
		)));

		$Dependents  	= $documents->find('all')
		//->where($conditions)
		->autoFields(true)
		->contain(array('Dependents.Employees.Companies' => array(
							'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
				)
			)
		);

		$documents = array_merge($Employees->toArray(),$Dependents->toArray());
		asort($documents);
		//echo '<pre>'; print_r($documents); exit;
		$this->set('SendAlert_data',$SendAlert_data);
		//$AlertTypesTable 	= tableRegistry::get('AlertTypes');
		//$AlertTypesTable = $AlertTypesTable->find('list');
		$this->set('documents',$documents);

		//$full_trans_records 		= $this->paginate($full_trans_record_data);
		//echo '<pre>'; print_r($SendAlert_data->toArray()); exit;
	}

	public function send_recieve_report(){
		$this->viewBuilder()->layout('ajax');
		$documents 		= tableRegistry::get('ClientsDocuments');
		$this->paginate = [
            'limit' => 500,
		];

		$SendAlert 		= tableRegistry::get('SendAlert');
		$conditions = [];

		if(isset($_GET['expired_type']) && !empty($_GET['expired_type'])){
			array_push($conditions,array(['SendAlert.alert_types_id' => $_GET['expired_type']]));
		}

		if(isset($_GET['start_date_ex_type']) && !empty($_GET['start_date_ex_type'])){
			$start_date_ex_type = explode('/',$_GET['start_date_ex_type']);
			$start_date_ex_type =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
			array_push($conditions,array(['SendAlert.created >' => $start_date_ex_type]));
		}

		if(isset($_GET['end_date_ex_type']) && !empty($_GET['end_date_ex_type'])){
			$start_date_ex_type = explode('/',$_GET['end_date_ex_type']);
			$start_date_ex_type =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
			array_push($conditions,array(['SendAlert.created <' => $start_date_ex_type]));
		}

		$Employees  	= $documents->find('all')
		//->where($conditions)
		->autoFields(true)
		->contain(array('Employees.Companies' => array(
						'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
		)));

		$Dependents  	= $documents->find('all')
		//->where($conditions)
		->autoFields(true)
		->contain(array('Dependents.Employees.Companies' => array(
							'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
				)
			)
		);

		$documents = array_merge($Employees->toArray(),$Dependents->toArray());
		asort($documents);
		//echo '<pre>'; print_r($documents); exit;
		$this->set('SendAlert_data',$documents);
		$AlertTypesTable 	= tableRegistry::get('AlertTypes');
		$AlertTypesTable = $AlertTypesTable->find('list');
		$this->set('documents',$documents);


		header("Content-Type: application/xls");
		header("Content-Disposition:attachment;filename=sendRecieve.xls");

		//$AlertTypesTable 	= tableRegistry::get('AlertTypes');
		//$AlertTypesTable = $AlertTypesTable->find('list');
		//$this->set('AlertTypesTable',$AlertTypesTable);
		//echo '<pre>'; print_r($SendAlert_data->toArray()); exit;
	}

	public function reminders(){
		$SendAlert 		= tableRegistry::get('SendAlert');


		$conditions = [];

		if(isset($_GET['expired_type']) && !empty($_GET['expired_type'])){
			array_push($conditions,array(['SendAlert.alert_types_id' => $_GET['expired_type']]));
		}

		if(isset($_GET['start_date_ex_type']) && !empty($_GET['start_date_ex_type'])){
			$start_date_ex_type = explode('/',$_GET['start_date_ex_type']);
			$start_date_ex_type =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
			array_push($conditions,array(['SendAlert.created >' => $start_date_ex_type]));
		}

		if(isset($_GET['end_date_ex_type']) && !empty($_GET['end_date_ex_type'])){
			$start_date_ex_type = explode('/',$_GET['end_date_ex_type']);
			$start_date_ex_type =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
			array_push($conditions,array(['SendAlert.created <' => $start_date_ex_type]));
		}

		/*$SendAlert_data  	= $SendAlert ->find('all')
		->where($conditions)
		->autoFields(true)
		->contain(['Employees.Companies' , 'Dependents.Employees.Companies' => array(
							'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
				) , 'AlertTypes']);
		$this->set('SendAlert_data',$SendAlert_data);*/


		$Employees  	= $SendAlert->find('all')
		->where($conditions)
		->autoFields(true)
		->contain(array('Employees.Companies' => array(
						'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
		)));

		$Dependents  	= $SendAlert->find('all')
		->where($conditions)
		->autoFields(true)
		->contain(array('Dependents.Employees.Companies' => array(
							'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
				)
			)
		);

		$SendAlert_data = array_merge($Employees->toArray(),$Dependents->toArray());
		asort($SendAlert_data);
		$this->set('SendAlert_data',$SendAlert_data);

		$AlertTypesTable 	= tableRegistry::get('AlertTypes');
		$AlertTypesTable = $AlertTypesTable->find('list');
		$this->set('AlertTypesTable',$AlertTypesTable);
		//echo '<pre>'; print_r($SendAlert_data->toArray()); exit;
	}

	public function reminders_report(){
		$this->viewBuilder()->layout('ajax');
		$SendAlert 		= tableRegistry::get('SendAlert');


		$conditions = [];

		if(isset($_GET['expired_type']) && !empty($_GET['expired_type'])){
			array_push($conditions,array(['SendAlert.alert_types_id' => $_GET['expired_type']]));
		}

		if(isset($_GET['start_date_ex_type']) && !empty($_GET['start_date_ex_type'])){
			$start_date_ex_type = explode('/',$_GET['start_date_ex_type']);
			$start_date_ex_type =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
			array_push($conditions,array(['SendAlert.created >' => $start_date_ex_type]));
		}

		if(isset($_GET['end_date_ex_type']) && !empty($_GET['end_date_ex_type'])){
			$start_date_ex_type = explode('/',$_GET['end_date_ex_type']);
			$start_date_ex_type =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
			array_push($conditions,array(['SendAlert.created <' => $start_date_ex_type]));
		}



		$Employees  	= $SendAlert->find('all')
		->where($conditions)
		->autoFields(true)
		->contain(array('Employees.Companies' => array(
						'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
		)));

		$Dependents  	= $SendAlert->find('all')
		->where($conditions)
		->autoFields(true)
		->contain(array('Dependents.Employees.Companies' => array(
							'conditions' => array('Employees.company_id =' => $this->Auth->user('company_id'))
				)
			)
		);

		$SendAlert_data = array_merge($Employees->toArray(),$Dependents->toArray());
		asort($SendAlert_data);
		$this->set('SendAlert_data',$SendAlert_data);

		header("Content-Type: application/xls");
		header("Content-Disposition:attachment;filename=Reminders.xls");

		//$AlertTypesTable 	= tableRegistry::get('AlertTypes');
		//$AlertTypesTable = $AlertTypesTable->find('list');
		//$this->set('AlertTypesTable',$AlertTypesTable);
		//echo '<pre>'; print_r($SendAlert_data->toArray()); exit;
	}

	public function trasection_report(){
		$this->paginate = [
            'limit' => 20,
			'order'=>['id'=>'DESC'],

        ];
		$conditions = [];
		$Em_conditions = [];
		if($this->request->params['isAjax']){
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

			if(isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])){
				array_push($conditions,array(['TrasectionsRelation.transaction_id' => $_GET['transaction_id']]));
			}


			if(isset($_GET['starting_date']) && !empty($_GET['starting_date'])){

				$start_date_ex_type = explode('/',$_GET['starting_date']);
				$_GET['starting_date'] =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];

				array_push($conditions,array(['TrasectionsRelation.starting_date >' => $_GET['starting_date']]));
			}

			if(isset($_GET['completion_date']) && !empty($_GET['completion_date'])){
				$start_date_ex_type = explode('/',$_GET['completion_date']);
				$_GET['completion_date'] =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
				array_push($conditions,array(['TrasectionsRelation.completion_date <' => $_GET['completion_date']]));
			}
		}
		//array_push($conditions,array(['TrasectionsRelation.status !=' => '1']));
		//echo '<pre>'; print_r($conditions); exit;
		/*$compnyTransTbale 			= tableRegistry::get('CompanyTransactions');
		$full_trans_record_data 	= $compnyTransTbale->find('all')
									->autoFields(true)
									->where($conditions)
									->contain(['Employees','Dependents','Companies','TrasectionsRelation']);*/
		//array_push($conditions , array('NOT' => array('TrasectionsRelation.note' => null)));
		// ,  array('not' => array('TrasectionsRelation.starting_date' => NULL))
		$data = $_GET;
		//echo '<pre>'; print_r($data); exit;
		$compnyTransTbale 			= tableRegistry::get('TrasectionsRelation');
		//echo '<pre>'; print_r($conditions); exit;
		$full_trans_record_data 	= $compnyTransTbale->find('all')
									->autoFields(true)
									->where($conditions)
									->contain('Users' , 'Dependents.Employees.Companies')
									//->where('TrasectionsRelation.starting_date !=' => null)
									->matching('CompanyTransactions.Companies' , function ($q) use ($data) {
        								$conditionsInner = array();
										array_push($conditionsInner,array(['CompanyTransactions.company_id' => $this->Auth->user('company_id')]));
										if($this->request->params['isAjax']){

										if(isset($data['for_whom']) && !empty($data['for_whom'])){
											array_push($conditionsInner,array(['CompanyTransactions.for_whom' => $data['for_whom']]));
										}

										if(isset($data['company_id']) && !empty($data['company_id'])){
											array_push($conditionsInner,array(['CompanyTransactions.company_id' => $data['company_id']]));
										}


										if(isset($data['employee_id']) && !empty($data['employee_id'])){
											array_push($conditionsInner,array(['CompanyTransactions.employee_id' => $data['employee_id']]));
										}

										if(isset($data['for_whom']) && $data['for_whom'] == 2){
											if(isset($data['dependet_id']) && !empty($data['dependet_id'])){
												array_push($conditionsInner,array(['CompanyTransactions.dependet_id' => $data['dependet_id']]));
											}
										}

										if(isset($data['transaction_type_id']) && !empty($data['transaction_type_id'])){
											array_push($conditionsInner,array(['CompanyTransactions.transaction_type_id' => $data['transaction_type_id']]));
										}
							//echo '<pre>'; print_r($conditionsInner); exit;
										 //return $q->where($conditions);
										}
										return $q->where($conditionsInner);
										 //return $q->where(['username' => $username]);

										}
									);

		//'Employees.name = CompanyTransactions.name',
		//echo '<pre>'; print_r($full_trans_record_data); exit;
		$companyTable 	= tableRegistry::get('Companies');
		$transactionTypesTable 	= tableRegistry::get('TransactionTypes');

		$transactionsTable 	= tableRegistry::get('Transactions');

		$companies = $companyTable->find('list');
		$transactions_type_ids = $transactionTypesTable->find('list', [
			'keyField' => 'id',
			'valueField' => 'transaction_name'
		]);
		$transactions = $transactionsTable->find('list');
//echo '<pre>';print_r($transactions_type_ids->toArray()); exit;
		$full_trans_records 		= $this->paginate($full_trans_record_data);

		$transStatusTable = tableRegistry::get('StatusTransactions');
		$transaction_status	    = $transStatusTable->find('list');
		$this->set('full_trans_records',$full_trans_records);
		$this->set('companies',$companies);
		$this->set('transactions',$transactions);
		$this->set('transaction_status',$transaction_status->toArray());
		$this->set('transactions_type_ids',$transactions_type_ids->toArray());

	}

	public function excel_full(){
		$this->viewBuilder()->layout('ajax');
		$this->paginate = [
            'limit' => 500,
			'order'=>['id'=>'DESC'],

        ];

		$conditions = [];

		if(isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])){
				array_push($conditions,array(['TrasectionsRelation.transaction_id' => $_GET['transaction_id']]));
			}


			if(isset($_GET['starting_date']) && !empty($_GET['starting_date'])){

				$start_date_ex_type = explode('/',$_GET['starting_date']);
				$_GET['starting_date'] =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];

				array_push($conditions,array(['TrasectionsRelation.starting_date >' => $_GET['starting_date']]));
			}

			if(isset($_GET['completion_date']) && !empty($_GET['completion_date'])){
				$start_date_ex_type = explode('/',$_GET['completion_date']);
				$_GET['completion_date'] =$start_date_ex_type[2].'-'.$start_date_ex_type[1].'-'.$start_date_ex_type[0];
				array_push($conditions,array(['TrasectionsRelation.completion_date <' => $_GET['completion_date']]));
			}
			//array_push($conditions,array(['TrasectionsRelation.status !=' => '1']));

		$compnyTransTbale 			= tableRegistry::get('CompanyTransactions');
		$Transactions 				= tableRegistry::get('Transactions');

		$compnyTransTbale 			= tableRegistry::get('TrasectionsRelation');
		$full_trans_record_data 	= $compnyTransTbale->find('all')
									->autoFields(true)
									->where($conditions)
									->contain('Users')
									//->where('TrasectionsRelation.starting_date !=' => null)
									->matching('CompanyTransactions.Companies' , function ($q) use ($data) {
        								$conditionsInner = array();
										array_push($conditionsInner,array(['CompanyTransactions.company_id' => $this->Auth->user('company_id')]));
										if($this->request->params['isAjax']){
										if(isset($data['for_whom']) && !empty($data['for_whom'])){
											array_push($conditionsInner,array(['CompanyTransactions.for_whom' => $data['for_whom']]));
										}

										if(isset($data['company_id']) && !empty($data['company_id'])){
											array_push($conditionsInner,array(['CompanyTransactions.company_id' => $data['company_id']]));
										}


										if(isset($data['employee_id']) && !empty($data['employee_id'])){
											array_push($conditionsInner,array(['CompanyTransactions.employee_id' => $data['employee_id']]));
										}

										if(isset($data['for_whom']) && $data['for_whom'] == 2){
											if(isset($data['dependet_id']) && !empty($data['dependet_id'])){
												array_push($conditionsInner,array(['CompanyTransactions.dependet_id' => $data['dependet_id']]));
											}
										}

										if(isset($data['transaction_type_id']) && !empty($data['transaction_type_id'])){
											array_push($conditionsInner,array(['CompanyTransactions.transaction_type_id' => $data['transaction_type_id']]));
										}
							//echo '<pre>'; print_r($conditionsInner); exit;
										 //return $q->where($conditions);
										}
										return $q->where([$conditionsInner]);
										 //return $q->where(['username' => $username]);
										});
		//echo 'dd'; exit;
		header("Content-Type: application/xls");
		header("Content-Disposition:attachment;filename=Transaction.xls");
		$full_trans_records 		= $this->paginate($full_trans_record_data);
		$transactionTypesTable 		= tableRegistry::get('TransactionTypes');
		$transactions_type_ids 		= $transactionTypesTable->find('list', [
			'keyField' => 'id',
			'valueField' => 'transaction_name'
		]);
		$transStatusTable = tableRegistry::get('StatusTransactions');
		$transaction_status	    = $transStatusTable->find('list');
		$this->set('transaction_status',$transaction_status->toArray());
		$this->set('transactions_type_ids',$transactions_type_ids->toArray());
		$this->set('full_trans_records',$full_trans_records);

	}

}
