<?php

class Admin extends AdminController
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->setBreadCrumbs([
				'home' => '', 
				'test' => 'test'
			])
			->setTitle('Dashboard - '.APP_NAME)
			->setMeta([
				'description' => 'Sample'
			])
			->twig->display('backend/dashboard');
	}
}