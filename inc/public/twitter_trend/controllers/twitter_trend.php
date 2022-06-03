<?php
use Abraham\TwitterOAuth\TwitterOAuth;
class twitter_trend extends MY_Controller {

	public $tb_account_manager = "sp_account_manager";

	public function __construct(){
		$this->load->model(get_class($this).'_model', 'model');

		//
		$this->module_name = get_module_config( $this, 'name' );
		$this->module_icon = get_module_config( $this, 'icon' );
		$this->module_color = get_module_config( $this, 'color' );
		//

		include get_module_path($this, 'libraries/vendor/autoload.php', true);
		$this->consumer_key = get_option('twitter_consumer_key', '') ;
        $this->consumer_secret = get_option('twitter_consumer_secret', '');
	}

	public function index($ids = "")
	{
		$team_id = _t("id");

		$account = $this->model->get("*", $this->tb_account_manager, "social_network = 'twitter' AND team_id = '{$team_id}'");

		$result = false;
		if($account && $ids != ""){
			
			$this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
			$access_token = json_decode($account->token);
			$this->twitter->setOauthToken($access_token->oauth_token, $access_token->oauth_token_secret);

			$params = ["id" => $ids];

			$data = $this->twitter->get("trends/place", $params);
			if( is_array($data) && isset($data[0]) && isset($data[0]->trends) ){
				$result = $data;
			}

		}

		if( !is_ajax() ){
			$views = [
				"subheader" => view( 'main/subheader', [ 'module_name' => $this->module_name, 'module_icon' => $this->module_icon, 'module_color' => $this->module_color ], true ),
				"column_one" => view("main/sidebar", [ 'result' => [], 'module_name' => $this->module_name, 'module_icon' => $this->module_icon ], true ),
				"column_two" => view("pages/general", ["result" => $result, "account" => $account] ,true), 
			];
			
			views( [
				"title" => $this->module_name,
				"fragment" => "fragment_two",
				"views" => $views
			] );
		}else{
			view("pages/general", ["result" => $result, "account" => $account], false);
		}
	}
}