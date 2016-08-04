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
		public function getListFavorites(){
	    	/*$restaurantId = $this->request->query["restaurantId"];
			$userId = $this->request->query["userId"];*/
			// How to receive data from a token
			$token = $this->request->header('Token');
			// decode to get userid at here
			
			$userId = 1;
			if(!empty(trim((string)$userId))){
				$queryResult = $this->Food->getFoodFavorites($userId);
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