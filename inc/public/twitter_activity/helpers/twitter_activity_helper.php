<?php 
/*Account Settings*/
if(!function_exists("tw_get_setting")){
    function tw_get_setting($key, $value = "", $id){
        $CI = &get_instance();
        $setting = $CI->main_model->get("settings", "sp_twitter_activities", "id = '".$id."'");
        if(!empty($setting)){
            $setting = $setting->settings;
            $option = json_decode($setting);

            if(is_array($option) || is_object($option)){
                $option = (array)$option;

                if( isset($option[$key]) ){
                    return $option[$key];
                }else{
                    $option[$key] = $value;
                    $CI->db->update("sp_twitter_activities", array("settings" => json_encode($option)), array("id" => $id) );
                    return $value;
                }
            }else{
                $option = json_encode(array($key => $value));
                $CI->db->update("sp_twitter_activities", array("settings" => $option), array("id" => $id));
                return $value;
            }
        }

        return false;
    }
}

if(!function_exists("tw_update_setting")){
    function tw_update_setting($key, $value, $id){
        $CI = &get_instance();
        $setting = $CI->main_model->get("settings", "sp_twitter_activities", "id = '".$id."' ")->settings;
        $option = json_decode($setting);
        if(is_array($option) || is_object($option)){
            $option = (array)$option;
            if( isset($option[$key]) ){
                $option[$key] = $value;
                $CI->db->update("sp_twitter_activities", array("settings" => json_encode($option)), array("id" => $id) );
                return true;
            }
        }
        return false;
    }
}

if(!function_exists('get_value')){
    function get_value($data, $key, $parse_array = false, $return = false){
        if(is_string($data)){
            $data = json_decode($data);
        }

        if(is_object($data)){
            if(isset($data->$key)){
                if($parse_array){
                    return (array)$data->$key;
                }else{
                    return $data->$key;
                }
            }
        }else if(is_array($data)){
            if(isset($data[$key])){
                return $data[$key];
            }
        }else{
            return $data;
        }
        
        return $return;
    }
}

if(!function_exists('remove_empty_value')){
    function remove_empty_value($data){
        if(!empty($data)){
            return array_filter($data, function($value) {
                return ($value !== null && $value !== false && $value !== ''); 
            });
        }else{
            return false;
        }
    }
}

if(!function_exists("get_time_next_schedule")){
    function get_time_next_schedule($numbers, $maxSum, $minutes = 60, $maxRandom = 1){
        $minute = 0;
        $task = 0;
        $new_numbers = array();
        if(is_string($numbers)){
            $numbers = (array)json_decode($numbers);
        }

        $numbers = (array)$numbers;

        if(!empty($numbers) && $numbers[0] != 0){
            $task = $numbers[0];
            unset($numbers[0]);
            $numbers = array_values($numbers);
        }

        foreach ($numbers as $key => $value) {
            if($value == 0){
                $minute++;
                unset($numbers[$key]);
            }else{
                break;
            }
        }

        if(empty($numbers)){
            $numbers = get_random_numbers($maxSum, $minutes, $maxRandom);
        }else{
            $numbers = array_values($numbers);
        }

        return (object)array(
            "task" => $task,
            "minute" => $minute,
            "numbers" => $numbers
        );

    }
}

if(!function_exists("get_action_left")){
    function get_action_left($numbers, $action_complete, $task){
        if(!$action_complete){
            $action_left = $task - 1;
            if(!empty($numbers)){
                $zero_indexs = array();
                foreach ($numbers as $key => $value) {
                    if($value == 0){
                        $zero_indexs[] = $key;
                    }
                }

                if(!empty($zero_indexs)){
                    $zero_index = get_random_value($zero_indexs);
                    $numbers[$zero_index] = $action_left;
                }
            }
            return $numbers;
        }else{
            return $numbers;
        }
    }
}

if(!function_exists("get_random_numbers")){
    function get_random_numbers($maxSum, $minutes = 60, $maxRandom = 1){
        $numbers = array();
        for ($i=1; $i <= $minutes; $i++) { 
            $rand = rand(0, $maxRandom);
            $sum = array_sum($numbers);
            if($sum + $rand >= $maxSum){
                if($sum < $maxSum){
                    $numbers[] = $maxSum - $sum;
                }else{
                    $numbers[] = 0;
                }
            }else{
                $numbers[] = $rand;
            }
        }
        shuffle($numbers);
        return $numbers;
    }
}

if(!function_exists("twaa")){
    function twaa($action){
        switch ($action) {
            case "favorite":
                $result = array(
                    "text" => __('Favorite tweet'),
                    "icon" => "far fa-heart"
                );
                break;

            case "reply":
                $result = array(
                    "text" => __('Reply'),
                    "icon" => "fas fa-reply"
                );
                break;

            case "retweet":
                $result = array(
                    "text" => __('Retweet'),
                    "icon" => "far fa-comment-dots"
                );
                break;

            case "follow":
                $result = array(
                    "text" => __('Followed user'),
                    "icon" => "fas fa-user-plus"
                );
                break;

            case "unfollow":
                $result = array(
                    "text" => __('Unfollowed user'),
                    "icon" => "fas fa-user-minus"
                );
                break;

            case "direct":
                $result = array(
                    "text" => __('Message sent to user'),
                    "icon" => "far fa-comment-alt"
                );
                break;

            default:
                $result = array(
                    "text" => "",
                    "icon" => ""
                );
                break;
        }

        return (object)$result;
    }
}

if(!function_exists("twav")){
    function twav($data, $type, $key = "", $compare = false){
        $data_tmp = $data;
        $data = json_decode($data);
        $data = get_value($data, $type);

        switch ($type) {
            case 'todos':
                
                if(get_value($data, $key)){
                    _e(" checked='true' ");
                }else if(empty($data_tmp)){
                    get_option('twac_status_favorite', 1);
                    get_option('twac_status_reply', 1);
                    get_option('twac_status_retweet', 1);
                    get_option('twac_status_follow', 0);
                    get_option('twac_status_unfollow', 0);
                    get_option('twac_status_direct', 0);
                    get_option('twac_status_repost', 0);
                    _e( get_option('twac_status_'.$key, 0)?" checked='true' ":"" );
                }
                break;

            case 'targets':

                switch ($key) {
                    case 'tag':
                        if(get_value($data, $key)){
                            _e(" checked='true' ");
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_targets_tag', 1)?" checked='true' ":"" );
                        }
                        break;

                    case 'keyword':
                        if(get_value($data, $key)){
                            _e(" checked='true' ");
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_targets_keyword', 0)?" checked='true' ":"" );
                        }
                        break;

                    case 'follower':
                        if(get_value($data, $key)){
                            _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_targets_follower', '') == $compare? " selected='true' ":"" );
                        }
                        break;

                    case 'following':
                        if(get_value($data, $key)){
                            _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_targets_following', '') == $compare? " selected='true' ":"" );
                        }
                        break;

                    case 'retweeter':
                        if(get_value($data, $key)){
                            _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_targets_retweeter', '') == $compare? " selected='true' ":"" );
                        }
                        break;
                    
                }

                break;

            case 'speeds':

                switch ($key) {
                    case 'level':
                        if(get_value($data, $key)){
                            _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_speeds_level', 'slow') == $compare? " selected='true' ":"" );
                        }
                        break;
                    
                    default:
                        if(get_value($data, $key) != ""){
                            _e( (int)get_value($data, $key) );
                        }else if(empty($data_tmp)){
                            $level = get_option('twac_speeds_level', "slow");
                            $level = $level!=""?$level:"slow";
                            _e( get_option('twac_speeds_'.$level.'_'.$key, 1) );
                        }
                        break;
                }
                break;

            case 'filters':

                switch ($key) {
                    case 'media_age':
                        _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        break;

                    case 'media_type':
                        _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        break;

                    case 'user_relation':
                        _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        break;

                    case 'user_profile':
                        _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        break;

                    default:
                        if(get_value($data, $key) != ""){
                            _e( (int)get_value($data, $key) );
                        }else{
                            _e( 0 );
                        }
                        break;
                }

                break;

            case 'op_replies':
                if(get_value($data, $key)){
                    _e(" checked='true' ");
                }else if(empty($data_tmp)){
                    _e( get_option('twac_op_replies_dont_spam', 0)?" checked='true' ":"" );
                }
                break;

            case 'replies':
                if(empty($data_tmp)){
                    return explode("\n", get_option('twac_default_replies', "Made my day\nTotally rocks!\nVery nice\nVery sweet :)\nThis is great\nSo cool\nFascinating one\nNeat-o!\nGorgeous! Love it!\nThe cutest\nBreathtaking one\nThis is awesome :)\nOutstanding one!\nWhoopee!\nMy Goodness\nThis is awesome!") );
                }else{
                    return $data;
                }
                break;

            case 'follows':
                switch ($key) {
                    case 'dont_spam':
                        if(get_value($data, $key)){
                            _e(" checked='true' ");
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_follows_dont_spam', 0)?" checked='true' ":"" );
                        }
                        break;

                    case 'dont_private':
                        if(get_value($data, $key)){
                            _e(" checked='true' ");
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_follows_dont_private', 0)?" checked='true' ":"" );
                        }
                        break;
                }
                break;

            case 'unfollows':
                switch ($key) {
                    case 'source':
                        _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        break;

                    case 'after':
                        _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        break;

                    case 'dont_follower':
                        if(get_value($data, $key)){
                            _e(" checked='true' ");
                        }else if(empty($data_tmp)){
                            _e( get_option('twac_unfollows_dont_follow', 0)?" checked='true' ":"" );
                        }
                        break;
                }
                break;

            case 'op_directs':
                switch ($key) {
                    case 'by':
                        _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        break;
                }
                break;

            case 'directs':
                if(empty($data_tmp)){
                    return explode("\n", get_option('twac_default_directs', "Hello {username}, How are you?\nHi {username}, How are you today?\nHi {username}, Hey, how's it going?\nHello {username}, What's up?") );
                }else{
                    return $data;
                }
                break;

            case 'tags':
                if(empty($data_tmp)){
                    return explode("\n", get_option('twac_default_tags', "author\nvacation\ninstaart\nnature\ntasty\nmasterpiece\ncreative\nbestoftheday\npretty\nsiblings\nclouds\npage\nthrowbackthursday\ncuddle\ninstafollow\nlovely\nshoutout\ncute\ndraw"));
                }else{
                    return $data;
                }
                break;

            case 'keywords':
                if(empty($data_tmp)){
                    return explode("\n", get_option('twac_default_keywords', "author\nvacation\ninstaart\nnature\ntasty\nmasterpiece\ncreative\nbestoftheday\npretty\nsiblings\nclouds\npage\nthrowbackthursday\ncuddle\ninstafollow\nlovely\nshoutout\ncute\ndraw"));
                }else{
                    return $data;
                }
                break;

            case 'usernames':
                return $data;
                break;

            case 'blacklist_tags':
                if(empty($data_tmp)){
                    return explode("\n", get_option('twac_default_tags_blacklist', "sex\nxxx\nfuckyou\nvideoxxx\nnude"));
                }else{
                    return $data;
                }
                break;

            case 'blacklist_usernames':
                if(empty($data_tmp)){
                    return get_option('twac_blacklist_usernames', '');
                }else{
                    return $data;
                }
                break;

            case 'blacklist_keywords':
                if(empty($data_tmp)){
                    return explode("\n", get_option('twac_default_keywords_blacklist', "sex\nfuck now\nnude"));
                }else{
                    return $data;
                }
                break;

            case 'schedule_days':
                return $data;
                break;

            case 'stops':

                switch ($key) {
                    case 'no_activity':
                        _e( get_value($data, $key) == $compare? " selected='true' ":"" );
                        break;

                    case 'timer':
                        if(get_value($data, $key) != ""){
                            _e( get_value($data, $key) );
                        }else{
                            _e("");
                        }
                        break;

                    default:
                        if(get_value($data, $key) != ""){
                            _e( (int)get_value($data, $key) );
                        }else{
                            _e( 0 );
                        }
                        break;
                }

            default:
                # code...
                break;
        }
    }
}

if(!function_exists("twac")){
    function twac($data, $type){
        if(is_string($data)){
            $data = json_decode($data);
        }

        $data = (object)$data;

        if(isset($data->$type)){
            return $data->$type;
        }else{
            return 0;
        }
    }
}