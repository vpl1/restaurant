<?php
App::uses('AppModel', 'Model');

class CGroupFood extends AppModel{
    
    var $name = "CGroupFood";
    var $useTable = 'c_group_food';

    public function getGroupFood($restaurantId=''){
    	if (!empty(trim((string)$restaurantId))){
    		$data = $this->find("all",array('conditions'=>array('restaurant_id'=>$restaurantId)));
    		return $data;
    	}
    	return null;
    }
}
