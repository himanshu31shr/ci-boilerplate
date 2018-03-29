<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserPermissions extends MY_Model {

    protected $table = 'aauth_perm_to_user';

    public function __construct(){
        parent::__construct();
    }
	
}