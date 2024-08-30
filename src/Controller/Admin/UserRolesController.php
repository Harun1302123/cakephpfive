<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class UserRolesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        if (!$this->isSupAdmin()) {
            $this->redirect(BASE_URL);
        }
    }

    /**
     * Function name     : index
     * Description         : list Role
     * Author             : Wepro
     * Created by         : Wepro 19-Apr-2017
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->paginate = [
            'limit' => 2,
            'order' => ['id' => 'DESC'],
        ];

        $user_roles = $this->paginate($this->UserRoles);
        $this->set('user_roles', $user_roles);
    }

    /**
     * Function name     : add
     * Description         : Add Roles related Information
     * Author             : Wepro
     * Created by         : Wepro 19-Apr-2017
     */

    public function add()
    {
        $this->viewBuilder()->setLayout('admin');
        $user_role = $this->UserRoles->newEmptyEntity();
        if ($this->request->is('post')) {
            $this->UserRoles->patchEntity($user_role, $this->request->getData());
            $user_role->created = date('Y-m-d h:i:s');
            if ($this->UserRoles->save($user_role)) {
                $this->Flash->success(__('User Role added successfully'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('User Role could not be save'));
            return $this->redirect(['action' => 'add']);
        }
        $this->set('user_role', $user_role);
    }

    /**
     * Function name     : edit
     * Description         : edit role
     * Author             : Wepro
     * Created by         : Wepro 19-Apr-2017
     */

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $id = base64_decode($id);
        $user_role = $this->UserRoles->get($id);

        if (!empty($this->request->getData())) {
            $this->UserRoles->patchEntity($user_role, $this->request->getData());
            if ($this->UserRoles->save($user_role)) {
                $this->Flash->success(__('The User Role has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The User Role could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'edit', base64_encode($id)]);

        }

        $this->set('user_role', $user_role);
    }

}
