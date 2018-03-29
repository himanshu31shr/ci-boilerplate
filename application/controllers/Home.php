<?php
class Home extends GuestController {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->twig->display('backend/dashboard');	
	}
}