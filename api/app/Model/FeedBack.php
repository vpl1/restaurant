<?php
App::uses('AppModel', 'Model');

class FeedBack extends AppModel{
    var $name = "FeedBack";
    var $useTable = "b_feedback";

	public function saveFeeBack($fbData=null){
		if($fbData != null){
			$this->create();
			if($this->save($fbData)["FeedBack"]){
				$result = array("error"=>array('code'=>0,'message'=>'Connect success'));
				return $result;
			}
			else{
				$result = array("error"=>array('code'=>0,'message'=>'Connect failed'));
				return $result;
			}			
		}
		return null;
	}
}
