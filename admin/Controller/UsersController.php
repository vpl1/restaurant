<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
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
        return $this->redirect(array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id')));    
    }

    public function edit($id = null) {
        $userId = AuthComponent::user('id');
        $this->User->id = $userId;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data,array('id' => $userId))) 
            {
                $this->Flash->success(__('The password has been updated'));
                return $this->redirect(array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id'))); 
            }
            $this->Flash->error(
                __('The password update error. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            $this->set('data',$this->request->data);
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