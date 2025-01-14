<?php
/*
Plugin Name: Anps Theme plugin
Plugin URI: https://anpsthemes.com
Description: Anps theme plugin
Author: Anpsthemes
Version: 1.4.2
Author URI: https://anpsthemes.com
Text Domain: anps_theme_plugin
Domain Path: /languages
*/

if (!defined('WPINC')) {
    die;
}

$version = '';
if (is_admin()) {
    if (!function_exists('get_plugin_data')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    $version = get_plugin_data(__FILE__);
    $version = $version['Version'];
}

/* Plugin constants */
define('ANPS_PLUGIN_VERSION', $version);
define('ANPS_PLUGIN_PATH', plugin_dir_path(__FILE__));

/*updates*/
require 'plugin-updates/plugin-update-checker.php';
$AnpsUpdateChecker = PucFactory::buildUpdateChecker(
    'https://astudio.si/preview/plugins/industrial/update.json',
    __FILE__
);

/* Elementor Page Builder  */
include_once 'elementor_init.php';

// include helpers
include_once 'helpers.php';

/* Portfolio */
include_once 'portfolio.php';
add_action('init', 'anps_portfolio');
function anps_portfolio()
{
    new Portfolio();
}
/* Team */
include_once 'team.php';
add_action('init', 'anps_team');
function anps_team()
{
    new AnpsTeam();
}
/* Load plugin admin_view.php page */
if (!function_exists('anps_plugin_options_do_page')) {
    function anps_plugin_options_do_page()
    {
        include_once ANPS_PLUGIN_PATH . '/views/admin_view.php';
    }
}
/* Include google analytics */
function anps_ga_wp_footer()
{
    if (get_option('anps_google_analytics', '') != '') {
        echo get_option('anps_google_analytics', '');
    }
}


add_action('wp_footer', 'anps_ga_wp_footer');
