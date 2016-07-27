<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public $paginate = array(
    'limit' => 10,
    'order' => array('User.id' => 'Desc')
    );
    public function beforeFilter() {
        parent::beforeFilter();
        
        if ($this->Auth->loggedIn()) {
            if($this->isAuthorized($this->Auth->user))
               $this->Auth->allow('*');
            else
               $this->Auth->allow('login', 'logout', 'edit');    
        }
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->User->find('all'));      
    }

    public function ajaxData() {
        $this->modelClass = "User";
        $this->autoRender = false;          
        $output = $this->User->GetData();
         
        echo json_encode($output);
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {

        if ($this->request->is('post')) {
            $data = $this->request->data;
            print_r($data); exit();
            $username = $data['User']['username'];
            $role = $data['User']['role'];
            $checkUser = $this->User->checkUser($username,$role);
            if ($checkUser != true){
              $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('The user has been saved'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Flash->error(
                    __('The user could not be saved. Please, try again.')
                );  
            }else{
               $this->Flash->error(
                    __('The user has existed. Please, choose another name.')
                ); 
            }
            
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->data;
            $username = $data['User']['username'];
            $role = $data['User']['role'];
            $checkUser = $this->User->checkUser($username,$role);
            if ($checkUser != true){
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('The user has been updated'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Flash->error(
                    __('The user could not be updated. Please, try again.')
                ); 
            }else{
                //use case update pass
                if ($this->User->save($this->request->data,array('id' => $id))) {
                    $this->Flash->success(__('The password has been updated'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Flash->error(
                    __('The password could not be updatede. Please, try again.')
                );
            }
            
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');
        //$this->request->allowMethod('post');
        $this->User->id = $id;

        if(AuthComponent::user('id') == $id) {
            $this->Flash->error(__('System is user logged in.'));    
            return $this->redirect(array('action' => 'index'));
        }

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

}