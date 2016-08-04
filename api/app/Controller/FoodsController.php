<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

class FoodsController extends AppController {

    public $components = array("RequestHandler");

    /*
     *   Function beforeFilter begin when call Controller
     *   Useful: Import Model
     */

    public function beforeFilter() {
        $this->autoRender = false;
        $this->LoadModel("CFood");
        $this->LoadModel("CGroupFood");
        $this->LoadModel("User");
        $this->LoadModel("BFoodFavorite");
        $this->LoadModel("Restaurant");
        $this->LoadModel("BFoodReview");
        $this->LoadModel("BFoodReviewLike");
        $this->LoadModel("BFoodComment");
        $this->LoadModel("BFoodImage");
    }

    //x_thinh
    public function getListMenu(){

        $response = array();
        $response['error']['code'] = 1;

        if(isset($_GET['restaurantId']) && trim($_GET['restaurantId']) != '') {
            $response['error']['message'] = 'Connect successfully !';
            $restaurant_id = $_GET['restaurantId'];
            $bR = $this->Restaurant->checkExistRestaurant($restaurant_id);
            if($bR){
                $data = $this->CGroupFood->getGroupFood($restaurant_id);

                $response['itemCount'] = $this->CFood->countItem($restaurant_id);
                $response['listFoodGroups'] = array();

                if($data){
                    foreach ($data as $groups => $group) {
                        $groupInfo = array();
                        $groupInfo['groupId'] = $group['CGroupFood']['id'];
                        $groupInfo['groupName'] = $group['CGroupFood']['name'];
                        $groupInfo['listFoods'] = array();

                        $foods = $this->CFood->getFood($groupInfo['groupId']);

                        if($foods){
                            foreach ($foods as $food) {
                                $foodInfo = array(
                                        'id'          =>  $food['CFood']['id'],
                                        'imageUrl'    =>  $food['CFood']['image_url'],
                                        'name'        =>  $food['CFood']['name'],
                                        'price'       =>  $food['CFood']['price'],
                                        'discount'    =>  $food['CFood']['discount'],
                                        'type'        =>  $food['CFood']['type'],
                                        'sale'        =>  $food['CFood']['sale'],
                                    );

                                array_push($groupInfo['listFoods'],$foodInfo);
                            }
                        } else {
                            $groupInfo['listFoods'] = 'No Item Found';                 
                        }
                        array_push($response['listFoodGroups'],$groupInfo);
                    }

                } else {
                    $response['listFoodGroups'] = 'No Group Found!';
                }
     
                $foodSuggest = $this->CFood->getSuggest($restaurant_id);

                if($foodSuggest) {
                    $response['listSuggest'] = array();
                    foreach ($foodSuggest as $c_food => $fs) {
                        $listSu = array(
                                'id'        => $fs['CFood']['id'],
                                'imageUrl'  => $fs['CFood']['image_url'],
                                'name'      => $fs['CFood']['name'],
                                'price'     => $fs['CFood']['price'],
                                'discount'  => $fs['CFood']['discount'],
                                'type'      => $fs['CFood']['type'],
                                'sale'      => $fs['CFood']['sale']
                            );

                        array_push($response['listSuggest'],$listSu);
                    }
                } else {
                    $response['listSuggest'] = 'No Item Found'; 
                }
            } else {
                $response['error']['message'] = 'Restaurant Id Not Available !';
            }
        } else {
            $response['error']['message'] = 'Restaurant Id Not Correct !';
        }

        echo json_encode($response);
        die;
    }

    public function setFavoriteFood(){
        if(isset($_GET['foodId']) && trim($_GET['foodId']) != '' && isset($_GET['userId']) && trim($_GET['userId']) != '') {

            $data = array(
                        'food_id' =>  $_GET['foodId'],
                        'user_id'   =>  $_GET['userId']
                    );

            $bF = $this->CFood->checkExistFood($data['food_id']);
            $bU = $this->User->checkExistUser($data['user_id']);

            if($bF && $bU){
                $bM = $this->BFoodFavorite->checkMatchFavorite($data['food_id'],$data['user_id']);
                if($bM) {
                    $response = $this->BFoodFavorite->saveFoodFavorite($data);
                } else {
                    $response = array('code' => 0, 'message' => 'Your data is existing');
                }
            } else {
                $response = array('code' => 0, 'message' => 'User Id or Restaurant Id Not Available');
            }
        } else {
            $response = array('code' => 0, 'message' => 'Food Id or User Id Not Correct ');
        }
        echo json_encode($response);
        die;
    }
    //end getlistmenu

    //h_vu
    public function getListPhotoFoods(){
        //$restaurantId = 2;
        if (!empty($this->request->query['foodId'])) {
            $foodId = $this->request->query["foodId"];
            if (!empty(trim((string) $foodId))) {
                $queryResult = $this->CFood->getListPhotoByFoodId($foodId);
                if ($queryResult != null) {
                    foreach ($queryResult as $key => $value) {
                        # code...
                        $listPhoto[] = array(
                            'id' => $value["cFoodImage"]['id'],
                            'imageSmallUrl' => $value["cFoodImage"]['small_url'],
                            'imageLargeUrl' => $value["cFoodImage"]['large_url']
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
    //_end h_vu

    //start d_trinh
    /*
     *   METHOD: GET
     *   API: 37
     */
    public function getFoodDetail() {
        $response = array(
            'error'         => array(
                'code'      => 404,
                'message'   => "Don't have 1 agrumments for this request : food id."),
            'count'         => array(),
            'food'          => array(),
            'listReview'    => array()
            );

         if (isset($_GET['foodId']) && trim($_GET['foodId']) != ''){

            $response['error']['message'] = 'Connect successfully !';
            $response['error']['code'] = 0;
            $food_id = $_GET['foodId'];
            /* 
            *   get reviews items by food id
            *   get food info for this
            */

            /* get reviews info items */
            $review_items = $this->BFoodReview->getReviewFoods($food_id);
            $listReview = array();

            for($i=0; $i<count($review_items); $i++){
                $review_item = $review_items[$i]['BFoodReview'];
                array_push($listReview, array(
                    'reviewId'  => $review_item['id'],
                    'name'      => $this->User->find('first', array('conditions' => array('id' => $review_item['user_id'])))['User']['user_name'],
                    'rate'      => array(
                        'average'   => ($review_item['price'] + $review_item['quality'] + $review_item['decoration'])/3,
                        'price'     => $review_item['price'],
                        'quality'   => $review_item['quality'],
                        'decoration'=> $review_item['decoration']
                        ),
                    'date'      => $review_item['update_time'],
                    'title'     => $review_item['title'],
                    'content'   => $review_item['content'],
                    'like'      => $this->BFoodReviewLike->countReviewLike($review_item['id']),
                    'likestatus'=> $this->BFoodReview->checkLikeStatus($review_item['id'], $food_id),
                    'comment'   => $this->BFoodComment->countComment($review_item['id'])
                    )
                );
            }

            //get food info item
            $food_record = $this->CFood->find('first',array('conditions'=>array('id'=>$food_id)))['CFood'];
            $food_result = array(
                "id"        => $food_id,
                "imageUrl"  => $food_record['image_url'],
                "rate"      => array(
                    "average"           => 0,
                    "price"             => $this->BFoodReview->Get_AVG_AnField('price',     array('food_id' => $food_id)),// get avg for price 
                    "quality"           => $this->BFoodReview->Get_AVG_AnField('quality',   array('food_id' => $food_id)),// get avg for quality
                    "decoration"        => $this->BFoodReview->Get_AVG_AnField('decoration',array('food_id' => $food_id)),// get avg for decoretion
                    "excellentCount"    => $this->BFoodReview->getCountRatingLevel($listReview,9,10),
                    "goodCount"         => $this->BFoodReview->getCountRatingLevel($listReview,7,9),
                    "averageCount"      => $this->BFoodReview->getCountRatingLevel($listReview,4,7),
                    "badCount"          => $this->BFoodReview->getCountRatingLevel($listReview,1,4)
                    ),
                "name"      => $food_record['name'],
                "price"     => $food_record['price'],
                "sale"      => $food_record['sale'],
                "discount"  => $food_record['discount'],
                "type"      => $food_record['type'],
                'likestatus'=> $this->BFoodFavorite->checkLikeStatusFood($food_id),
                );
            $food_result['rate']['average'] = ($food_result['rate']['price'] + $food_result['rate']['quality'] + $food_result['rate']['decoration'])/3;

            $count_result = array(
                    "imageCount"    => $this->BFoodImage->countFoodImage($food_id),
                    "reviewCount"   => $this->BFoodReview->countReview($food_id),
                    "bookmarkCount" => $this->BFoodFavorite->countFoodFavorite($food_id)
                    );

            $response['count']      = $count_result;
            $response['food']       = $food_result;
            $response['listReview'] = $listReview;
        }
        echo json_encode($response);
    }
    //end d_trinh
}