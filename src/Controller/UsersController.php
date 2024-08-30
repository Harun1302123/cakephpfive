<?php

// src/Controller/UsersController.php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;
use App\Controller\AppController;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // $this->loadComponent('Auth', [
        //     'authenticate' => [
        //         'Form' => [
        //             'fields' => [
        //                 'username' => 'email',
        //                 'password' => 'password'
        //             ]
        //         ]
        //     ],
        //     'loginRedirect' => [
        //         'controller' => 'Users',
        //         'action' => 'dashboard'
        //     ],
        //     'logoutRedirect' => [
        //         'controller' => 'Users',
        //         'action' => 'login'
        //     ]
        // ]);
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login']);
    }

    public function login()
    {
        // if ($this->Auth->user()) {
        //     return $this->redirect('/admin/Users/dashboard');
        // }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $userRolesTable = TableRegistry::getTableLocator()->get('UserRoles');
                $user['UserRoles'] = $userRolesTable->find('all')->where(['id' => $user['user_role_id']])->first()->toArray();
                $this->Auth->setUser($user);

                if ($this->request->is('ajax')) {
                    return $this->response->withStatus(204);
                }

                return $this->redirect('/admin/Users/dashboard');
            } else {
                $data = $this->request->getData();
                // $this->loadModel('Clients');
                $clientResult = $this->Clients->identify_user($data);
                if ($clientResult) {
                    $userRolesTable = TableRegistry::getTableLocator()->get('UserRoles');
                    $this->Auth->setUser($clientResult);
                    return $this->redirect('/client/employees');
                } else {
                    $this->Flash->error(__('Username or password is incorrect'), [
                        'key' => 'auth',
                    ]);
                    return $this->response->withStatus(422);
                }
            }
        }
    }

    public function dashboard()
    {
    }

    public function logout()
    {
        if ($this->Auth->logout()) {
            return $this->redirect('/Users/login');
        }
    }
}
