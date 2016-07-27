<?php

App::uses('AppController', 'Controller');

class OrdersController extends AppController {

	public function index() {
		$this->set('dataOrder', $this->Order->getDataIndex());
	}

	public function ajaxData() {
		$this->modelClass = "Order";
		$this->autoRender = false; 
		$output = $this->Order->GetData();
		//print_r($output); exit(); 
		echo json_encode($output);
	}

	public function view($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid Order'));
		}else{
			// $data = $this->Order->getItemsOrder($id);
			// print_r($data);
			$this->set('bsData', $this->Order->getDataView($id));
			$this->set('dtOrderData', $this->Order->getItemsOrder($id));
		}  
	}

	public function updateStatus(){
 		echo 123; exit;
 	}
}