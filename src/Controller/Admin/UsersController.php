<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'Username', 'password' => 'Password'],
                ],
            ],
        ]);

    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['dashboard']);

        $this->Auth->setConfig('authenticate', [
            'Basic' => ['userModel' => 'Users'],
            'Form' => ['userModel' => 'Users'],
        ]);

    }

    // function for dashboard
    public function dashboard()
    {
        if (!$this->Auth->user()) {
            $this->redirect(BASE_URL);
        }
        $this->redirect('/admin/companies/');
        $this->viewBuilder()->setLayout('admin');
        // $this->viewBuilder()->layout('admin');
    }

    // function to redirect to main login when session expires
    public function login()
    {
        $this->redirect(BASE_URL . '/Users/login');
    }

    /**
     * Function name     : index
     * Description         : list Clients
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */
    public function index()
    {
        if (!$this->isSupAdmin()) {
            $this->redirect(BASE_URL);
        }
        $this->viewBuilder()->setLayout('admin');
        $this->paginate = [
            'limit' => 20,
            'order' => ['id' => 'DESC'],
            'contain' => ['UserRoles'],
        ];

        $users = $this->paginate($this->Users);
        $this->set('users', $users);
    }

    /**
     * Function name     : add
     * Description         : Add users related Information
     * Author             : Wepro
     * Created by         : Wepro 18-Apr-2017
     */

    public function add()
    {
        if (!$this->isSupAdmin()) {
            $this->redirect(BASE_URL);
        }

        // $this->viewBuilder()->layout('admin');
        $this->viewBuilder()->setLayout('admin');
        $user = $this->Users->newEmptyEntity();
        // Add the Client data and Save
        if ($this->request->is('post')) {
            //print_r($this->request->data); exit;
            $this->Users->patchEntity($user, $this->request->getData());
            //$user->created = date();

            if ($this->Users->save($user)) {
                $this->Flash->success(__('User added successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('User could not be save'));
            return $this->redirect(['action' => 'add']);
        }

        $dropDownTable = TableRegistry::get('DropdownValues');

        $user_roles = $this->Users->UserRoles->find('list', ['fields' => ['id', 'name']])->toArray();
        $status = $dropDownTable->find('list', ['keyField' => 'keyID', 'valueField' => 'value'])->where(['name' => 'status'])->toArray();

        $this->set('user_roles', $user_roles);
        $this->set('user', $user);
        $this->set('status', $status);

    }

    /**
     * Function name     : edit
     * Description         : edit User related Information
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function edit($id = null)
    {
        if (!$this->isSupAdmin()) {
            $this->redirect(BASE_URL);
        }
        $this->viewBuilder()->setLayout('admin');
        $id = base64_decode($id);
        $user = $this->Users->get($id);

        if (!empty($this->request->getData())) {
            $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The User data has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The User  could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'edit', base64_encode($id)]);

        }

        $dropDownTable = TableRegistry::get('DropdownValues');

        $user_roles = $this->Users->UserRoles->find('list', ['fields' => ['id', 'name']])->toArray();
        $status = $dropDownTable->find('list', ['keyField' => 'keyID', 'valueField' => 'value'])->where(['name' => 'status'])->toArray();

        $this->set('user_roles', $user_roles);
        $this->set('user', $user);
        $this->set('status', $status);
    }

    /**
     * Function name     : changeImage
     * Description         : Used for change logo image from header
     * Author             : Wepro
     * Created by         : Wepro 15-Apr-2017
     */

    public function changeImage()
    {

        $allowedExts = array("gif", "jpeg", "jpg", "png");
        if (isset($this->request->data['image']) && !empty($this->request->data['image'])) {
            if (isset($this->request->data['image']['tmp_name']) && !empty($this->request->data['image']['tmp_name'])) {
                $data = pathinfo($this->request->data['image']['name']);
                $ext = $data['extension'];
                if (in_array($ext, $allowedExts)) {
                    $tmp_name = $this->request->data['image']['tmp_name'];
                    $newName = 'logo_' . uniqid() . '.' . $ext;

                    $userTable = TableRegistry::get('Users');
                    $user = $userTable->get($this->Auth->user('id'));
                    $user->image = $newName;

                    if ($userTable->save($user)) {
                        if ($this->Auth->user('image')) {
                            $path = WWW_ROOT . 'img/admin/' . $this->Auth->user('image');
                            unlink($path);
                        }

                        $user = $this->Auth->user();
                        $user['image'] = $newName;
                        $this->Auth->setUser($user);

                        // now upload file
                        move_uploaded_file($tmp_name, "img/admin/" . $newName);

                        $this->Flash->success(__('Profile Image has been changed.'));
                        return $this->redirect($this->referer());
                    }
                } else {
                    $this->Flash->error(__('Invalid file type, try again'));
                    return $this->redirect($this->referer());
                }
                $this->Flash->error(__('Something went wrong, try again.'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('Image is not selected. Please, try again.'));
                return $this->redirect($this->referer());
            }

        } else {
            $this->Flash->error(__('File Attachment is not found. Please, try again.'));
            return $this->redirect($this->referer());
        }
    }

    // function for change password
    public function changePassword()
    {
        $this->viewBuilder()->setLayout('ajax');
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

    /*
     * Function name     : Delete
     * Description         : Delete functionality for user
     */
    public function delete($id = null)
    {
        $id = base64_decode($id);
        //$companyTable = TableRegistry::get('Companies');
        $users = $this->Users->find('all')->where(['id' => $id])->first();
        if (!empty($users)) {
            if ($this->Users->delete($users)) {
                $this->Flash->success(__('The user has been deleted.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The course could not be deleted. Please, try again.'));
            }

        }
        $this->Flash->success(__('Oops! some issue while deleting.'));
        return $this->redirect($this->referer());
    }

    /*
     * Function name     : ChangeUserPassword
     * Description         : ChangeUserPassword for any user
     */
    public function ChangeUserPassword()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $passowrd = $this->request->getData('password');
        $obj = new DefaultPasswordHasher;

        //$old_pass =  $obj->hash($oldPass);
        $this->Users->get($this->request->getData('id'));

        $user = $this->Users->newEmptyEntity();
        $user->id = $this->request->getData('id');
        $user->Password = $this->request->getData('password');
        if ($this->Users->save($user)) {
            echo '1';die;
        } else {
            echo '0';die;
        }
        exit;
    }
}
