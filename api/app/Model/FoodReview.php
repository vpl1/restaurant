<?php
App::uses('AppModel', 'Model');
class FoodReview extends AppModel{
    var $name = "FoodReview";
    var $useTable = "b_food_review";

    // Start vpLuan
    public function getRateString($foodId)
    {
        $queryRateBy = $this->find('all', array('fields'=> array('(avg(FoodReview.price)) as rateByPrice','(avg(FoodReview.quality)) as rateByQuality','(avg(FoodReview.decoration)) as rateByDecoration'),
            'conditions'=>array('FoodReview.food_id'=> $foodId)
        ));
        $ratestring = array();
        $ratestring[0] = $queryRateBy[0][0]["rateByPrice"];
        $ratestring[1] = $queryRateBy[0][0]["rateByQuality"];
        $ratestring[2] = $queryRateBy[0][0]["rateByDecoration"];
        
        //pr($ratestring); exit;
        $iCount = 0;
        $fSum = 0;
        for ($i=0; $i < 3 ; $i++) { 
            if($ratestring[$i] != null){
                $iCount++;
                $fSum += $ratestring[$i];
            }
        }
        return round($fSum/$iCount,1);
    }
    // End vpLuan
}
