<?php
/*----------------------------------------------------------------------------------------------------------------------------------
 |
 |	CORE CONTROLLER FOR USER MODULE
 |
 |----------------------------------------------------------------------------------------------------------------------------------
 |
 |	Provides common configuration for all the methods extending the class.
 |	Currently included auth methods and modal method.
 |
 |	@author Himanshu Shrivastava <himanshu31shr@gmail.com>
 |	@package CI-Boilerplate
 */
class UserController extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Returns modal view, provided view name.
	 * 
	 * @param  string 		$view    View name
	 * @param  string|int 	$options Optional argument for passing config var
	 * @return json
	 */
	protected function modal($view, $options = nul){
		
	}

	/**
	 * Checks logged user
	 */
	protected function setAuth(){
		if(!$this->aauth->is_loggedin() || !$this->aauth->is_member('user')){
			show_error('You are not authorized to view this page!');
		}
	}
}