<?php

// src/Controller/AppController.php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Routing\Router;

class AppController extends Controller
{

    protected $session;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Paginator');

        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'dashboard',
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'home',
            ], 'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'Username', 'password' => 'Password'],
                ],
            ],
        ]);

        
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        if ($this->request->getParam('prefix') == 'admin' && $this->Auth->user()) {
            if ($this->Auth->user('user_role_id') == 0) {
                if ($this->Auth->logout()) {
                    return $this->redirect('/client/users/login');
                }
            }
        }

        // if ($this->Auth->user() && $this->isClient()) {
        //     return $this->redirect('client/users/login');
        // } 

        $this->set('current_controller', $this->request->getParam('controller'));
        $this->set('current_action', $this->request->getParam('action'));

        $this->session = $this->request->getSession();

        $referer = Router::url($this->request->getParam('url'), true);
        $this->Auth->loginAction = array('controller' => 'Users', 'action' => 'login', '?' => ['referer' => $referer]);

    }

    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        if (!array_key_exists('_serialize', $this->viewBuilder()->getVars()) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function isSupAdmin()
    {

        if ($this->Auth->user('user_role_id') == 1) {
            return true;
        } else {
            return false;
        }

    }

    public function isClient()
    {
        if ($this->Auth->user('user_role_id') == 0) {
            return true;
        } else {
            return false;
        }
    }
}
