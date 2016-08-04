<?php
App::uses('AppModel', 'Model');

class RestaurantInfo extends AppModel{
    var $name = "RestaurantInfo";
    var $useTable = "b_restaurant_info";

    // start vpLuan
    public function getDelivery($restaurantId){
    	$data = $this->find('all',array('conditions'=>array('RestaurantInfo.restaurant_id'=>$restaurantId),'fields'=>array('RestaurantInfo.delivery_process')));
    	return $data[0]['RestaurantInfo']['delivery_process'];
    }    
    // end vpLuan
}
