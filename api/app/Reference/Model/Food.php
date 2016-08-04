<?php
App::import('Model','FoodReview');
class Food extends AppModel{
    var $name = "Food";
    var $useTable = "c_food";
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
                    }
        return $listFoods;
    }
    // End VpLuan
}