<?php
App::uses('AppModel', 'Model');

class Restaurant extends AppModel{

	public $useTable = "b_restaurant";

	//get 
	public function getInforByRestaurantId($restaurantId =''){
		if (!empty(trim((string)$restaurantId))){
			$data = $this->find('first',array(
				'joins'=>array(
					array(
						'table'=>'b_restaurant_info',
						'alias'=>'bRestaurantInfo',
						'type'=>'INNER',
						'conditions'=> array(
							'`bRestaurantInfo.restaurant_id` = `Restaurant.id`'
						)
					)
				),
				'fields' => array('Restaurant.*', 'bRestaurantInfo.*'),
				'conditions'=>array('bRestaurantInfo.restaurant_id'=>$restaurantId))
			);
			return $data;
		}
		return null;
	}

	//get
	public function getListPhotoByRestaurantId($restaurantId =''){
		if (!empty(trim((string)$restaurantId))){
			$data = $this->find('all',array(
				'joins'=>array(
					array(
						'table'=>'b_restaurant_image',
						'alias'=>'bRestaurantImage',
						'type'=>'INNER',
						'conditions'=> array(
							'`bRestaurantImage.restaurant_id` = `Restaurant.id`'
						)
					)
				),
				'fields' => array('bRestaurantImage.*'),
				'conditions'=>array('bRestaurantImage.restaurant_id'=>$restaurantId))
			);
			return $data;
		}
		return null;
	}

	//x_thinh
	public function checkExistRestaurant($restaurantId=''){

 		if (!empty(trim((string)$restaurantId))){

   			$count = $this->find('count',array('conditions'=>array('id' => $restaurantId)));
   			if($count!=0)
   				return true;
   			else 
   				return false;
	  	}

 	}
 	//end x_thinh

 	//start h_ha
 	public function getCountryCodeByRestaurantId($restaurantId =''){
        if(!(trim((string)$restaurantId)==false))
        {
            $data = $this->find('first',array(
            	'fields' => array('country_code_id'),
                'conditions'=>array('id'=>$restaurantId))
            );
            return $data;
        }
       	return null;
    }
 	//end h_ha
}