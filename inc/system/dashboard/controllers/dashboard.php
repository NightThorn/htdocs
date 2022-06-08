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
				$response = $connection->get("statuses/home_timeline", [
					'tweet_mode' => 'extended'
				], 'array');
				$mytimeline = $connection->get("statuses/user_timeline", [
					'tweet_mode' => 'extended'
				], 'array');
				$mentions = $connection->get("statuses/mentions_timeline", [
					'tweet_mode' => 'extended'
				], 'array');
				echo ('<div class="row">');

				echo ('<div class="col-sm-4">');
				echo ('<h2><span class="menu-icon"><img height="30" src="" class="mCS_img_loaded"><i class="fab fa-twitter" style="color: #00acee"></i></span> Newsfeed</h2>');
				foreach ($response as $value) {
					
					$returnedTimestamp = strtotime($value->created_at);
					$timePart = date('h:i A', $returnedTimestamp);
					$words = $this->tweet($value->full_text, $value->entities->urls[0]->expanded_url);
					echo ('  <div class="preview-twitter preview-twitter-text item-post-type" style="max-width: 700px;
    padding: 10px 5px 10px;" data-type="text">
                <div style="border: 1px solid #323a5f; border-radius: 10px;" class="preview-content">
                    <div class="user-info">
                        <img style="border-radius: 30px;" class="img-circle" src="' . $value->user->profile_image_url . '">
                        <div class="text">
                            <div class="name">' . $value->user->name .'<span> @' . $value->user->screen_name . '</span></div>
							<span>'. $timePart .'</span>
                        </div>
                    </div>
                    <div style="padding: 10px;"> '. (($value->retweeted_status) ? '<i class="fas fa-retweet" style="color: grey;" aria-hidden="true"> '.$value->user->name.' retweeted</i>': '<span style="font-size: large;">'.$words.'</span>') . '</div>
					' .
						(($value->extended_entities->media[0]->type) === "photo" && !$value->retweeted_status ?
					'<img style="padding: 10px;" width="100%" src="' . $value->extended_entities->media[0]->media_url_https . '" />' : '')
						. '
							' .
						(($value->extended_entities->media[0]->type) === "video"&& !$value->retweeted_status ?
					'<video muted style="padding: 10px;" width="100%" src="' . $value->extended_entities->media[0]->url . '" />' : '')
						.'
						' .
						(($value->extended_entities->media[0]->type) === "animated_gif"&& !$value->retweeted_status ?
					'<video autoplay loop muted style="padding: 10px;" width="100%" src="' . $value->extended_entities->media[0]->video_info->variants[0]->url . '" />' : '')
						. '

						'. (($value->retweeted_status) ?
					'<blockquote style="padding: 10px;" class="twitter-tweet"><p lang="en" dir="ltr"> '.$value->retweeted_status->full_text.'</p>&mdash; '.$value->retweeted_status->user->name.' (@'. $value->retweeted_status->user->screen_name.') <a href="https://twitter.com/'.$value->retweeted_status->user->screen_name.'/statuses/'.$value->retweeted_status->id.'"></a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>' : '').'
                    <div class="post-info">
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="preview-comment">
                        <div class="row">
                            <div class="col-4">
                                <i class="far fa-comment" id="comment_' . $value->id . '" aria-hidden="true"> </i><span>Comment</span>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-retweet"  style="' . (($value->retweeted ? 'color: green;' : '')) . '" id="retweet_' . $value->id . '"aria-hidden="true"></i><span> ' . (($value->retweeted ? 'Retweeted' : 'Retweet This')) . '</span>
                            </div>
                            <div class="col-4">
                                <i class="far fa-heart"  style="' . (($value->favorited ? 'color: red;' : '')) . '" id="like_' . $value->id . '"aria-hidden="true"></i> <span>' . (($value->favorited ? 'Liked' : 'Like This')) . '</span>
                            </div>
                            
                        </div> 
                    </div>
                </div>
            </div> ');
				}
				echo ('</div>');

					echo ('<div class="col-sm-4">');
					echo ('<h2><span class="menu-icon"><img height="30" src="" class="mCS_img_loaded"><i class="fab fa-twitter" style="color: #00acee"></i></span> My Timeline</h2>');
				foreach ($mytimeline as $value) {

					$returnedTimestamp = strtotime($value->created_at);
					$timePart = date('h:i A', $returnedTimestamp);
					$words = $this->tweet($value->full_text, $value->entities->urls[0]->expanded_url);
					echo ('  <div class="preview-twitter preview-twitter-text item-post-type" style="max-width: 700px;
    padding: 10px 5px 10px;" data-type="text">
                <div style="border: 1px solid #323a5f; border-radius: 10px;" class="preview-content">
                    <div class="user-info">
                        <img style="border-radius: 30px;" class="img-circle" src="' . $value->user->profile_image_url . '">
                        <div class="text">
                            <div class="name">' . $value->user->name . '<span> @' . $value->user->screen_name . '</span></div>
							<span>' . $timePart . '</span>
                        </div>
                    </div>
                    <div style="padding: 10px;"> ' . (($value->retweeted_status) ? '<i class="fas fa-retweet" style="color: grey;" aria-hidden="true"> ' . $value->user->name . ' retweeted</i>' : '<span style="font-size: large;">' . $words . '</span>') . '</div>
					' .
						(($value->extended_entities->media[0]->type) === "photo" && !$value->retweeted_status ?
					'<img width="100%" style="padding: 10px;" src="' . $value->extended_entities->media[0]->media_url_https . '" />' : '')
						. '
							' .
						(($value->extended_entities->media[0]->type) === "video" && !$value->retweeted_status ?
					'<video muted style="padding: 10px;" width="100%" src="' . $value->extended_entities->media[0]->url . '" />' : '')
						. '
						' .
						(($value->extended_entities->media[0]->type) === "animated_gif" && !$value->retweeted_status ?
					'<video autoplay style="padding: 10px;" loop muted width="100%" src="' . $value->extended_entities->media[0]->video_info->variants[0]->url . '" />' : '')
						. '

						' . (($value->retweeted_status) ?
						'<blockquote class="twitter-tweet"><p lang="en" dir="ltr"> ' . $value->retweeted_status->full_text . '</p>&mdash; ' . $value->retweeted_status->user->name . ' (@' . $value->retweeted_status->user->screen_name . ') <a href="https://twitter.com/' . $value->retweeted_status->user->screen_name . '/statuses/' . $value->retweeted_status->id . '"></a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>' : '') .'
                    <div class="post-info">
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="preview-comment">
                         <div class="row">
                            <div class="col-4">
                                <i class="far fa-comment" id="comment_' . $value->id . '" aria-hidden="true"> </i><span>Comment</span>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-retweet"  style="' . (($value->retweeted ? 'color: green;' : '')) . '" id="retweet_' . $value->id . '"aria-hidden="true"></i><span> ' . (($value->retweeted ? 'Retweeted' : 'Retweet This')) . '</span>
                            </div>
                            <div class="col-4">
                                <i class="far fa-heart"  style="' . (($value->favorited ? 'color: red;' : '')) . '" id="like_' . $value->id . '"aria-hidden="true"></i> <span>' . (($value->favorited ? 'Liked' : 'Like This')) . '</span>
                            </div>
                            
                        </div> 
                    </div>
                </div>
            </div> ');
				}
					echo ('</div>');
				echo ('<div class="col-sm-4">');
				echo ('<h2><span class="menu-icon"><img height="30" src="" class="mCS_img_loaded"><i class="fab fa-twitter" style="color: #00acee"></i></span> Mentions</h2>');
				foreach ($mentions as $value) {

					$returnedTimestamp = strtotime($value->created_at);
					$timePart = date('h:i A', $returnedTimestamp);
					$words = $this->tweet($value->full_text, $value->entities->urls[0]->expanded_url);
					echo ('  <div class="preview-twitter preview-twitter-text item-post-type" style="max-width: 700px;
    padding: 10px 5px 10px;" data-type="text">
                <div style="border: 1px solid #323a5f; border-radius: 10px;" class="preview-content">
                    <div class="user-info">
                        <img style="border-radius: 30px;" class="img-circle" src="' . $value->user->profile_image_url . '">
                        <div class="text">
                            <div class="name">' . $value->user->name . '<span> @' . $value->user->screen_name . '</span></div>
							<span>' . $timePart . '</span>
                        </div>
                    </div>
                    <div style="padding: 10px;"> ' . (($value->retweeted_status) ? '<i class="fas fa-retweet" style="color: grey;" aria-hidden="true"> ' . $value->user->name . ' retweeted</i>' : '<span style="font-size: large;">' . $words . '</span>') . '</div>
					' .
					(($value->extended_entities->media[0]->type) === "photo" && !$value->retweeted_status ?
					'<img width="100%"style="padding: 10px;"  src="' . $value->extended_entities->media[0]->media_url_https . '" />' : '')
						. '
							' .
						(($value->extended_entities->media[0]->type) === "video" && !$value->retweeted_status ?
					'<video muted style="padding: 10px;" width="100%" src="' . $value->extended_entities->media[0]->url . '" />' : '')
						. '
						' .
						(($value->extended_entities->media[0]->type) === "animated_gif" && !$value->retweeted_status ?
					'<video autoplay style="padding: 10px;" loop muted width="100%" src="' . $value->extended_entities->media[0]->video_info->variants[0]->url . '" />' : '')
						. '

						' . (($value->retweeted_status) ?
							'<blockquote class="twitter-tweet"><p lang="en" dir="ltr"> ' . $value->retweeted_status->full_text . '</p>&mdash; ' . $value->retweeted_status->user->name . ' (@' . $value->retweeted_status->user->screen_name . ') <a href="https://twitter.com/' . $value->retweeted_status->user->screen_name . '/statuses/' . $value->retweeted_status->id . '"></a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>' : '') . '
                    <div class="post-info">
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="preview-comment">
                        <div class="row">
                            <div class="col-4">
                                <i class="far fa-comment" id="comment_' . $value->id . '" aria-hidden="true"> </i><span>Comment</span>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-retweet"  style="' . (($value->retweeted ? 'color: green;' : '')) . '" id="retweet_' . $value->id . '"aria-hidden="true"></i><span> ' . (($value->retweeted ? 'Retweeted' : 'Retweet This')) . '</span>
                            </div>
                            <div class="col-4">
                                <i class="far fa-heart"  style="' . (($value->favorited ? 'color: red;' : '')) . '" id="like_' . $value->id . '"aria-hidden="true"></i> <span>' . (($value->favorited ? 'Liked' : 'Like This')) . '</span>
                            </div>
                            
                        </div>  
                    </div>
                </div>
            </div> ');
				}
				echo ('</div>');



			echo ('</div>');

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


	public function tweet($tweet, $url)
	{

		//Convert urls to <a> links
		$tweeter = preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2">'.$url.'</a>', $tweet);

		//Convert hashtags to twitter searches in <a> links
		$tweets = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $tweeter);

		//Convert attags to twitter profiles in <a> links
		$tweetss = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $tweets);

		return $tweetss;
	}
}

