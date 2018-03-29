<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Variables extends MY_Model {

    protected $table = 'aauth_user_variables';

    public function __construct(){
        parent::__construct();
    }
	
	public function user(){
		return $this->belongsTo('aauth_users', 'user_id', 'id');
	}
}