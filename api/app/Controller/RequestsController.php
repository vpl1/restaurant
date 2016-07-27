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
	    	$this->LoadModel("User");
	        $this->LoadModel("Restaurant");
	        $this->LoadModel("Food");
	        $this->LoadModel("FoodReview");
	    }

	    // Start vpLuan
	    public function index(){

	    }
	    public function getListFavorites(){
	    	$restaurantId = $this->request->query["restaurantId"];
			$userId = $this->request->query["userId"];
			//$restaurantId = 1;
			//$userId = 1;
 			if(!empty(trim(((string)$restaurantId))) && !empty(trim((string)$userId))){
				$queryResult = $this->Food->getFoodFavorites($userId,$restaurantId);
				//pr($queryResult); exit();
				if($queryResult != null){
					foreach ($queryResult as $key => $value) {
						$listFoods[] = array(
							'id'=> $value['Food']['id'],
						    'imageUrl' => $value['Food']['image_url'],
						    'rateString' => $this->FoodReview->getRateString($value['Food']['id']),
						    'name'=> $value['Food']['name'],
						    'price' => $value['Food']['price'],
						    'sale' => $value['Food']['sale'],
						    'discount' => $value['Food']['discount'],
						    'type' => $value['Food']['type']
						);
					}
					$result = array("error"=>array('code'=>0,'message'=>'Connect successfully'), "listFoods"=>$listFoods);
                	echo json_encode($result);
				}
				else{
					$result = array("error"=>array('code'=>0,'message'=>'Connect successfully'), "listFoods"=>null);
            		echo json_encode($result);
				}
			}
			else{
				$result = array("error"=>array('code'=>404,'message'=>'Connect failed'), "listFoods"=>null);
            	echo json_encode($result); 
			}
	    }

	    public function getDeliveryProcess($restaurantId)
	    {
	    	
	    }
	    //End vpLuan
	}
?>
