<?php
App::uses('AppModel', 'Model');

class CFood extends AppModel{
    
    var $name = "CFood";
    var $useTable = 'c_food';

    public function getFood($groupFoodId=''){
    	if (!empty(trim((string)$groupFoodId))){
    		$data = $this->find("all",array('conditions'=>array('group_food_id'=>$groupFoodId)));
    		return $data;
    	}
    	return null;
    }


    public function getSuggest($restaurantId =''){

  		if (!empty(trim((string)$restaurantId))){
   		$data = $this->find('all',array(
	    	'joins'=>array(
	     		array(
	      			'table'=>'c_group_food',
	      			'alias'=>'cGroupFood',
	      			'type'=>'INNER',
	      			'conditions'=> array(
	       				'`cGroupFood.id` = `CFood.group_food_id`'
	      			)
	     		)
	    	),
	    	'fields' => array('CFood.*', 'cGroupFood.*'),
	    	'conditions'=>array('CFood.is_suggest' => '1','cGroupFood.restaurant_id'=>$restaurantId))
	   	);

	   	return $data;
	  	}
	  	return null;
 	}

 	public function countItem($restaurantId =''){

  		if (!empty(trim((string)$restaurantId))){
   		$data = $this->find('count',array(
	    	'joins'=>array(
	     		array(
	      			'table'=>'c_group_food',
	      			'alias'=>'cGroupFood',
	      			'type'=>'INNER',
	      			'conditions'=> array(
	       				'`cGroupFood.id` = `CFood.group_food_id`'
	      			)
	     		)
	    	),
	    	'fields' => array('CFood.*', 'cGroupFood.*'),
	    	'conditions'=>array('cGroupFood.restaurant_id'=>$restaurantId))
	   	);

	   	return $data;
	  	}
	  	return null;
 	}

 	public function checkExistFood($foodId){

 		if (!empty(trim((string)$foodId))){
   			$count = $this->find('count',array('conditions'=>array('id' => $foodId)));
   			if($count!=0)
   				return true;
   			else 
   				return false;
	  	}

 	}

 	public function getFoodReview($userId ='',$restaurantId=''){
 		//die('test');
 		//var_dump($userId); die;
  		if (!empty(trim((string)$userId)) && !empty(trim((string)$restaurantId))){
	   		$data = $this->find('all',array(
		    	'joins'=>array(
		     		array(
		      			'table'=>'b_food_review',
		      			'alias'=>'bFoodReview',
		      			'type'=>'INNER',
		      			'conditions'=> array(
		       				'`CFood.id` = `bFoodReview.food_id`'
		      			)
		     		),
		     		array(
		     			'table'=>'c_group_food',
		      			'alias'=>'cGroupFood',
		      			'type'=>'INNER',
		      			'conditions'=> array(
		       				'`CFood.group_food_id` = `cGroupFood.id`'
		      			)
		     		)
		    	),
		    	'fields' => array('bFoodReview.*', 'CFood.image_url','CFood.name','CFood.discount','CFood.sale','CFood.type','CFood.price'),
		    	'conditions'=>array('bFoodReview.user_id'=>$userId,'cGroupFood.restaurant_id'=>$restaurantId))
		   	);
	   		//var_dump($data); die;
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

 	//h_vu
 	public function getListPhotoByFoodId($foodId =''){
 		if (!empty(trim((string)$foodId))){
			$data = $this->find('all',array(
				'joins'=>array(
					array(
						'table'=>'c_food_image',
						'alias'=>'cFoodImage',
						'type'=>'INNER',
						'conditions'=> array(
							'`cFoodImage.food_id` = `CFood.id`'
						)
					)
				),
				'fields' => array('cFoodImage.*'),
				'conditions'=>array('cFoodImage.food_id'=>$foodId))
			);
			return $data;
		}
		return null;
 	}
 	//end h_vu
 	
 	// Start vpluan
    public function getFoodFavorites($userId = null){        
        $data = $this->find('all', array(
        'joins' => array(
            array(
                'table' => 'b_user_has_food_favorite',
                'alias' => 'foodfavorite',
                'type' => 'inner',
                'conditions'=> array('foodfavorite.food_id = Food.id'
                )
            ),
            array(
                'table' => 's_user',
                'alias' => 'user',
                'type' => 'inner',
                'conditions'=> array('user.id = foodfavorite.user_id')
            ),
        ),
        'fields'=> array('Food.id','Food.image_url','Food.name','Food.price','Food.sale','Food.discount','Food.type'),
        'conditions' => array('user.id'=>$userId)
        )); 
       	if($data != null){
       		foreach ($data as $key => $value) {
	           	$f = new FoodReview();
	            $listFoods[] = array(
	                'id'=> $value['Food']['id'],
	                'imageUrl' => $value['Food']['image_url'],
	                'rateString' => round($f->getRateString($value['Food']['id']),1),
	                'name'=> $value['Food']['name'],
	                'price' => $value['Food']['price'],
	                'sale' => $value['Food']['sale'],
	                'discount' => $value['Food']['discount'],
	                'type' => $value['Food']['type']
	            );
	            return $listFoods;
        	}
       	}      
    }
    // End VpLuan
}
