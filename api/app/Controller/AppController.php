<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::import('Jwt', 'Jwt');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	private $secretKey = "brycen@copyright2016";

	public function beforeFilter(){
  		$this->LoadModel("User");
	}

	protected function getSecretKey(){
		return $this->secretKey;
	}

	protected function decodeJWT($JWT = null){
		try{
			if($JWT){
				$decode = Jwt::decode($JWT, $this->getSecretKey(), array('HS256'));
				$decode = (array)(json_decode(json_encode($decode)));
				$user = $this->User->Login($decode["restaurantId"], $decode["userName"], $decode["password"]);
				if(count($user)){
					return json_encode(array('status'=>true,'userId'=>$user["userId"],'restaurantId'=>$decode["restaurantId"]));
				}
			}
			return null;
		}catch(Exception $ex){
			return json_encode("error", $ex->getMessage());
		}
	}

	function time_elapsed_string($ptime){
		$etime = time() - $ptime;

		if($etime<1){
			return '0 seconds';
		}

		$a = array(365 * 24 * 60 * 60 => 'year',
			30 *25 * 60 *60 => 'month',
			24 * 60 * 60 => 'day',
			60 * 60 => 'hour',
			60 => 'minute',
			1 => 'second'
			);
		$a_plural = array(
			'year'=>'years',
			'month'  => 'months',
            'day'    => 'days',
            'hour'   => 'hours',
            'minute' => 'minutes',
           	'second' => 'seconds'
			);
		foreach($a  as $secs => $str){
			$d = $etime / $secs;
			if($d >= 1){
				$r = round($d);
				return $r.' '.($r>1?$a_plural[$str]:$str).' ago';
			}
		}
	}
	function getGUID(){
		if (function_exists('com_create_guid')){
			return com_create_guid();
		}else{
			mt_srand((double)microtime()*10000);
			$charid = strtoupper(md5(uniqid(rand(), true)));
			$hyphen = chr(45);// "-"
			$uuid = chr(123)// "{"
			.substr($charid, 0, 8).$hyphen
			.substr($charid, 8, 4).$hyphen
			.substr($charid,12, 4).$hyphen
			.substr($charid,16, 4).$hyphen
			.substr($charid,20,12)
			.chr(125);// "}"
			return $uuid;
		}
	}
}
