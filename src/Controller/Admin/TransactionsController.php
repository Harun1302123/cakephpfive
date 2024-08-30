<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Centers Controller
 *
 * @property \App\Model\Table\CentersTable $Centers
 */
class TransactionsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
    }

    public function beforeFilter(\CAKE\Event\EventInterface $event)
    {
        $this->viewBuilder()->setLayout('admin');
        parent::beforeFilter($event);
    }

    /**
     * Function name     : index
     * Description         : list transactions
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 10,
            'order' => ['id' => 'DESC'],
        ];

        $transactions = $this->paginate($this->Transactions);
        $this->set('transactions', $transactions);
    }

    /*
     * Function name     : Add
     * Description         : Add functionality for Transactions
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function add()
    {
        $transaction = $this->Transactions->newEntity();
        if ($this->request->is('post')) {
            $this->Transactions->patchEntity($transaction, $this->request->data);
            $transaction->created = date('Y-m-d h:i:s');
            $transaction->user_id = $this->Auth->user('id');
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('Transactions added successfully'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Transactions could not be save'));
            return $this->redirect(['action' => 'add']);
        }

        $this->set('transaction', 'transaction');
    }

    /*
     * Function name     : Edit
     * Description         : Edit functionality for Transactions
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function edit($id = null)
    {
        $id = base64_decode($id);
        $transaction = $this->Transactions->get($id);

        if ($this->request->is(['post', 'put'])) {
            $this->Transactions->patchEntity($transaction, $this->request->data);
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('Transactions added successfully'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Transactions could not be save'));
            return $this->redirect(['action' => 'add']);
        }

        $this->set('transaction', $transaction);

    }

    /*
     * Function name     : Delete
     * Description         : Delete functionality for Transactions
     * Author             : Wepro
     * Created by         : Wepro 28-Dec-2016
     */
    public function delete($id = null)
    {
        $id = base64_decode($id);
        $transactionTable = TableRegistry::get('Transactions');
        $transData = $transactionTable->find('all')->where(['Transactions.id' => $id])->first();
        if (!empty($transData)) {
            if ($this->Transactions->delete($transData)) {
                $this->Flash->success(__('The transaction has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
            }

        }
        return $this->redirect($this->referer());
    }
}
