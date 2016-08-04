<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

class RestaurantsController extends AppController {

    public $components = array("RequestHandler");

    /*
     *   Function beforeFilter begin when call Controller
     *   Useful: Import Model
     */

    public function beforeFilter() {
        $this->autoRender = false;
    	$this->LoadModel("Restaurant");
        echo date("Y-m-d H:i:s", time()).'<br>'; 
    }

    //start.h_vu
    /*
     *   METHOD: GET
     *   API: 2
     */
    public function test(){
       $GUID = $this->getGUID();
       echo $GUID;
    }
    public function getRestaurantInfo() {
        //$restaurantId = 1;
        if (!empty($this->request->query['restaurantId'])) {
            $restaurantId = $this->request->query["restaurantId"];
            if (!empty(trim((string) $restaurantId))) {
                $queryResult = $this->Restaurant->getInforByRestaurantId($restaurantId);
                //print_r($queryResult);
                if ($queryResult != null) {
                    $restaurantInfo = array(
                        'description' => $queryResult["bRestaurantInfo"]['description'],
                        'cost' => $queryResult["bRestaurantInfo"]['cost'],
                        'direction' => $queryResult["bRestaurantInfo"]['direction'],
                        'capacity' => $queryResult["bRestaurantInfo"]['capacity'],
                        'categories' => $queryResult["bRestaurantInfo"]['categories'],
                        'cuisines' => $queryResult["bRestaurantInfo"]['cuisine'],
                        'typicalDishes' => $queryResult["bRestaurantInfo"]['typical_dishes'],
                        'services' => $queryResult["bRestaurantInfo"]['services'],
                        'holidays' => $queryResult["bRestaurantInfo"]['holidays'],
                        'lastReceiveTime' => $queryResult["bRestaurantInfo"]['last_receive_time']
                    );
                    $result = array("error" => array('code' => 0, 'message' => 'Connect successfully'), "restaurantInfo" => $restaurantInfo);
                }else{
                    $result = array("error" => array('code' => 0, 'message' => 'Connect successfully'), "restaurantInfo" => null);
                }
            } else {
                $result = array("error" => array('code' => 404, 'message' => 'Connect failed'), "restaurantInfo" => null);
            }
            echo json_encode($result);
        } 
        die;
    }
    /*
     *   METHOD: GET
     *   API: 3
     */
    public function getListPhotosRestaurant() {
        //$restaurantId = 2;
        if (!empty($this->request->query['restaurantId'])) {
            $restaurantId = $this->request->query["restaurantId"];
            if (!empty(trim((string) $restaurantId))) {
                $queryResult = $this->Restaurant->getListPhotoByRestaurantId($restaurantId);
                if ($queryResult != null) {
                    foreach ($queryResult as $key => $value) {
                        # code...
                        $listPhoto[] = array(
                            'id' => $value["bRestaurantImage"]['id'],
                            'imageSmallUrl' => $value["bRestaurantImage"]['small_url'],
                            'imageLargeUrl' => $value["bRestaurantImage"]['large_url']
                        );
                    }
                    $result = array("error" => array('code' => 0, 'message' => 'Connect successfully'), "listPhotos" => $listPhoto);
                    
                }else{
                    $result = array("error" => array('code' => 0, 'message' => 'Connect successfully'), "listPhotos" => null);
                }   
            } else {
                $result = array("error" => array('code' => 404, 'message' => 'Connect failed'), "listPhotos" => null);
            }
            echo json_encode($result);
        }
        
        die;
    }
    //end.h_vu

    //start.d_trinh
    /*
     *   METHOD: GET
     *   API: 4
    public function getOpentime(){
        $response = array();
        $response['error']['code'] = 1;
        $restaurantId = $this->request->query["restaurantId"];

        if (isset($_GET['restaurantId']) && trim($_GET['restaurantId']) != ''){
            $response['error']['message'] = 'Connect successfully !';
            $restaurantId = $_GET['restaurantId'];

            $queryResult = $this->BOpenTime->getOpentime($restaurantId);    
            if ($queryResult !=null){
                foreach ($queryResult as $value) {
                    $openTime[] = array(
                    'day'  => $value["BOpenTime"]['day'],
                    'from' => $value["BOpenTime"]['from'],
                    'to'   => $value["BOpenTime"]['to']
                    );
                }
            }
            $result = array("error"=>array('code'=>0,'message'=>'Connect successfully'), "openTime"=>$openTime);
            echo json_encode($result);
        }else{
            $result = array("error"=>array('code'=>404,'message'=>'Connect failed'), "openTime"=>null);
            echo json_encode($result);
        }
        die;
    }*/
    //end d_trinh
}