<?php
/*----------------------------------------------------------------------------------------------------------------------------------
 |
 |	CORE CONTROLLER FOR ADMIN MODULE
 |
 |----------------------------------------------------------------------------------------------------------------------------------
 |
 |	Provides common configuration for all the methods extending the class.
 |	Currently included auth methods and modal method.
 |
 |	@author Himanshu Shrivastava <himanshu31shr@gmail.com>
 |	@package CI-Boilerplate
 */
class AdminController extends MY_Controller {

	protected $_modal_data = [];

	function __construct() {
		parent::__construct();
	}

	/**
	 * Returns modal view, provided view name.
	 * 
	 * @param  string 		$view    View name
	 * @param  string|int 	$options Optional argument for passing config var
	 * @return json
	 */
	protected function modal($view, $options = null){

		echo json_encode([
			'status' => true,
			'modal' => $this->twig->render('backend/modals/'.$view, $this->_modal_data)
		]);
	}

	/**
	 * Checks logged user
	 */
	protected function setAuth(){
		// $this->aauth->create_perm('backend');		
		if(!$this->aauth->is_loggedin() && (!$this->aauth->is_admin() || !$this->aauth->is_member('Super admin')) ){
			show_error('You are not authorized to view this page! <br> Client here to go to the <a href="'.base_url('login').'" >Login</a> Page', 504, '504: Unauthorized access!');
		}
	}

	/**
	 * Return to base path of the current controller with an exception
	 */
	protected function setOutput(){
		parent::setTwigConfig();
		$this->data['error'] = ['type' => 'Permission exception', 'message' => 'Not authorized to view this page!'];    		
		$this->twig->addGlobal('data', $this->data);
		return $this->index();
	}
}