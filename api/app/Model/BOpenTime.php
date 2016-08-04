<?php
App::uses('AppModel', 'Model');

class BOpenTime extends AppModel{

	var $name = 'BOpenTime';
	var $useTable = "b_open_time";

	//get 
	public function getOpentime($restaurantId =''){
		if (!empty(trim((string)$restaurantId))){
			$data = $this->find('first',array(
				'joins'=>array(
					array(
						'table'=>'b_restaurant',
						'alias'=>'BRestaurant',
						'type'=>'INNER',
						'conditions'=> array(
							'`BRestaurant.id` = `BOpenTime.restaurant_id`'
						)
					)
				),
				'fields' => array('BOpenTime.*'),
				'conditions'=>array('BOpenTime.restaurant_id'=>$restaurantId))
			);
			return $data;
		}
		return null;
	}
}