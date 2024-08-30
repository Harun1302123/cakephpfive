<?php
namespace App\Controller\Client;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;

class EmployeesController extends AppController
{
    public $paginate = [
        'limit' => 10,
        'order' => [
            'Employees.id' => 'DESC',
        ],
    ];

    public function initialize(): void
    {
        parent::initialize();

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('client');
    }

    /**
     * Function name     : index
     * Description         : list Employees
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function index($id = null)
    {
        $this->paginate = [
            'limit' => 10,
            'order' => ['id' => 'DESC'],
            'contain' => ['Companies', 'ClientsDocuments', 'Documents'],
        ];

        $employeeTable = tableRegistry::get('Employees');
        $query = $employeeTable
            ->find('all')
            ->enableAutoFields(true);

        $conditions = [];
        // array_push($conditions,['Employees.company_id' => $this->Auth->user('company_id')]);
        $query->where(['Employees.company_id' => $this->Auth->user('company_id')]);

        if ($this->request->is('ajax')) {

            if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
                // array_push($conditions,array(['Employees.company_id' => $_GET['company_id']]));
                $query->where(['Employees.company_id' => $_GET['company_id']]);

            }

            if ($this->request->getQuery('email_or_name')) {
                $searchQuery = $this->request->getQuery('email_or_name');
                // array_push($conditions,['OR' =>[['Employees.email LIKE' =>'%'.ltrim($searchQuery).'%'] , ['Employees.name LIKE' =>'%'.trim($searchQuery).'%']]]);
                $query->where(
                    function (QueryExpression $expression, Query $query) use ($searchQuery): QueryExpression {
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
        $companies = $companyTable->find('list')->where(['Companies.id' => $this->Auth->user('company_id')]);
        $this->set('companies', $companies);
        $this->set('employees', $employees);

    }

    /**
     * Function name     : add
     * Description         : Add Employees related Information
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function add($referer = null)
    {exit;}

    /**
     * Function name     : edit
     * Description         : edit Employees related Information
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */
    public function edit($id = null)
    {
        if (empty($id)) {
            return $this->redirect(['action' => 'index']);
        }

        $id = base64_decode($id);
        $companyTable = tableRegistry::get('Companies');
        $employeeTable = tableRegistry::get('Employees');
        $employee = $employeeTable->get($id, ['contain' => ['Documents', 'ClientsDocuments']]);

        if ($employee['company_id'] != $this->request->getSession()->read('Auth.User.company_id')) {
            $this->Flash->error(__('You are not authorized.'));
            return $this->redirect('/client/employees/');
        }
        if (!empty($this->request->getData())) {
            $oldValues = $employee->clients_document;
            $oldValues = json_decode(json_encode($oldValues), true);

            $changed_receive = array();
            $changed_send = array();
            //echo '<pre>';print_r($this->request->data['clients_document']); exit;
            foreach ($this->request->getData('clients_document') as $key => $value) {
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
            //echo '<pre>'; print_r($this->request->data()); exit;
            $requestPayload['clients_document']['section_name'] = 'employee';

            $employeeTable->patchEntity($employee, $requestPayload);
            if ($employeeTable->save($employee)) {

                $compnay = $companyTable->find('all')
                    ->where(['id' => $employee['company_id']])
                    ->first();
                //print_r($changed_fields); exit;
                if (!empty($changed_receive)) {
                    $settingTable = tableRegistry::get('Settings');
                    $Row = $settingTable->find('all');
                    foreach ($Row as $key => $value) {
                        $CCemails = explode(",", $value['cc_emails']);
                    }
                    $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));
                    $employee['email'] = $employee['email'] != '' ? $employee['email'] : $CCemails[0];
                    //echo $employee['email']; exit;
                    $changed_receive['name'] = $employee['name'];
                    if (isset($this->request->getData('clients_document')['other_receive_value'])) {
                        $changed_receive['other_receive_value'] = $this->request->getData('clients_document')['other_receive_value'];
                    }

                    // $email = new Email('default');
                    //$this->request->data['email']
                    $email = new Mailer();
                    $email
                        ->setSubject("Delivery note of " . $changed_receive['name'])
                        ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                        ->setTo($employee['email'])
                        ->setEmailFormat('html')
                        ->setViewVars(array('information' => $changed_receive))
                        ->viewBuilder()
                        ->setTemplate('documentsConfirmationReceiveEmployeeClient');

                    $email->send();

                    $email2 = new Mailer();
                    $email2
                        ->setSubject("Delivery note of " . $changed_receive['name'])
                        ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                        ->setTo($CCemails)
                        ->setEmailFormat('html')
                        ->setViewVars(array('information' => $changed_receive))
                        ->viewBuilder()
                        ->setTemplate('documentsConfirmationReceiveEmployeeClientDaman');

                    $email2->send(); /**/
                    //echo 'heree'; exit;
                }
                if (!empty($changed_send)) {
                    $settingTable = tableRegistry::get('Settings');
                    $Row = $settingTable->find('all');
                    foreach ($Row as $key => $value) {
                        $CCemails = explode(",", $value['cc_emails']);
                    }
                    $CCemails = array_filter(array_merge($CCemails, explode(",", $compnay['cc_emails'])));
                    $employee['email'] = $employee['email'] != '' ? $employee['email'] : $CCemails[0];
                    //echo $employee['email']; exit;
                    $changed_send['name'] = $employee['name'];

                    if (isset($this->request->getData('clients_document')['other_send_value'])) {
                        $changed_send['other_send_value'] = $this->request->getData('clients_document')['other_send_value'];
                    }
                    // $email = new Email('default');
                    $email3 = new Mailer();
                    //$this->request->data['email']
                    $email3
                        ->setSubject("Delivery note of " . $changed_send['name'])
                        ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                        ->setTo($employee['email'])
                        ->setEmailFormat('html')
                        ->setViewVars(array('information' => $changed_send))
                        ->viewBuilder()
                        ->setTemplate('documentsConfirmationSendEmployeeClient');

                    $email3->send();

                    $email4 = new Mailer();

                    $email4
                        ->setSubject("Delivery note of " . $changed_send['name'])
                        ->setFrom(['portal@enjazsys.com' => 'Daman portal'])
                        ->setTo($CCemails)
                        ->setEmailFormat('html')
                        ->setViewVars(array('information' => $changed_send))
                        ->viewBuilder()
                        ->setTemplate('documentsConfirmationSendEmployeeClientDaman');

                    $email4->send();
                    //echo 'heree'; exit;
                }
                $this->Flash->success(__('Employee has been Updated'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Employee could not be Updated'));
            return $this->redirect(['action' => 'index']);
            //return $this->redirect(['action' => 'edit', base64_encode($id)]);

        }
        /*$companies = $companyTable->find('list')->where(['Companies.id' => $this->Auth->user('company_id')]);
    $countries = TableRegistry::get('Countries')->find('list',['keyField'=>'name','valueField'=>'name']);

    $this->set('countries',$countries);
    $this->set('companies',$companies);
    $this->set('employee',$employee);
    $this->set('controller', $this->request->params['controller']);*/
    }

    /**
     * Function name     : Delete
     * Description         : Delete functionality for employee
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function delete($id = null)
    {exit;}

    /**
     * Function name     : Delete employee documents
     * Description         : Delete functionality for Company  documents
     * Author             : Wepro
     * Created by         : Wepro 18-May-2017
     */

    public function deleteEmployeeDocument($id = null)
    {exit;}

    /**
     * Function name     : save employee attachment title
     * Description         : save employee attachment title
     * Author             : Wepro
     * Created by         : Wepro 5-May-2017
     */

    public function save_title()
    {exit;}

    /**
     * Function name     : upload_attachment
     * Description         : upload_attachment is used for upload file from "Manage Employees" file
     * Author             : Wepro
     * Created by         : Wepro 8-May-2017
     */

    public function upload_attachment($empId = null)
    {exit;}

    /**
     *
     */
    public function DownloadEmployeeDocument($id = null)
    {
        $id = base64_decode($id);
        $documentTable = TableRegistry::get('Documents');
        $document = $documentTable->find('all')->where(['Documents.id' => $id, 'Documents.sectionName' => 'employee'])->first();

        $employeeTable = tableRegistry::get('Employees');
        $employee = $employeeTable->get($document->related_id);

        if ($employee->company_id == $this->Auth->user('company_id')) {
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
    }

    public function xls()
    {
        $output_type = 'D';
        $file = 'employees.xlsx';
        $conditions = [];

        $employeeTable = tableRegistry::get('Employees');
        $query = $employeeTable
            ->find('all')
            ->enableAutoFields(true);

        // array_push($conditions,array(['Employees.company_id' => $this->Auth->user('company_id') ]));

        if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
            // array_push($conditions,array(['Employees.company_id' => $_GET['company_id']]));
            $query->where(['Employees.company_id' => $_GET['company_id']]);
        }

        if ($this->request->getQuery('email_or_name')) {
            $searchQuery = $this->request->getQuery('email_or_name');
            // array_push($conditions,['OR' =>[['Employees.email LIKE' =>'%'.ltrim($searchQuery).'%'] , ['Employees.name LIKE' =>'%'.trim($searchQuery).'%']]]);
            $query->where(
                function (QueryExpression $expression, Query $query) use ($searchQuery): QueryExpression {
                    return $query
                        ->newExpr()
                        ->or(['Employees.email LIKE' => '%' . ltrim($searchQuery) . '%'])
                        ->add(['Employees.name LIKE' => '%' . trim($searchQuery) . '%']);
                }
            );
        }
        //pr($employees->toArray());
        //die('nitin');
        $this->set(compact('employees', 'output_type', 'file'));
        $this->viewBuilder()->setlayout('xls/default');
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
        //    echo '<pre>';print_r($documents['employee']['company_id']); exit;
        if ($documents['employee']['company_id'] == $this->Auth->user('company_id')) {
            // $URL = BASE_URL."/documents/employee/".$documents['file'];

            $file_path = WWW_ROOT . "/documents/employee/" . $documents['file'];

            $response = $this->response
                ->withFile($file_path, array(
                    '‘download’' => true,
                    'name' => $documents['file'],
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

        } else {
            echo "<center style='margin-top:30px;'><h3>you don't have permission to access this file</h3></center>";
            exit;
        }
/**/}

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
        //echo json_encode(array('status' => true)); exit;
        $ClientsDocuments_table->patchEntity($ClientsDocuments, $request);

        if ($ClientsDocuments_table->save($ClientsDocuments)) {
            echo json_encode(array('status' => true));
        } else {
            echo json_encode(array('status' => false));
        }
        exit;
    }
}
