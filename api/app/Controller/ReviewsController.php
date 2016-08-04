<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

class ReviewsController extends AppController {

    public $components = array("RequestHandler");

    /*
     *   Function beforeFilter begin when call Controller
     *   Useful: Import Model
     */

    public function beforeFilter() {
        $this->autoRender = false;
        $this->LoadModel("BFoodReview");
    	$this->LoadModel("BFoodReviewLike");
    	$this->LoadModel("BFoodComment");
    	$this->LoadModel("BFoodCommentLike");
    	$this->LoadModel("BRestaurantReviewLike");
    	$this->LoadModel("BRestaurantReview");
    	$this->LoadModel("BRestaurantComment");
    	$this->LoadModel("BRestaurantCommentLike");
        $this->LoadModel("Restaurant");
        $this->LoadModel("User");
        $this->LoadModel("CFood");

    }


    //x_thinh
    public function getReviewHistory(){

        $response = array();
        $response['error']['code'] = 1;

        if((isset($_GET['restaurantId']) && trim($_GET['restaurantId']) != '')&&(isset($_GET['userId']) && trim($_GET['userId']) != '')) {
            $response['error']['message'] = 'Connect successfully !';
            $userId = $_GET['userId'];
            $restaurantId = $_GET['restaurantId'];

            $resReview = $this->BRestaurantReview->getRestaurantReview($userId,$restaurantId);
            $foodReview = $this->CFood->getFoodReview($userId,$restaurantId);

            $response['countRestaurant'] = count($resReview);
            $response['countFood'] = count($foodReview);

            if($resReview) {
                $response['listReviewRestaurant'] = array();
                foreach ($resReview as $review) {
                    $listResReview = array(
                            'reviewId'  =>  $review['BRestaurantReview']['id'],
                            'rate'      =>  array(
                                                'location'  =>  $review['BRestaurantReview']['location'],
                                                'price'     =>  $review['BRestaurantReview']['price'],
                                                'service'   =>  $review['BRestaurantReview']['service'],
                                                'quality'   =>  $review['BRestaurantReview']['quality'],
                                                'decoration'=>  $review['BRestaurantReview']['decoration']
                                            ),
                            'date'      =>   date('Y-m-d',strtotime($review['BRestaurantReview']['create_time'])),
                            'title'     =>  $review['BRestaurantReview']['title'],
                            'content'   =>  $review['BRestaurantReview']['content'],
                            'like'      =>  $this->BRestaurantReviewLike->countReviewLike($review['BRestaurantReview']['id']),
                            'comment'   =>  $this->BRestaurantComment->countComment($review['BRestaurantReview']['id'])
                        );
                    array_push($response['listReviewRestaurant'],$listResReview);
                }
            } else {
                $response['listReviewRestaurant'] = 'No Review Found !';
            }

            if($foodReview) {
                $response['listReviewFood'] = array();
                foreach ($foodReview as $review) {
                    $listFoodReview = array(
                            'reviewId'  =>  $review['bFoodReview']['id'],
                            'imageUrl'  =>  $review['CFood']['image_url'],
                            'name'      =>  $review['CFood']['name'],
                            'discount'  =>  $review['CFood']['discount'],
                            'price'     =>  $review['CFood']['price'],
                            'sale'      =>  $review['CFood']['sale'],
                            'type'      =>  $review['CFood']['type'],
                            'rate'      =>  array(
                                                'price'     =>  $review['bFoodReview']['price'],
                                                'quality'   =>  $review['bFoodReview']['quality'],
                                                'decoration'=>  $review['bFoodReview']['decoration']
                                            ),
                            'date'      =>  date('Y-m-d',strtotime($review['bFoodReview']['create_time'])),
                            'title'     =>  $review['bFoodReview']['title'],
                            'content'   =>  $review['bFoodReview']['content'],
                            'like'      =>  $this->BFoodReviewLike->countReviewLike($review['bFoodReview']['id']),
                            'comment'   =>  $this->BFoodComment->countComment($review['bFoodReview']['id'])
                        );
                    array_push($response['listReviewFood'],$listFoodReview);
                }
            } else {
                $response['listReviewFood'] = 'No Review Found !';
            }

        } else {
            $response['error']['message'] = 'Restaurant Id or User Id Not Available !';
        }
        echo json_encode($response);
        die;
    }
    //end getReviewHistory


    public function getReviewFoodDetail(){

        $response = array();
        $response['error']['code'] = 1;

        if(isset($_GET['restaurantId']) && trim($_GET['restaurantId']) != '' && isset($_GET['reviewId']) && trim($_GET['reviewId']) != '') {

            $response['error']['message'] = 'Connect successfully !';
            $reviewId = $_GET['reviewId'];
            $restaurantId = $_GET['restaurantId'];
            $reviewDetails = $this->BFoodReview->getFoodReviewDetail($reviewId);
            if($reviewDetails){
                $response['reviewFood'] = array();
                foreach ($reviewDetails as $fd) {
                    $reviewDetail = array(
                                        'reviewId'  =>  $fd['BFoodReview']['id'],
                                        'name'      =>  $fd['User']['last_name'].' '.$fd['User']['first_name'],
                                        'rate'      =>  array(
                                                            'price'     =>  $fd['BFoodReview']['price'],
                                                            'quality'   =>  $fd['BFoodReview']['quality'],
                                                            'decoration'=>  $fd['BFoodReview']['decoration']  
                                                        ),
                                        'date'      =>   date('Y-m-d',strtotime($fd['BFoodReview']['create_time'])),
                                        'title'     =>  $fd['BFoodReview']['title'],
                                        'content'   =>  $fd['BFoodReview']['content'],
                                        'like'      =>  $this->BFoodReviewLike->countReviewLike($reviewId),
                                        'comment'   =>  $this->BFoodComment->countComment($reviewId)
                                    );
                }
                array_push($response['reviewFood'], $reviewDetail);
            } else {
                $response['reviewFood'] = 'No Review Found !';
            }

            $commentDetails = $this->BFoodComment->getCommentDetail($reviewId);
            if($commentDetails){
                $response['listComments'] = array();
                foreach ($commentDetails as $cm) {
                    $listCom = array(
                                    'reviewId'      =>  $cm['BFoodComment']['id'],
                                    'name'          =>  $cm['User']['first_name'].' '.$cm['User']['last_name'],
                                    'content'       =>  $cm['BFoodComment']['content'],
                                    'like'          =>  $this->BFoodCommentLike->countCommentLike($cm['BFoodComment']['id'])
                                );
                    array_push($response['listComments'], $listCom);
                }
            } else {
                $response['listComments'] = 'No Comment Found !';
            }
            
        } else {
            $response['error']['message'] = 'Restaurant Id or Review Id Not Correct !';
        }
        echo json_encode($response);
        die;
    }
    //end getReviewFoodDetail


    public function getReviewRestaurantDetail(){

        $response = array();
        $response['error']['code'] = 1;

        if(isset($_GET['restaurantId']) && trim($_GET['restaurantId']) != '' && isset($_GET['reviewId']) && trim($_GET['reviewId']) != '') {

            $response['error']['message'] = 'Connect successfully !';
            $reviewId = $_GET['reviewId'];
            $restaurantId = $_GET['restaurantId'];
            $reviewDetails = $this->BRestaurantReview->getRestaurantReviewDetail($reviewId,$restaurantId);

            if($reviewDetails){
                $response['reviewRestaurant'] = array();
                foreach ($reviewDetails as $rd) {
                    $reviewDetail = array(
                                        'reviewId'  =>  $rd['BRestaurantReview']['id'],
                                        'name'      =>  $rd['User']['last_name'].' '.$rd['User']['first_name'],
                                        'rate'      =>  array(
                                        					'location'  =>  $rd['BRestaurantReview']['location'],
                                                            'service'   =>  $rd['BRestaurantReview']['service'],
                                                            'price'     =>  $rd['BRestaurantReview']['price'],
                                                            'quality'   =>  $rd['BRestaurantReview']['quality'],
                                                            'decoration'=>  $rd['BRestaurantReview']['decoration']  
                                                        ),
                                        'date'      =>   date('Y-m-d',strtotime($rd['BRestaurantReview']['create_time'])),
                                        'title'     =>  $rd['BRestaurantReview']['title'],
                                        'content'   =>  $rd['BRestaurantReview']['content'],
                                        'like'      =>  $this->BRestaurantReviewLike->countReviewLike($reviewId),
                                        'comment'   =>  $this->BRestaurantComment->countComment($reviewId)
                                    );
                }
                array_push($response['reviewRestaurant'], $reviewDetail);
            } else {
                $response['reviewRestaurant'] = 'No Review Found !';
            }

            $commentDetails = $this->BRestaurantComment->getCommentDetail($reviewId,$restaurantId);

            if($commentDetails){
                $response['listComments'] = array();
                foreach ($commentDetails as $cm) {
                    $listCom = array(
                                    'reviewId'     =>  $cm['BRestaurantComment']['id'],
                                    'name'         =>  $cm['User']['first_name'].' '.$cm['User']['last_name'],
                                    'date'		   =>  date('Y-m-d',strtotime($cm['BRestaurantComment']['date'])),
                                    'content'      =>  $cm['BRestaurantComment']['content'],
                                    'like'         =>  $this->BRestaurantCommentLike->countCommentLike($cm['BRestaurantComment']['id'])
                                );
                    array_push($response['listComments'], $listCom);
                }
            } else {
                $response['listComments'] = 'No Comment Found !';
            }
            
        } else {
            $response['error']['message'] = 'Restaurant Id or Review Id Not Correct !';
        }
        echo json_encode($response);
        die;
    }
    //end getReviewFoodDetail


    public function postReviewRestaurant(){

    	//if($this->request->is('post')){
    		if(!isset($this->request->data['review'])){
    			//$review = $this->request->data['review'];
    			$review = array(
    				'reviewRestaurant'	=>	array(
    											'restaurantId'	=>	'2',
							    				'userId'		=>	'3',
							    				'rate'			=>	array(
							    										'location'	=>	'1',
							    										'price'		=>	'1',
							    										'quality'	=>	'1',
							    										'services'	=>	'1',
							    										'decoration'=>	'1'
							    									),
							    				'title'			=>	'test title new',
							    				'content'		=>	'test content new'

    										)
    				
    				);

    			foreach ($review as $rv) {

    				$data = array(
    							'restaurant_id'	=>	$rv['restaurantId'],
    							'user_id'		=>	$rv['userId'],
    							'location'		=>	$rv['rate']['location'],
    							'price'			=>	$rv['rate']['price'],
    							'quality'		=>	$rv['rate']['quality'],
    							'service'		=>	$rv['rate']['services'],
    							'decoration'	=>	$rv['rate']['decoration'],
    							'title'			=>	$rv['title'],
    							'content'		=>	$rv['content']
    						);
    			}
    			$response = $this->BRestaurantReview->postReview($data);
    		} else {
    			$response = array('code' => 0, 'message' => 'No data found');
    		}
    	//} else {
    		//$response = array('code' => 0, 'message' => 'Connect failed');
    	//}
    	echo json_encode($response);
        die;
    }
    //end postReviewRestaurant


    public function postReviewFood(){

        //if($this->request->is('post')){
            if(!isset($this->request->data['review'])){
                //$review = $this->request->data['review'];
                $review = array(
                    'reviewFood'  =>  array(
                                                'foodId'        =>  '1',
                                                'userId'        =>  '2',
                                                'rate'          =>  array(
                                                                        'price'     =>  '0.1',
                                                                        'quality'   =>  '0.21',
                                                                        'decoration'=>  '0.31'
                                                                    ),
                                                'title'         =>  'test title new',
                                                'content'       =>  'test content new'

                                            )
                    
                    );

                foreach ($review as $rv) {

                    $data = array(
                                'food_id'       =>  $rv['foodId'],
                                'user_id'       =>  $rv['userId'],
                                'price'         =>  $rv['rate']['price'],
                                'quality'       =>  $rv['rate']['quality'],
                                'decoration'    =>  $rv['rate']['decoration'],
                                'title'         =>  $rv['title'],
                                'content'       =>  $rv['content']
                            );
                }
                $response = $this->BFoodReview->postReview($data);
            } else {
                $response = array('code' => 0, 'message' => 'No data found');
            }
        //} else {
            //$response = array('code' => 0, 'message' => 'Connect failed');
        //}
        echo json_encode($response);
        die;
    }
    //end postReviewRestaurant


    public function setLikeReview(){
        if(isset($_GET['restaurantId']) && trim($_GET['restaurantId']) != '' && isset($_GET['reviewId']) && trim($_GET['reviewId']) != ''
            && isset($_GET['userId']) && trim($_GET['userId']) != '' && isset($_GET['like']) && trim($_GET['like']) != '') {

            $restaurantId = $_GET['restaurantId'];
            $data = array(
                        'like'      =>  $_GET['like'],
                        'review_id' =>  $_GET['reviewId'],
                        'user_id'   =>  $_GET['userId']
                    );

            $bR = $this->Restaurant->checkExistRestaurant($restaurantId);
            $bU = $this->User->checkExistUser($data['user_id']);

            if($bR && $bU){
                $bM = $this->BRestaurantReview->checkMatchReview($data['review_id'],$restaurantId);
                if($bM) {
                    $response = $this->BRestaurantReviewLike->saveReviewLike($data);
                } else {
                    $response = array('code' => 0, 'message' => 'Your data not match');
                }
            } else {
                $response = array('code' => 0, 'message' => 'User Id or Restaurant Id not available');
            }
        } else {
            $response = array('code' => 0, 'message' => 'Opps! Missing data. Please try again');
        }
        echo json_encode($response);
        die;
    }
    //end setLikeReview

    //end x_thinh

    //start.d_trinh
    /*
     *   METHOD: GET
     *   API: 11
     */
    public function getListReviewRestaurants(){
        $response = array(
            'error'         => array(
                'code'      => 404,
                'message'   => "Don't have 3 agrumments for this request : from, count, restaurant id."),
            'restaurant'    => array(),
            'listReview'    => array()
            );

        if (trim($_GET['from']) != '' && trim($_GET['count']) != '' && (isset($_GET['restaurantId']) && trim($_GET['restaurantId']) != '')){
            $response['error']['message'] = 'Connect successfully !';
            $response['error']['code'] = 0;
            $from              = $_GET['from'];
            $count             = $_GET['count'];
            $restaurant_id     = $_GET['restaurantId'];

            /* get reviews items by restaurant id
            *   get restaurant info for this
            */

            /* get reviews info items
            */
            $review_items = $this->BRestaurantReview->getListRestaurantReviewRange($restaurant_id,$from,$count);
            $listReview = array();

            for($i=0;$i<count($review_items);$i++){
                $review_item= $review_items[$i]['b_restaurant_review'];
                array_push($listReview, array(
                    'reviewId'  => $review_item['id'],
                    'name'      => $this->User->find('first', array('conditions' => array('id' => $review_item['user_id'])))['User']['user_name'],
                    'rate'      => array(
                        'average'   => ($review_item['location'] + $review_item['price'] + $review_item['quality'] + $review_item['service'] + $review_item['decoration'])/5,
                        'location'  => $review_item['location'],
                        'price'     => $review_item['price'],
                        'quality'   => $review_item['quality'],
                        'service'   => $review_item['service'],
                        'decoration'=> $review_item['decoration']
                    ),
                    'date'      => $review_item['update_time'],
                    'title'     => $review_item['title'],
                    'content'   => $review_item['content'],
                    'like'      => $this->BRestaurantReviewLike->countReviewLike($review_item['id']),
                    'likestatus'=> $this->BRestaurantReview->checkLikeStatus($review_item['id'], $restaurant_id),
                    'comment'   => $this->BRestaurantComment->countComment($review_item['id'])
                    ));
            }

            //get restaurant info item
            $res_result = array(
                "reviewCount" => $this->BRestaurantReview->countRestaurantReview($restaurant_id),
                "rate"        => array(
                    "average"           => 0,
                    "location"          => $this->BRestaurantReview->Get_AVG_AnField('location',  array('restaurant_id' => $restaurant_id)),// get avg for location 
                    "price"             => $this->BRestaurantReview->Get_AVG_AnField('price',     array('restaurant_id' => $restaurant_id)),// get avg for price 
                    "quality"           => $this->BRestaurantReview->Get_AVG_AnField('quality',   array('restaurant_id' => $restaurant_id)),// get avg for quality
                    "service"           => $this->BRestaurantReview->Get_AVG_AnField('service',   array('restaurant_id' => $restaurant_id)),// get avg for service 
                    "decoration"        => $this->BRestaurantReview->Get_AVG_AnField('decoration',array('restaurant_id' => $restaurant_id)),// get avg for decoretion
                    "excellentCount"    => $this->BRestaurantReview->getCountRatingLevel($listReview,9,10),
                    "goodCount"         => $this->BRestaurantReview->getCountRatingLevel($listReview,7,9),
                    "averageCount"      => $this->BRestaurantReview->getCountRatingLevel($listReview,4,7),
                    "badCount"          => $this->BRestaurantReview->getCountRatingLevel($listReview,1,4)
                    )
                );
            $res_result['rate']['average'] = ($res_result['rate']['location'] + $res_result['rate']['price'] + $res_result['rate']['quality'] + $res_result['rate']['service'] + $res_result['rate']['decoration'])/5;

            $response['restaurant'] = $res_result;
            $response['listReview'] = $listReview;
        }
        echo json_encode($response);
    }

    /*
     *   METHOD: GET
     *   API: 12
     */
    public function getListReviewFoods() {
        $response = array(
            'error'         => array(
                'code'      => 404,
                'message'   => "Don't have 3 agrumments for this request : from, count, food id."),
            'food'          => array(),
            'listReview'    => array()
            );

         if (trim($_GET['from']) != '' && trim($_GET['count']) != '' && (isset($_GET['foodId']) && trim($_GET['foodId']) != '')){

            $response['error']['message'] = 'Connect successfully !';
            $response['error']['code'] = 0;
            $from       = $_GET['from'];
            $count      = $_GET['count'];
            $food_id    = $_GET['foodId'];
            /* get reviews items by food id
            *   get food info for this
            */

            /* get reviews info items
            */
            $review_items = $this->BFoodReview->getListFoodReviewRange($food_id,$from,$count);
            $listReview = array();

            for($i=0; $i<count($review_items); $i++){
                $review_item = $review_items[$i]['b_food_review'];
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
                "type"      => $food_record['type']
                );
            $food_result['rate']['average'] = ($food_result['rate']['price'] + $food_result['rate']['quality'] + $food_result['rate']['decoration'])/3;

            $response['food']       = $food_result;
            $response['listReview'] = $listReview;
        }
        echo json_encode($response);
    }
    //end d_trinh
}