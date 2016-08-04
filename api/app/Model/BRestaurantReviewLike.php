<?php
App::uses('AppModel', 'Model');

class BRestaurantReviewLike extends AppModel{
    
    var $name = "BRestaurantReviewLike";
    var $useTable = 'b_restaurant_review_like';

    public function countReviewLike($reviewId=''){
    	if (!empty(trim((string)$reviewId))){
    		$data = $this->find("count",array('conditions'=>array('review_id'=>$reviewId)));
    		return $data;
    	}
    	return null;
    }
    
    public function saveReviewLike($data){
    	if($data){
    		$this->create();
			if($this->save($data))
				$result = array('code' => 0, 'message' => 'Connect successfully');
    	} else {
    		$result = array('code' => 0, 'message' => 'Data empty');
    	}
    	return $result;
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
