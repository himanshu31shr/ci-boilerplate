<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*-------------------------------------------------------------------------------------------------------------------
|
|	CORE MODEL
|
|--------------------------------------------------------------------------------------------------------------------
|	
|	Integrated eloquent ORM.
|
|	@author Himanshu Shrivastava <himanshu31shr@gmail.com>
|	@package CI-BoilerPlate
|
*/
use \Illuminate\Database\Eloquent\Model as Eloquent;

abstract class MY_Model extends Eloquent {}