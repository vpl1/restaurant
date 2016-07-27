<?php
App::uses('AppController', 'Controller');
App::import('Model','Food');
App::import('Model','User');
App::import('Model','Restaurant');
class RequestsController extends AppController {

	    public $uses = array('Menu');

	    public function getAllMenu(){
	        $data = $this->Menu->find('all');
	        $data = json_encode($data);
	        echo $data;
	    }
	    public function index(){}
	   	// Start vpluan
	   	/*
	   	* function getListFavorites 
	   	* return list favorites food format json or error by two get_pramaster: UserID and           * RestaurantId
	   	*/
	    public function getListFavorites()
	    {
			if(isset($_GET)) {
			    $restaurantId = $this->request->query["restaurantId"];
			    $userId = $this->request->query["userId"];

			    if(strlen($restaurantId) >= 0 && strlen($userId) >= 0) {
			    	if($this->isExistUserAndRestaurant($userId,$restaurantId)){
			    		$food = new Food();
			    		$getdata = $food->getFoodFavorites($userId,$restaurantId);
			    		$data2json  = '{
			  						"error": {
			    					"code": 0,
			    					"message": "Connect successfully"
			  						},
			  						"listFoods":'.json_encode($getdata).'}';
			    	}
			    	else{
			    		$data2json 	='{
								"error": {
								"code": 1,
								"message": "Error"
								}}';

			    	}
				}else{
					$data2json 	='{
								"error": {
								"code": 1,
								"message": "Error"
								}}';
				}
			}
			else{
				$data2json 	= '{
								"error": {
								"code": 1,
								"message": "Error"
								}}';
			}
			$this->set("data",$data2json);
	    }

	    /*
	   	* function isExistUserAndRestaurant
	   	* return true: if User and Restaurant is exits else return false;
	   	* 
	   	*/
	    public function isExistUserAndRestaurant($userId,$restaurantId)
	    {
	
			$res = new Restaurant();
			$user = new User();
			if(($user->read(null, $userId) != null) && ($res->read(null,$restaurantId)!= null)){
				return true;
			}
			else {
				return false;
			}
	    }
	    //end vpluan
	}
?>
