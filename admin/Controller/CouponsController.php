<?php

App::uses('AppController', 'Controller');

class CouponsController extends AppController {

    public function index() {
        $this->Coupon->recursive = 0;
        $this->set('coupons', $this->Coupon->find('all'));
    }

    public function ajaxData() {
        $this->modelClass = "Coupon";
        $this->autoRender = false;
        $output = $this->Coupon->GetData();
        
        echo json_encode($output);
    }
    
    public function view($id = null) {
        $this->Coupon->id = $id;
        if (!$this->Coupon->exists()) {
            throw new NotFoundException(__('Invalid coupon'));
        }
        $this->set('coupons', $this->Coupon->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Coupon->create();
            if ($this->Coupon->save($this->request->data)) {
                $this->Flash->success(__('The coupon has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The coupon could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->Coupon->id = $id;
        if (!$this->Coupon->exists()) {
            throw new NotFoundException(__('Invalid coupon'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Coupon->save($this->request->data)) {
                $this->Flash->success(__('The coupon has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The coupon could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->Coupon->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');
        //$this->request->allowMethod('post');

        $this->Coupon->id = $id;
        if (!$this->Coupon->exists()) {
            throw new NotFoundException(__('Invalid coupon'));
        }
        if ($this->Coupon->delete()) {
            $this->Flash->success(__('Coupon deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Coupon was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    public function validate() {
        $this->validate->set($this->data);
        if($this->Valid->valid_01()==TRUE){
            $this->Session->setFlash("Data is avaliable !");
        }else{
            $this->Session->setFlash("Data is not avaliable !");
        }
    }
}