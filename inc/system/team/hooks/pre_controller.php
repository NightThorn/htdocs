<?php
$CI = &get_instance();

if( _s("join_team") ){
	$uid = _u("id");
	$email = _u("email");
	$team_id = _s("join_team");
	$user = $CI->main_model->get("*", "sp_users", "id = '{$uid}'");

	if($user){
		$team = $CI->main_model->get("*", "sp_team", "ids = '{$team_id}'");
		

		if($team){

			$team_member = $CI->main_model->get("*", "sp_team_member", "team_id = '{$team->id}' AND pending = '{$user->email}'");

			if($team_member){

				$CI->db->update("sp_team_member", ["uid" => $user->id, "pending" => NULL], ["id" => $team_member->id]);
				_us("join_team");
				redirect( get_url("dashboard") );

			}

		}

		_us("join_team");
	}
}

if($CI->load->module_name == 'team'){

	if( !_s("uid") && !_s("team_id") ){

		if( segment(2) == "join" && segment(3) ){
			_ss("join_team", segment(3));
			redirect( get_url("login?redirect=".urlencode( current_url() ) ) );

		}
	}

	$package = $CI->main_model->get('*', 'sp_package_manager', "ids = '".segment(4)."'");

	$CI->package_permissions = false;
	if( $package ){
		if( $package->permissions != "" ){
			$CI->package_permissions = json_decode( $package->permissions );
		}
	}

	$module_paths = get_module_paths();
	$package_permission_data = array();
	$general = "";
	if(!empty($module_paths))
	{
	    foreach ($module_paths as $module_path) 
	    {

	        $models = $module_path.'/models/*.php';
	        $models = glob($models);

	        if(empty($models)) continue;

	        foreach ($models as $model) 
	        {
	        	//Get Directory
	        	$dir = str_replace(DIR_ROOT, "", $model);
	        	$dir = explode("/", $dir);
	        	$dir = $dir[0]."/";

	        	//Get file name
	        	$file_tmp = str_replace(".php", "", $model);
	        	$file_tmp = explode("/", $file_tmp);
	        	$file_name = end($file_tmp);

	        	//Get folder name
	        	$folder_name = str_replace("_model", "", $file_name);

	        	$model_content = file_get_contents($model);
	        	if (preg_match("/block_permissions/i", $model_content))
				{	
					$path = '../../'.DIR_ROOT.$dir.$folder_name.'/models/'.strtolower($file_name);
					$key = md5($path);
					
					$CI->load->model($path, $key);
					$package_permission_data[$key] = $CI->$key->block_permissions($key);
				}

	        }

	    }
	}

	$permissions = [];
	if( !empty($package_permission_data)){
		usort($package_permission_data, function($a, $b) {
            return $a['position'] <= $b['position'];
        });

        $permissions = $package_permission_data;

        if(!empty($permissions)){
            $CI->package_manager = $permissions;
        }else{
            $CI->package_manager = false;
        }
	}
}

$CI = &get_instance();
$modules = array();
if( $CI->load->module_name == 'team' && segment(3) == "update" ){
	$module_paths = get_module_paths();
	$account_manager_data = array();
	$general = "";
	if(!empty($module_paths))
	{
	    foreach ($module_paths as $module_path) 
	    {

	        $models = $module_path.'/models/*.php';
	        $models = glob($models);

	        if(empty($models)) continue;

	        foreach ($models as $model) 
	        {
	        	//Get Directory
	        	$dir = str_replace(DIR_ROOT, "", $model);
	        	$dir = explode("/", $dir);
	        	$dir = $dir[0]."/";

	        	//Get file name
	        	$file_tmp = str_replace(".php", "", $model);
	        	$file_tmp = explode("/", $file_tmp);
	        	$file_name = end($file_tmp);

	        	//Get folder name
	        	$folder_name = str_replace("_model", "", $file_name);

	        	$model_content = file_get_contents($model);
	        	if (preg_match("/block_accounts/i", $model_content))
				{	
					$path = '../../'.DIR_ROOT.$dir.$folder_name.'/models/'.strtolower($file_name);
					$key = md5($path);
					
					$CI->load->model($path, $key);
					$account_manager_data[$key] = $CI->$key->block_accounts($key);
				}

	        }

	    }
	}

	if( !empty($account_manager_data)){
		usort($account_manager_data, function($a, $b) {
            return $a['position'] <=> $b['position'];
        });

        foreach ($account_manager_data as $row) {
            if( isset($row['accounts']) ){
                $modules[ $row['id'] ] = $row['name'];
            }
        }
	}

	$CI->account_manager = $modules;
}