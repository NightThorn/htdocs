<?php
if(!function_exists("ig_get_img")){
    function ig_get_img($controller, $url, $return = false){

        $info = @get_headers($url,1);

        if($info && isset($info['Content-Type']) && $info['Content-Type'] != "text/plain"){
            $data = get_curl ($url);

            if($return){
                return @"data:image/jpg;base64, ".base64_encode($data);
            }else{
                echo @"data:image/jpg;base64, ".base64_encode($data);
            }
        }else{
            if($return){
                return get_module_path( $controller, "assets/img/logo.png", false);
            }else{
                echo get_module_path( $controller, "assets/img/logo.png", false);
            }
        }
    }
}