<?php

App::import('Model','FoodReview');
class Food extends AppModel{
    var $name = "Food";
    var $useTable = "c_food";

    // Start vpluan

    public function getFoodFavorites($userId, $restaurantId){
    //$userId = $this->request->query('userId');
        $data = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'b_food_favorite',
                    'alias' => 'foodfavorite',
                    'type' => 'inner',
                    'conditions'=> array('foodfavorite.food_id = Food.id')
                ),
                array(
                    'table' => 's_user',
                    'alias' => 'user',
                    'type' => 'inner',
                    'conditions'=> array('user.id = foodfavorite.user_id')
                ),
                array(
                    'table' => 'b_restaurant',         
                    'type' => 'inner',
                    'foreignKey' => false,
                    'conditions'=> array('b_restaurant.id = user.id')
                )
            ),

            'fields'=> array('Food.id','Food.image_url','Food.name','Food.price','Food.sale','Food.discount','Food.type'),

            'conditions' => array('user.id'=>$userId,'b_restaurant.id'=>$restaurantId)
        )); 

        $arrdata = array();
        foreach ($data as $key) {
                array_push($arrdata,new apiFood(
                    $key["Food"]["id"],
                    $key["Food"]["image_url"],
                    $this->getRateString($key["Food"]["id"])+"",
                    $key["Food"]["name"],
                    $key["Food"]["price"],
                    $key["Food"]["sale"],
                    $key["Food"]["discount"],
                    $key["Food"]["type"]
                )
            );
        }
        return $arrdata;
    }


    public function getRateString($foodId)
    {
        $f = new FoodReview();
        $avg = $f->find('all',array(
            'fields'=>array('(avg(FoodReview.quality)+ avg(FoodReview.decoration) + avg(FoodReview.price)) as SumAvg'),
            'conditions'=>array('FoodReview.food_id'=> $foodId)
        ));
        return round($avg[0][0]['SumAvg']/3,1);
    }

    // end vpluan
}


// start vpluan
/*
*   Code below to create the same Food class to save query of list Foodfavorite because to use Food *   class it give result too complex.
*/
class apiFood{
    var $id;
    var $imageUrl;
    var $rateString;
    var $name;
    var $price;
    var $sale;
    var $discount;
    var $type;
    function apiFood($id, $imageUrl, $rateString, $name, $price, $sale, $discount, $type){
        $this->id = $id;
        $this->imageUrl = $imageUrl;
        $this->rateString = $rateString;
        $this->name = $name;
        $this->price = $price;
        $this->sale = $sale;
        $this->discount = $discount;
        $this->type = $type;
    }
}
// end vpluan