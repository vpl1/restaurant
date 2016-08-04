<?php
App::uses('AppModel', 'Model');

class BFoodComment extends AppModel{
    
    var $name = "BFoodComment";
    var $useTable = 'b_food_comment';

    public function countComment($reviewId=''){
    	if (!empty(trim((string)$reviewId))){
    		$data = $this->find("count",array('conditions'=>array('review_id'=>$reviewId)));
    		return $data;
    	}
    	return null;
    }

    public function getCommentDetail($reviewId=''){

  		if (!empty(trim((string)$reviewId))){
   		$data = $this->find('all',array(
	    	'joins'=>array(
	     		array(
	      			'table'=>'b_food_Review',
	      			'alias'=>'bFoodReview',
	      			'type'=>'INNER',
	      			'conditions'=> array(
	       				'`bFoodReview.id` = `BFoodComment.review_id`'
	      			)
	     		),
	     		array(
	     			'table'=>'s_user',
	     			'alias'=>'User',
	     			'type'=>'INNER',
	     			'conditions'=>array(
	     				'`User.id` = `BFoodComment.user_id`'
     				)
     			)
	    	),
	    	'fields' => array('bFoodReview.*','BFoodComment.content','BFoodComment.id','User.last_name','User.first_name'),
	    	'conditions'=>array('bFoodReview.id'=>$reviewId))
	   	);

	   	return $data;
	  	}
	  	return null;

    }

}
