<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*-------------------------------------------------------------------------------------------------------------------
|
|	CORE MODEL v0.1b
|
|--------------------------------------------------------------------------------------------------------------------
|
|	Added function to be called directly through the controller.
|	To use the functionality create a model for every table, extend it to this class.
|	
|	By Default the primary key set to 'id' for each table, which can be overriden by
|	specifyig a value in the primaryId property in the child model.
|
|	@author Himanshu Shrivastava <himanshu31shr@gmail.com>
|	@package CI-BoilerPlate
|
*------------------------------------------------------------------------------------------------------------------*/
use \Illuminate\Database\Eloquent\Model as Eloquent;

abstract class MY_Model extends Eloquent {
	
}