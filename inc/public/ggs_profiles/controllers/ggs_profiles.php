<?php

class ggs_profiles extends MY_Controller
{

    public $tb_account_manager = "sp_account_manager";
    public $module_name;

    public function __construct()
    {
        parent::__construct();
        _permission("account_manager_enable");
        $this->load->model(get_class($this) . '_model', 'model');

        //
        $this->module_name = get_module_config($this, 'name');
        $this->module_icon = get_module_config($this, 'icon');
        $this->module_color = get_module_config($this, 'color');
        //
        $this->module_img = get_module_config($this, 'img');
        $this->consumer_key = get_option('ggs_consumer_key', '');
        $this->consumer_secret = get_option('ggs_consumer_secret', '');



        $this->callback_url = get_module_url();
    }

    public function index($page = "", $ids = "")
    {
        $team_id = _t('id');
        try {
            $public =  get_option('ggs_consumer_key', '');
            $private = get_option('ggs_consumer_secret', '');
            $auth_key = $_GET['auth_key']; // the returned auth key from previous step
            $get = file_get_contents("https://ggs.tv/api/authorize?app_id=$public&app_secret=$private&auth_key=$auth_key");
            $json = json_decode($get, true);


            $accessToken = $json['access_token']; // your access token
            _ss('accessToken', $accessToken);
            $respon = file_get_contents("https://ggs.tv/api/get_user_info?access_token=$accessToken");
            $response = json_decode($respon);

            $result = [];
            $result[] = (object)[
                'id' => $response->user_info->user_id,
                'name' => $response->user_info->user_name,
                'avatar' => "https://ggspace.nyc3.cdn.digitaloceanspaces.com/uploads/" . $response->user_info->user_picture,
                'desc' => $response->user_info->user_biography
            ];

            $data = [
                "status" => "success",
                "result" => $result
            ];
        } catch (Exception $e) {
            $data = [
                "status" => "error",
                "message" => $e->getMessage()
            ];
        }

        $views = [
            "subheader" => view('main/subheader', ['module_img' => $this->module_img, 'module_name' => $this->module_name, 'module_icon' => $this->module_icon, 'module_color' => $this->module_color], true),
            "column_one" => page($this, "pages", "general", $page, $data),
        ];

        views([
            "title" => $this->module_name,
            "fragment" => "fragment_one",
            "views" => $views
        ]);
    }

    public function oauth()
    {
        $public = get_option('ggs_consumer_key', '');

        $url = "https://ggs.tv/api/oauth?app_id=$public";
        redirect($url);
        $public =  get_option('ggs_consumer_key', '');
        $private = get_option('ggs_consumer_secret', '');
        $auth_key = $_GET['auth_key']; // the returned auth key from previous step
        $get = file_get_contents("https://ggs.tv/api/authorize?app_id=$public&app_secret=$private&auth_key=$auth_key");
        $json = json_decode($get, true);


        $accessToken = $json['access_token']; // your access token
        _ss('accessToken', $accessToken);
        $respon = file_get_contents("https://ggs.tv/api/get_user_info?access_token=$accessToken");
        $response = json_decode($respon);
        if (!is_string($response)) {
            $result = [];
            $result[] = (object)[
                'id' => $response->user_info->user_id,
                'name' => $response->user_info->user_name,
                'avatar' => "https://ggspace.nyc3.cdn.digitaloceanspaces.com/uploads/" . $response->user_info->user_picture,
                'desc' => $response->user_info->user_biography
            ];
        }
    }

    public function save()
    {

        $ids = post('id');
        $team_id = _t("id");
        $public =  get_option('ggs_consumer_key', '');
        $private = get_option('ggs_consumer_secret', '');


        $accessToken = _s('accessToken');

        $respon = file_get_contents("https://ggs.tv/api/get_user_info?access_token=$accessToken");
        $response = json_decode($respon);
        _us('accessToken');

        if (!is_string($response)) {
            $result = [];
            $result[] = (object)[
                'id' => $response->user_info->user_id,
                'name' => $response->user_info->user_name,
                'avatar' => "https://ggspace.nyc3.cdn.digitaloceanspaces.com/uploads/" . $response->user_info->user_picture,
                'desc' => $response->user_info->user_biography
            ];
            if (in_array($response->user_info->user_id, $ids, true)) {
                $ggstoIMG = "https://ggspace.nyc3.cdn.digitaloceanspaces.com/uploads/" . $response->user_info->user_picture;
                $avatar = save_img($ggstoIMG, TMP_PATH . 'avatar/');

                $item = $this->model->get('*', $this->tb_account_manager, "social_network = 'ggs' AND team_id = 1 AND pid = '{$response->id}'");
                if (!$item) {
                    $data = [
                        'ids' => ids(),
                        'social_network' => 'ggs',
                        'category' => 'profile',
                        'login_type' => 1,
                        'can_post' => 1,
                        'team_id' => $team_id,
                        'pid' => $response->user_info->user_id,
                        'name' => $response->user_info->user_name,
                        'username' => $response->user_info->user_name,
                        'token' => $accessToken,
                        'avatar' => $avatar,
                        'url' => 'https://ggs.tv/' . $response->user_info->user_name,
                        'data' => NULL,
                        'status' => 1,
                        'changed' => now(),
                        'created' => now()
                    ];

                    $this->model->insert($this->tb_account_manager, $data);
                } else {
                    @unlink($item->avatar);

                    $data = [
                        'social_network' => 'ggs',
                        'category' => 'profile',
                        'login_type' => 1,
                        'can_post' => 1,
                        'team_id' => $team_id,
                        'pid' => $response->user_info->user_id,
                        'name' => $response->user_info->user_name,
                        'username' => $response->user_info->user_name,
                        'token' => $accessToken,
                        'avatar' => "https://ggspace.nyc3.cdn.digitaloceanspaces.com/uploads/" . $response->user_info->user_picture,
                        'url' => 'https://ggs.tv/' . $response->user_info->user_name,
                        'status' => 1,
                        'changed' => now(),
                    ];

                    $this->model->update($this->tb_account_manager, $data, ['id' => $item->id]);
                }
            }

            ms([
                "status" => "success",
                "message" => __("Success")
            ]);
        } else {
            ms([
                "status" => "error",
                "message" => $response
            ]);
        }
    }

    public function get($params, $accessToken)
    {

        try {
            $response = $this->fb->get($params, $accessToken);
            return json_decode($response->getBody());
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            return $e->getMessage();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            return $e->getMessage();
        }
    }
}
