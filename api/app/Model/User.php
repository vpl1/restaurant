<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/*
*   class User
*   Author Xuan Hoang
*/
class User extends AppModel{

	public $useTable = "s_user";

	var $name = "User";


	public function Login($restaurantId=null, $userName=null, $password=null){

		if(($restaurantId)&&($userName)&&($password)){
			$user = $this->find('first', array(
				'conditions'=>array(
					'OR'=> array(
						array('User.restaurant_id'=>$restaurantId, 'User.user_name'=>$userName),
						array('User.restaurant_id'=>$restaurantId, 'User.email'=>$userName)
					)
				)
			));
			if(count($user)){
				$blowfish = new BlowfishPasswordHasher();
				$passwordcheck = $blowfish->check($password, $user["User"]["password"]);
				if($passwordcheck == true){
					$this->id = $user["User"]["id"];
					$this->saveField('last_login_time', date('Y-m-d H:i:s'));
					return array("userId"=>$user["User"]["id"],"firstName"=>$user["User"]["first_name"],"lastName"=>$user["User"]["last_name"]);
				}				
			}			
		}
		return null;
	}

	public function Register($restaurantId = null, $userName = null, $password = null, $firstName = null, $social = null){

		if(($restaurantId) && ($userName) && ($password) && ($firstName)){
			$user = $this->find('first', array(
				'conditions'=>array('User.restaurant_id'=>$restaurantId, 'User.email'=>$userName)
			));
			if(!count($user)){
				$user = array(
					'user_name'			=>	$userName, 
					'password'			=>	BlowfishPasswordHasher::hash($password),
					'first_name'		=>	$firstName,
					'email'				=>	$userName,
					'restaurant_id'		=>	$restaurantId,
					'province_id'		=>	0
				);
				$this->create();
				$result = $this->save($user);
				if(count($result)){
					return $result;
				}
			}
		}
		return null;
	}

	public function Logout($restaurantId = null, $userId = null){
		if(($restaurantId) && ($userId)){
			$user = $this->find('first', array('conditions'=>array('User.id'=>$userId, 'User.restaurant_id'=>$restaurantId)));
			if(count($user)){
				$result = $this->updateAll(array("logout_time"=> '"'.date("Y-m-d H:i:s").'"'), array('id'=>$userId, 'restaurant_id'=>$restaurantId));
				return $result;
			}		
		}
		return false;
	}

	public function GetUserbyIdAndRestaurantId($userId = '', $restaurantId =''){

		if( !(empty(trim((string)$userId)) && empty(trim((string)$restaurantId)))){
			return $this->find('first',array(
				'joins'=>array(
					array(
						'table'=>'c_province',
						'alias'=>'Province',
						'type'=>'INNER',
						'conditions'=> array(
							'`Province.id` = `User.province_id`'
						)
					)
				),
				'fields' => array('User.*', 'Province.*'),
				'conditions'=>array('User.id'=>$userId, 'User.restaurant_id'=> $restaurantId))
			);
		}

		return null;
	}

	public function EditProfile($userData=null){

		if($userData != null){
			$CurrentUser = $this->find('first', array(
				'conditions'=>array('User.id'=>$userData["id"], 'User.restaurant_id'=>$userData["restaurant_id"])
				)
			);

			if(count($CurrentUser)){
				$this->set($userData);
				try{
					$result = $this->save($userData)["User"];
					$ReturnUser = array('firstName'=>$result["first_name"],'lastName'=>$result["last_name"]);
					return $ReturnUser;
				}catch(Exception $e){
					return "Save User Failed, Because Invalid User Data, Please try again";
				}				
			}
		}

		return null;
	}

	//d_loc
	public function updatePassword($user_id,$new_password,$old_password){
		$existing= $this->query('SELECT COUNT(s_user.id) as \'count\' FROM s_user WHERE id='.$user_id.' and s_user.password='.$old_password);
		if($existing[0][0]['count']>0){
			$this->query('UPDATE s_user SET s_user.password=\''.$new_password.'\' WHERE s_user.id='.$user_id.' and s_user.password='.$old_password);
			return 'Update is successfully';
		}
		else{
			return 'user or password is incorrect';
		}
	}

	//end d_loc

	public function test(){
		$user = $this->find('first', array('conditions'=>array('User.id'=>2)));
		print_r($user);
	}
}