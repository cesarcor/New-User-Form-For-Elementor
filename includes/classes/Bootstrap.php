<?php

namespace New_User_Form_Elementor\Classes;

// Exit if accessed directly
if (!defined('ABSPATH')):
    exit;
endif;

class Bootstrap{

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
        require_once(NUF_ELEMENTOR_PATH . '/includes/classes/form/form.php');
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Form() );
    }

    protected function hook_registration(){
        add_action('elementor/widgets/widgets_registered', array($this, 'init_widgets'));
    }

}