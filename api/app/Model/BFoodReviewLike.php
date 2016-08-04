<?php
App::uses('AppModel', 'Model');

class BFoodReviewLike extends AppModel{
    
    var $name = "BFoodReviewLike";
    var $useTable = 'b_food_review_like';

    public function countReviewLike($reviewId=''){
    	if (!empty(trim((string)$reviewId))){
    		$data = $this->find("count",array('conditions'=>array('review_id'=>$reviewId)));
    		return $data;
    	}
    	return null;
    }
    
    //start d_trinh
 	public function Get_AVG_AnField($field_name,$conditions){
		$this->find("all", array(
		    "fields"     => array("AVG(".$field_name.") AS ".$field_name),
		    "conditions" => $conditions
		));
 	}
    //end d_trinh

}
