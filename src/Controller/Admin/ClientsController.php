<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Centers Controller
 *
 * @property \App\Model\Table\CentersTable $Centers
 */
class ClientsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->viewBuilder()->setLayout('admin');
        parent::beforeFilter($event);
    }

    /**
     * Function name     : index
     * Description         : list Clients
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 2,
            'order' => ['id' => 'DESC'],
            'contain' => ['Companies'],
        ];

        $clients = $this->paginate($this->Clients);
        $this->set('clients', $clients);
    }

    /**
     * Function name     : add
     * Description         : Add Clients related Information
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function add()
    {
        $client = $this->Clients->newEmptyEntity();
        // Add the Client data and Save
        if ($this->request->is('post')) {
            $requestPayload = $this->request->getData();
            $requestPayload['user_role_id'] = 0;
            $this->Clients->patchEntity($client, $requestPayload);
            $client->created = date('Y-m-d h:i:s');
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('Client added successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Client could not be save'));
            return $this->redirect(['action' => 'add']);

        }

        // Find Companies Data used from Companies Table for Drop down values
        $companyTable = tableRegistry::get('Companies');
        $company = $companyTable->find('list', ['fields' => ['id', 'name']])->toArray();

        $this->set('company', $company);
        $this->set('client', $client);
    }

    /**
     * Function name     : edit
     * Description         : edit Clients related Information
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function edit($id = null)
    {
        $id = base64_decode($id);
        $client = $this->Clients->get($id);

        if (!empty($this->request->getData())) {
            $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The Client data has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The Client  could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'edit']);

        }

        $companyTable = tableRegistry::get('Companies');
        $company = $companyTable->find('list', ['fields' => ['id', 'name']])->toArray();

        $this->set('company', $company);
        $this->set('client', $client);
    }

    /*
     * Function name     : Delete
     * Description         : Delete functionality for client
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */
    public function delete($id = null)
    {
        $id = base64_decode($id);
        $clients = $this->Clients->find('all')->where(['Clients.id' => $id])->first();
        if (!empty($clients)) {
            if ($this->Clients->delete($clients)) {
                $this->Flash->success(__('The client has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be deleted. Please, try again.'));
            }

        }
        return $this->redirect($this->referer());
    }
}
