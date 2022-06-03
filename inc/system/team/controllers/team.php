<?php
class team extends MY_Controller {
	
	public $tb_team = "sp_team";
	public $tb_team_member = "sp_team_member";
	public $tb_users = "sp_users";
	public $module_name;

	public function __construct(){
		parent::__construct();
		if(segment(2) != "access" && segment(2) != "join"){
			_permission(get_class($this)."_enable");
		}
		$this->load->model(get_class($this).'_model', 'team_model');

		//
		$this->module_name = __("Team manager");
		$this->module_icon = "fas fa-users";
		//
	}

	public function index($page = "", $ids = "")
	{	
		$team_id = _t("id");
		$result = $this->team_model->get_team_member();
		$page_type = is_ajax()?false:true;

		//
		$data = [];
		switch ($page) {
			case 'update':
				$member = $this->team_model->get("*", $this->tb_team_member, "ids = '{$ids}' AND team_id = '{$team_id}'");
				$member_permissions = [];
				if($member){
					$member_permissions = json_decode($member->permissions, 1);
				}

				$permissions = _t("permissions");
				$data['full_permissions'] = json_decode($permissions);
				$data['result'] = $member_permissions;
				break;

			case 'assign':
				$data = $this->team_model->get_data();
				break;
		}

		$page = page($this, "pages", "general", $page, $data, $page_type);
		//

		if( !is_ajax() ){

			$views = [
				"subheader" => view( 'main/subheader', [ 'result' => $result, 'module_name' => $this->module_name, 'module_icon' => $this->module_icon ], true ),
				"column_one" => view("main/sidebar", [ 'result' => $result, 'module_name' => $this->module_name, 'module_icon' => $this->module_icon ], true ),
				"column_two" => view("main/content", [ 'view' => $page ] ,true), 
			];
			
			views( [
				"title" => $this->module_name,
				"fragment" => "fragment_two",
				"views" => $views
			] );

		}else{
			_e( $page, false );
		}

	}

	public function access($ids = ""){
		$uid = _u("id");
		$team_id = _t("ids");

		$team = $this->team_model->get("*", $this->tb_team, " ids = '{$ids}' ");


		if( $team && $team_id == $team->ids ){
			ms([
				"status" => "success",
				"message" => __("Success")
			]);
		}

		if($ids == ""){
			if( _s("owner_team_id") ){
				_ss("team_id", _s("owner_team_id"));
			}

			ms([
				"status" => "success",
				"message" => __("Success")
			]);
		}

		if(!$team){
			ms([
				"status" => "error",
				"message" => __("Cannot found this team")
			]);
		}

		$team_member = $this->team_model->get("*", $this->tb_team_member, " team_id = '{$team->id}' AND uid = '{$uid}' ");
		
		if(!$team_member){
			ms([
				"status" => "error",
				"message" => __("Cannot access this team")
			]);
		}

		_ss("owner_team_id", $team_id);
		_ss("team_id", $team->ids);

		ms([
			"status" => "success",
			"message" => __("Success")
		]);
	}

	public function join($ids = ""){
		if( segment(2) == "join" && segment(3) ){
			_ss("join_team", segment(3));
		}

		redirect( get_url("dashboard") );
	}

	public function save($ids = "")
	{
		$uid = _u("id");
		$team_id = _t("id");
		$email = post('email');
		$permissions = post('permissions');
		
		$full_permissions = _t("permissions");
		$full_permissions = json_decode($full_permissions);

		foreach ($full_permissions as $key => $value) {
			if( stripos($key, "_enable") === FALSE && stripos($key, "am_") === FALSE ){
				$permissions[$key] = $value;	
			}
		}

		$permissions['post_enable'] = 1;

		$item = $this->team_model->get("*", $this->tb_team_member, "ids = '{$ids}'");
		if(!$item){

			$item = $this->team_model->get("*", $this->tb_team_member, "pending = '{$email}'");

			if(!$item){
				$user = $this->team_model->get("*", $this->tb_users, "email = '{$email}'");

				if($user){
					if($user->id == $uid){
						ms([
							"status" => "error",
							"message" => __('You cannot add yourself to the team')
						]);
					}
					
					$item = $this->team_model->get("*", $this->tb_team_member, "uid = '{$user->id}'");
				}

			}

			validate('email', "", $email);
			validate('not_empty', __('This member already exists'), $item);

			$this->team_model->insert($this->tb_team_member , [
				"ids" => ids(),
				"uid" => 0,
				"team_id" => $team_id,
				"permissions" => json_encode($permissions),
				"pending" => $email,
				"status" => 0
			]);

			send_mail_form($email, get_module_url("join/"._s("team_id")) );
		}else{
			$this->team_model->update(
				$this->tb_team_member, 
				[
					"permissions" => json_encode($permissions)
				], 
				array("ids" => $ids)
			);
		}

		ms([
			"status" => "success",
			"message" => __('Success')
		]);
	}

	public function resend($ids = ""){
		$team_id = _t("id");
		$team_ids = _t("ids");
		$team_member = $this->team_model->get("*", $this->tb_team_member, "team_id = '{$team_id}' AND ids = '{$ids}'");
		if(!$team_member){
			ms([
				"status" => "error",
				"message" => __("Cannot send email to this team")
			]);
		}

		if($team_member->pending == ""){
			ms([
				"status" => "error",
				"message" => __("This team member is team is already activated")
			]);
		}

		send_mail_form($team_member->pending, get_module_url("join/"._s("team_id")) );

		ms([
			"status" => "success",
			"message" => __('Success')
		]);
	}

	public function delete(){
		$ids = post('id');

		if( empty($ids) ){
			ms([
				"status" => "error",
				"message" => __('Please select an item to delete')
			]);
		}

		if( is_array($ids) ){
			foreach ($ids as $id) {
				$this->team_model->delete($this->tb_team_member, ['ids' => $id]);
			}
		}
		elseif( is_string($ids) )
		{
			$this->team_model->delete($this->tb_team_member, ['ids' => $ids]);
		}

		ms([
			"status" => "success",
			"message" => __('Success')
		]);
	}
}