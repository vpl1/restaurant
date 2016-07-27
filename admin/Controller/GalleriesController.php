<?php
App::uses("AppController", "Controller");

class GalleriesController extends AppController{
	var $name = "Galleries";
	public $helpers = array("Html", "Menu","Form");
	public $components = array("Flash");
	

	public function index(){
		$UserId = AuthComponent::user('id');
		$this->Gallery->recursive = 0;
		$data = $this->Gallery->FindAll($UserId);
        $this->set('gallery', $data); 
	}

	/*
	* GET : /admin/galleries/add
	* POST : /admin/galleries/add
	*/
	public function add(){
		if($this->request->is('post')){
			$this->Gallery->create();
			if($this->Gallery->save($this->request->data)){
				$this->Flash->set('Data has been saved successfully');
                $this->redirect(array('action' => 'index'));
			}else {
                $this->Flash->set('The data could not be saved. Please, try again.');
            }
		}
	}

	/*
	* POST : /admin/galleries/delete
	*/
	public function delete(){
		$Id = $this->request["pass"][0];
		$UserId = AuthComponent::user('id');
		$Gallery = $this->Gallery->read(null,$Id)["Gallery"];

		if($Gallery["user_id"] != $UserId){
			$this->Flash->set(__('Dont have this category, Please check mistake'));
		}else{
			$result = $this->Gallery->delete($Id);
			if($result){
				$this->Flash->set(__('Menu deleted'));
			}else{
				$this->Flash->set(__('Error while deleted, Please try again'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}

	/*
	*	GET: /admin/galleries/edit/{$id}
	*/
	public function edit($id){
		if(!$this->Gallery->exists($id)){
			throw new NotFoundException(__("Invalid Gallery"));
		}

		$data = $this->Gallery->read(0,$id);
		$this->set(compact('data',$data));
	}

	/*
	*	POST: /admin/galleries/save
	*/
	public function save(){
		$userId = AuthComponent::user('id');
        $gallery = $this->Gallery->read(null,$this->data['id'])["Gallery"];

        if($gallery["user_id"] !=$this->data['user_id']){
        	$this->Flash->set(__('Dont have this Gallery, Please check mistake'));
        }else{
	    	$this->Gallery->set($this->data);
	    	if($this->data){
	    		if($this->request->is("post")|| $this->request->is("put")){
	    			if($this->Gallery->save($this->request->data)){
	                    $this->Flash->set("Data has been saved successfully");
	                    $this->redirect('/galleries');
	                }
	    		}else{
					$this->Flash->set("The data could not be saved. Please, try again.");
	                $this->redirect(array('action' => 'edit/'.$this->data['id']));
	            } 
	    	}
    	}
	}
}