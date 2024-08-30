<?php
namespace App\Controller\Client;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    // function for dashboard
    public function dashboard()
    {
        if (!$this->Auth->user()) {
            $this->redirect(Router::fullBaseUrl());
        }

        $this->viewBuilder()->setLayout('admin');
    }

    // function to redirect to main login when session expires
    public function login()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $this->loadModel('Clients');
            $client_result = $this->Clients->identify_user($data);
            if ($client_result) {
                $userRolesTable = TableRegistry::get('UserRoles');
                //$client_result['UserRoles'] = $userRolesTable->find('all')->where(['id'=>$client_result['user_role_id']])->first()->toArray();
                //echo '<pre>'; print_r($client_result); exit;
                $this->Auth->setUser($client_result);
                // $this->redirect('/client/employees');
                return $this->response->withType('application/json')
                ->withStringBody(json_encode(['redirectUrl' => '/client/employees']));
            } else {
                $this->Flash->error(__('Username or password is incorrect'), [
                    'key' => 'auth',
                ]);
            }
        }
    }

    // function to logout.
    public function logout()
    {
        if ($this->Auth->logout()) {
            return $this->redirect('/client/users/login');
        }
    }

    // function for add
    public function add()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                return $this->redirect($this->Auth->redirectUrl());
            } else {die('No');
                $this->Flash->error(__('Username or password is incorrect'), [
                    'key' => 'auth',
                ]);
            }
        }
    }

    // function for change password
    public function changePassword()
    {
        $this->viewBuilder()->layout('ajax');
        $this->autoRender = false;
        $passowrd = $this->request->data['password'];
        $oldPass = $this->request->data['old_password'];
        $obj = new DefaultPasswordHasher;
        //$old_pass =  $obj->hash($oldPass);

        $currentData = $this->Users->get($this->Auth->user('id'));
        $postpassword = $obj->check($oldPass, $currentData->Password);
        if ($postpassword == 1) {
            $user = $this->Users->newEntity();
            $user->id = $this->Auth->user('id');
            $user->Password = $passowrd;
            if ($this->Users->save($user)) {
                echo '1';die;
            } else {
                echo '0';die;
            }
        } else {
            echo '2';die;
        }

    }

    // function for change image
    public function changeImage()
    {
        if ($this->request->data) {
            $data = pathinfo($this->request->data['image']['name']);
            $ext = $data['extension'];
            $allow = ['jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG'];
            if (in_array($ext, $allow)) {
                $tmp_name = $this->request->data['image']['tmp_name'];
                $newName = 'img_' . uniqid() . '.' . $ext;
                // save user image to table
                $user = $this->Users->newEntity();
                $user->id = $this->Auth->user('id');
                $user->image = $newName;
                if ($this->Users->save($user)) {
                    // now upload file
                    move_uploaded_file($tmp_name, "img/admin/" . $newName);
                    $this->request->getSession()->write('Auth.User.image', $newName);
                    $this->Flash->success(__('Image Uploaded.'));
                    $this->redirect($this->referer());
                } else {
                    $this->Flash->error(__('An error occured, please try again.'));
                    $this->redirect($this->referer());
                }
            } else {
                $this->Flash->error(__('Image type is invalid, please select valid image.'));
                $this->redirect($this->referer());
            }
        }
    }

}
