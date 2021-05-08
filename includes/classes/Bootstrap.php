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

}