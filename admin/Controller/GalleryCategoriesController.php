<?php
App::uses('AppController','Controller');

class GalleryCategoriesController extends AppController{

	var $name = 'GalleryCategories';
	public $helpers = array("Html","Menu","Form");
    public $components = array('Flash');

    function index(){
    	$this->render('index');
    }

    /*
    * GET : /admin/gallerycategories/edit/{$id}
    */
    public function edit($id){
    	if(!$this->GalleryCategory->exists($id)){
    		throw new NotFoundException(__("Invalid Category"));
    	}

    	$data = $this->GalleryCategory->read(null,$id);
    	$this->set(compact('data',$data));
    }

    /*
    * POST : /admin/gallerycategories/save/
    */
    public function save(){
    	$userId = AuthComponent::user('id');

        $galleryCategory = $this->GalleryCategory->read(null,$this->data['id'])["GalleryCategory"];

        if($galleryCategory["user_id"] !=$this->data['user_id']){
        	$this->Flash->set(__('Dont have this category, Please check mistake'));
        }else{
	    	$this->GalleryCategory->set($this->data);
	    	if($this->data){
	    		if($this->request->is("post")|| $this->request->is("put")){
	    			if($this->GalleryCategory->save($this->request->data)){
	                    $this->Flash->set("Data has been saved successfully");
	                    $this->redirect('/gallerycategories');
	                }
	    		}else{
					$this->Flash->set("The data could not be saved. Please, try again.");
	                $this->redirect(array('action' => 'edit/'.$this->data['id']));
	            } 
	    	}
    	}
    }

    /*
    * GET : /admin/gallerycategories/add/
    * POST : /admin/gallerycategories/add/
    */
    public function add(){
    	if ($this->request->is('post')) {
            $this->GalleryCategory->create();
            if ($this->GalleryCategory->save($this->request->data)) {
                $this->Flash->set('Data has been saved successfully');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set('The data could not be saved. Please, try again.');
            }
        }
    }

    public function delete(){
        $id = $this->params['pass'][0];
        $userId = AuthComponent::user('id');

        $galleryCategory = $this->GalleryCategory->read(null,$id)["GalleryCategory"];

        if($galleryCategory["user_id"] != $userId){
        	$this->Flash->set(__('Dont have this category, Please check mistake'));
        }else{
        	$result = $this->GalleryCategory->delete($id);

	        if($result){
	        	$this->Flash->set(__('Menu deleted'));

	        }else{
	        	$this->Flash->set(__('Error while deleted, Please try again'));
	        	$this->redirect(array('action' => 'edit/'.$id));
	        }
        }
    	$this->redirect(array('action' => 'index'));
    }
}