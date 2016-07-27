<?php 
App::uses('AppModel', 'Model');

class GalleryCategory extends AppModel{
	public $useTable = "gallery_categories";

	var $name = 'GalleryCategory';
	public $validate = array(
		'title' => array (
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'This field is required'
            )
        )
	);
}