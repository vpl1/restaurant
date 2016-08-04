<?php
App::uses('AppModel', 'Model');

class BFoodImage extends AppModel{
    
    var $name = "BFoodImage";
    var $useTable = 'c_food_image';

    public function countFoodImage($foodId=''){
    	if (!empty(trim((string)$foodId))){
    		$data = $this->find("count",array('conditions'=>array('food_id'=>$foodId)));
    		return $data;
    	}
    	return null;
    }
}
