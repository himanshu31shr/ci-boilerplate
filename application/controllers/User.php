<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

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