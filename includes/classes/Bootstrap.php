<?php

namespace New_User_Form_Elementor\Classes;

// Exit if accessed directly
if (!defined('ABSPATH')):
    exit;
endif;

use New_User_Form_Elementor\Traits\User_Registration;

class Bootstrap{

    use User_Registration;

    private static $instance = null;

    public static function instance(){
        if (self::$instance == null):
            self::$instance = new self;
        endif;

        return self::$instance;
    }

    private function __construct(){
        $this->hook_registration();
    }

    public function init_widgets(){
        require_once(NUF_PATH . '/includes/classes/form/form.php');
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Form() );
    }

    public function widget_scripts() {
        wp_enqueue_script('nuf-js', NUF_PLUGIN_URL . 'assets/js/nuf.js', ['jquery'], false, true);

        $translation_array = [
            'ajax_url' => admin_url('admin-ajax.php')
        ];
        wp_localize_script('nuf-js', 'nuf_ajax', $translation_array);

        wp_enqueue_script('nuf-js');
    }

    protected function hook_registration(){
        add_action('elementor/widgets/widgets_registered', array($this, 'init_widgets'));
        
        // Load script for the front-end
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

        // Register User
        add_action('init', [$this, 'user_registration']);
    }

}