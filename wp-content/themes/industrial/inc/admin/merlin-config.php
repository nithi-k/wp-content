<?php
/**
 * Merlin WP Configuration file.
 *
 * @package     AnpsThemes Admin
 * @link        http://anpsthemes.com/
 */

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(

	$config  = array(
		'directory'            => 'inc/admin/merlin',
		'merlin_url'           => 'merlin',
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes',
		'dev_mode'             => false,
		'license_step'         => true,
		'license_required'     => false,
		'license_help_url'     => 'https://kb.themebeans.com/article/14-license-activation-guide',
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Anps Theme Wizard', 'industrial' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'industrial' ),
		'return-to-dashboard'      => esc_html__( 'Return to the Dashboard', 'industrial' ),
		'ignore'                   => esc_html__( 'Disable Wizard', 'industrial' ),

		'btn-skip'                 => esc_html__( 'Skip', 'industrial' ),
		'btn-next'                 => esc_html__( 'Next', 'industrial' ),
		'btn-start'                => esc_html__( 'Start', 'industrial' ),
		'btn-no'                   => esc_html__( 'Cancel', 'industrial' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'industrial' ),
		'btn-child-install'        => esc_html__( 'Install', 'industrial' ),
		'btn-content-install'      => esc_html__( 'Install', 'industrial' ),
		'btn-import'               => esc_html__( 'Import', 'industrial' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'industrial' ),
		'btn-license-skip'         => esc_html__( 'Later', 'industrial' ),

		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'industrial' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'industrial' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'industrial' ),
		'license-label'            => esc_html__( 'License key', 'industrial' ),
		/* translators: Theme Name */
		'license-success%s'        => esc_html__( '%s is already registered and activated. Please proceed to the next step.', 'industrial' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'industrial' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'industrial' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome', 'industrial' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'industrial' ),
		'welcome%s'                => esc_html__( 'Welcome to Anpsthemes easy theme and demo installation. This is a step by step process which will guide you trough setting up your theme effortlessly.', 'industrial' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'industrial' ),
		'welcome-let'        	   => esc_html__( 'Lets start!', 'industrial' ),

		'child-header'             => esc_html__( 'Install Child Theme', 'industrial' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'industrial' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'industrial' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'industrial' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'industrial' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'industrial' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'industrial' ),

		'plugins-header'           => esc_html__( 'Install Plugins', 'industrial' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'industrial' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'industrial' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'industrial' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'industrial' ),

		'pagebuilder-header'           => esc_html__( 'Choose Page Builder', 'industrial' ),
		'pagebuilder-header-success'   => esc_html__( 'You\'re up to speed!', 'industrial' ),
		'pagebuilder'                  => esc_html__( 'Let\'s choose your preferred page builder. Choose one of the two offered options (Elementor or WP Bakery page builder)', 'industrial' ),
		'pagebuilder-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'industrial' ),
		'pagebuilder-action-link'      => esc_html__( 'Advanced', 'industrial' ),

		'import-header'            => esc_html__( 'Select preferred demo', 'industrial' ),
		'import'                   => esc_html__( 'Almost there! Select your demo from drop down menu,to complete your installation.', 'industrial' ),
		'import-action-link'       => esc_html__( 'Advanced', 'industrial' ),

		'ready-header'             => esc_html__( 'All done. Have fun!', 'industrial' ),

		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'industrial' ),
		'ready-action-link'        => esc_html__( 'Extras', 'industrial' ),
		'ready-big-button'         => esc_html__( 'View your website', 'industrial' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://anpsthemes.com/', esc_html__( 'Explore all of Anpsthemes', 'industrial' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://anpsthemes.com/contact/', esc_html__( 'Get Theme Support', 'industrial' ) ),
		'ready-link-3'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'industrial' ) ),
	)
);

/**
 * Filter demo content.
 */
function anps_merlin_import_files() {
	if(is_plugin_active( 'js_composer/js_composer.php' ) and is_plugin_active( 'elementor/elementor.php' )){
		return '<div>You can not have active 2 or more page builders</div>';
	}elseif(is_plugin_active( 'js_composer/js_composer.php' )){
	return array(
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 1', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo1/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo1/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo1/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo1/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo1.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 1', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-1/',
			'anps_slug'						   => 'vc-demo-1'
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 2', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo2/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo2/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo2/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo2/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo2.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 2', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-2/',
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 3', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo3/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo3/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo3/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo3/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo3.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 3', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-3/',
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 4', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo4/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo4/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo4/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo4/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo4.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 4', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-4/',
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 5', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo5/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo5/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo5/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo5/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo5.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 5', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-5/',
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 6', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo6/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo6/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo6/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo6/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo6.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 6', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-6/',
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 7', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo7/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo7/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo7/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo7/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo7.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 7', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-7/',
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 8', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo8/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo8/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo8/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo8/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo8.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 8', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-8/',
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 9', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo9/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo9/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo9/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo9/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo9.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 9', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-9/',
		),
		array(
			'import_file_name'             => esc_html__( 'Industrial Demo 10', 'anpsthemes' ),
			'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo10/content.xml' ),
			'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo10/widgets.wie' ),
			'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo10/customizer.dat' ),
			'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo10/slider3.zip' ),
			'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo10.jpg',
			'import_notice'                => esc_html__( 'Industrial demo content 10', 'anpsthemes' ),
			'preview_url'                  => 'http://anpsthemes.com/industrial/demo-10/',
		),
		);
	}elseif(is_plugin_active( 'elementor/elementor.php' )){
		return array(
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 1', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo1e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo1e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo1e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo1e/slider3.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo1.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 1', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-1/',
				'anps_slug'						   => 'vc-demo-1'
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 2', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo2e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo2e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo2e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo2e/slider3.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo2.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 2', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-2/',
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 3', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo3e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo3e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo3e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo3e/slider3.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo3.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 3', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-3/',
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 4', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo4e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo4e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo4e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo4e/slider3.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo4.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 4', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-4/',
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 5', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo5e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo5e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo5e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo5e/slider3.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo5.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 5', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-5/',
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 6', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo6e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo6e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo6e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo6e/slider31.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo6.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 6', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-6/',
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 7', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo7e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo7e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo7e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo7e/slider3.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo7.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 7', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-7/',
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 8', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo8e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo8e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo8e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo8e/slider3.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo8.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 8', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-8/',
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 9', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo9e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo9e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo9e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo9e/slider31.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo9.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 9', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-9/',
			),
			array(
				'import_file_name'             => esc_html__( 'Industrial Demo 10', 'anpsthemes' ),
				'local_import_file'            => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo10e/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo10e/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo10e/customizer.dat' ),
				'local_import_rev_slider_file' => get_parent_theme_file_path( 'inc/admin/merlin/demos/demo10e/slider31.zip' ),
				'import_preview_image_url'     =>  'http://astudio.si/preview/merlin-img/industrial_demo10.jpg',
				'import_notice'                => esc_html__( 'Industrial demo content 10', 'anpsthemes' ),
				'preview_url'                  => 'http://anpsthemes.com/industrial/demo-10/',
			),
		);
	}


}
add_filter( 'merlin_import_files', 'anps_merlin_import_files' );

/**
 * Assign menus after the import has finished.
 */
function anps_merlin_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Menu 1', 'nav_menu' );
	$services_menu = get_term_by( 'name', 'Left side services menu', 'nav_menu');
	$side_menu = get_term_by('name', 'side menu', 'nav_menu');

	set_theme_mod(
		'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	if (isset($front_page_id->ID)) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		$blog_page_id  = get_page_by_title( 'Blog' );
		if (isset($blog_page_id->ID)) {
			update_option( 'page_for_posts', $blog_page_id->ID );
		}
	}

}
add_action( 'merlin_after_all_import', 'anps_merlin_after_import_setup' );
