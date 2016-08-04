<?php
App::uses('AppModel', 'Model');

class BRestaurantComment extends AppModel{
    var $useTable = 'b_restaurant_comment';
    var $name = "BRestaurantComment";
    

    public function countComment($reviewId=''){
    	if (!empty(trim((string)$reviewId))){
    		$data = $this->find("count",array('conditions'=>array('review_id'=>$reviewId)));
    		return $data;
    	}
    	return null;
    }
    
    public function getCommentDetail($reviewId='',$restaurantId=''){

  		if (!empty(trim((string)$reviewId)) && !empty(trim((string)$restaurantId))){
   		$data = $this->find('all',array(
	    	'joins'=>array(
	     		array(
	      			'table'=>'b_restaurant_review',
	      			'alias'=>'bRestaurantReview',
	      			'type'=>'INNER',
	      			'conditions'=> array(
	       				'`bRestaurantReview.id` = `BRestaurantComment.review_id`'
	      			)
	     		),
	     		array(
	     			'table'=>'s_user',
	     			'alias'=>'User',
	     			'type'=>'INNER',
	     			'conditions'=>array(
	     				'`User.id` = `BRestaurantComment.user_id`'
     				)
     			)
	    	),
	    	'fields' => array('bRestaurantReview.*','BRestaurantComment.content','BRestaurantComment.id','BRestaurantComment.date','User.last_name','User.first_name'),
	    	'conditions'=>array('bRestaurantReview.id'=>$reviewId,'bRestaurantReview.restaurant_id'=>$restaurantId))
	   	);

	   	return $data;
	  	}
	  	return null;

    }

    /*Author: Xuan_Hoang*/
    public function getAllCommentByUserId($userId = null){
    	if($userId){
    		return $this->find("all",array(
    				'joins'=>array(
			     		array(
			      			'table'=>'b_restaurant_review',
			      			'alias'=>'bRestaurantReview',
			      			'type'=>'INNER',
			      			'conditions'=> array(
			       				'`bRestaurantReview.id` = `BRestaurantComment.review_id`'
			      			)
			     		),
			     		array(
			     			'table'=>'s_user',
			     			'alias'=>'User',
			     			'type'=>'INNER',
			     			'conditions'=>array(
			     				'`User.id` = `bRestaurantReview.user_id`'
		     				)
		     			)
			    	),
			    	"fields"=> array("BRestaurantComment.*",'User.last_name','User.first_name'),
    				"conditions"=>array("BRestaurantComment.user_id"=>$userId)
    			)
			);
    	}
    	return null;
    }
}
