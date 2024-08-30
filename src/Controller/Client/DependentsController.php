<?php
namespace App\Controller\Client;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Collection\Collection;
use Cake\Mailer\Email;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\Mailer\Mailer;

class DependentsController extends AppController
{
	public $paginate = [
		'limit' => 10,
		'order' => [
			'Dependents.id' => 'DESC'
		]
	];

	public function initialize(): void
	{
		parent::initialize();
	}

	public function beforeFilter(\Cake\Event\EventInterface $event): void
	{
		parent::beforeFilter($event);
		$this->viewBuilder()->setLayout('client');
    }
	
	/**
	 * Function name 	: index 
	 * Description 		: list Dependents 
	 * Author 			: Wepro 
	 * Created by 		: Wepro 18-May-2017
	 */

	public function index($id = null){
		$this->paginate = [
            'limit' => 10,
			'order'=>['id'=>'DESC'],
			'contain' => ['Employees' , 'ClientsDocuments' , 'Documents']				
        ];
	
		$conditions = [];
		$employeeTable 	= tableRegistry::get('Employees');
		$employees = $employeeTable->find('all')
			->select(['ids'=>'Employees.id'])
			->disableHydration()
			->join([
					'Clients'=>[
						'table'=>'clients',
						'aliase'=>'Clients',
						'conditions'=>['Employees.company_id = Clients.company_id', 'Clients.id' => $this->Auth->user('id')]
					]
				]);
		
		$collection = new Collection($employees);
		$employees_ids = $collection->extract('ids');
		$ids = $employees_ids->toArray();

		if(empty($ids)){
			$this->Flash->error(__('There is no dependent. Please add atleast one employee and his/her dependent'));
			return $this->redirect(['controller'=>'employees', 'action'=> 'index']);
		}

		$query = $this->Dependents->find('all');

		// array_push($conditions,['Dependents.employee_id IN' => $ids]);
		$query->where(['Dependents.employee_id IN' => $ids]);
		
		if($this->request->is('ajax')){

			if(isset($_GET['employee_id']) && !empty($_GET['employee_id'])){
				// array_push($conditions,array(['Dependents.employee_id' => $_GET['employee_id']]));
                $query->where(['Dependents.employee_id' => $_GET['employee_id']]);

			}

			if($this->request->getQuery('email_or_name')){
				$searchQuery = $this->request->getQuery('email_or_name');
				// array_push($conditions,array(['Dependents.name LIKE' =>'%'.trim($searchQuery).'%']));

				$query->where(
					['Dependents.name LIKE' =>'%'.trim($searchQuery).'%']
                );
			}
		}
	
		$dependents = $this->paginate($query);
	
		$employeeTable 	= tableRegistry::get('Employees');
		$employees = $employeeTable->find('list')->where(['Employees.id IN' => $ids ]);
		$this->set('dependents',$dependents);
		$this->set('employees',$employees);

	}
	
	/**
	 * Function name 	: add 
	 * Description 		: Add Dependents related Information
	 * Author 			: Wepro 
	 * Created by 		: Wepro 18-May-2017
	 */

	public function add($emp_id = null ,$refere = null){exit;}
	
	/**
	 * Function name 	: edit 
	 * Description 		: edit Dependents related Information
	 * Author 			: Wepro 
	 * Created by 		: Wepro 18-May-2017
	 */
	public function edit($id = null)
    {
		$id = base64_decode($id);
		$dependent 		= $this->Dependents->get($id,['contain' => ['Documents' , 'ClientsDocuments']]);
		/*if(empty($dependent->clients_document)){
			$this->Dependents->clients_document->save(array('person_id' => $id , 'section_name' => ));		
		}*/
		$employeeTable 	= tableRegistry::get('Employees');
		$employees_collect = $employeeTable->find('all')
            ->select(['ids'=>'Employees.id'])
            ->enableHydration(false)
            ->join([
                    'Clients'=>[
                        'table'=>'clients',
                        'aliase'=>'Clients',
                        'conditions'=>['Employees.company_id = Clients.company_id', 'Clients.id' => $this->Auth->user('id')]
                    ]
                ]);
										
		$collection = new Collection($employees_collect);
		$employees_ids = $collection->extract('ids');
		$ids = $employees_ids->toArray();

		if (!empty($this->request->getData())) {
			if(!in_array($dependent->employee_id,$ids)){
				$this->Flash->error(__('You are not authorized'));
				return $this->redirect(['action' => 'edit',base64_encode($id)]);
			}
			
			//echo '<pre>'; print_r($this->request->data['clients_document']); exit;
			$oldValues = $dependent->clients_document;
			$oldValues = json_decode(json_encode($oldValues), true);
			
			$changed_receive = array();
			$changed_send = array();
            $clientDocumentRequestPayload = $this->request->getData('clients_document');

			foreach ($clientDocumentRequestPayload as $key =>$value) {
				if ($oldValues[$key] != $value && (strpos($key, 'date') == false) && (strpos($key, 'value') == false) && ($value != 0) ){
					if(strpos($key, 'receive') !== false ){
						$changed_receive[$key] = $value;
					}
					if(strpos($key, 'send') !== false ){
						$changed_send[$key] = $value;
					}
				}
			}
			//echo '<pre>'; print_r($dependent->employee_id); exit;
			$clientDocumentRequestPayload['section_name'] = 'dependent';
			
            $this->Dependents->patchEntity($dependent, $this->request->getData());

			if($this->Dependents->save($dependent)){
				$employeeTable = TableRegistry::get('Employees');
				$companyTable 	= tableRegistry::get('Companies');
				$employeeS = $employeeTable->find('all')->where(['Employees.id'=>$dependent->employee_id])->first();
				$compnay   = $companyTable->find('all')->where(['id'=>$employeeS['company_id']])->first();
				$settingTable 	= tableRegistry::get('Settings');			
				$Row = $settingTable->find('all'); 
				foreach($Row as $key => $value){	
						$CCemails	= explode(",",$value['cc_emails']);
				}
				$CCemails = array_filter(array_merge($CCemails, explode(",",$compnay['cc_emails'])));
				$employeeS->email = $employeeS->email != ''  ? $employeeS->email : $CCemails[0];
				/*print_r($changed_receive);
				echo 'ss';
				print_r($changed_send); exit;*/
			//echo '<pre>';	print_r($dependent); exit;
                $email = new Mailer();

				if(!empty($changed_receive)){
					$changed_receive['name'] = $dependent['name'];
					//$changed_receive['name'] = $this->request->data['name'];
                    if (isset($clientDocumentRequestPayload['other_receive_value'])) {
                        $changed_receive['other_receive_value'] = $clientDocumentRequestPayload['other_receive_value'];
                    }

                    ($emailDocConfirmDpd = (clone $email))
                        ->setSubject("Delivery note of " . $changed_receive['name'])
                        ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                        ->setTo($employeeS->email)
                        ->setEmailFormat('html')
                        ->setViewVars(array('information' => $changed_receive, 'employeeS' => $employeeS))
                        ->viewBuilder()
                        ->setTemplate('documentsConfirmationReceiveDependentClient');

                    $emailDocConfirmDpd->send();

					// $email = new Email('default');
					// $email->from(['portal@enjazsys.com' => 'Daman portal'])
					// 	->to($employeeS->email) //$employeeS->email
					// 	->template('documentsConfirmationReceiveDependentClient')
					// 	->emailFormat('html')
					// 	->subject("Delivery note of ".$employeeS->name)
					// 	->viewVars(array('information' => $changed_receive, 'employeeS' => $employeeS ))
					// 	->send();
						//echo 'heree'; exit;

                    ($emailDocConfirmDpd2 = (clone $email))
                        ->setSubject("Delivery note of " . $employeeS->name)
                        ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                        ->setTo($CCemails)
                        ->setEmailFormat('html')
                        ->setViewVars(array('information' => $changed_receive, 'employeeS' => $employeeS))
                        ->viewBuilder()
                        ->setTemplate('documentsConfirmationReceiveDependentClientDaman');

                    $emailDocConfirmDpd2->send();

					// $email->from(['portal@enjazsys.com' => 'Daman portal'])
					// 	->to($CCemails) //$employeeS->email
					// 	->template('documentsConfirmationReceiveDependentClientDaman')
					// 	->emailFormat('html')
					// 	->subject("Delivery note of ".$employeeS->name)
					// 	->viewVars(array('information' => $changed_receive, 'employeeS' => $employeeS ))
					// 	->send();	
				}

				if(!empty($changed_send)){ 
					$changed_send['name'] = $dependent['name'];
                    if (isset($clientDocumentRequestPayload['other_send_value'])) {
                        $changed_send['other_send_value'] = $clientDocumentRequestPayload['other_send_value'];
                    }
					
					// $email = new Email('default');
					// $email->from(['portal@enjazsys.com' => 'Daman portal'])
					// 	->to($employeeS->email) //$employeeS->email
					// 	->template('documentsConfirmationSendDependentClient')
					// 	->emailFormat('html')
					// 	->subject("Delivery note of ".$changed_send['name'])
					// 	->viewVars(array('information' => $changed_send, 'employeeS' => $employeeS ))
					// 	->send();
						
                    ($emailDocConfirmDpd3 = (clone $email))
                        ->setSubject("Delivery note of " . $changed_send['name'])
                        ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                        ->setTo($employeeS->email)
                        ->setEmailFormat('html')
                        ->setViewVars(array('information' => $changed_send, 'employeeS' => $employeeS))
                        ->viewBuilder()
                        ->setTemplate('documentsConfirmationSendDependentClient');

                    $emailDocConfirmDpd3->send();

					// $email->from(['portal@enjazsys.com' => 'Daman portal'])
					// 	->to($CCemails) //$employeeS->email
					// 	->template('documentsConfirmationSendDependentClientDaman')
					// 	->emailFormat('html')
					// 	->subject("Delivery note of ".$changed_send['name'])
					// 	->viewVars(array('information' => $changed_send, 'employeeS' => $employeeS ))
					// 	->send();	


                    ($emailDocConfirmDpd4 = (clone $email))
                        ->setSubject("Delivery note of " . $changed_send['name'])
                        ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                        ->setTo($CCemails)
                        ->setEmailFormat('html')
                        ->setViewVars(array('information' => $changed_send, 'employeeS' => $employeeS))
                        ->viewBuilder()
                        ->setTemplate('documentsConfirmationSendDependentClientDaman');

                    $emailDocConfirmDpd4->send();
				}

				$this->Flash->success(__('Dependent has been saved'));
				return $this->redirect(['action' => 'index']);
			}

			$this->Flash->error(__('Dependent could not be save'));
			return $this->redirect(['action' => 'index']);
		}

		
		$employees = $this->Dependents->Employees->find('list')->where(['Employees.id IN' => $ids]);

		$dropDownTable = TableRegistry::get('DropdownValues');

		$relations = $dropDownTable->find(
            'list',
            [
                'keyField' => 'keyID',
                'valueField' => 'value'
            ]
        )
        ->where(['name' =>'relation'])
        ->toArray();
	
		$this->set('relations',$relations);
		$this->set('employees',$employees);
		$this->set('dependent',$dependent);
		$this->set('controller', $this->request->params['controller']);
    }


	/**
	 * Function name 	: Delete
	 * Description 		: Delete functionality for Dependent 
	 * Author 			: Wepro 
	 * Created by 		: Wepro 18-May-2017
	 */

	 public function delete($id = null){exit;}


		/**
	 * Function name 	: Delete dependent documents
	 * Description 		: Delete functionality for dependent  documents
	 * Author 			: Wepro 
	 * Created by 		: Wepro 14-Apr-2017
	 */

	 public function deleteDependentDocument($id = null){exit;}

	 /**
	 * Function name 	: save dependents attachment title
	 * Description 		: save dependents attachment title
	 * Author 			: Wepro 
	 * Created by 		: Wepro 5-May-2017
	 */

	public function save_title(){exit;}

	/**
	 * Function name 	: upload_attachment
	 * Description 		: upload_attachment is used for upload file from "Manage Dependent" file
	 * Author 			: Wepro 
	 * Created by 		: Wepro 8-May-2017
	 */

	public function upload_attachment($deptId = NULL){exit;}

	public function DownloadDependentDocument($id = null){ 
		$id = base64_decode($id);        
		$documentTable = TableRegistry::get('Documents');
		$document = $documentTable->find('all')->where(['Documents.id'=>$id , 'Documents.sectionName' => 'dependent'])->first();
		
		
		$dependent 		= $this->Dependents->get($document->related_id);
		
		$employeeTable 	= tableRegistry::get('Employees');			
		$employee 		= $employeeTable->get($dependent->employee_id);
		
		//echo '<pre>'; print_r($employee->company_id);  echo $this->Auth->user('company_id'); exit;
		if($employee->company_id == $this->Auth->user('company_id')){
			if(!empty($document)){
				$path = WWW_ROOT.'documents/dependent/'.$document->file;
				
				header("Content-Description: File Transfer"); 
				header("Content-Type: application/octet-stream"); 
				header("Content-Disposition: attachment; filename=" . basename($path)); 
				readfile ($path);
				exit();
			}
		} 
		return $this->redirect($this->referer());
	 }

	public function xls() {
		exit;
		$output_type = 'D'; 
		$file = 'dependents.xlsx';
		$conditions = [];
		
		$employeeTable 	= tableRegistry::get('Employees');
		$employees = $employeeTable->find('all')
									->select(['ids'=>'Employees.id'])
			                        ->hydrate(false)
									->join([
											'Clients'=>[
												'table'=>'clients',
												'aliase'=>'Clients',
												'conditions'=>['Employees.company_id = Clients.company_id', 'Clients.id' => $this->Auth->user('id')]
											]
										]);

		$collection = new Collection($employees);
		$employees_ids = $collection->extract('ids');
		$ids = $employees_ids->toArray();

		array_push($conditions,['Dependents.employee_id IN' => $ids]);
		
		if(isset($_GET['employee_id']) && !empty($_GET['employee_id'])){
				array_push($conditions,array(['Dependents.employee_id' => $_GET['employee_id']]));
			}

			if($this->request->query('email_or_name')){
				$searchQuery = $this->request->query('email_or_name');
				array_push($conditions,array(['Dependents.name LIKE' =>'%'.trim($searchQuery).'%']));
			}

		$dependents = $this->Dependents->find('all')->where($conditions)->contain('Employees');
		
		$this->set(compact('dependents', 'output_type', 'file'));
		$this->viewBuilder()->layout('xls/default');
		$this->viewBuilder()->template('xls/spreadsheet_dependents');
		$this->RequestHandler->respondAs('xlsx');
		$this->render();
	}
	public function files($link){
		$this->layout = false;
		$documentTable = TableRegistry::get('Documents');
		$documents = $documentTable->get(base64_decode($link) , [
				'contain' => ['Dependents.Employees']
			]); //;
	
	if($documents['dependent']['employee']['company_id'] == $this->Auth->user('company_id') ){
		$URL = BASE_URL."/documents/dependent/".$documents['file'];
		$ch = curl_init($URL);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		if($this->_mime_content_type($documents['file']) == 'image/jpeg' || $this->_mime_content_type($documents['file']) == 'image/png'){
			$output = curl_exec($ch);
			curl_close($ch);
			$this->set('type', $this->_mime_content_type($documents['file']));
			$this->set('file','data: '.$this->_mime_content_type($documents['file']).';base64,'.base64_encode($output));
		
		}else{
			header('Content-type: '.$this->_mime_content_type($documents['file']));
			$output = curl_exec($ch);
			curl_close($ch);
			echo $output; exit;		
			}
		}else{
				echo "<center style='margin-top:30px;'><h3>you don't have permission to access this file</h3></center>";
				exit;
		}
	}
	
	public function _mime_content_type($filename) {

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

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
	public function re_set(){
		$id   = base64_decode($this->request->getData('type_id'));
		$type = $this->request->getData('data_type');        
		$ClientsDocuments_table = TableRegistry::get('ClientsDocuments');
		$ClientsDocuments = $ClientsDocuments_table->find('all')->where(['ClientsDocuments.id'=>$id])->first();	
		
		//print_r($ClientsDocuments); exit;
		
		$request[$type.'_receive_admin'] = 0;
		$request[$type.'_send_admin'] = 0;
		$request[$type.'_receive_admin_date'] = NULL;
		$request[$type.'_send_admin_date'] = NULL;
		$request[$type.'_receive_client'] = 0;
		$request[$type.'_send_client'] = 0;
		$request[$type.'_receive_client_date'] = NULL;
		$request[$type.'_send_client_date'] = NULL;
		
		//echo json_encode(array('status' => true)); exit;
		
		if($type == 'other'){
			$request[$type.'_receive_value'] = '';
			$request[$type.'_send_value'] = '';
		}
		
		$ClientsDocuments_table->patchEntity($ClientsDocuments, $request);
		
		if($ClientsDocuments_table->save($ClientsDocuments)){
			echo json_encode(array('status' => true));
		}else{
			echo json_encode(array('status' => false));
		}
		exit;	
	}
}

