<?php
App::uses('AppModel','Model');
class GalleryLayer extends AppModel{
	public $useTable = "gallery_layers";

	var $name = "GalleryLayer";
	public $validate = array(
		'name' => array (
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'This field is required'
            )
        )
	);
}