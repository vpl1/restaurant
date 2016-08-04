<?php
App::uses('AppModel', 'Model');

class BFoodReview extends AppModel{
    
    var $name = "BFoodReview";
    var $useTable = 'b_food_review';

     // Start vpLuan
    public function getRateString($foodId)
    {
        $query = "select avg(cprice) as rateString from( 
            select price as cprice from b_food_review where price is not null and food_id= ".$foodId." union all 
            select quality as cprice from b_food_review where  quality is not null and food_id= ".$foodId." union all 
            select decoration as cprice from b_food_review where decoration is not null and food_id= ".$foodId."
        ) AS T";
        return $this->query($query)[0][0]['rateString'];
    }
    // End vpLuan

    
    /*public function getFoodReview($userId =''){

  		if (!empty(trim((string)$userId))){
   		$data = $this->find('all',array(
	    	'joins'=>array(
	     		array(
	      			'table'=>'c_food',
	      			'alias'=>'cFood',
	      			'type'=>'INNER',
	      			'conditions'=> array(
	       				'`cFood.id` = `BFoodReview.food_id`'
	      			)
	     		)
	    	),
	    	'fields' => array('BFoodReview.*', 'cFood.image_url','cFood.name','cFood.discount','cFood.sale','cFood.type','cFood.price'),
	    	'conditions'=>array('user_id'=>$userId))
	   	);

	   	return $data;
	  	}
	  	return null;
 	}*/

 	public function getFoodReviewDetail($reviewId=''){
 		if (!empty(trim((string)$reviewId))){
   		$data = $this->find('all',array(
	    	'joins'=>array(
	     		array(
	      			'table'=>'s_user',
	      			'alias'=>'User',
	      			'type'=>'INNER',
	      			'conditions'=> array(
	       				'`User.id` = `BFoodReview.user_id`'
	      			)
	     		)
	    	),
	    	'fields' => array('BFoodReview.*','User.*'),
	    	'conditions'=>array('BFoodReview.id'=>$reviewId))
	   	);
	   	return $data;
	  	}
	  	return null;
 	}

 	public function postReview($data=''){
 		if($data!=null){
 			$bF = $this->checkExistFood($data['food_id']);
 			$bU = $this->checkExistUser($data['user_id']);
 			if($bU && $bF){
 				$this->create();
 				if($this->save($data))
 					$result = array('code' => 0, 'message' => 'Connect successfully');
 			} else {
 				$result = array('code' => 0, 'message' => 'Not available User Id or Food Id');
 			}
 			
 		} else {
 			$result = array('code' => 0, 'message' => 'No data save');
 		}
 		return $result;
 	}

 	public function checkExistFood($foodId){

 		if (!empty(trim((string)$foodId))){
   			App::import('Model','CFood');
   			$this->CFood = new CFood();

   			$count = $this->CFood->find('count',array('conditions'=>array('id' => $foodId)));
   			if($count!=0)
   				return true;
   			else 
   				return false;
	  	}

 	}

 	public function checkExistUser($userId){

 		if (!empty(trim((string)$userId))){
   			App::import('Model','User');
   			$this->User = new User();

   			$count = $this->User->find('count',array('conditions'=>array('id' => $userId)));
   			if($count!=0)
   				return true;
   			else 
   				return false;
	  	}

 	}

 	//start d_trinh
 	public function checkLikeStatus($reviewId='',$foodId=''){
 		if (!empty(trim((string)$reviewId)) && !empty(trim((string)$foodId))){
 			$count = $this->find('count',array('conditions'=>array('id'=>$reviewId,'food_id'=>$foodId)));
 			if($count!=0)
   				return 1;
   			else 
   				return 0;
 		}
 	}

 	public function getListFoodReviewRange($food_id,$from,$count){
        return $this->query("SELECT * FROM b_food_review WHERE food_id=".$food_id." LIMIT ".$from.",".$count);
    }

    public function getReviewFoods($food_id =''){
    	if(!empty(trim((string)$food_id))){
    		$data = $this->find("all", array('conditions'=>array('food_id'=>$food_id)));
    		return $data;
    	}
    	return null;
    }

 	public function Get_AVG_AnField($field_name,$conditions){
 		$AVG_item= $this->find("all", array(
		    "fields"     => array("AVG(".$field_name.") AS 'AVG'"),
		    "conditions" => $conditions
		));
		return $AVG_item[0][0]['AVG'];
 	}

 	public function getCountRatingLevel($review_items,$min,$max){
 		$count=0;
 		for($i=0;$i<count($review_items);$i++){
 			$avg_rating=$review_items[$i]['rate']['average'];
 			if($avg_rating>=$min && $avg_rating < $max){
 				$count++;
 			}
 		}
 		return $count;
 	}

 	public function countReview($foodId=''){
    	if (!empty(trim((string)$foodId))){
    		$data = $this->find("count",array('conditions'=>array('food_id'=>$foodId)));
    		return $data;
    	}
    	return null;
    }
 	//end d_trinh
}
