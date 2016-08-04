<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

class NotificationsController extends AppController {

    public $components = array("RequestHandler");

    /*
     *   Function beforeFilter begin when call Controller
     *   Useful: Import Model
     */

    public function beforeFilter() {
        $this->loadModel("BNotificationRestaurant");
        $this->loadModel("BRestaurantComment");
    }

    //xuan_hoang
    /*
     *   function getListNotification: get List Notification
     *   METHOD: GET
     *   Author Xuan Hoang
     *   API: 21
     */
    public function getListNotification() {

    	$restaurantId = null; $userId = null;
        if(isset($this->request->query["restaurantId"]) && isset($this->request->query["userId"]))
        {
        	$restaurantId = $this->request->query["restaurantId"];
        	$userId = $this->request->query["userId"];
        }

        if($restaurantId && $userId){
            $listNotificationRestaurants = null;
            $listNotificationComments = null;

        	$resultlistNotificationRestaurants = $this->BNotificationRestaurant->getAllNotificationByRestaurantId($restaurantId);
            $resultlistNotificationComments = $this->BRestaurantComment->getAllCommentByUserId($userId);

            foreach($resultlistNotificationRestaurants as $Notification){
                $Notification = $Notification["BNotificationRestaurant"];
                $Notification["type"] = $Notification["type"] == true?1:0;
                unset($Notification["time"],$Notification["target_content_id"],$Notification["restaurant_id"]);
                $listNotificationRestaurants[] = $Notification;
            }

            foreach($resultlistNotificationComments as $Notification){
                $listNotificationComments[] = array(
                    "id"        =>$Notification["BRestaurantComment"]["id"],
                    "content"   =>$Notification["BRestaurantComment"]["content"],
                    "firstName" =>$Notification["User"]["first_name"],
                    "lastName"  =>$Notification["User"]["last_name"],
                    "reviewId"  =>$Notification["BRestaurantComment"]["review_id"],
                    "time"      =>$this->time_elapsed_string(strtotime($Notification["BRestaurantComment"]["date"]))
                );
            }
            echo json_encode(array("error"=>array("code"=>0,"message"=>"Connect successfully"),"listNotificationRestaurants"=>$listNotificationRestaurants,"listNotificationComments"=>$listNotificationComments));
        }else{
            echo json_encode(array("error"=>array("code"=>404,"message"=>"Connection Failed"),"listNotificationRestaurants"=> null, "listNotificationComments"=> null));
        }
        die;
    }

    /*
     *   function getCountNotificationNew: get Notification
     *   METHOD: GET
     *   Author Xuan Hoang
     *   API: 22
     */
    public function getCountNotificationNew() {
        $restaurantId = null; $userId = null;
        if(isset($this->request->query["restaurantId"]) && isset($this->request->query["userId"]))
        {
            $restaurantId = $this->request->query["restaurantId"];
            $userId = $this->request->query["userId"];
        }

        if($restaurantId && $userId){
            $count = $this->BNotificationRestaurant->getCountNotificationNew($restaurantId, $userId);
        }else{

        }
        die;

    }

    /*
     *   function setNotificationReadStatus: set Notification Read Status
     *   METHOD: GET
     *   Author Xuan Hoang
     *   API: 23
     */
    public function setNotificationReadStatus() {
        $restaurantId = null; $userId = null; $notifyId = null;
        if(isset($this->request->query["restaurantId"]) && isset($this->request->query["userId"]) && isset($this->request->query["notifyId"]))
        {
            $restaurantId = $this->request->query["restaurantId"];
            $userId = $this->request->query["userId"];
            $notifyId = $this->request->query["notifyId"];
        }
        if($restaurantId && $userId && $notifyId){

        }else{

        }
        die;
    }

    /*
     *   function getSettingNotification: get Setting Notification
     *   METHOD: GET
     *   Author Xuan Hoang
     *   API: 26
     */
    public function getSettingNotification() {
        $restaurantId = null; $userId = null;
        if(isset($this->request->query["restaurantId"]) && isset($this->request->query["userId"]))
        {
            $restaurantId = $this->request->query["restaurantId"];
            $userId = $this->request->query["userId"];
        }
        if($restaurantId && $userId){

        }else{

        }
        die;
    }

    /*
     *   function SetSettingNotification: set Setting Notification
     *   METHOD: GET
     *   Author Xuan Hoang
     *   API: 27
     */
    public function SetSettingNotification() {
        $restaurantId = null; $userId = null; $allow = null;
        if(isset($this->request->query["restaurantId"]) && isset($this->request->query["userId"]) && isset($this->request->query["allow"]))
        {
            $restaurantId = $this->request->query["restaurantId"];
            $userId = $this->request->query["userId"];
            $allow = $this->request->query["allow"];
        }
        if($restaurantId && $userId && $allow){

        }else{

        }
        die;
    }
    //end xuan_hoang
}