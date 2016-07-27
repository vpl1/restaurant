<?php

class Food extends AppModel{
    var $name = "Food";
    var $useTable = "c_food";

    // Start vpluan
    public function getFoodFavorites($userId, $restaurantId){
        $data = $this->find('all', array(
        'joins' => array(
            array(
                'table' => 'b_food_favorite',
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
        return $data;
    }
    // End VpLuan
}