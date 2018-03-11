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
}