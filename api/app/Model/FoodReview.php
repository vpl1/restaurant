<?php
App::uses('AppModel', 'Model');
class FoodReview extends AppModel{
    var $name = "FoodReview";
    var $useTable = "b_food_review";

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
}
