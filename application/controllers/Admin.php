<?php

class Admin extends AdminController {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('User/Users');
	}

	public function index(){
		$this->setBreadCrumbs([
				'home' => '', 
				'test' => 'test'
			])
			->setTitle('Dashboard - '.APP_NAME)
			->setMeta([
				'description' => 'Sample'
			])
			->twig->display('backend/dashboard');
	}

	public function add_user($view, $option = null){

		$this->_modal_data = [
			'groups' => $this->aauth->list_groups()
		];
		
		if($option != null) {
			$user = Users::where('id', $option)->first();
			// echo '<pre>';
			// print_r($user->variables);die;
			if(!$user) {
				show_error('No such user is present!');
			}

			$this->_modal_data['user'] = $user;
			$this->_modal_data['group'] = $this->aauth->get_user_groups($user->id);
		}
		
		$this->modal($view, $option);
	}

	function change_user_status($id) {
		if($this->aauth->is_banned($id)) {
			$this->aauth->unban_user($id);
		} else {
			$this->aauth->ban_user($id);
		}

		echo json_encode([
			'status' => true,
			'message' => 'User status successfully!',
			'goto' => base_url('admin/users')
		]);
	}

	public function users(){

		$inject = [
			'users' => Users::with('variables')->get()
		];

		$this->setBreadCrumbs([
				'home' => '', 
				'Users' => 'admin/users'
			])
			->setTitle('All Users - '.APP_NAME)
			->twig->display('backend/users', $inject);
	}

	public function update_user($id){
		$data = $this->input->post();
	
		$this->aauth->update_user(
			$id,
			isset($data['email']) && $data['email'] != '' ? $data['email'] : false,
			isset($data['password']) && $data['password'] != '' ? $data['password'] : false
			);

		$groups = $this->aauth->list_groups();

		foreach ($groups as $group) {
			$this->aauth->remove_member($id, $group->id);
		}

		foreach ($data['group'] as $user_group) {
			$this->aauth->add_member($id, $user_group);
		}

		$this->aauth->set_user_var("phone",$data['phone'], $id);
		$this->aauth->set_user_var("first_name",$data['first_name'], $id);
		$this->aauth->set_user_var("middle_name",$data['middle_name'], $id);
		$this->aauth->set_user_var("last_name",$data['last_name'], $id);
		$this->aauth->set_user_var("phone",$data['phone'], $id);

		echo json_encode([
			'status' => true,
			'message' => 'User updated successfully!',
			'goto' => base_url('admin/users')
		]);
	}

	public function save_user(){
		$data = $this->input->post();

		$user_id = $this->aauth->create_user($data['email'], $data['password']);

		if(!$user_id) {
			show_error($this->aauth->get_errors_array());
		}

		if(isset($data['group'])) {
			foreach ($data['group'] as $group) {
				$this->aauth->add_member($user_id, $group);
			}
		}

		$this->aauth->set_user_var("phone",$data['phone'], $user_id);
		$this->aauth->set_user_var("first_name",$data['first_name'], $user_id);
		$this->aauth->set_user_var("middle_name",$data['middle_name'], $user_id);
		$this->aauth->set_user_var("last_name",$data['last_name'], $id);
		$this->aauth->set_user_var("phone",$data['phone'], $user_id);

		echo json_encode([
			'status' => true,
			'message' => 'User created successfully!'
		]);
	}

	public function groups(){

		$inject = [
			'groups' => $this->aauth->list_groups()
		];

		$this->setBreadCrumbs([
				'home' => '', 
				'Groups	' => 'admin/groups'
			])
			->setTitle('All groups - '.APP_NAME)
			->twig->display('backend/auth/groups', $inject);
	}

	public function add_group($view, $option = null){
		$this->_modal_data['permissions'] = $this->aauth->list_perms();

		if($option != null) {
			$this->_modal_data['group'] = $this->aauth->get_group_name($option);
			$allowed_permissions = $this->aauth->get_group_perms($option);
			foreach ($allowed_permissions as $perms) {
				$this->_modal_data['allowed_perms'][] = $perms->id;
			}
		}

		$this->modal($view);
	}

	public function save_group(){
		$data = $this->input->post();

		if(!$this->aauth->create_group($data['name'])){
			show_error($this->aauth->get_errors_array() == '' ? 'Somethhing went wrong' : $this->aauth->get_errors_array());
		}

		if(isset($data['permission']) && $data['permission'] != '') {
			foreach ($data['permission'] as $permission) {
				$this->aauth->allow_group($data['name'], $permission);
			}
		}

		echo json_encode([
			'status' => true,
			'message' => 'Group created successfully!',
			'goto' => base_url('admin/groups')
		]);
	}

	public function update_group($id){
		$data = $this->input->post();
		$this->aauth->update_group($id, $data['name']);

		$permissions = $this->aauth->list_perms();
		foreach ($permissions as $permission) {
			$this->aauth->deny_group($id, $permission->id);
		}

		if(isset($data['permission']) && $data['permission'] != '') {
			foreach ($data['permission'] as $permission) {
				$this->aauth->allow_group($id, $permission);
			}
		}

		echo json_encode([
			'status' => true,
			'message' => 'Group updated successfully!',
			'goto' => base_url('admin/groups')
		]);
	}

	public function permissions(){
		$inject = [
			'permissions' => $this->aauth->list_perms()
		];


		$this->setBreadCrumbs([
				'home' => '', 
				'Permissions' => 'admin/permissions'
			])
			->setTitle('All permissions - '.APP_NAME)
			->twig->display('backend/auth/permissions', $inject);
	}

	public function add_permission($view){
		$this->modal($view);
	}

	public function save_permission(){
		$data = $this->input->post();

		if(!$this->aauth->create_perm($data['name'])){
			show_error($this->aauth->get_errors_array());
		}

		echo json_encode([
			'status' => true,
			'message' => 'Permission created successfully!',
			'goto' => base_url('admin/permissions')
		]);
	}
}