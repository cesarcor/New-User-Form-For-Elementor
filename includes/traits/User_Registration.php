<?php
namespace New_User_Form_Elementor\Traits;

use Elementor\Plugin;

// Exit if accessed directly
if (!defined('ABSPATH')):
    exit;
endif;

trait User_Registration{

    public function user_registration(){
        add_action('wp_ajax_nuf_register_user', [$this, 'nuf_register_user']);
        add_action('wp_ajax_nopriv_nuf_register_user', [$this, 'nuf_register_user']);
    }

    /**
	 * Register user
	 *
	 * @since 1.0.0
	 * @access public
	*/
    public function nuf_register_user(){

        if(!wp_verify_nonce($_POST['nuf_register_user_nonce'], 'nuf_register_user')):
            wp_send_json_error(wp_die('Invalid nonce'));
        endif;

        $user_login = isset($_POST['username']) ? $_POST['username'] : "";
        $user_pass = isset($_POST['user_password']) ? $_POST['user_password'] : "";
        $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : "";
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";

        $userdata = array(
            'user_login' => $user_login,
            'user_pass' => $user_pass,
            'user_email' => $user_email,
            'first_name' => $first_name,
            'last_name' => $last_name
        );

        $user_id = wp_insert_user($userdata);

        die();

    }

}