<?php
App::uses('AppModel', 'Model');

class AddressType extends AppModel{

	public $useTable = "c_address_type";
	public function AddressTypeById($id)
    {
        return $this->find('first',array('conditions'=>array('id'=>$id)))['AddressType'];
    }
}