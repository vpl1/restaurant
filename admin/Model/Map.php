<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class Map extends AppModel {
	public $validate = array(
        'address' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A address is required'
            )
        ),
        'title_marker' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A marker title is required'
            )
        ),
       
    );
    
    public function beforeSave($options = array()) {
    }

    public function deleteLocation($locationId = null,$userId = null){
        $conditions = array(
                'Map.id' => $locationId,
                'Map.user_id' => $userId
            );
        $this->deleteAll($conditions);
    }

    public function updateLocation($arrayData = array(),$locationId=null, $userId=null){
        $conditions = array(
                'Map.id' => $locationId,
                'Map.user_id' => $userId
            );
        $this->updateAll($arrayData,$conditions);
    }
    //check restaurant exists
    public function checkRestaurant($userId){
        $conditions = array(
            'conditions' => array(
                'Map.user_id' => $userId
            ));
        $result = $this->find('first', $conditions);
        if (isset($result['Map'])){
            return true;
        }else{
            return false;
        }
    }

}
?>