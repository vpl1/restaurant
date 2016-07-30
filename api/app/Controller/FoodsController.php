<?php 
	/**
	* 
	*/
	class FoodsController extends AppController
	{
		// start vpLuan
		public function beforeFilter(){
	        $this->LoadModel("User");
	        $this->LoadModel("Restaurant");
	    }
	    /**
	     * getListFavorites is the get function	
	     * @return json _string json of foodfavorite if success else failed
	     */
		public function getListFavorites(){
		    	$restaurantId = $this->request->query["restaurantId"];
				$userId = $this->request->query["userId"];
				/*$restaurantId = 1;
				$userId = 2;*/
				// check exist of user into restaurant here :))
				if(!empty(trim(((string)$restaurantId))) && !empty(trim((string)$userId))){
					$queryResult = $this->Food->getFoodFavorites($userId,$restaurantId);
					if($queryResult != null){
						$result = array("error"=>array('code'=>0,'message'=>'Connect successfully'), "listFoods"=>$queryResult);
		            	echo json_encode($result); 
					}
					else{		
						$result = array("error"=>array('code'=>404,'message'=>'Connect failed'), "listFoods"=>null);	
		        		echo json_encode($result);
					}
				}
				else{
					$result = array("error"=>array('code'=>404,'message'=>'Connect failed'), "listFoods"=>null);
		        	echo json_encode($result); 
				}
			die;
		}
		// end vpLuan
	}
 ?>