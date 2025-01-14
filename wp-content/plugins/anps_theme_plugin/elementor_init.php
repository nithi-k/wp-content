<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
final class Anps_Shortcodes_Extension {

/**
 * Plugin Version
 *
 * @since 1.0.0
 *
 * @var string The plugin version.
 */
const VERSION = '1.0.0';

/**
 * Minimum Elementor Version
 *
 * @since 1.0.0
 *
 * @var string Minimum Elementor version required to run the plugin.
 */
const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

/**
 * Minimum PHP Version
 *
 * @since 1.0.0
 *
 * @var string Minimum PHP version required to run the plugin.
 */
const MINIMUM_PHP_VERSION = '7.0';

/**
 * Instance
 *
 * @since 1.0.0
 *
 * @access private
 * @static
 *
 * @var Anps_Shortcodes_Extension The single instance of the class.
 */
private static $_instance = null;

/**
 * Instance
 *
 * Ensures only one instance of the class is loaded or can be loaded.
 *
 * @since 1.0.0
 *
 * @access public
 * @static
 *
 * @return Anps_Shortcodes_Extension An instance of the class.
 */
public static function instance() {

    if ( is_null( self::$_instance ) ) {
        self::$_instance = new self();
    }
    return self::$_instance;

}

/**
 * Constructor
 *
 * @since 1.0.0
 *
 * @access public
 */
public function __construct() {

    add_action( 'init', [ $this, 'i18n' ] );
    add_action( 'plugins_loaded', [ $this, 'init' ] );

}

/**
 * Load Textdomain
 *
 * Load plugin localization files.
 *
 * Fired by `init` action hook.
 *
 * @since 1.0.0
 *
 * @access public
 */
public function i18n() {

    load_plugin_textdomain( 'anps_theme_plugin' );

}

/**
 * Initialize the plugin
 *
 * Load the plugin only after Elementor (and other plugins) are loaded.
 * Checks for basic plugin requirements, if one check fail don't continue,
 * if all check have passed load the files required to run the plugin.
 *
 * Fired by `plugins_loaded` action hook.
 *
 * @since 1.0.0
 *
 * @access public
 */
public function init() {


    // Add Plugin actions
    add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
}

/**
 * Admin notice
 *
 * Warning when the site doesn't have Elementor or VC installed or activated.
 *
 * @since 1.0.0
 *
 * @access public
 */
public function admin_notice_missing_main_plugin() {

    if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

    $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
        esc_html__( '%1$s requires %2$s or %3$s to be installed and activated.', 'anps_theme_plugin' ),
        '<strong>' . esc_html__( 'Anps Theme Plugin', 'anps_theme_plugin' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor Page Builder', 'anps_theme_plugin' ) . '</strong>',
        '<strong>' . esc_html__( 'WP Bakery Page Builder', 'anps_theme_plugin' ) . '</strong>'
    );

    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

}

/**
 * Init Widgets
 *
 * Include widgets files and register them
 *
 * @since 1.0.0
 *
 * @access public
 */
public function init_widgets() {

    // Include Widget files
    
    require_once( __DIR__ . '/widgets/alert.php' );
    require_once(__DIR__ . '/widgets/appointment.php');
    require_once(__DIR__ . '/widgets/button.php');
    require_once(__DIR__ . '/widgets/counter.php');
    require_once(__DIR__ . '/widgets/cta.php');
    require_once(__DIR__ . '/widgets/download.php');
    require_once(__DIR__ . '/widgets/error404.php');
    require_once(__DIR__ . '/widgets/featured_content.php');
    require_once(__DIR__ . '/widgets/featured_horizontal_content.php');
    require_once(__DIR__ . '/widgets/gallery.php');
    require_once(__DIR__ . '/widgets/gallery_slider.php');
    require_once(__DIR__ . '/widgets/heading.php');
    require_once(__DIR__ . '/widgets/icon.php');
    require_once(__DIR__ . '/widgets/portfolio.php');
    require_once(__DIR__ . '/widgets/quote.php');
    require_once(__DIR__ . '/widgets/recent_blog.php');
    require_once(__DIR__ . '/widgets/recent_portfolio.php');
    require_once(__DIR__ . '/widgets/subscribe.php');
    require_once(__DIR__ . '/widgets/team.php');
    require_once(__DIR__ . '/widgets/team_with_description.php');
    require_once(__DIR__ . '/widgets/blog.php');
    require_once(__DIR__ . '/widgets/contact_info.php');
    require_once(__DIR__ . '/widgets/contact_info_card.php');
    require_once(__DIR__ . '/widgets/google_maps.php');
    require_once(__DIR__ . '/widgets/info.php');
    require_once(__DIR__ . '/widgets/list.php');
    require_once(__DIR__ . '/widgets/social_icon.php');
    require_once(__DIR__ . '/widgets/table.php');
    require_once(__DIR__ . '/widgets/timeline.php');
    require_once(__DIR__ . '/widgets/logos.php');
    require_once(__DIR__ . '/widgets/twitter.php');
    require_once(__DIR__ . '/widgets/testimonials.php');


    // Register widget
    
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Alert() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Appointment() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Button() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Counter() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Cta() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Download() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Error404() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Featured_Content() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Featured_Horizontal_Content() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Gallery() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Gallery_Slider() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Heading() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Icon() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Portfolio() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Quote() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Recent_Blog() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Recent_Portfolio() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Subscribe() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Team() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_TWD() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Blog() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Contact_Info() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Contact_Info_Card() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Google_Maps() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Info() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_List() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Social_Icon() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Table() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Timeline() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Logos() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Twitter() );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Anps_Testimonials() );



}

/**
 * Init Controls
 *
 * Include controls files and register them
 *
 * @since 1.0.0
 *
 * @access public
 */


}

Anps_Shortcodes_Extension::instance();