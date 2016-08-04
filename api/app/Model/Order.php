<?php

App::uses('AppModel', 'Model');

class Order extends AppModel {

    public $useTable = 'b_order';

    //d_loc

    public function GetOrderById($restaurant_id, $food_id) {
        $foods_ordered = $this->query(
                'SELECT 
                    b_order_foods.id,c_food.image_url,
                    c_food.name,b_order_foods.price,
                    (SELECT AVG(cprice) as rateString FROM (
                        SELECT price as cprice FROM b_food_review WHERE price is not null and food_id=' . $food_id . ' UNION all 
                        SELECT quality as cprice FROM b_food_review WHERE quality is not null and food_id=' . $food_id . ' UNION ALL
                        SELECT decoration as cprice FROM b_food_review WHERE decoration is not null and food_id=' . $food_id . '
                    ) AS T) as rateString
                FROM    b_order,b_order_foods,c_food,c_group_food,b_restaurant
                WHERE 	b_order.id=b_order_foods.order_id AND
                        b_order_foods.food_id= c_food.id AND
                        c_food.group_food_id= c_group_food.id AND
                        c_group_food.restaurant_id= b_restaurant.id AND
                        b_restaurant.id =' . $restaurant_id . ' and b_order_foods.food_id=' . $food_id
        );
        if (count($foods_ordered) > 0) {
            $foods = array();
            for ($i = 0; $i < count($foods_ordered); $i++) {
                array_push($foods, array(
                    'id'            => $foods_ordered[$i]['b_order_foods']['id'],
                    'imageUrl'      => $foods_ordered[$i]['c_food']['image_url'],
                    'rateString'    => $foods_ordered[$i]['0']['rateString'],
                    'name'          => $foods_ordered[$i]['c_food']['name'],
                    'price'         => $foods_ordered[$i]['b_order_foods']['price']
                ));
            }
            return $foods;
        } else {
            return null;
        }
    }

    public function GetListOrdered($res_id, $user_id, $month,$year){
        $order_records= $this->query('SELECT b_order.id,b_order.order_date,c_order_status.name 
            FROM b_order,s_user,b_restaurant,c_order_status 
            WHERE 
            b_order.user_id='.$user_id.' AND MONTH(b_order.order_date)='.$month.' AND 
            YEAR(b_order.order_date)= '.$year.' AND b_order.user_id=s_user.id AND 
            s_user.restaurant_id = b_restaurant.id AND 
            b_order.order_status_id= c_order_status.id AND b_restaurant.id='.$res_id);

        $orders_result = array();
        for($i=0;$i<count($order_records);$i++){
            array_push($orders_result, array(
                'id'        =>$order_records[$i]['b_order']['id'],
                'orderCode' =>$order_records[$i]['b_order']['id'],
                'orderDate' =>date('Y/m/d',strtotime($order_records[$i]['b_order']['order_date'])),
                'status'    =>$order_records[$i]['c_order_status']['name']
                ));
        }
        return $orders_result;
    }

    public function GetRateAFood($food_id){
        return $this->query('SELECT AVG(cprice) as rateString FROM (
            SELECT price as cprice FROM b_food_review WHERE price is not null and food_id=' . $food_id . ' UNION all 
            SELECT quality as cprice FROM b_food_review WHERE quality is not null and food_id=' . $food_id . ' UNION ALL
            SELECT decoration as cprice FROM b_food_review WHERE decoration is not null and food_id=' . $food_id . '
        ) AS T')[0][0]['rateString'];
    }  

    public function GetProvincy($district, $province){
        $this->query('SELECT c_province.id 
            FROM (SELECT * FROM c_province) AS T,c_province
            WHERE c_province.parent_id= T.id 
            AND c_province.id=\''.$district.'\' 
            AND T.id=\''.$province.'\'')[0]['c_province']['id'];
    }

    public function GetSUMPrice($food_items){
        $sum=0;
        for($i=0;$i<count($food_items);$i++){
            $sum+=$food_items[$i]['OrderFoods']['price'] * $food_items[$i]['OrderFoods']['amount'];
        }
        return $sum;
    }

    // end d_loc
}
