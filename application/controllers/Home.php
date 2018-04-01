<?php
/*----------------------------------------------------------------------------------------------------------------------------------
 |
 |	AUTH CONTROLLER
 |
 |----------------------------------------------------------------------------------------------------------------------------------
 |
 |  Houses common functions for Landing pages
 |
 |	@author Himanshu Shrivastava <himansuthu31shr@gmail.com>
 |	@package CI-Boilerplate
 |
 */
class Home extends GuestController {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->twig->display('backend/dashboard');	
	}
}