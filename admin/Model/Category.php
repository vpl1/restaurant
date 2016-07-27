<?php
App::uses('AppModel', 'Model');

class Category extends AppModel{
    
    var $name = "Category";

    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'This field is required'
            )
        )
    );
}
