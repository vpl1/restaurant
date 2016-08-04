<?php
App::uses('AppModel','Model');
App::uses('Restaurant','Model');
App::uses('RestaurantHasDeviceToken','Model');

class DeviceToken extends AppModel{
	public $useTable = "s_device_token";

	function SetDeviceToken($deviceToken = null, $userId = null, $restaurantId = null){

		if($deviceToken && $restaurantId && $userId){

			$Restaurant = new Restaurant();
			if(count($Restaurant->findById($restaurantId)))
			{
				$DeviceToken = $this->find('first',array(
					'joins'=>array(
						array(
							'table'=>'b_restaurant_has_s_device_token',
							'alias'=>'RestaurantHasDeviceToken',
							'type'=>'INNER',
							'conditions'=>array(
								'DeviceToken.id = RestaurantHasDeviceToken.s_device_token_token'
							)
						)
					),
					'fields'=>array("DeviceToken.*"),
					'conditions'=>array('DeviceToken.token'=>$deviceToken)
					)
				);
				if(count($DeviceToken)){

				}
			}
		}
		return null;
	}
}