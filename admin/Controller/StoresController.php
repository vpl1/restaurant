<?php

App::uses('AppController', 'Controller');

class StoresController extends AppController {

    public function index() {
        $this->Store->recursive = 0;
        $this->set('stores', $this->Store->find('all')); 
      
    }
    public function ajaxData() {
        $this->modelClass = "Store";
        $this->autoRender = false;          
        $output = $this->Store->GetData();
        echo json_encode($output);
       	
    }
    public function paging(){
        $data1 = $this->Store->find('all');
        pr($data1);
    }
    public function edit($id = null) {
        $this->Store->id = $id;
        if (!$this->Store->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Store->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->Store->findById($id);
            unset($this->request->data['store_name']['address']);
        }
    }
    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');
        //$this->request->allowMethod('post');
        $this->Store->id = $id;

        if(AuthComponent::user('id') == $id) {
            $this->Flash->error(__('System is user logged in.'));    
            return $this->redirect(array('action' => 'index'));
        }

        if (!$this->Store->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->Store->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
      
    public function storeform() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Store->create();

            if ($this->Store->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
            }
  
    }  
     public function freeship() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Store->create();

            if ($this->Store->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
            }
  
    }  

    public function add() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Store->create();
            
            if ($this->Store->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
            }
    }  
    
}
