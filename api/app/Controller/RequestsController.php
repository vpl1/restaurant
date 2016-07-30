<?php
App::uses('AppController', 'Controller');
class RequestsController extends AppController {

	    public $uses = array('Menu');

	    public function getAllMenu(){
	        $data = $this->Menu->find('all');
	        $data = json_encode($data);
	        echo $data;
	    }
	    /*
	    *	Function beforeFilter begin when call Controller
	    *	Useful: Import Model
	    */
	    public function beforeFilter(){
	        $this->LoadModel("RestaurantInfo");
	        $this->LoadModel("Food");
	        $this->LoadModel("FoodReview");
	        $this->LoadModel("FeedBack");
	        $this->LoadModel("Restaurant");
	        $this->LoadModel("User");
	    }
	    // Start vpLuan
	    /**
	    * getDeliveryProcess the get function
	    * @return json String json success or failed
	    */
	    public function getDeliveryProcess()
	    {
	    	$restaurantId = $this->request->query["restaurantId"];
	    	if (!empty(trim((string)$restaurantId))  && $this->Restaurant->read(null,$restaurantId)){
	            $queryResult = $this->RestaurantInfo->getDelivery($restaurantId);
	            if ($queryResult !=null){
	                $result = array("error"=>array('code'=>0,'message'=>'Connect successfully'),"contents"=>$queryResult);
	                echo json_encode($result);
	            }else{
	            	$result = array("error"=>array('code'=>404,'message'=>'Connect failed'),"contents"=>null);
	            	echo json_encode($result);
	            }
	        }else{
	            $result = array("error"=>array('code'=>404,'message'=>'Connect failed'), "content"=>null);
	            echo json_encode($result); 
	        }
	        die;
	    }
	    /**
	    * postFeedback the post function
	    * @return json String json success or failed
	    */
	   	public function postFeedback(){
        	$repuestData = (array)$this->request->input('json_decode');
            $feedbackData = (array)$repuestData['feedback']; 

            $user_id = null; $restaurant_id = null; $email = null; $first_name = null; $last_name = null; $phone = null; $content = null;
            $status = true;
           	empty(trim($feedbackData['userId'])) ? $status = false : $user_id = $feedbackData['userId'];
           	empty(trim($feedbackData['restaurantId'])) ? $status = false : $restaurant_id = $feedbackData['restaurantId'];
           	empty(trim($feedbackData['email'])) ? $status = false : $email = $feedbackData['email'];
           	empty(trim($feedbackData['firstName'])) ? $status = false : $first_name = $feedbackData['firstName'];
           	empty(trim($feedbackData['lastName'])) ? $status = false : $last_name = $feedbackData['lastName'];
           	empty(trim($feedbackData['phone'])) ? $status = false : $phone = $feedbackData['phone'];
           	empty(trim($feedbackData['content'])) ? $status = false : $content = $feedbackData['content'];
           	
           	if(count($status) && $this->User->isExitsUserIntoRestaurant($user_id,$restaurant_id)){
           		$data = array(
           		'user_id' => $user_id,
           		'restaurant_id' => $restaurant_id,
           		'email' => $email,
           		'first_name' => $first_name,
           		'last_name' => $last_name,
           		'phone' => $phone,
           		'content' => $content,
	           	);
	           	if($this->FeedBack->saveFeeBack($data)){
					$result = array("error"=>array('code'=>0,'message'=>'Connect success'));
					echo json_encode($result);
				}
				else{
					$result = array("error"=>array('code'=>404,'message'=>'Connect failed'));
					echo json_encode($result);
	           	}
	        }
           	else{
           		$result = array("error"=>array('code'=>404,'message'=>'Connect failed'));
				echo json_encode($result);
           	}
           	die;        	        
        }
	    //End vpLuan
	}
?>
