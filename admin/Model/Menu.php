<?php
App::uses('AppModel', 'Model');

class Menu extends AppModel{
    
    var $name = "Menu";

    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'This field is required'
            )
        )
    );
}
