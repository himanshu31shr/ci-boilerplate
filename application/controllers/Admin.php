<?php

class Admin extends AdminController
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->load->model('Test');
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

	public function test(){
		$data = ['modal' => $this->twig->render('backend/modals/test'), 'status' => true];
		echo json_encode($data);
	}
}