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

	   		// Receive data from client
	   		// post pramater
        	$repuestData = (array)$this->request->input('json_decode');
            $feedbackData = (array)$repuestData['feedback']; 

            $user_id = null; $restaurant_id = null; 
            // Receive token and decode       
            //$user_id = get from token decod
            //$restaurant_id = query from user_id
            

           	if(checkUser() && !empty(trim($feedbackData['email'])) && !empty(trim($feedbackData['firstName'])) 
           		&& !empty(trim($feedbackData['lastName'])) && !empty(trim($feedbackData['phone'])) 
           		&& !empty(trim($feedbackData['content']))){
           		$data = array(
           			'user_id' => $user_id,
           			'restaurant_id' => $restaurant_id,
	           		'email' => $feedbackData['email'],
	           		'first_name' => $feedbackData['firstName'],
	           		'last_name' => $feedbackData['lastName'],
	           		'phone' => $feedbackData['phone'],
	           		'content' => $feedbackData['content'],
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
