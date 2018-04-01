<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/*----------------------------------------------------------------------------------------------------------------------------------
 |
 |	AUTH CONTROLLER
 |
 |----------------------------------------------------------------------------------------------------------------------------------
 |
 |  Houses common functions for managing User module
 |
 |	@author Himanshu Shrivastava <himansuthu31shr@gmail.com>
 |	@package CI-Boilerplate
 |
 */
class User extends UserController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/User
	 *	- or -
	 * 		http://example.com/index.php//index
	 *
	 * Required method for remapping default route		
	 */
	public function index()
	{
		echo 'Dashboard';
	}
}