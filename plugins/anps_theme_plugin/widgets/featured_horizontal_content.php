<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;


class Anps_Featured_Horizontal_Content extends Widget_Base{

  public function get_name(){
    return 'featured_horizontal_content';
  }

  public function get_title(){
    return 'Anps Featured Horizontal Content';
  }

  public function get_icon(){
    return 'fas fa-bullhorn';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_featured_horizontal_content',
        [
            'label' => __( 'Featured Horizontal Content', 'anps_theme_plugin' ),
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
    $this->add_control(
        'content',
        [
            'label' => __( 'Content', 'anps_theme_plugin' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'placeholder' => __( 'Enter content of shortcode', 'anps_theme_plugin' ),
        ]
    );
    $this->add_control(
        'link',
        [
            'label' => __( 'Link', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter content text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
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
        $image = $settings['image']['url'];
        $content = $settings['content'];
        $link = $settings['link'];
        
        //validation
        if($image) {
            echo wp_get_attachment_image_src($image, 'full');
        }

        if( $link ) {
            $link_el_start = "<a href='".$link."' target='_blank'>";
            $link_el_end = "</a>";
        }
        
        //display on frontent
        echo "<div class='featured-horizontal'>";
            echo "<div class='featured-horizontal-header'>";
            if($link !== ''){
                echo "$link_el_start<img alt='$title' src='$image'>$link_el_end";
            }else{
                echo "<img alt='$title' src='$image'>";
            }
            echo "</div>";
            echo "<div class='featured-horizontal-content'>";
            if($link !== ''){
                echo "$link_el_start<h3 class='featured-horizontal-title'>$title</h3>$link_el_end";
            }else{
                echo "<h3 class='featured-horizontal-title'>$title</h3>";
            }
                echo "<p class='featured-horizontal-desc'>$content</p>";
            echo "</div>";
        echo "</div>";
    }
}