<?php

App::uses('AppController', 'Controller');

class PostsController extends AppController {
    public $helpers = array('Js','Paginator');   
    public $components = array('RequestHandler'); // support ajax pagin
    public $paginate = array();

    public function index1() {
        $userId = AuthComponent::user('id');
        $this->set('posts', $this->Post->findAllByUserId($userId));
    }

    public function index(){
        $userId = AuthComponent::user('id');
        $this->paginate = array(
       'limit' => 10,
       'conditions' => array('user_id ' => $userId));
        $data = $this->paginate("Post");
        $this->set("posts",$data);
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add() {
        $userId = AuthComponent::user('id');
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->data;
            $data['Post']['user_id'] = $userId;
            if ($this->Post->save($data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action'=>'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }   

     public function delete($id = null)
    {  
        $this->Post->id = $id;
        if(!$id || !$this->Post->exists()){
            throw new NotFoundException(__('ID was not set.'));
        }
        if($this->Post->delete()){
            $this->Flash->success(__('Your post was deleted.'));
        }else{
                $this->Flash->success(__('Your post was not deleted.'));
        }
        $this->redirect('index');
    }
    
    public function edit($id = null) {
        $this->Post->id = $id;
        if (!$id || !$this->Post->exists()) {
            throw new NotFoundException(__('Invalid Post'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('The Post has been updated'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('The Post could not be updated. Please, try again.')
            );
        } else {
            $this->request->data = $this->Post->findById($id);
        }
    }
}