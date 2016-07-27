<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController {

    var $name = "Items";
    public $helpers = array("Html","Form");
    public $components = array('Flash');

    public function index() {
        $this->Item->recursive = 0;
        $this->set('item', $this->Item->find('all'));      
    }

    public function ajaxData() {
        $this->modelClass = "Item";
        $this->autoRender = false;          
        $output = $this->Item->GetData();
         
        echo json_encode($output);
    }

    public function add() {
        
    }
}
?>
