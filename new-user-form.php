<?php
/**
 * Plugin Name: New User Form for Elementor
 * Description: Adds user registration form widget inside the elementor editor
 * Plugin URI: https://github.com/cesarcor
 * Author: Cesar Correchel
 * Version: 1.0.0
 * Author URI: https://github.com/cesarcor
 * Text Domain: new-user-form-elementor
 */

 // Exit if accessed directly
if (!defined('ABSPATH')):
    exit;
endif;

add_action('plugins_loaded', function (){
    \NEW_USER_FORM\Classes\Bootstrap::instance();
});