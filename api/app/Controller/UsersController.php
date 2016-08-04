<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::import('Jwt', 'Jwt');
class UsersController extends AppController {

    public $components = array("RequestHandler");

    /*
     *   Function beforeFilter begin when call Controller
     *   Useful: Import Model
     */

    public function beforeFilter() {
      $this->loadModel("DeviceToken");
  		$this->autoRender = false;
    }


    // d_loc
    /*
     *   function getProfile: get email and then send password to this email
     *   METHOD: POST
     *   Author: Dinh Loc
     *   API: 33
     */
    public function sendForgotPassword(){
      /* initialize the response data
         */
        $response = array(
            'error' => array(
                'code' => 0,
                'message' => ""
            )
        );
        $message ='';
        /* get user have this res id and this email
        * if existing, send the pswd to this email
        */
        if(isset($_GET['restaurantId']) && isset($_GET['email'])){
        $user=  $this->User->find('all', array(
              'conditions' => array('email' => $_GET['email'],'restaurant_id'=>$_GET['restaurantId'])
          ));
        if(count($user)>0){
          $message= 'Sent an email to your email for get password';
      //    $msg_to_email= "Your password is \'".$user[0]['User']['password']."\'";
      //    $msg_to_email = wordwrap($msg_to_email,70);

      //    $to = "khikho93@hotmail.com";
        // $subject = "restaurant - password";
        // $headers = "From: khikho92@hotmail.com" . "\r\n" .;

        // mail($to,$subject,$msg_to_email,$headers);
        }
        else{
          $message="don't have this user to send the password";
        }
        }
        else{
          $message = 'restaurantId or email is null';
        }
        $response['error']['message']= $message;
        echo json_encode($response);
    }

    //end d_loc

	   /*
     *   function getProfile: change password for a user
     *   METHOD: POST
     *   Author: Dinh Loc
     *   API: 30
     */
    public function postChangePassword(){
     /* initialize the response data
         */
        $response = array(
            'error' => array(
                'code' => 0,
                'message' => "Failed to update this user info"
            )
        );

        /* check the post data existing
         * get user id, old pswd, new pswd
         * compare old pswd and user
         * replace new paswd to old pswd if 'true'
         */
        $requests = $this->request->data;
        if($requests){
      		$update_result= $this->User->updatePassword($requests['userId'],$requests['newPassword'],$requests['currentPassword']);
      		$response['error']['message']=$update_result;
        }
        else{
         	$response['error']['message']="No have the post parameters in this request!";
         	$response['error']['code'] =404;
        }
        echo json_encode($response);
    }
    //end d_loc

    // xuan_hoang
    /*
     *   function getProfile: return profile by userId and restaurantId
     *   METHOD: GET
     *   Author Xuan Hoang
     *   API: 6
     */
    public function getProfile() {
        if (!empty($this->request->query['restaurantId'])) {
           $restaurantId = $this->request->query["restaurantId"];
        }
        if (!empty($this->request->query['restaurantId'])) {
           $userId = $this->request->query["restaurantId"];
        }
        if (!(empty(trim((string) $restaurantId)) || empty(trim((string) $userId)))) {
            $user = null;
            $queryResult = $this->User->GetUserbyIdAndRestaurantId($userId, $restaurantId);

            if ($queryResult != null) {
                $user = array(
                    'userName' => $queryResult["User"]['user_name'],
                    'firstName' => $queryResult["User"]['first_name'],
                    'lastName' => $queryResult["User"]['last_name'],
                    'gender' => $queryResult["User"]['gender'],
                    'birthday' => $queryResult["User"]['birthday'],
                    'participateDate' => $queryResult["User"]['participate_date'],
                    'province' => isset($queryResult["Province"]['parent_id']) ? $queryResult["Province"]['parent_id'] : '',
                    'district' => $queryResult["User"]['province_id'],
                    'address' => $queryResult["User"]['address'],
                    'phone' => $queryResult["User"]['phone'],
                    'email' => $queryResult["User"]['email']
                );
            }

            $result = array("error" => array('code' => 0, 'message' => 'Connect successfully'), "user" => $user);
            echo json_encode($result);
        } else {
            $result = array("error" => array('code' => 404, 'message' => 'Connect failed'), "user" => null);
            echo json_encode($result);
        }
        die;
    }

    /*
     *   function postProfile: update User Profile
     *   METHOD: POST
     *   Author Xuan Hoang
     *   API: 7
     */
    public function postProfile() {
        if ($this->request->is('post')) {
            $user = null;
            if (isset($this->request->data["user"]))
                $user = $this->request->data["user"];
            if (count($user)) {

                $editUser = array(
                    'id' => $user["userId"],
                    'first_name' => $user["firstName"],
                    'last_name' => $user["lastName"],
                    'gender' => $user["gender"],
                    'birthday' => date('Y-m-d', strtotime($user["birthday"])),
                    'participate_date' => date('Y-m-d', strtotime($user["participateDate"])),
                    'province_id' => $user["district"],
                    'address' => str_replace('\\', '', $user["address"]),
                    'phone' => $user["phone"],
                    'email' => $user["email"],
                    'restaurant_id' => $user["retaurantId"],
                );
                $result = $this->User->EditProfile($editUser);
                if (count($result)) {
                    echo json_encode(array("error" => array("code" => 0, "message" => "Connection successfully"), "user" => $result));
                } else {
                    echo json_encode(array("error" => array("code" => 404, "message" => "Connection successfully"), "user" => $result));
                }
            } else {
                echo json_encode(array("error" => array("code" => 404, "message" => "Connection failed"), "user" => null));
            }
            die;
        }
    }

    /*
     *   function postLogin: Login
     *   METHOD: POST
     *   Author Xuan Hoang
     *   API: 31
     */
    public function postLogin() {
        if ($this->request->is('post')) {

            $restaurantId = null; $userName = null; $password = null; $deviceToken = null;

            if (isset($this->request->data["restaurantId"]) && isset($this->request->data["userName"]) && isset($this->request->data["password"])){
                $restaurantId = $this->request->data["restaurantId"];
                $userName = $this->request->data["userName"];
                $password = $this->request->data["password"];                
            }

            if(isset($this->request->data["deviceToken"])){
                $deviceToken = $this->request->data["deviceToken"];
            }

            if (($restaurantId) && ($userName) && ($password)) {
                try{
                    $user = $this->User->Login($restaurantId, $userName, $password);
                    if(!count($user)){
                        throw new Exception('No have User return');
                    }                        

                    $dataToken = array(
                        "iss" => "brycen",
                        "iat" => time(),
                        "exp" => time() + (2000 * 60 * 60),
                        "restaurantId"  =>$restaurantId,
                        "userName"      =>$userName,
                        "userId"        => $user["userId"],
                        "firstName"     => $user["firstName"],                        
                        "lastName"      => $user["lastName"],
                        "password"      => $password,
                    );

                    $token = Jwt::encode($dataToken, $this->getSecretKey());                  

                    if($deviceToken){
                        $test = $this->DeviceToken->setDeviceToken($deviceToken, $user["userId"], $restaurantId);
                    }
                    $decode = $this->decodeJWT($token);

                    $user["token"] = $token;                    
                    unset($user["userId"]);                    
                    echo json_encode(array("error" => array("code" => 0, "message" => "Connection successfully"), "user" => $decode));
                }catch(Exception $ex){
                    echo json_encode(array("error" => array("code" => 0, "message" => "Connection failed"), "user" => $ex->getMessage()));
                }
            } else {
                echo json_encode(array("error" => array("code" => 403, "message" => "Connection failed"), "user" => null));
            }
            die;
        }
    }

    /*
     *   function postRegister: Register
     *   METHOD: POST
     *   Author Xuan Hoang
     *   API: 32
     */
    public function postRegister() {
        if ($this->request->is('post')) {

            $restaurantId = null; $userName = null; $password = null; $firstName = null; $social = null;

            if (isset($this->request->data["restaurantId"]) && isset($this->request->data["userName"]) && isset($this->request->data["password"]) && isset($this->request->data["firstName"])){
                $restaurantId = $this->request->data["restaurantId"];
                $userName = $this->request->data["userName"];
                $password = $this->request->data["password"];
                $firstName = $this->request->data["firstName"];
            }

            if (isset($this->request->data["social"]))
                $social = $this->request->data["social"];

            if (($restaurantId) && ($userName) && ($password) && ($firstName)) {

                if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
                    $user = $this->User->Register($restaurantId, $userName, $password, $firstName, $social);
                    if (count($user)) {
                        echo json_encode(array("error" => array("code" => 0, "message" => "Connection successfully"), "user" => $user));
                    } else {
                        echo json_encode(array("error" => array("code" => 404, "message" => "Cannot create this account"), "user" => null));
                    }
                } else {
                    echo json_encode(array("error" => array("code" => 404, "message" => "Email not Validate"), "user" => null));
                }
            } else {
                echo json_encode(array("error" => array("code" => 404, "message" => "Connection failed"), "user" => null));
            }
            die;
        }
    }

    /*
     *   function getLogout: Logout
     *   METHOD: GET
     *   Author Xuan Hoang
     *   API: 34
     */
    public function getLogout() {
        $restaurantId = null;
        $userId = null;

        if (isset($this->request->query["restaurantId"]))
            $restaurantId = $this->request->query["restaurantId"];
        if (isset($this->request->query["userId"]))
            $userId = $this->request->query["userId"];

        if (!( empty(trim((string) $restaurantId)) || empty(trim((string) $userId)) )) {
            $result = $this->User->Logout($restaurantId, $userId);
            if ($result) {
                echo json_encode(array("error" => array("code" => 0, "message" => "Connection Successfully")));
                die;
            }
        }
        echo json_encode(array("error" => array("code" => 404, "message" => "Connection failed")));
        die;
    }
    

    public function testDecodeJwt(){
        if($this->request->is('post')){
          /*$token = $this->request->data["token"];
          $decode = Jwt::decode($jwt, $this->getSecretKey(), array('HS256'));
          echo json_encode(array("decode"=>$decode));*/
          $token = $this->request->header('token');
          echo json_encode(array("decode"=>$token));
        }
    }

    public function testJWT(){
        $key = "1234";
        $token = array(
            "userId" => "1",
            "userName" => "testusername",
            "startTime" => time(),
            "exprideTime" => time() + (2 * 60 * 60)
        );

        $jwt = Jwt::encode($token, $key);
        $decode = Jwt::decode($jwt, $key, array('HS256'));
        echo json_encode(array("encode"=>$jwt,));
        echo json_encode(array("decode"=>$decode));
        die;
    }
    //end xuan_hoang

    public function test(){
      $this->User->test();
    }



}