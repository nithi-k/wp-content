<?php


if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Anps_Quote extends Widget_Base{

  public function get_name(){
    return 'quote';
  }

  public function get_title(){
    return 'Anps Quote';
  }

  public function get_icon(){
    return 'fas fa-quote-right';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_quote',
        [
            'label' => __( 'Quote', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'content',
        [
            'label' => __( 'Quote text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter quote text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'style',
        [
            'label' => __( 'Icon', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => __( 'Style 1', 'anps_theme_plugin' ),
                'blockquote-style-2' => __( 'Style 2', 'anps_theme_plugin' ),
            ],
            'style_transfer' => true,
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

    //Store value from controls      
    
    $content = $settings['content'];
    $style = $settings['style'];

    //display on frontend
    $style_class = '';
        if($style) {
            $style_class = " class='$style'";
        }
    echo "<blockquote$style_class><p>$content</p></blockquote>";
}

}