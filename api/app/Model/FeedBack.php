<?php
App::uses('AppModel', 'Model');

class FeedBack extends AppModel{
    var $name = "FeedBack";
    var $useTable = "b_feedback";

	public function saveFeeBack($fbData=null){
		if($fbData != null){
			$this->create();
			$this->save($fbData)["FeedBack"];
			return true;	
		}
		return null;
	}
}
