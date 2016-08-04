<?php
App::uses('AppModel', 'Model');

class BRestaurantCommentLike extends AppModel{
    
    var $name = "BRestaurantCommentLike";
    var $useTable = 'b_restaurant_comment_like';

    public function countCommentLike($reviewId=''){
    	if (!empty(trim((string)$reviewId))){
    		$data = $this->find("count",array('conditions'=>array('comment_id'=>$reviewId)));
    		return $data;
    	}
    	return null;
    }

}
