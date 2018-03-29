<?php
class Auth extends GuestController
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		return $this->login();
	}

	public function login(){
		return $this->twig->display('auth/login');
	}

	public function logout(){

	}

	public function register(){
		$this->twig->display('auth/register');
	}

	public function forgot_password(){
		
	}

	public function grantRequest(){
		$data = $this->input->post();
		if($this->aauth->login($data['username'], $data['password'])){
			redirect('admin');
		} else {
			show_error($this->aauth->get_errors_array()[0], 1, 500, 500);
		}
	}
}
	