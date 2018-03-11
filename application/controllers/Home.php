<?php
class Home extends GuestController
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		echo 'index';
	}
}