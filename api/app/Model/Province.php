<?php
App::uses('AppModel', 'Model');

class Province extends AppModel{

	public $useTable = "c_province";
	var $name = "Province";
	public function getCountryByCountryCode($country_code='')
    {
        $listCountry=$this->find('all', array(
            'conditions' =>array('country_code_id' => $country_code))
        );
        return $listCountry;
    }

    /* 	feature: get province by province id
	*	author : dinh loc pro
    */
    public function ProvinceById($province_id){
    	return $this->find('first',array(
    		'conditions'=>array('id'=>$province_id)))['Province'];
    }
}