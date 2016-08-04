<?php
App::uses('AppModel', 'Model');

class BFoodCommentLike extends AppModel{
    
    var $name = "BFoodCommentLike";
    var $useTable = 'b_food_comment_like';

    public function countCommentLike($reviewId=''){
    	if (!empty(trim((string)$reviewId))){
    		$data = $this->find("count",array('conditions'=>array('comment_id'=>$reviewId)));
    		return $data;
    	}
    	return null;
    }

}
