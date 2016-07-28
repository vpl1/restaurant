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
	    }
	    // Start vpLuan
	    public function getDeliveryProcess()
	    {
	    	$restaurantId = $this->request->query["restaurantId"];
	    	if (!empty(trim((string)$restaurantId))  && $this->Restaurant->read(null,$restaurantId) != null){
	            $queryResult = $this->RestaurantInfo->getDelivery($restaurantId);
	            if ($queryResult !=null){
	                $result = array("error"=>array('code'=>0,'message'=>'Connect successfully'),"contents"=>$queryResult);
	                echo json_encode($result);
	            }else{
	            	$result = array("error"=>array('code'=>0,'message'=>'Connect failed'),"contents"=>null);
	            	echo json_encode($result);
	            }
	        }else{
	            $result = array("error"=>array('code'=>404,'message'=>'Connect failed'), "content"=>null);
	            echo json_encode($result); 
	        }
	        die;
	    }

	   	public function postFeedback(){
        	$repuestData = (array)$this->request->input('json_decode');
            $feedbackData = (array)$repuestData['feedback'];        	
           	$data = array(
           		'user_id' => $feedbackData['userId'],
           		'restaurant_id' => $feedbackData['restaurantId'],
           		'email' => $feedbackData['email'],
           		'first_name' => $feedbackData['firstmame'],
           		'last_name' => $feedbackData['lastname'],
           		'phone' => $feedbackData['phone'],
           		'content' => $feedbackData['content'],
           	);
           	$resultquery = $this->FeedBack->saveFeeBack($data);   
           	if($resultquery != null){           		
	        	echo json_encode($resultquery);
           	}
           	die;        	        
        }
	    //End vpLuan
	}
?>
