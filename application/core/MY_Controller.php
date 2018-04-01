<?php
/*--------------------------------------------------------------------------------------------------------------------------
|
|	CORE CLASS
|
|---------------------------------------------------------------------------------------------------------------------------
|
|	Core classes for global data injection and/or managing 
|	user authentication, twig and other configuration
|
|	@author Himanshu Shrivastava <himanshu31shr@gmail.com>
|	@package CI-Boilerplate
*--------------------------------*/

abstract class MY_Controller extends CI_Controller{

	protected $_twigConfig = [];

	protected $data = [];

	public function __construct(){
		parent::__construct();

		$this->setAuth();
		$this->data['title'] = APP_NAME;				
		$this->load->library('session');
		$this->setTwigConfig();
	}

	/**
	 * Sets twig configuration
	 */
	protected function setTwigConfig(){
		$this->_twigConfig = [
			'functions' => ['twig_helper']
		];

		$this->load->library('twig', $this->_twigConfig);
		$this->twig->addGlobal('session', $this->session);
		$this->twig->addGlobal('user', $this->aauth->get_user());
	}

	/**
	 * Inverts undefined methods and binds data with the 
	 * caller name to twig views as global variables.
	 *  
	 * @param  string $method 
	 * @param  array $params 
	 * @return object
	 */
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
    	} else {
			return call_user_func_array([$this, $method], $params);
        }

    	return $this;
	}

	/**
	 * Returns modal view, provided view name.
	 * 
	 * @param  string 		$view    View name
	 * @param  string|int 	$options Optional argument for passing config var
	 * @return json
	 */
	abstract protected function modal($view, $options = null);

	/**
	 * Checks logged user
	 */
	abstract protected function setAuth();
}