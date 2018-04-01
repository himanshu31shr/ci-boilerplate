<?php
/*----------------------------------------------------------------------------------------------------------------------------------
 |
 |	CORE CONTROLLER FOR GUEST MODULE
 |
 |----------------------------------------------------------------------------------------------------------------------------------
 |
 |	Provides common configuration for all the methods extending the class.
 |	Currently included auth methods and modal method.
 |
 |	@author Himanshu Shrivastava <himanshu31shr@gmail.com>
 |	@package CI-Boilerplate
 */
class GuestController extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
	}

	protected function modal($view, $options = nul){
		
	}

	protected function setAuth(){
		# Do nothing here
	}
}