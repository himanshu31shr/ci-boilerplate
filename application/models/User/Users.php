<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Model {

    protected $table = 'aauth_users';

    public function __construct(){
        parent::__construct();
    }

    public function permissions(){
    	return $this->hasMany('aauth_perm_to_user', 'user_id', 'id');
    }

    public function groups(){
    	return $this->hasMany(Groups::class, 'user_id', 'id');
    }

    public function variables(){
    	return $this->hasMany(Variables::class, 'user_id', 'id');
    }

    public function getFullNameAttribute(){
        $ci =& get_instance();
        return $ci->aauth->get_user_var('first_name', $this->id).' '.$ci->aauth->get_user_var('middle_name', $this->id).' '.$ci->aauth->get_user_var('last_name', $this->id).''; 
    }

    public function getGroupAttribute(){
        $ci =& get_instance();
        $return = [];
        $groups = $ci->aauth->get_user_groups($this->id);
        foreach($groups as $group) {
            $return[] = $group->name;
        }

        return $return;
    }

    public function getVariablesAttribute(){
        $variables = $this->variables()->get();
        $return  = [];
        foreach ($variables as $variable) {
            $return[$variable->data_key] = $variable->value;
        }

        return $return;
    }
}