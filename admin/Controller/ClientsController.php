<?php

App::uses('AppController', 'Controller');

class ClientsController extends AppController {

    public function index() {
        $this->Client->recursive = 0;
        $this->set('clients', $this->Client->find('all'));      
    }

    public function ajaxData() {
        $this->modelClass = "Client";
        $this->autoRender = false;          
        $output = $this->Client->GetData();
         
        echo json_encode($output);
    }

    public function view($id = null) {
        $this->Client->id = $id;
        if (!$this->Client->exists()) {
            throw new NotFoundException(__('Invalid client'));
        }
        $this->set('Client', $this->Client->findById($id));
    }
    
    public function edit($id = null) {
        $this->Client->id = $id;
        if (!$this->Client->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Client->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->Client->findById($id);
            unset($this->request->data['Client']['first_name']);
        }
    }

    public function delete($id = null) {
        if (!$this->Client->exists()) {
            throw new NotFoundException(__('Invalid client'));
        }
        if ($this->Client->delete()) {
            $this->Flash->success(__('Client deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Client was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}