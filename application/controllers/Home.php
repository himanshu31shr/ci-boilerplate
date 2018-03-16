<?php
class Home extends GuestController {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->load->model('Test');
		echo $this->twig->display('backend/dashboard');	
	}
}