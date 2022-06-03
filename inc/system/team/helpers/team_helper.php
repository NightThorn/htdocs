<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/*Permissions*/
if(!function_exists('permission')){
    function permission($type, $field){
        $CI = &get_instance();
        $permissions =  $CI->package_permissions;


        if( !$permissions ) return false;

        switch ($type) {
            case 'checkbox':
                
                if( isset($permissions->$field) ) return $permissions->$field;

                break;

            case 'radio':
                
                if( isset($permissions->$field) ) return $permissions->$field;

                break;

            case 'selected':
                
                if( isset($permissions->$field) ) return $permissions->$field;

                break;
            
            default:
                
                if( isset($permissions->$field) ) return $permissions->$field;

                break;
        }

        return false;
    }
}


if(!function_exists("send_mail_form")){
    function send_mail_form($email, $invite_link){
        include __DIR__.'/../libraries/vendor/autoload.php';
        $CI = &get_instance();

        try {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';

            if(get_option("email_protocal", 1) == 2){
                //Server settings
                $mail->SMTPDebug = false;
                $mail->isSMTP();
                $mail->Host       = get_option('email_smtp_server', '');
                $mail->SMTPAuth   = true; 
                $mail->Username   = get_option('email_smtp_username', '');
                $mail->Password   = get_option('email_smtp_password', '');
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = get_option('email_smtp_port', '');
            }

            //Recipients
            $mail->setFrom( get_option('email_from', 'example@gmail.com'), get_option('email_name', 'Stackposts') );
            $mail->addAddress( $email );
            $mail->addReplyTo( get_option('email_from', 'example@gmail.com'), get_option('email_name', 'Stackposts') );

            $variables = [
            "{invite_link}" => $invite_link,
            "{website_name}" => get_option('website_title', 'Stackposts - Social Marketing Tool'),
            "{website_link}" => get_url(),
        ];

        $subject =  str_replace(
                        array_keys($variables), 
                        array_values($variables), 
                        get_option('email_invite_team_member_subject', "Hello there! You received an invitation to join the team")
                    );


        $content =  str_replace(
                        array_keys($variables), 
                        array_values($variables), 
                        get_option('email_invite_team_member_content', "Hello there,  <br/><br/>You've been invited to join the team<br/><br/>Click here to join to the team {invite_link}<br/><br/>Thanks and Best Regards!")
                    );

            // Content
            $mail->isHTML(true); 
            $mail->Subject = $subject;
            $mail->Body    = $content;
            $mail->AltBody = strip_tags($content);

            $mail->send();

            return [
                "status" => "success",
                "message" => __("Success")
            ];
        } catch (Exception $e) {
            return [
                "status" => "error",
                "message" => __("Message could not be sent. Mailer Error: {$mail->ErrorInfo}")
            ];
        }
    }
}