<?php
App::uses('AppModel', 'Model');

class BFoodFavorite extends AppModel{
    
    var $name = "BFoodFavorite";
    var $useTable = 'b_user_has_food_favorite';

    public function saveFoodFavorite($data){
    	if($data){
    		$this->create();
			if($this->save($data))
				$result = array('code' => 0, 'message' => 'Connect successfully');
    	} else {
    		$result = array('code' => 0, 'message' => 'Data empty');
    	}
    	return $result;
    }


	public function checkMatchFavorite($foodId,$userId){
		if (!empty(trim((string)$foodId)) && !empty(trim((string)$userId))){
	   			$count = $this->find('count',array('conditions'=>array('food_id' => $foodId,'user_id' => $userId)));
	   			if($count==0)
	   				return true;
	   			else 
	   				return false;
		  	}
	}

	//start d_trinh
	public function countFoodFavorite($foodId=''){
		if (!empty(trim((string)$foodId))){
    		$count = $this->find("count",array('conditions'=>array('food_id'=>$foodId)));
    		return $count;
    	}
		return null;
	}
	//end d_trinh
	public function checkLikeStatusFood($userId='',$foodId=''){
 		if (!empty(trim((string)$userId)) && !empty(trim((string)$foodId))){
 			$count = $this->find('count',array('conditions'=>array('user_id' => $userId ,'food_id'=>$foodId)));
 			if($count!=0)
   				return 1;
   			else 
   				return 0;
 		}
 	}

}
