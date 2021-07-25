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

define('NUF_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('NUF_PLUGIN_URL', trailingslashit(plugins_url('/', __FILE__)));

require_once NUF_PATH . 'autoload.php';

add_action('plugins_loaded', function (){
    \New_User_Form_Elementor\Classes\Bootstrap::instance();
});