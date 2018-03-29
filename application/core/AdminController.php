<?php
class AdminController extends MY_Controller {

	protected $_modal_data = [];

	function __construct() {
		parent::__construct();
	}

	protected function modal($view, $options = null){

		echo json_encode([
			'status' => true,
			'modal' => $this->twig->render('backend/modals/'.$view, $this->_modal_data)
		]);
	}

	protected function setAuth(){
		// $this->aauth->create_perm('backend');		
		if(!$this->aauth->is_loggedin() && (!$this->aauth->is_admin() || !$this->aauth->is_member('Super admin')) ){
			$this->data['error'] = ['type' => 'Permission exception', 'message' => 'Not authorized to view this page!'];    		
			$this->twig->addGlobal('data', $this->data);
			return call_user_func_array([$this, 'index'], $params);
		}
	}

	protected function setOutput(){
		
		$this->data['error'] = ['type' => 'Permission exception', 'message' => 'Not authorized to view this page!'];    		
		$this->twig->addGlobal('data', $this->data);
		return $this->index();
	}
}