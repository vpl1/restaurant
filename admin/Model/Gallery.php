<?php 
App::uses('AppModel', 'Model');

class Gallery extends AppModel{
	public $useTable = "gallery";

	var $name = 'Gallery';
	public $validate = array(
		'name' => array (
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'This field is required'
            )
        )
	);

	public function FindAll($UserId = ''){
		$data = null;
		if($UserId != ''){
			$data = $this->find('all', array(
				'joins'=>array(
					array(
						'table'=>'gallery_categories',
						'alias'=>'GalleryCategoryJoin',
						'type'=>'INNER',
						'conditions'=> array(
							'`GalleryCategoryJoin.id` = `Gallery.gallery_categories_id`',
							'`Gallery.user_id` ='.$UserId
						)
					)
				),
				'fields' => array('GalleryCategoryJoin.*', 'Gallery.*'),
				'order' => 'Gallery.created_date DESC'
			));
		}		
		return $data;
	}
}