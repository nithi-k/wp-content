<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Anps_Subscribe extends Widget_Base{

  public function get_name(){
    return 'subscribe';
  }

  public function get_title(){
    return 'Anps Subscribe';
  }

  public function get_icon(){
    return 'far fa-envelope';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_subscribe',
        [
            'label' => __( 'Subscribe', 'anps_theme_plugin' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
        'content',
        [
            'label' => __( 'Description', 'anps_theme_plugin' ),
            'type' => Controls_Manager::WYSIWYG,
            'placeholder' => __( 'Enter content', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    
    $this->add_control(
        'title_color',
        [
            'label' => __( 'Title & placeholder color', 'anps_theme_plugin' ),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .title' => 'color: {{VALUE}}',
            ],
        ]
    );
    $this->add_control(
        'input_bg_color',
        [
            'label' => __( 'Input field background color', 'anps_theme_plugin' ),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .title' => 'color: {{VALUE}}',
            ],
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
        $content= $settings['content'];
        $title_color = $settings['title_color'];
        $input_bg_color = $settings['input_bg_color'];
        
        //validation for colors
        $input_colors = '';

        if($title_color != '') {
            $input_colors .= "color: $title_color;";
            $title_color = " style='color: $title_color;'";
        }

        if($input_bg_color != '') {
            $input_colors .= "background-color: $input_bg_color;";
            $input_bg_color = " style='background-color: $input_bg_color;'";
        }

        if($input_colors != '') {
            $input_colors = " style='$input_colors'";
        }

        //display on frontend
        echo '<div class="subscribe">';
        echo do_shortcode("[newsletter_form default_css='false'$input_colors][newsletter_field name='email' label='Submit your email'][/newsletter_form]");
        echo '<div class="subscribe-content">';
        echo "<div class='subscribe-title'$title_color>$title</div>";
        echo "<div class='subscribe-description'>$content</div>";
        echo '</div>';
        echo '</div>';
        
    }
}