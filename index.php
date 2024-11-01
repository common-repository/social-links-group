<?php

/**
 * Plugin Name: social links group
 * Plugin URI: #
 * Description: This plugin provide functionality to display social link with multiple time with grouping and aslo with mulitple option to design.
 * Version: 1.1
 * Author: auratechmind
 * Author URI: #
 * License: GPL2
 */
/* * ********** constant ddefine ******************* */
ob_start();
define('WSLG_VERSION', '1.1');

define('WSLG_REQUIRED_WP_VERSION', '3.2');

define('WSLG_PLUGIN', __FILE__);

define('WSLG_PLUGIN_BASENAME', plugin_basename(WSLG_PLUGIN));

define('WSLG_PLUGIN_NAME', trim(dirname(WSLG_PLUGIN_BASENAME), '/'));

define('WSLG_PLUGIN_DIR', untrailingslashit(dirname(WSLG_PLUGIN)));

define('WSLG_PLUGIN_PATH', plugin_dir_path(__FILE__));


require_once WSLG_PLUGIN_DIR . '/include/function.php';
require_once WSLG_PLUGIN_DIR . '/include/widget.php';
/* * *********************** add style to front ************************ */

function WSLG_front_enqueued_style() {
       wp_enqueue_style('animated-css', WSLG_plugin_url('css/animate.css'), array(), WSLG_VERSION, 'all');
       wp_enqueue_style('fontawesome_css', WSLG_plugin_url('css/font-awesome.css'), array(), WSLG_VERSION, 'all');
}

add_action('wp_head', 'WSLG_front_enqueued_style');

/* * *********************** add style ************************ */

function WSLG_enqueued_style() {
       if (is_admin() && isset($_REQUEST['page']) && $_REQUEST['page'] == 'WSLG_settings_menu') {

              wp_enqueue_style('animated-css', WSLG_plugin_url('css/animate.css'), array(), WSLG_VERSION, 'all');
              wp_enqueue_style('jquery-ui-css', WSLG_plugin_url('css/jquery-ui.min.css'), array(), WSLG_VERSION, 'all');
              wp_enqueue_style('WSLG_custom', WSLG_plugin_url('css/wslg_style.css'), array(), WSLG_VERSION, 'all');
              wp_enqueue_style('bootstrap_css', WSLG_plugin_url('css/bootstrap.css'), array(), WSLG_VERSION, 'all');
              wp_enqueue_style('fontawesome_css', WSLG_plugin_url('css/font-awesome.css'), array(), WSLG_VERSION, 'all');
       }
}

add_action('admin_init', 'WSLG_enqueued_style');

/* * *********************** add script scripts ************************ */
add_action('admin_init', 'WSLG_enqueued_scripts');

function WSLG_enqueued_scripts() {
       if (is_admin()) {
              wp_enqueue_script('WSLG_script', WSLG_plugin_url('js/wslg_scripts.js'), array('jquery', 'jquery-ui-dialog'), '1.0', true);
       }
}

/* * *********************** add admin menu ************************ */

add_action('admin_menu', 'WSLG_register_my_custom_submenu_page', 99);

function WSLG_register_my_custom_submenu_page() {
       add_submenu_page('options-general.php', 'Social Links', 'Social Links', 'manage_options', 'WSLG_settings_menu', 'WSLG_settings_page');
}

/* * *********************** add admin menu page ************************ */

function WSLG_settings_page() {
       echo "<style>@font-face {
    font-family: 'FontAwesome';
    src: url('" . WSLG_plugin_url('css') . "/fonts/fontawesome-webfont.eot?v=4.4.0');
    src: url('" . WSLG_plugin_url('css') . "/fonts/fontawesome-webfont.eot?#iefix&v=4.4.0') format('embedded-opentype'), url('" . WSLG_plugin_url('css') . "/fonts/fontawesome-webfont.woff2?v=4.4.0') format('woff2'), url('" . WSLG_plugin_url('css') . "/fonts/fontawesome-webfont.woff?v=4.4.0') format('woff'), url('" . WSLG_plugin_url('css') . "/fonts/fontawesome-webfont.ttf?v=4.4.0') format('truetype'), url('" . WSLG_plugin_url('css') . "/fonts/fontawesome-webfont.svg?v=4.4.0#fontawesomeregular') format('svg');
    font-weight: normal;
    font-style: normal;
}</style>";

       echo '<div id="dialog-confirm"></div>';
       do_action('wslg_admin_page');
}

/* * *********************** Social links group plugin activation hook ************************ */
register_activation_hook(__FILE__, 'WSLG_activation');

function WSLG_activation() {
       add_action('admin_notices', 'wslg_plugin_activation_notice');
}

/* * *********************** Social links group plugin deactivation hook ************************ */
register_deactivation_hook(__FILE__, 'WSLG_deactivation');

function WSLG_deactivation() {
       add_action('admin_notices', 'wslg_plugin_deactivation_notice');
}

/* * *********************** Social links group plugin uninstall hook ************************ */
register_uninstall_hook(__FILE__, 'WSLG_uninstall');

function WSLG_uninstall() {
       add_action('admin_notices', 'wslg_plugin_uninstall_notice');
}

function WSLG_plugin_url($path = '') {
       $url = plugins_url($path, WSLG_PLUGIN);

       if (is_ssl() && 'http:' == substr($url, 0, 5)) {
              $url = 'https:' . substr($url, 5);
       }
       return $url;
}

function redirect($url) {
       wp_redirect($url);
       exit;
}

?>