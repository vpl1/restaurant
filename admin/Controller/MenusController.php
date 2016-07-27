<?php
App::uses('AppController', 'Controller');

class MenusController extends AppController {

    var $name = "Menus";
    public $helpers = array("Html","Menu","Form");
    public $components = array('Flash');

    public function  index(){

        $this->render("index");

    }
    
    public function edit() {

        $id = $this->params['pass'][0];
        $user_id = AuthComponent::user('id');
        $sql = "Select * from menus where id = $id and user_id = $user_id";
        $db = $this->Menu->query($sql);
        $data = array();
        if($db){
            foreach($db as $cat_info){
                $data['error'] = true;
                $data['id'] = $cat_info['menus']['id'];
                $data['name'] = $cat_info['menus']['name'];
                $data['title'] = $cat_info['menus']['title'];
                $data['keyword'] = $cat_info['menus']['keyword'];
                $data['display'] = $cat_info['menus']['display'];
                $data['description'] = $cat_info['menus']['description'];
                $data['parent_id'] = $cat_info['menus']['parent_id'];
            } 
        } else {
            $data['error'] = false;
        }
        $this->set("data",$data);

    }
    /*public function edit($id) {
        if (!$this->Menu->exists($id)) {
            throw new NotFoundException(__('Invalid Menu'));
        }
        
        $data = $this->Menu->read(null,$id);
        $this->set(compact('data'));
    }*/
    
    public function add() {

        if ($this->request->is('post')) {
            $this->Menu->create();
            if ($this->Menu->save($this->request->data)) {
                $this->Flash->set('Data has been saved successfully');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set('The data could not be saved. Please, try again.');
            }
        }

    }

    public function save(){
        //var_dump($this->data); die();
        $this->Menu->set($this->data);
        if($this->data){
            if ($this->request->is('post') || $this->request->is('put')) {
                if($this->Menu->save($this->request->data)){
                    $this->Flash->set("Data has been saved successfully");
                    $this->redirect(array('action' => 'index'));
                }
            }else{
				$this->Flash->set("The data could not be saved. Please, try again.");
                $this->redirect(array('action' => 'edit/'.$this->data['id']));
            } 
        }

    }

    public function delete(){

        $id = $this->params['pass'][0];
        $sql = "Delete from menus where id = $id or parent_id = $id";
        $this->Menu->query($sql);
        $this->Flash->set(__('Menu deleted'));
        $this->redirect(array('action' => 'index'));

    }
}
?>
