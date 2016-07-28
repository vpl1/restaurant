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
		    	$restaurantId = $this->request->query["restaurantId"];
				$userId = $this->request->query["userId"];
				if(!empty(trim(((string)$restaurantId))) && !empty(trim((string)$userId)) 
					&& $this->Restaurant->read(null,$restaurantId)
					&& $this->User->read(null,$userId) 
					){
					// check exist of user and restaurant here :))
					$queryResult = $this->Food->getFoodFavorites($userId,$restaurantId);
					if($queryResult != null){
						$result = array("error"=>array('code'=>0,'message'=>'Connect successfully'), "listFoods"=>$queryResult);
		            	echo json_encode($result); 
					}
					else{
						
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