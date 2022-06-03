<?php
class twitter_direct_message extends MY_Controller {
	public $tb_account_manager = "sp_account_manager";

	public function __construct(){
		$this->load->model(get_class($this).'_model', 'model');

		//
		$this->module_name = get_module_config( $this, 'name' );
		$this->module_icon = get_module_config( $this, 'icon' );
		$this->module_color = get_module_config( $this, 'color' );
		//
	}

	public function index($ids = "", $thread_id = "")
	{
		$team_id = _t("id");
		$account = $this->model->get("*", $this->tb_account_manager, "ids = '{$ids}' AND team_id = '{$team_id}' AND status = '1'");

		//Sidebar
		$team_id = _t("id");
		$accounts = $this->model->fetch('*', $this->tb_account_manager, " team_id = '{$team_id}' AND social_network = 'twitter'", "social_network, category", "ASC");
		//End sidebar

		//Get threads
		$threads = [];
		if($account){
			$threads = $this->model->get_threads($account->pid, $account->team_id);
			//pr($threads,1);
		}
		//End get threads

		//Get threads
		$thread = [];
		if($account && $thread_id != "" && $thread_id != "null"){
			$thread = $this->model->get_thread($account->pid, $account->team_id, $thread_id);
		}
		//End get threads

		if( !is_ajax() ){
			$list = view("pages/list", ["result" => $threads, "account" => $account], true);

			$views = [
				"subheader" => view( 'main/subheader', [ 'module_name' => $this->module_name, 'module_icon' => $this->module_icon, 'module_color' => $this->module_color ], true ),
				"column_one" => view("main/sidebar", [ 'result' => $accounts, 'list' => $list, 'module_name' => $this->module_name, 'module_icon' => $this->module_icon ], true ),
				"column_two" => view("pages/general", ["result" => $thread, "account" => $account] ,true), 
			];
			
			views( [
				"title" => $this->module_name,
				"fragment" => "fragment_two",
				"views" => $views
			] );
		}else{
			if($ids != "" && $thread_id == ""){
				return view("pages/list", ["result" => $threads, "account" => $account], false);
			}

			view("pages/general", ["result" => $thread, "account" => $account], false);
		}
	}

	public function send($account_id = "", $thread_id = ""){
		$message = post("message");
		$media = post("media");
		$userid = post("userid");
		if($userid){
			$thread_id = $userid;
		}

		if($account_id != "" && $thread_id != ""){
			$team_id = _t("id");
			$account = $this->model->get("*", $this->tb_account_manager, "ids = '{$account_id}' AND team_id = '{$team_id}' AND status = '1'");

			if(!empty($account)){
				$result = $this->model->send($account->pid, $team_id, $thread_id, $message, $media);
				ms($result);
			}
		}

		ms([
			"status" => "error",
			"message" => __("Cannot send the message")
		]);
	}

	public function delete_item($account_id = "", $thread_id = "", $thread_item_id = ""){

		if($account_id != "" && $thread_id != "" && $thread_item_id != ""){
			$team_id = _t("id");
			$account = $this->model->get("*", $this->tb_account_manager, "ids = '{$account_id}' AND team_id = '{$team_id}' AND status = '1'");

			if(!empty($account)){
				try {
					$result = $this->model->delete_item($account->pid, $team_id, $thread_id, $thread_item_id);
					ms($result);
				} catch (Exception $e) {
					ms(array(
						"status" => "error",
						"message" => $e->getMessage()
					));
				}
			}
		}

		ms([
			"status" => "error",
			"message" => __("Cannot delete this message")
		]);

	}
}