<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Model {

    protected $table = 'user';

    public function __construct(){
        parent::__construct();
    }
	
}