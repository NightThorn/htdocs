<?php

use Abraham\TwitterOAuth\TwitterOAuth;

class dashboard extends MY_Controller
{

	public $tb_account_manager = "sp_account_manager";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(get_class($this) . '_model', 'model');
		include get_module_path($this, 'libraries/vendor/autoload.php', true);

		//
		$this->module_name = get_module_config($this, 'name');
		$this->module_icon = get_module_config($this, 'icon');
		$this->module_color = get_module_config($this, 'color');
		$this->module_img = get_module_config($this, 'img');

		$this->dir = get_directory_block(__DIR__, get_class($this));
		//
	}

	public function index($ids = "")
	{
		$where = "";
		$team_id = _t("id");
		$account = $this->model->get("*", $this->tb_account_manager, "ids = '{$ids}' AND team_id = '{$team_id}' AND status = '1'");


		$result = $this->model->fetch('*', $this->tb_account_manager, " status = '1' AND team_id = '{$team_id}' AND can_post = 1 " . $where, "social_network, category", "ASC");
		$result_final = [];

		$ids = addslashes(post("edit"));

		if ($result) {
			foreach ($result as $row) {
				$social_network = $row->social_network;
				if (_p($social_network . "_post_enable")) {
					$result_final[] = $row;
				}
			}
		}
		if (!is_ajax()) {
			$views = [
				"subheader" => view('main/subheader', ['module_img' => $this->module_img, 'module_name' => $this->module_name, 'module_icon' => $this->module_icon, 'module_color' => $this->module_color], true),
				"column_one" => view("main/sidebar", ['result' => $result_final,  'module_name' => $this->module_name, 'module_img' => $this->module_img, 'module_icon' => $this->module_icon], true, $this),
				"column_two" => view("pages/general", ["result" => $this->block_report()], true),
			];

			views([
				"title" => $this->module_name,
				"fragment" => "fragment_two",
				"views" => $views
			]);
		} else {
			view("pages/general", ["result" => $this->block_report(), "account" => $account], false);
		}
	}

	public function block_report()
	{


		$id = $this->input->post('id');
		$social = $this->input->post('social');

		if (!empty($id)) {
			if ($social == "twitter") {
				$this->consumer_key = get_option('twitter_consumer_key', '');
				$this->consumer_secret = get_option('twitter_consumer_secret', '');

				$account = $this->model->get("*", $this->tb_account_manager, "pid = '{$id}' AND social_network = '{$social}'");
				$data = $account->token;
				$json = json_decode($data, true);
				$oauth_token = $json['oauth_token'];
				$oauth_secret = $json['oauth_token_secret'];

				$connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
				$connection->setOauthToken($oauth_token, $oauth_secret);
				$response = $connection->get("statuses/home_timeline");
				foreach ($response as $value) {
					echo ('  <div class="preview-twitter preview-twitter-text item-post-type" style="max-width: 500px;
    padding: 10px 5px 10px;" data-type="text">
                <div style="border: 1px solid #323a5f;" class="preview-content">
                    <div class="user-info">
                        <img class="img-circle" src="' . $value->user->profile_image_url . '">
                        <div class="text">
                            <div class="name">' . $value->user->name . '</div>
                            <span>@' . $value->user->screen_name . '</span>
                        </div>
                    </div>
                    <div class="caption">' . $value->text . '</div>
                    
                    <div class="post-info">
                        <div class="info-active"><?php _e( date( "g:i A d M, Y", strtotime( now() ) ) )?></div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="preview-comment">
                        <div class="row">
                            <div class="col-4">
                                <i class="far fa-comment" aria-hidden="true"></i>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-retweet" aria-hidden="true"></i>
                            </div>
                            <div class="col-4">
                                <i class="far fa-heart" aria-hidden="true"></i>
                            </div>
                            
                        </div>  
                    </div>
                </div>
            </div>');
				}

				//echo json_encode($result);
			} else {
				$token = "yres";
				echo $token;
			}
		} else {

			$token = "";
		}

		return view($this->dir . "pages/block_reports", ['result' => $token], true, $this);
	}

	public function block()
	{
	}
	public function settheme()
	{
		$id = (int) $this->input->post('theme');

		$CI = &get_instance();
		if (_s("uid")) {
			$uid = _u("id");
		}
		print_r($uid);

		$int_value = intval($uid);
		$int_theme = intval($id);
		print_r($id);
		$sql = "UPDATE sp_users SET theme = ? WHERE id = ?";
		$this->db->query($sql, array($int_theme, $int_value));
		$tr = $this->db->last_query();
		print_r($tr);
	}
}
