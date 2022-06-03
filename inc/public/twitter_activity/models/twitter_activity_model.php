<?php
class twitter_activity_model extends MY_Model {

	public $tb_account_manager = "sp_account_manager";
	public $tb_twitter_activities = "sp_twitter_activities";
	public $tb_twitter_activities_log = "sp_twitter_activities_log";

	public function __construct(){
		parent::__construct();

		//
		$module_path = get_module_directory(__DIR__);
		$this->module_name = get_module_config( $module_path, 'name' );
		$this->module_icon = get_module_config( $module_path, 'icon' );
		$this->module_color = get_module_config( $module_path, 'color' );
		//
		
		include $module_path.'libraries/vendor/autoload.php';
		include $module_path.'libraries/twac.php';
	}

	public function block_social_settings($path = ""){
		$dir = get_directory_block(__DIR__, get_class($this));
		return [
			'twitter' => [
				'position' => 900,
				'name' => __('Twitter'),
				'desc' => $this->module_name,
				'color' => "#00acee",
				'icon' => "fab fa-twitter", 
				'content' => view( $dir.'settings/configuration', ['path' => $path], true, $this ),
			]
		];
	}

	public function block_permissions($path = ""){
		$dir = get_directory_block(__DIR__, get_class($this));
		return [
			'position' => 1000,
			'name' => $this->module_name,
			'color' => $this->module_color,
			'icon' => $this->module_icon, 
			'id' => str_replace("_model", "", get_class($this)),
			'html' => view( $dir.'pages/block_permissions', ['path' => $path], true, $this ),
		];
	}

	public function block_cronjobs($path = ""){
		$dir = get_directory_block(__DIR__, get_class($this));
		return [
			'position' => 20000,
			'name' => $this->module_name,
			'color' => $this->module_color,
			'icon' => $this->module_icon, 
			'id' => str_replace("_model", "", get_class($this)),
			'cronjobs' => [
				[
					"name" => $this->module_name,
					"time" => __("Once/minute"),
					"command_line" => "curl ". get_url( str_replace("_model", "", get_class($this) )."/cron?key=" . get_option("cron_key", uniqid() ) ) ." >/dev/null 2>&1"
				]
			]
		];
	}

	public function get_activities(){
		$team_id = _t("id");
		$this->db->select("a.*, b.username, b.ids as ids, b.avatar, b.status as account_status, b.pid as account_id");
		$this->db->from($this->tb_twitter_activities." as a");
		$this->db->join($this->tb_account_manager." as b", "a.account = b.pid", "RIGHT");

		$this->db->where("((b.team_id = ".$team_id." AND a.pid = 0 AND b.social_network = 'twitter' AND b.login_type = '1') OR (b.team_id = '".$team_id."' AND a.pid IS NULL  AND b.social_network = 'twitter' AND b.login_type = '1'))");
		switch (post("f")) {
			case 'started':
				$this->db->where("a.status", 1);
				break;

			case 'stoped':
				$this->db->where("a.status", 0);
				break;
			
			case 'none':
				$this->db->where("a.status", NULL);
				break;
		}

		if( post("k") ){
			$this->db->like("b.username",  addslashes( post("k") ) );
		}		

		switch (post("s")) {
			case 'username':
				$this->db->order_by("b.username", "asc");
				break;

			case 'time':
				$this->db->order_by("b.created", "asc");
				break;
		}
		
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_log($account, $type, $page = 0){
		$team_id = _t("id");

		$this->db->select("*");
		$this->db->from($this->tb_twitter_activities_log);

		switch ($type) {
			case "favorite":
				$this->db->where("action", "favorite");
				break;

			case "reply":
				$this->db->where("action", "reply");
				break;
			
			case "retweet":
				$this->db->where("action", "retweet");
				break;

			case "follow":
				$this->db->where("action", "follow");
				break;

			case "unfollow":
				$this->db->where("action", "unfollow");
				break;

			case "direct":
				$this->db->where("action", "direct");
				break;
		}

		$this->db->where("pid", $account);
		$this->db->where("team_id", $team_id);
		$this->db->order_by("created", "desc");
		$this->db->limit(30, (int)$page*30);
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	public function get_stats($id){
		$team_id = _t("id");
		$activity_id = 0;
		$activity = $this->model->get("*", $this->tb_twitter_activities, "id = '".$id."' AND pid = 0 AND team_id = '".$team_id."'");
		$counter = [
			"favorite" => 0, 
			"reply" => 0, 
			"retweet" => 0, 
			"follow" => 0, 
			"unfollow" => 0, 
			"direct" => 0,
		];

		$time_start = 0;
		$total_followers_gained = 0;

		if($activity){
			$settings = $activity->settings;
			$counter["favorite"] += twac( $activity->settings, "favorite" );
			$counter["reply"] += twac( $activity->settings, "reply" );
			$counter["retweet"] += twac( $activity->settings, "retweet" );
			$counter["follow"] += twac( $activity->settings, "follow" );
			$counter["unfollow"] += twac( $activity->settings, "unfollow" );
			$counter["direct"] += twac( $activity->settings, "direct" );


			$follower_count = tw_get_setting("follower_count", 0, $activity->id);
			$current_follower_count = tw_get_setting("current_follower_count", 0, $activity->id);

			$account = $this->model->get("*", $this->tb_account_manager, " pid = '".$activity->account."' AND team_id = '".$team_id."' AND social_network = 'twitter' AND login_type = 1 ");
			if($account){
				$this->tw = new twac($account);
				$account_info = $this->tw->get_user_info();
				tw_update_setting("current_follower_count", $account_info->followers_count, $activity->id);
				$current_follower_count = $account_info->followers_count;
			}

			if( tw_get_setting("save_count", 0, $activity->id) ){
				$time_start = time_elapsed_string( $activity->created );
				$total_followers_gained = $current_follower_count - $follower_count;
			}

			$activity_id = $activity->id;
		}

		$favorite_chart = $this->get_chart_by_id($activity_id, "favorite");
		$reply_chart = $this->get_chart_by_id($activity_id, "reply");
		$retweet_chart = $this->get_chart_by_id($activity_id, "retweet");
		$follow_chart = $this->get_chart_by_id($activity_id, "follow");
		$unfollow_chart = $this->get_chart_by_id($activity_id, "unfollow");
		$direct_chart = $this->get_chart_by_id($activity_id, "direct");

		$total_action = array_sum($counter);

		$favorite_percent = $total_action != 0 ? $counter["favorite"]/$total_action*100 : 0;
		$reply_percent = $total_action != 0 ? $counter["reply"]/$total_action*100 : 0;
		$retweet_percent = $total_action != 0 ? $counter["retweet"]/$total_action*100 : 0;
		$follow_percent = $total_action != 0 ? $counter["follow"]/$total_action*100 : 0;
		$unfollow_percent = $total_action != 0 ? $counter["unfollow"]/$total_action*100 : 0;
		$direct_percent = $total_action != 0 ? $counter["direct"]/$total_action*100 : 0;

		return (object)[
			"favorite_count" => $counter['favorite'],
			"reply_count" => $counter['reply'],
			"retweet_count" => $counter['retweet'],
			"follow_count" => $counter['follow'],
			"unfollow_count" => $counter['unfollow'],
			"direct_count" => $counter['direct'],
			"favorite_percent" => $favorite_percent,
			"reply_percent" => $reply_percent,
			"retweet_percent" => $retweet_percent,
			"follow_percent" => $follow_percent,
			"unfollow_percent" => $unfollow_percent,
			"direct_percent" => $direct_percent,
			"time_start" => $time_start,
			"total_followers_gained" => $total_followers_gained,
			"favorite_chart" => $favorite_chart,
			"reply_chart" => $reply_chart,
			"retweet_chart" => $retweet_chart,
			"follow_chart" => $follow_chart,
			"unfollow_chart" => $unfollow_chart,
			"direct_chart" => $direct_chart,
		];
	}

	public function get_chart_by_id($id, $action){
		$team_id = _t("id");

		$value_string = "";
		$date_string = "";

		$date_list = [];
		$date = strtotime(date('Y-m-d', strtotime(NOW)));
		for ($i=6; $i >= 0; $i--) { 
			$left_date = $date - 86400 * $i;
			$date_list[date('Y-m-d', $left_date)] = 0;
		}

		//Get data
		$query = $this->db->query("SELECT COUNT(FROM_UNIXTIME(created)) as count, DATE(FROM_UNIXTIME(created)) as created FROM ".$this->tb_twitter_activities_log." WHERE pid = '".$id."' AND action = '".$action."' AND team_id = '".$team_id."' AND FROM_UNIXTIME(created) > NOW() - INTERVAL 7 DAY GROUP BY DATE(FROM_UNIXTIME(created));");
		if($query->result()){
			foreach ($query->result() as $key => $value) {
				if(isset($date_list[$value->created])){
					$date_list[$value->created] = $value->count;
				}
			}
		}

		foreach ($date_list as $date => $value) {
			$value_string .= "{$value},";
			$date_string .= "'{$date}',";
		}

		$value_string = "[".substr($value_string, 0, -1)."]";
		$date_string  = "[".substr($date_string, 0, -1)."]";

		return (object)[
			"value" => $value_string,
			"date" => $date_string
		];
	}

	public function get_profile($id, $maxId){
		$team_id = _t("id");
		$activity = $this->model->get("*", $this->tb_twitter_activities, "id = '".$id."' AND pid = 0 AND team_id = '".$team_id."'");

		$account = $this->model->get("*", $this->tb_account_manager, " pid = '".$activity->account."' AND team_id = '".$team_id."' AND social_network = 'twitter' AND login_type = 1 ");

		$account_info = false;
		$feeds = false;
		$next_page = false;

		if($account){
			$this->tw = new twac($account);
			$account_info = $this->tw->get_user_info();
			$feeds = $this->tw->twitter->get("statuses/user_timeline", ["user_id" => $account->username]);
			$next_page = -1;
		}

		return (object)[
			"account" => $account_info,
			"feed" => $feeds,
			"activity" => $activity,
			"maxId" => $next_page
		];
	}
}