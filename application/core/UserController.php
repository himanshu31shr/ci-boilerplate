<?php
class UserController extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	protected function modal($view, $options = nul){
		
	}

	protected function setAuth(){
		if(!$this->aauth->is_loggedin() || !$this->aauth->is_member('user')){
			show_error('You are not authorized to view this page!');
		}
	}
}