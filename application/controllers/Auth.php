<?php
/*----------------------------------------------------------------------------------------------------------------------------------
 |
 |	AUTH CONTROLLER
 |
 |----------------------------------------------------------------------------------------------------------------------------------
 |
 |  Houses common functions for managing authentication of users
 |
 |	@author Himanshu Shrivastava <himansuthu31shr@gmail.com>
 |	@package CI-Boilerplate
 |
 */
class Auth extends GuestController
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Login view
	 */
	public function index(){
		return $this->login();
	}

	/**
	 * Login view
	 */
	public function login(){
		return $this->twig->display('auth/login');
	}

	/**
	 * Clears all session data
	 */
	public function logout(){
		if($this->aauth->logout()){
			return redirect(base_url());
		} else {
			$this->data['error'] = 'Unknown Exception: Unable to perform the operation at the moment!';
			$this->index();
		}
	}

	/**
	 * Register view
	 */
	public function register(){
		$this->twig->display('auth/register');
	}

	/**
	 * Forgot Password view
	 */
	public function forgot_password(){
		
	}

	/**
	 * Logs in users
	 * @return json
	 */
	public function grantRequest(){
		$data = $this->input->post();
		if($this->aauth->login($data['username'], $data['password'])){
			echo json_encode([
				'status' => true,
				'message' => 'Logged in successfully!',
				'goto' => base_url('admin')
			]);
		} else {
			show_error($this->aauth->get_errors_array()[0], 1, 500, 500);
		}
	}

	/**
	 * Registers a new user
	 * @return json
	 */
	public function save(){
		$data = $this->input->post();

		$user_id = $this->aauth->create_user($data['email'], $data['password']);
		if(!$user_id){
			show_error('Whoa! Something went terribly wrong, please try again later.');
		}

		$this->aauth->add_member($user_id, 'user');

		echo json_encode(['status' => true, 'message' => 'Account created successfully!', 'goto' => 'auth/success']);
	}

	/**
	 * Success page
	 */
	public function success(){
		$this->data['success'] = ['type'=>'Account', 'message' => 'Account created successfully!'];
		$this->twig->addGlobal('data', $this->data);
		$this->index();
	}
}
	