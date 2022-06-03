<?php
use Abraham\TwitterOAuth\TwitterOAuth;
class twitter_analytics_model extends MY_Model {

	public $tb_account_manager = "sp_account_manager";
	public $tb_twitter_analytics = "sp_twitter_analytics";
	public $tb_twitter_analytics_stats = "sp_twitter_analytics_stats";

	public function __construct(){
		parent::__construct();

		//
		$module_path = get_module_directory(__DIR__);
		$this->module_name = get_module_config( $module_path, 'name' );
		$this->module_icon = get_module_config( $module_path, 'icon' );
		$this->module_color = get_module_config( $module_path, 'color' );
		//

		include $module_path.'libraries/vendor/autoload.php';
		$this->consumer_key = get_option('twitter_consumer_key', '') ;
        $this->consumer_secret = get_option('twitter_consumer_secret', '');
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

	public function get_stats($ids = ""){

		$result = $this->db->select("a.*")
				->from($this->tb_twitter_analytics_stats." as a")
				->join($this->tb_account_manager." as b", "a.account = b.pid")
				->where("b.ids = '{$ids}'")
				->where("b.social_network = 'twitter'")
				->order_by("a.date","desc")
				->limit(15,0)
				->get()
				->result();

		$profile_info = $this->db->select("a.*")
				->from($this->tb_twitter_analytics." as a")
				->join($this->tb_account_manager." as b", "a.account = b.pid")
				->where("b.ids = '{$ids}'")
				->where("b.social_network = 'twitter'")
				->get()
				->row();

		$result_tmp = array_reverse($result);	
		$list = array();
		$followers_tmp = -1;
		$following_tmp = -1;
		$posts_tmp = -1;
		
		$followers_value_string = "";
		$following_value_string = "";
		$engagement_value_string = "";
		$date_string = "";
		$count_date = 0;

		if(!empty($result_tmp)){
			foreach ($result_tmp as $key => $row) {
				//List summary
				$data = json_decode($row->data);
				
				$follower_count = $data->follower_count;
				$following_count = $data->following_count;
				$engagement = $data->engagement;
				$media_count = $data->media_count;

				$list[date_show($row->date)] = (object)array(
					"followers" => $follower_count,
					"following" => $following_count,
					"posts" => $media_count,
					"followers_sumary" => ($followers_tmp == -1)?"":($follower_count-$followers_tmp),
					"following_sumary" => ($following_tmp == -1)?"":($following_count-$following_tmp),
					"posts_sumary" => ($posts_tmp == -1)?"":($media_count-$posts_tmp),
					"date" => date_show($row->date)
				);

				$followers_tmp = $follower_count;
				$following_tmp = $following_count;
				$posts_tmp = $media_count;

				//Followers chart
				$followers_value_string .= "{$follower_count},";

				//Followers chart
				$following_value_string .= "{$following_count},";

				//Followers chart
				$engagement_value_string .= "{$engagement},";

				//Date chart
				$date_string .= "'".date_show($row->date)."',";
			}

			//Cound Date
			$start_date = strtotime($result_tmp[0]->date);
			$end_date = strtotime($result_tmp[count($result_tmp) - 1]->date);
			$datediff = $end_date - $start_date;
			$count_date = round($datediff / (60 * 60 * 24));

			$followers_value_string = "[".substr($followers_value_string, 0, -1)."]";
			$following_value_string = "[".substr($following_value_string, 0, -1)."]";
			$engagement_value_string = "[".substr($engagement_value_string, 0, -1)."]";
			$date_string  = "[".substr($date_string, 0, -1)."]";

			//Following chart
			$result = (object)array(
				"list_summary" => $list,
				"followers_chart" => $followers_value_string,
				"following_chart" => $following_value_string,
				"engagement_chart" => $engagement_value_string,
				"date_chart" => $date_string,
				"data" => isset($profile_info->data)?json_decode($profile_info->data):"",
				"total_days" => $count_date
			);

			return $result;
		}

		return false;
	}

	public function save_stats($pid, $team_id)
	{
		$date = strtotime(date("Y-m-d"));
		$check_stats = $this->model->get("id", $this->tb_twitter_analytics_stats, " account = '{$pid}' AND team_id = '{$team_id}' AND date = '".$date."'");
		if(!$check_stats)
		{
			$result = self::get_data($pid, $team_id);
			if( $result['status'] == "success" ){
				$result = (object)$result;

				//Save data
				$user_data = [
					"media_count" => $result->profile_info->statuses_count,
					"follower_count" => $result->profile_info->followers_count,
					"following_count" => $result->profile_info->friends_count,
					"engagement" => $result->engagement
				];

				$data = [
					"ids" => ids(),
					"team_id" => $team_id,
					"account" => $pid,
					"data" => json_encode($user_data),
					"date" => $date
				];

				$this->db->insert($this->tb_twitter_analytics_stats, $data);

				$save_info = [
					"engagement" => $result->engagement,
					"average_likes" => $result->average_likes,
					"average_comments" => $result->average_comments,
					"top_hashtags" => $result->top_hashtags,
					"top_mentions" => $result->top_mentions,
					"feeds" => $result->feeds,
					"profile_info" => $result->profile_info,
				];

				//Next Action
				$check_action = $this->model->get("id", $this->tb_twitter_analytics, "team_id = '{$team_id}' AND account = '{$pid}'");
				if(!$check_action)
				{
					$next_action = strtotime(date("Y-m-d")) + (86400 * 1);
					$data_next_action = [
						"ids" => ids(),
						"team_id" => $team_id,
						"account" => $pid,
						"data" => json_encode($save_info),
						"next_action" => $next_action
					];

					$this->db->insert($this->tb_twitter_analytics, $data_next_action);
				}
				else
				{
					$next_action = strtotime(date("Y-m-d")) + (86400 * 1);
					$data_next_action = [
						"data" => json_encode($save_info),
						"next_action" => $next_action
					];
					$this->db->update($this->tb_twitter_analytics, $data_next_action, "account = '{$pid}' AND team_id = '{$team_id}'");
				}
			}
		}
	}

	public function get_data($pid, $team_id){
		$account = $this->model->get("*", $this->tb_account_manager, "social_network = 'twitter' AND pid = '{$pid}' AND team_id = '{$team_id}'");

		if($account){
			
			$this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
			$access_token = json_decode($account->token);
			$this->twitter->setOauthToken($access_token->oauth_token, $access_token->oauth_token_secret);

			$profile_info = $this->twitter->get("account/verify_credentials");
			if( isset($profile_info->errors) ){
				return [
					"status" => "error",
					"message" => __($profile_info->errors[0]->message)
				];
			}

	        //GET DATA
	        $follower_count = (int)$profile_info->followers_count;

	        //Get user medias
            $feeds = [];
            $media_count = 0;
            $total_likes = 0;
            $total_comments = 0;
            $average_likes = 0;
            $average_comments = 0;
            $hashtags_array = [];
            $mentions_array = [];

            $medias = $this->twitter->get("statuses/user_timeline", [
            	"screen_name" =>  $profile_info->screen_name,
            	"count" => 200,
            	"include_rts" => false
            ]);

            if( isset($medias->errors) ){
				return [
					"status" => "error",
					"message" => __($medias->errors[0]->message)
				];
			}

            if(!empty($medias)){
                foreach ($medias as $key => $row) {

                    $total_likes += (int)$row->favorite_count;
                    $total_comments += (int)$row->retweet_count;
                    $engagement = (int)$row->favorite_count + (int)$row->retweet_count;

                    $rate = 0;
                    if($engagement != 0 && $follower_count != 0){
                        $rate = $engagement/$follower_count*100;
                    }

                    $feeds[] = [
                        'engagement' => $rate,
                        'media_id' => $row->id
                    ];
                    
                    if($row->text != ""){
                        $hashtags = get_hashtags($row->text);
                        foreach ($hashtags as $hashtag) {
                            if (!isset($hashtags_array[$hashtag])) {
                                $hashtags_array[$hashtag] = 1;
                            } else {
                                $hashtags_array[$hashtag]++;
                            }
                        }

                        $mentions = get_mentions($row->text);
                        foreach ($mentions as $mention) {
                            if (!isset($mentions_array[$mention])) {
                                $mentions_array[$mention] = 1;
                            } else {
                                $mentions_array[$mention]++;
                            }
                        }
                    }

                    $media_count++;

                    if ($key >= 10) break;

                }

                usort($feeds, function($a, $b) {
                    return $b['engagement'] - $a['engagement'];
                });
            }

            $engagement = array_sum(array_column($feeds, 'engagement'));

            if ($engagement != 0 && !empty($feeds)) {
                $engagement = number_format($engagement / sizeof($feeds), 2);
            }

            if ($total_comments != 0 && $media_count != 0) {
                $average_comments = number_format($total_comments / $media_count, 2);
            }

            if ($total_likes != 0 && $media_count != 0) {
                $average_likes = number_format($total_likes / $media_count, 2);
            }

            arsort($hashtags_array);
            arsort($mentions_array);
            $feeds = array_slice($feeds, 0, 3);
            $top_hashtags_array = array_slice($hashtags_array, 0, 15);
            $top_mentions_array = array_slice($mentions_array, 0, 15);
            return [
                "feeds" => $feeds,
                "profile_info" => $profile_info,
                "engagement" => $engagement,
                "average_likes" => $average_likes,
                "average_comments" => $average_comments,
                "top_hashtags" => $top_hashtags_array,
                "top_mentions" => $top_mentions_array,
                "average_comments" => $average_comments,
                "feeds" => $feeds,
                "status" => "success"
            ];
	        //END GET DATA
		
		}
	}
}