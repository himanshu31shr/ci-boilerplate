<?php
/*----------------------------------------------------------------------------------------------------------------------------------
 |
 |	ADMIN CONTROLLER
 |
 |----------------------------------------------------------------------------------------------------------------------------------
 |
 |  Houses common functions for admin module.
 |
 |	@author Himanshu Shrivastava <himanshu31shr@gmail.com>
 |	@package CI-Boilerplate
 |
 */
class Admin extends AdminController {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('User/Users');
	}

	/**
	 * Dashboard page
	 * @return view
	 */
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

	/**
	 * Modal view for adding a new user
	 * 
	 * @param string 	$view   View name 
	 * @param int 		$option User id 
	 */
	public function add_user($view, $option = null){

		$this->_modal_data = [
			'groups' => $this->aauth->list_groups()
		];
		
		if($option != null) {
			$user = Users::where('id', $option)->first();
			if(!$user) {
				show_error('No such user is present!');
			}

			$this->_modal_data['user'] = $user;
			$this->_modal_data['group'] = $this->aauth->get_user_groups($user->id);
		}
		
		$this->modal($view, $option);
	}
 
	/**
	 * Changes status of a user provided id.
	 * 
	 * @param  int $id [description]
	 * @return json
	 */
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

	/**
	 * Lists all users.
	 * @return view
	 */
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

	/**
	 * Updates user details.
	 * 
	 * @param  int $id 	User id
	 * @return json
	 */
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

	/**
	 * Adds a new user
	 * @return json
	 */
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

	/**
	 * Lists all groups
	 * @return view
	 */
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

	/**
	 * Model view for adding a new group
	 * @param string $view   name of the modal view
	 * @param int $option    group id
	 */
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

	/**
	 * Adds a new group
	 * 
	 * @return json
	 */
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

	/**
	 * Updates existing group
	 * @param  int $id Group id
	 * @return json
	 */
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

	/**
	 * Lists all permissions
	 * @return view
	 */
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

	/**
	 * Modal view for adding a new permission
	 * @param string $view view name
	 */
	public function add_permission($view){
		$this->modal($view);
	}

	/**
	 * Adds a new permission
	 * @return view
	 */
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

	/**
	 * Returns profile view for logged user
	 * @return view
	 */
	public function profile() {
		$user_id = $this->aauth->get_user()->id;

		$this->data['user'] = Users::where('id', $user_id)->first();
		$this->data['groups'] = $this->aauth->list_groups();
		$this->data['group'] = $user_id;

		$this->twig->display('backend/profile', $this->data);
	}
}