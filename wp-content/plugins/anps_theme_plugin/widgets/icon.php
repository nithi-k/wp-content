<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;


class Anps_Icon extends Widget_Base{

  public function get_name(){
    return 'icon';
  }

  public function get_title(){
    return 'Anps Icon';
  }

  public function get_icon(){
    return 'fas fa-icons';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_icon',
        [
            'label' => __( 'Icon', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'title',
        [
            'label' => __( 'Title', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter title', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'text',
        [
            'label' => __( 'Text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::WYSIWYG,
            'label_block' => true,
        ]
    );
    $this->add_control(
        'link',
        [
            'label' => __( 'Link', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter link', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'target',
        [
            'label' => __( 'Target', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '_self', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'icon',
            [
            'label'   => __('Icon', 'anps_theme_plugin'),
            'type'    => Controls_Manager::ICONS,
            'default' => [
            'value'   => 'fas fa-bars',
            'library' => 'fa-solid',
            ],
        ]
    );
    $this->add_control(
        'image',
        [
            'label'	=> __( 'Custom icon image', 'anps_theme_plugin' ),
			'type'	=> Controls_Manager::MEDIA,
            'dynamic' => [ 'active' => true ],
			'default' => [
				'url' => ''
			],
			'show_external'	=> true
        ]
    );
    $this->add_control(
        'position',
        [
            'label' => __( 'Position', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                'icon-left' => __('Left', 'anps_theme_plugin'),
                'icon-right' => __('Right', 'anps_theme_plugin'),
                'icon-center' => __('Center', 'anps_theme_plugin'),
            ],
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'icon_size',
        [
            'label' => __( 'Icon Size', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '30', 'anps_theme_plugin' ),
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
        $text = $settings['text'];
        $link = $settings['link'];
        $target = $settings['target'];
        $icon = $settings['icon']['value'];
        $image = $settings['image']['url'];
        $position = $settings['position'];
        $icon_size = $settings['icon_size'];

        //display on frontend
         echo "<div class='icon $position'>";
         echo "<div class='icon-header'>";
         if($image != '') {
             echo "<div class='icon-media' style='width: {$icon_size}px;'><img src='".$image."'></div>";
         } else {
             echo "<div class='icon-media' data-style='width: {$icon_size}px;' style='font-size: {$icon_size}px;'><i class='$icon'></i></div>";
         }
         echo "<h3 class='icon-title text-uppercase'>$title</h3>";
         echo "</div>";
         echo "<p>$text</p>";
         if($link!='') {
             echo "<a href='".esc_url($link)."' target='$target' class='btn btn-md btn-minimal'>".esc_html__('Read more', 'anps_theme_plugin')."</a>";
         }
         echo "</div>";
        

        
    }
}