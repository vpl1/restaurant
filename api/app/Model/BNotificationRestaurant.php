<?php
App::uses('AppModel', 'Model');

class BNotificationRestaurant extends AppModel{
	var $useTable = "b_notification_restaurant";
	var $name = "NotificationRestaurant";
	
	public function getAllNotificationByRestaurantId($restaurantId = null){

		if($restaurantId){
			return $this->find("all",array(
				"conditions"=>array("BNotificationRestaurant.restaurant_id"=>$restaurantId)
				)
			);
		}
		return null;
	}

	public function getCountNotificationNew($restaurantId = null, $userId = null){
		if($restaurantId && $userId){

		}
		return null;
	}
}