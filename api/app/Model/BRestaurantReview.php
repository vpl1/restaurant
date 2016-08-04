<?php
App::uses('AppModel', 'Model');

class BRestaurantReview extends AppModel{
    
    var $name = "BRestaurantReview";
    var $useTable = 'b_restaurant_review';

    public function getRestaurantReview($userId='',$restaurantId=''){
    	if (!empty(trim((string)$userId))){
    		$data = $this->find("all",array('conditions'=>array('user_id'=>$userId,'restaurant_id'=>$restaurantId)));
    		return $data;
    	}
    	return null;
    }
    
    public function getRestaurantReviewDetail($reviewId='',$restaurantId=''){
 		if (!empty(trim((string)$reviewId)) && !empty(trim((string)$restaurantId))){
   		$data = $this->find('all',array(
	    	'joins'=>array(
	     		array(
	      			'table'=>'s_user',
	      			'alias'=>'User',
	      			'type'=>'INNER',
	      			'conditions'=> array(
	       				'`User.id` = `BRestaurantReview.user_id`'
	      			)
	     		)
	    	),
	    	'fields' => array('BRestaurantReview.*','User.*'),
	    	'conditions'=>array('BRestaurantReview.id'=>$reviewId,'BRestaurantReview.restaurant_id'=>$restaurantId))
	   	);
	   	return $data;
	  	}
	  	return null;
 	}

 	public function postReview($data=''){
 		if($data!=null){
 			$bR = $this->checkExistRestaurant($data['restaurant_id']);
 			$bU = $this->checkExistUser($data['user_id']);
 			if($bU && $bR){
 				$this->create();
 				if($this->save($data))
 					$result = array('code' => 0, 'message' => 'Connect successfully');
 			} else {
 				$result = array('code' => 0, 'message' => 'Not available User Id or Restaurant Id');
 			}
 			
 		} else {
 			$result = array('code' => 0, 'message' => 'No data save');
 		}
 		return $result;
 	}

 	/*public function checkExistRestaurant($restaurantId=''){

 		if (!empty(trim((string)$restaurantId))){
   			App::import('Model','Restaurant');
   			$this->Restaurant = new Restaurant();

   			$count = $this->Restaurant->find('count',array('conditions'=>array('id' => $restaurantId)));
   			if($count!=0)
   				return true;
   			else 
   				return false;
	  	}

 	}

 	public function checkExistUser($userId=''){

 		if (!empty(trim((string)$userId))){
   			App::import('Model','User');
   			$this->User = new User();

   			$count = $this->User->find('count',array('conditions'=>array('id' => $userId)));
   			if($count!=0)
   				return true;
   			else 
   				return false;
	  	}

 	}*/

 	public function checkMatchReview($reviewId='',$restaurantId=''){
 		if (!empty(trim((string)$reviewId)) && !empty(trim((string)$restaurantId))){
 			$count = $this->find('count',array('conditions'=>array('id'=>$reviewId,'restaurant_id'=>$restaurantId)));
 			if($count!=0)
   				return true;
   			else 
   				return false;
 		}
 	}

  //Start d_trinh

  public function countRestaurantReview($restaurant_id =''){
    if(!empty(trim((string)$restaurant_id))){
      $data = $this->find("count", array('conditions'=>array('restaurant_id'=>$restaurant_id)));
      return $data;
    }
    return null;
  }

  public function getListRestaurantReviewRange($restaurant_id,$from,$count){
    return $this->query("SELECT * FROM b_restaurant_review WHERE restaurant_id=".$restaurant_id." LIMIT ".$from.",".$count);
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

  public function checkLikeStatus($reviewId='',$restaurantId=''){
    if (!empty(trim((string)$reviewId)) && !empty(trim((string)$restaurantId))){
      $count = $this->find('count',array('conditions'=>array('id'=>$reviewId,'restaurant_id'=>$restaurantId)));
      if($count!=0)
          return 1;
        else 
          return 0;
    }
  }
  
  //end d_trinh

}
