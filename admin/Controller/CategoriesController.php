<?php
App::uses('AppController', 'Controller');

class CategoriesController extends AppController {

    var $name = "Categories";
    public $helpers = array("Html","Category","Form");
    public $components = array('Flash');

    function  index(){

        $this->render("index");

    }
    
    public function edit() {

        $id = $this->params['pass'][0];

        $sql = "Select * from categories where id = $id";
        $db = $this->Category->query($sql);
        $data = array();

        foreach($db as $cat_info){
            $data['id'] = $cat_info['categories']['id'];
            $data['name'] = $cat_info['categories']['name'];
            $data['title'] = $cat_info['categories']['title'];
            $data['keyword'] = $cat_info['categories']['keyword'];
            $data['display'] = $cat_info['categories']['display'];
            $data['description'] = $cat_info['categories']['description'];
            $data['parent_id'] = $cat_info['categories']['parent_id'];
        }
        $this->set("data",$data);

    }
    
    public function add() {

        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Flash->set('Data has been saved successfully');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set('The data could not be saved. Please, try again.');
            }
        }

    }

    public function save(){
        //var_dump($this->data); die();
        $this->Category->set($this->data);
        if($this->data){
            if ($this->request->is('post') || $this->request->is('put')) {
                if($this->Category->save($this->request->data)){
                    $this->Flash->set("Data has been saved successfully");
                    $this->redirect('/categories');
                }
            }else{
				$this->Flash->set("The data could not be saved. Please, try again.");
                $this->redirect(array('action' => 'edit/'.$this->data['id']));
            } 
        }

    }

    public function delete(){

        $id = $this->params['pass'][0];
        $sql = "Delete from categories where id = $id or parent_id = $id";
        $this->Category->query($sql);
        $this->Flash->set(__('Category deleted'));
        $this->redirect(array('action' => 'index'));

    }
}
?>
