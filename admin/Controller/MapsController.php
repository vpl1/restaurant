<?php

App::uses('AppController', 'Controller');

class MapsController extends AppController {

    
    public function index() {
        $userId = AuthComponent::user('id');
        $data = $this->Map->findAllByUserId($userId);
        $this->set('data',$data);
        
    }

    public function add(){
        $userId = AuthComponent::user('id');
        if ($this->request->is('post') || $this->request->is('put')) {
            $requestData = $this->request->data;
            $adDress = $requestData['Map']['address'];
            $titleMarker= $requestData['Map']['title_marker'];
            if (isset($adDress)){
                try {
                    $latitude = $this->getLatLong($adDress)['lat'];
                    $longitude = $this->getLatLong($adDress)['lng'];
                    $arrFirst = Array
                    ( 'Map' =>(
                        Array
                        (
                        'address' => $adDress,
                        'title_marker' => $titleMarker,
                        'lat' =>$latitude,
                        'lng' =>$longitude,
                        'user_id' =>$userId
                        ))
                    );
                    $this->Map->create();
                    $this->Map->save($arrFirst);
                    $this->Flash->success(__('The location has been save'));
                    return $this->redirect(array('action' => 'index'));
                } catch (Exception $e) {
                    $this->Flash->error(__('May be your address not true, try again'));
                }
            }
        }   
    }
    public function edit($id =null){
        $userId = AuthComponent::user('id');
        if(!$this->Map->exists($id)){
            throw new NotFoundException(__("Invalid Location"));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $requestData = $this->request->data;
            $adDress = $requestData['Map']['address'];
            $titleMarker= $requestData['Map']['title_marker'];
            if (isset($adDress)){
                try {
                    $latitude = $this->getLatLong($adDress)['lat'];
                    $longitude = $this->getLatLong($adDress)['lng'];
                    $arrFirst = Array
                    ( 
                        'address' => "'$adDress'",
                        'title_marker' => "'$titleMarker'",
                        'lat' =>$latitude,
                        'lng' =>$longitude
                    );
                    $this->Map->updateLocation($arrFirst,$id,$userId);
                    $this->Flash->success(__('The location has been updated'));
                    return $this->redirect(array('action' => 'index'));

                } catch (Exception $e) {

                    echo $e->getMessage();
                }
            }
        }else{
           $this->request->data = $this->Map->find('first', array('conditions' => array('Map.id' => $id,
                'Map.user_id' => $userId)));
           $this->set('data',$this->request->data);
        }
        
    }
    public function delete($id = null){
        $this->Map->id = $id;
        $userId = AuthComponent::user('id');
        $this->Map->deleteLocation($id,$userId);
        return $this->redirect(array('action' => 'index'));
    }

    //get Latitude & Longitude from address 
	function getLatLong($address) {
        $array = array();
        try {
            $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
            // We convert the JSON to an array
            $geo = json_decode($geo, true);

            // If everything is cool
            if ($geo['status'] = 'OK') {
            $latitude = $geo['results'][0]['geometry']['location']['lat'];
            $longitude = $geo['results'][0]['geometry']['location']['lng'];
            $array = array('lat'=> $latitude ,'lng'=>$longitude);
            return $array;
        }
        } catch (Exception $e) {
            return false;
        }
	}
}