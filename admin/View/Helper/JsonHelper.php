<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class JsonHelper extends AppHelper {
    public function makeJsonAutoComplete($data) {
        $arr = array();
        foreach($data as $d) {
            $arr[$d['User']['id']] = $d['User']['username'];
        }

        return json_encode($arr);
    }
	//auto complete for get Order No
    public function makeJsonAutoCompleteOrderNo($data) {
        //print_r($data);
    	$arr = array();
        foreach($data as $d) {
        	$arr[$d['Order']['order_no']] = $d['Order']['order_no'];
        }

        return json_encode($arr);
    }
    //get location to put select option 
    public function makeJsonLoadLocation($data) {
        $arr = array();
        foreach($data as $d) {
            $arr[$d['c']['location_name']] = $d['c']['location_name'];
        }

        return json_encode($arr);
    }
    public function makeCouponJsonAutoComplete($data) {
        $arr = array();
        foreach($data as $d) {
            $arr[$d['Coupon']['id']] = $d['Coupon']['code'];
        }

        return json_encode($arr);
    }
     public function makeClientJsonAutoComplete($data) {
        $arr = array();
        foreach($data as $d) {
            $arr[$d['Client']['id']] = $d['Client']['first_name'];
        }

        return json_encode($arr);
    }
}