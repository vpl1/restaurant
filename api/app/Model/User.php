<?php
App::uses('AppModel', 'Model');
App::import('AppModel','Restaurant');
class User extends AppModel{
    var $name = "User";
    var $useTable = "s_user";
    // start vpLuan
    public function isExitsUserIntoRestaurant($userId = null, $restaurantId = null)
    {
		$data = $this->find('all',array('conditions'=>array('User.id'=>$userId,'User.restaurant_id'=>$restaurantId)));
		if($data != null){
			return true;
		}
		else{
			return false;
		}
    }
    // end vpLuan
}
