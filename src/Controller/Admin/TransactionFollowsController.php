<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event; 
use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

/**
 * TransactionFollows Controller
 *
 * @property \App\Model\Table\CentersTable $Centers
 */
class TransactionFollowsController extends AppController
{
	
	 public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
		
    }

	public function beforeFilter(Event $event){
		$this->viewBuilder()->layout('admin');
		parent::beforeFilter($event);
		
    }

    public function index()
    {
       
    }
	
	 /*
	 * Function name 	: Manage 
	 * Description 		: View All Data for tranaction follow
	 * Author 			: Wepro 
	 * Created by 		: Wepro 29-Dec-2016
	 */
	
	public function manage(){
		
		$this->paginate = [
            'limit' => 2,
			'order'=>['name'=>'ASC'],
			'contain' => ['Companies','transactions','transactiontypes']						
        ];	

		$followTable = tableRegistry::get('Transactionfollows');
        $follow = $this->paginate($followTable); 
        //pr($follow); die;
		$this->set('follow',$follow);		
		
		/*$followTable = tableRegistry::get('Transactionfollows');
			
		$follow = $followTable->find('all',['fields'=>['Transactionfollows.id','Transactionfollows.name','companies.name','transactions.name','transactiontypes.transaction_name']])
        ->join([
            'companies' => [
                'table' =>'companies',
				'alias'=>'companies',
                'type' => 'INNER',
                'conditions' => 'companies.id = Transactionfollows.company_id'
            ],
			'transactions' => [
                'table' =>'transactions',
				'alias'=>'transactions',
                'type' => 'INNER',
                'conditions' => 'transactions.id = Transactionfollows.transaction_id'
            ],
			'transactiontypes' => [
                'table' =>'transactiontypes',
				'alias'=>'transactiontypes',
                'type' => 'INNER',
                'conditions' => 'transactiontypes.id = Transactionfollows.transaction_type'
            ],
				
        ]);*/	
		//pr($follow); die;
        $this->set(compact('follow',$follow));
		
		
	}
	
	/*
	 * Function name 	: Add Record 
	 * Description 		: Add All Data for tranactiont follow table
	 * Author 			: Wepro 
	 * Created by 		: Wepro 30-Dec-2016
	 */

	public function add(){
		
		// Find Companies Data used from Companies Table for Drop down values	
			
		$companyData 	= tableRegistry::get('Companies');			
		$company 		= $companyData->find('list',['fields'=>['id','name']])->toArray();	
		$this->set('company',$company);	
		
		
		// Find transaction Data used from Transaction Table for Drop down values
	 
		$tranactionTable 	= tableRegistry::get('Transactions');
		$transData 			= $tranactionTable->find('list',['fields'=>['id','name']])->toArray();
		$this->set('transData',$transData);	
		
		// Find transaction Types Data used from Transactiontypes Table for Drop down values
		
		$transTypes  	= tableRegistry::get('Transactiontypes');		 	
		$typesData 		= $transTypes->find('list',['fields'=>['id','transaction_name']])->toArray(); 	
		$this->set('typesData',$typesData);
		
		
		// Find transaction Status Data used from Transaction status Table for Drop down values
		
		$trans_Status  	= tableRegistry::get('StatusTransactions');		 	
		$statusData 	= $trans_Status->find('list',['fields'=>['id','status']])->toArray(); 			
		$this->set('statusData',$statusData);
		
		if(!empty($this->request->data)){
			
			// Save transaction follow Data into Follow Transaction Table
			
			$followTable 				= tableRegistry::get('Transactionfollows');			
			$follow 					= $followTable->newEntity();
			$follow->company_id			= $this->request->data['company_id'];
			$follow->transaction_id		= $this->request->data['transaction_id'];
			$follow->transaction_type 	= $this->request->data['transaction_type'];		
			$follow->for_whom			= $this->request->data['for_whom'];
			$follow->name				= $this->request->data['name'];		
			$follow->starting_date		= $this->request->data['starting_date'];
			$follow->status 			= $this->request->data['status'];	
			$follow->note				= $this->request->data['note'];	
			$follow->trans_finish		= $this->request->data['trans_finish'];		
			$follow->completion_date	= $this->request->data['completion_date'];
			
			if($followTable->save($follow)){				
				$this->Flash->success(__('Company Information  added successfully'));
				return $this->redirect(['action' => 'manage']);
			}
			
		}			
	}
	
	/*
	 * Function name 	: Edit Record 
	 * Description 		: Edit All Data for tranactiont follow table
	 * Author 			: Wepro 
	 * Created by 		: Wepro 30-Dec-2016
	 */

	public function edit($id=null){	


		// Find Companies Data used from Companies Table for Drop down values	
		
		$companyData 	= tableRegistry::get('Companies');			
		$company 		= $companyData->find('list',['fields'=>['id','name']])->toArray();	
		$this->set('company',$company);	
		
		
		// Find transaction Data used from Transaction Table for Drop down values
	 
		$tranactionTable 	= tableRegistry::get('Transactions');
		$transData 			= $tranactionTable->find('list',['fields'=>['id','name']])->toArray();
		$this->set('transData',$transData);	
		
		// Find transaction Types Data used from Transactiontypes Table for Drop down values
		
		$transTypes  	= tableRegistry::get('Transactiontypes');		 	
		$typesData 		= $transTypes->find('list',['fields'=>['id','transaction_name']])->toArray(); 	
		$this->set('typesData',$typesData);
		
		
		// Find transaction Status Data used from Transaction status Table for Drop down values
		
		$trans_Status  	= tableRegistry::get('StatusTransactions');		 	
		$statusData 	= $trans_Status->find('list',['fields'=>['id','status']])->toArray(); 			
		$this->set('statusData',$statusData);
		
		// Find Data on the Basis of Id 
		
		$id = base64_decode($id);
		$transFollow = tableRegistry::get('Transactionfollows');
		$followData  =  $transFollow->get($id);
		$this->set('followData',$followData);
		
		if(!empty($this->request->data)){
			$transFollow = tableRegistry::get('Transactionfollows');
			$transFollow->patchEntity($followData, $this->request->data);				
			if ($transFollow->save($followData)){
				$this->Flash->success(__('The Company data has been saved.'));
				return $this->redirect(['action' => 'manage']);
			}			
		}
		
		
	}
	
	/*
	 * Function name 	: Delete
	 * Description 		: Delete functionality for Transactionsfollows
	 * Author 			: Wepro 
	 * Created by 		: Wepro 28-Dec-2016
	 */
	 public function delete($id = null)
    {
	    $id = base64_decode($id);        
		$transactionTable = TableRegistry::get('Transactionfollows');
		$transData = $transactionTable->find('all')->where(['Transactionfollows.id'=>$id])->first();	
		//pr($transData); die;	
		if(!empty($transData)){
			if ($transactionTable->delete($transData)) {
				$this->Flash->success(__('The transaction has been deleted.'));
				return $this->redirect(['action' => 'manage']);
			} else {
				$this->Flash->error(__('The course could not be deleted. Please, try again.'));
			}
			
		} 
		return $this->redirect($this->referer());
    }
	
		
		
}