<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;


class Anps_Error404 extends Widget_Base{

  public function get_name(){
    return 'error404';
  }

  public function get_title(){
    return 'Anps Error404';
  }

  public function get_icon(){
    return 'fas fa-times';
    
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_counter',
        [
            'label' => __( 'Error404', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'title',
        [
            'label' => __( 'Title', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter content text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'subtitle',
        [
            'label' => __( 'Subtitle', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter content text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'image',
        [
            'label'			=> __( 'Image', 'anps_theme_plugin' ),
			'type'			=> Controls_Manager::MEDIA,
            'dynamic'       => [ 'active' => true ],
			'default'		=> [
				'url'	=> Utils::get_placeholder_image_src()
			],
			'show_external'	=> true
        ]
    );
    
    
    $this->end_controls_section();
}

/**
 * Render alert widget output on the frontend.
 *
 * Written in PHP and used to generate the final HTML.
 *
 * @since 1.0.0
 * @access protected
 */
protected function render() {
    $settings = $this->get_settings_for_display();

        //store value from controls
        $title = $settings['title'];
        $subtitle = $settings['subtitle'];
        $image = $settings['image']['url'];

        //display on frontend
        echo '<div class="text-center">';
        echo "<h2 class='title fs30'>$title</h2>";
        echo '<br>';
        echo "<span>$subtitle</span>";
        echo '<br>';
        if( $image ) {
            echo '<img src="'.$image.'" class="error404">';
        }
        echo '</div>';
        
    }
}