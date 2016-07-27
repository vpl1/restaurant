<?php
App::uses('AppController','Controller');

class UploadController extends AppController{

    public function index(){
    }
    public function upload()
    {
        if($_FILES["fileToUpload"]["tmp_name"]!=""){
            $uploadFile= "../uploads/images/".basename($_FILES["fileToUpload"]['name']);
            $this->loadModel('imgfolders');
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadFile);
            $this->imgfolders->Insert($uploadFile);
        }
        else
        {
            echo "<script type='text/javascript'>alert('no image');</script>";
        }
    }
    
    public function CheckBoxes(){
        echo '<h1>hello Ngoongx con</h1>';
    }
}