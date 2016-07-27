<?php
App::uses('AppModel', 'Model');
App::import('AppModel','Restaurant');
class User extends AppModel{
    var $name = "User";
    var $useTable = "s_user";
}
