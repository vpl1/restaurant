<?php
App::uses('AppModel','Model');

class imgfolders extends AppModel
{
    public function GetAllUsers()
    {
         return $this-> find('first');
    }
    public function Insert($img)
    {
        $this->save( 
        array(
        'Img' => $img
        )
    );
    }
}
?>