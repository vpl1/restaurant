<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

class RequestsController extends AppController {

    public $uses = array('Menu');
    public $helpers = array("Html", "Form");
    public $components = array("RequestHandler");

    /*
     *   Function beforeFilter begin when call Controller
     *   Useful: Import Model
     */

    public function beforeFilter() {
       
        $this->LoadModel("User");
        $this->LoadModel("Province");
        $this->LoadModel("Restaurant");
        $this->autoRender = false;
    }

    //start h_ha
    public function getListProvinces() {
        if(isset($_GET['RestaurantId']) && trim($_GET['RestaurantId']) != '')
        {
            $parameter = $this->request->query["RestaurantId"];
            $country_code = $this->Restaurant->getCountryCodeByRestaurantId($parameter);
            $allProvinces=$this->Province->getCountryByCountryCode($country_code["Restaurant"]["country_code_id"]);
            $listProvinces = null;
            foreach ($allProvinces as $valueParent) {
                if ($valueParent["Province"]['parent_id'] == 0) {
                    $objectProvinceParent = null;
                    $objectProvinceParent["id"] = $valueParent["Province"]["id"];
                    $objectProvinceParent["name"] = $valueParent["Province"]["name"];
                    foreach ($allProvinces as $valueChild) {
                        if ($valueChild["Province"]['parent_id'] == $valueParent["Province"]['id']) {
                            $objectProvinceChild["id"] = $valueChild["Province"]["id"];
                            $objectProvinceChild["name"] = $valueChild["Province"]["name"];
                            $objectProvinceParent["listDistricts"][] = $objectProvinceChild;
                        }
                    }
                    $listProvinces[] = $objectProvinceParent;
                }
            }
            if ($allProvinces != null) {
                $result = array("error" => array('code' => 0, 'message' => 'Connect successfully'), "listProvinces" => $listProvinces);
                echo json_encode($result);
            } else {
                $result = array("error" => array('code' => 404, 'message' => 'Connect failed'), "listProvinces" => null);
                echo json_encode($result);
            }
        }
         die;   
    }
    //end h_ha


}
