<?php
/*--------------------------------------------------------------------------------------------------------------------------
|
|	CORE CLASSES
|
|---------------------------------------------------------------------------------------------------------------------------
|
|	Core classes for global data injection and/or managing 
|	user authentication
|
*--------------------------------*/

abstract class MY_Controller extends CI_Controller{

	protected $_twigConfig = [];

	protected $data = [];

	public function __construct(){
		parent::__construct();

		$this->data['title'] = APP_NAME;				
		$this->load->library('session');
		$this->setTwigConfig();
	}

	private function setTwigConfig(){
		$this->_twigConfig = [
			'functions' => ['twig_helper']
		];

		$this->load->library('twig', $this->_twigConfig);
		$this->twig->addGlobal('session', $this->session);
	}

	public function __call($method, $params){
		if(strpos($method, 'set') !== false) {
			$inject_params = [];
			foreach ($params as $param) {
				if(is_array($param)) {
					$inject_params += $param;
				} else {
					$inject_params = $param;
				}
			} 

    		$this->data[str_replace('set', '', strtolower($method))] = $inject_params; 
			$this->twig->addGlobal('data', $this->data);
    	}

    	return $this;
	}
	
	public function _remap($method, $params = array())
	{
        if (!method_exists($this, $method)) {
        	if(strpos($method, 'set') !== false) {
        		$this->data[str_replace('set', '', strtolower($method))] = $params; 
				$this->twig->addGlobal('data', $this->data);

        	} else {
	        	$this->data['error'] = ['type' => 'Route exception', 'message' => 'Page doesn\'t exists!'];    		
				$this->twig->addGlobal('data', $this->data);
				return call_user_func_array([$this, 'index'], $params);
        	}

        } else{
			return call_user_func_array([$this, $method], $params);
        }
	}

	// protected function setBreadCrumbs($crumbs){

	// 	if(!is_array($crumbs)) {
	// 		$this->data['breadcrumbs'][$crumbs] = $crumbs;
	// 	} else {
	// 		$this->data['breadcrumbs'] += $crumbs;
	// 	}

	// 	$this->twig->addGlobal('data', $this->data);
	// 	// $this->data['breadcrumbs'] = $inject_crumbs;
	// }

	// protected function setTitle($title){
	// 	$this->data['title'] = $title.' - '.APP_NAME;
	// 	$this->twig->addGlobal('data', $this->data);
	// }

	// protected  

	abstract protected function setAuth();
}