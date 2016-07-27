<?php
App::uses('AppModel', 'Model');
class FoodReview extends AppModel{
    var $name = "FoodReview";
    var $useTable = "b_food_review";

    public function getRateString($foodId)
    {
    	$avg = $this->find('all',array(
    		'fields'=>array('(avg(FoodReview.quality)+ avg(FoodReview.decoration) + avg(FoodReview.price)) as SumAvg'),
    		'conditions'=>array('FoodReview.food_id'=> $foodId)
    	));
    	return round($avg[0][0]['SumAvg']/3,1);
    }
}
