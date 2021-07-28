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

        $page_id = $widget_id = 0;

        $user_login = isset($_POST['username']) ? $_POST['username'] : "";
        $user_pass = isset($_POST['user_password']) ? $_POST['user_password'] : "";
        $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : "";
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
        $user_role = '';

        if (!empty($_POST['page_id'])):
            $page_id = intval($_POST['page_id'], 10);
        endif;

        if (!empty($_POST['widget_id'])):
            $widget_id = sanitize_text_field($_POST['widget_id']);
        endif;

        $settings = $this->nuf_get_widget_settings($page_id, $widget_id);

        if (!empty($settings)):
            $user_role = sanitize_text_field($settings['nuf_user_role']);
        endif;

        $userdata = array(
            'user_login' => $user_login,
            'user_pass' => $user_pass,
            'user_email' => $user_email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'role' => $user_role
        );

        $user_id = wp_insert_user($userdata);

        die();

    }

    function find_element_recursive($elements, $form_id) {
        
        foreach ($elements as $element):

                if ($form_id === $element['id']):
                    return $element;
                endif;

            if (!empty($element['elements'])):
                $element = $this->find_element_recursive($element['elements'], $form_id);
                
                if ($element):
                    return $element;
                endif;
            endif;

        endforeach;

        return false;
    }

    function nuf_get_widget_settings($page_id, $widget_id) {

        $document = Plugin::$instance->documents->get($page_id);
        $settings = [];

        if ($document):

            $elements = Plugin::instance()->documents->get($page_id)->get_elements_data();
            $widget_data = $this->find_element_recursive($elements, $widget_id);
            $widget = Plugin::instance()->elements_manager->create_element_instance($widget_data);

            if ($widget):
                $settings = $widget->get_settings_for_display();
            endif;

        endif;

        return $settings;
    }

}