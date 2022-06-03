<?php
use Abraham\TwitterOAuth\TwitterOAuth;
class twitter_direct_message_model extends MY_Model {
	public $tb_account_manager = "sp_account_manager";

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

	public function get_threads($pid, $team_id, $cursor = ""){
		$account = $this->model->get("*", $this->tb_account_manager, "pid = '{$pid}' AND team_id = '{$team_id}' AND social_network = 'twitter'");
		if($account){
			$this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
			$access_token = json_decode($account->token);
			$this->twitter->setOauthToken($access_token->oauth_token, $access_token->oauth_token_secret);

			$params = ["count" => 50];

			if($cursor != ""){
				$params["cursor"] = $cursor;
			}

			$data = $this->twitter->get("direct_messages/events/list", $params);
			if( isset($data->events) ){
				$twitter_ids = [];
				$twitter_thread = [];
				$twitter_thread_id = [];
				foreach ($data->events as $value) {
					if($value->message_create->sender_id == $pid && !in_array($value->message_create->target->recipient_id, $twitter_ids)){
						if($value->message_create->target->recipient_id != $pid){
							$twitter_ids[] = $value->message_create->target->recipient_id;
							$twitter_thread[] = $value->message_create->message_data;
							$twitter_thread_id[] = $value->id;
						}
					}
				}

				$users = $this->twitter->get("users/lookup", ["user_id" => implode(",", $twitter_ids)]);

				if( !isset($users->errors)){

					foreach ($users as $key => $value) {
						$users[$key]->thread = $twitter_thread[$key];
						$users[$key]->thread_id = $twitter_thread_id[$key];
					}

					$result = (object)[
						"cursor" => isset($data->next_cursor)?$data->next_cursor:"",
						"events" => $users
					];

					return $result;
					
				}
			}
		}
		return false;

	}

	public function get_thread($pid, $team_id, $thread_id, $cursor = null){
		$account = $this->model->get("*", $this->tb_account_manager, "pid = '{$pid}' AND team_id = '{$team_id}' AND social_network = 'twitter'");
		if($account){

			$this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
			$access_token = json_decode($account->token);
			$this->twitter->setOauthToken($access_token->oauth_token, $access_token->oauth_token_secret);

			$params = ["count" => 50];

			$cursor = "";
			$messages = [];
			$page = 0;
			do {
				$data = $this->twitter->get("direct_messages/events/list", $params);

				if(isset($data->events)){
					foreach ($data->events as $key => $value) {
						if($value->message_create->target->recipient_id == $thread_id || $value->message_create->sender_id == $thread_id){
							$messages[] = $value;
						}
					}
					
				}

				$page++;

				if( isset($data->next_cursor) ){
					$cursor = $data->next_cursor;
				}

            } while (  isset($data->next_cursor) && $page < 3 );

			return $messages;
		}

		return false;
	}

	public function send($pid, $team_id, $thread_id, $message = null, $media = null){
		if(strlen($thread_id) > 15){
			$new = false;
			$thread = ["thread" => $thread_id];
		}else{
			$new = true;
			$thread = ["users" => [$thread_id]];
		}

		$account = $this->model->get("*", $this->tb_account_manager, "pid = '{$pid}' AND team_id = '{$team_id}' AND social_network = 'twitter'");
		if($account){

			$this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
			$access_token = json_decode($account->token);
			$this->twitter->setOauthToken($access_token->oauth_token, $access_token->oauth_token_secret);

			$data = [
                'event' => [
                    'type' => 'message_create',
                    'message_create' => [
                        'target' => [
                            'recipient_id' => $thread_id
                        ],
                        'message_data' => [
                            'text' => $message
                        ]
                    ]
                ]
            ];

			if($media != ""){
				$upload = $this->twitter->upload( 'media/upload' , [
					"media" => get_file_path($media),
					"media_category" => "dm_image"
				], false);

				if(isset($upload->media_id)){
					$data = [
		                'event' => [
		                    'type' => 'message_create',
		                    'message_create' => [
		                        'target' => [
		                            'recipient_id' => $thread_id
		                        ],
		                        'message_data' => [
		                            'attachment' =>[
					                    'type' =>'media',
					                    'media' => [
					                        'id' => $upload->media_id
					                    ]
					                ]
		                        ]
		                    ]
		                ]
		            ];
		        }
			}

            $result = $this->twitter->post( "direct_messages/events/new" , $data, true);

            if(isset($result->event->id)){
                return [
					"type" => "text",
					"status" => "success",
					"caption" => nl2br($result->event->message_create->message_data->text),
					"avatar" => BASE.$account->avatar,
					"time" => datetime_show(time()),
					"remove" => get_module_url("delete_item/".$account->ids."/".$thread_id."/".$result->event->id),
					"id" => "thread-item-".$result->event->id
				];
            }

            if(isset($result->errors)){
            	return [
					"status" => "error",
					"message" => __($result->errors[0]->message)
				];
            }
		}
		
		return [
			"status" => "error",
			"message" => __("Cannot send this message")
		];
	}

	public function delete_item($pid, $team_id, $thread_id, $thread_item_id){
		$account = $this->model->get("*", $this->tb_account_manager, "pid = '{$pid}' AND team_id = '{$team_id}' AND social_network = 'twitter'");
		if($account){

			$this->twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
			$access_token = json_decode($account->token);
			$this->twitter->setOauthToken($access_token->oauth_token, $access_token->oauth_token_secret);

			$params = ["id" => $thread_item_id];

			$data = $this->twitter->delete("direct_messages/events/destroy", $params);

			if(isset($data->errors)){
            	return [
					"status" => "error",
					"message" => __($result->errors[0]->message)
				];
            }

            if($data == ""){
            	return [
					"status" => "success",
					"callback" => '<script>$(".thread-item-' . $thread_item_id . '").remove();</script>'
				];
            }
		}
		
		return [
			"status" => "error",
			"message" => __("Cannot delete this message")
		];
	}
}