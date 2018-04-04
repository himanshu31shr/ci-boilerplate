<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends MY_Model {

    protected $table = 'aauth_user_to_group';

    public function __construct(){
        parent::__construct();
    }
	
}