<?php
App::uses('Model', 'Model');

class Post extends AppModel {
	public $hasMany = "Post";
    public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'body' => array(
            'rule' => 'notBlank'
        )
    );
}