<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Model {

	protected $primaryKey = 'test_id';

	protected $table = 'test';

	public function __construct(){
		parent::__construct();
	}
	
}