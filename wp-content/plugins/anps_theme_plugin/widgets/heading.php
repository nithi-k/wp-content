<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;


class Anps_Heading extends Widget_Base{

  public function get_name(){
    return 'heading';
  }

  public function get_title(){
    return 'Anps Heading';
  }

  public function get_icon(){
    return 'fas fa-heading';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_heading',
        [
            'label' => __( 'Heading', 'anps_theme_plugin' ),
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
        'subtitle',
        [
            'label' => __( 'Subtitle', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter subtitle', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'size',
        [
            'label' => __( 'Size', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '1' => __('H1', 'anps_theme_plugin'),
                '2' => __('H2', 'anps_theme_plugin'),
                '3' => __('H3', 'anps_theme_plugin'),
                '4' => __('H4', 'anps_theme_plugin'),
                '5' => __('H5', 'anps_theme_plugin'),
            ],
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'heading_class',
        [
            'label' => __( 'Heading class', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                'heading' => __('Middle heading', 'anps_theme_plugin'),
                'content_heading' => __('Content heading', 'anps_theme_plugin'),
                'style-3' => __('Left heading', 'anps_theme_plugin'),
            ],
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'heading_style',
        [
            'label' => __( 'Heading style', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                'style-1' => __('Style 1', 'anps_theme_plugin'),
                'divider-sm' => __('Style 2', 'anps_theme_plugin'),
                'divider-lg' => __('Style 3', 'anps_theme_plugin'),
                'divider-modern' => __('Style 4', 'anps_theme_plugin'),
            ],
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'h_id',
        [
            'label' => __( 'Id', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter id', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'h_class',
        [
            'label' => __( 'Class', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter class', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'title_color',
        [
            'label' => __('Title color', 'anps_theme_plugin'),
            'type'  => Controls_Manager::COLOR,
            'scheme'=> [
                'type'  => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'color: {{VALUE}};',
            ]
        ]
    );
    $this->add_control(
        'subtitle_color',
        [
            'label' => __('Subtitle color', 'anps_theme_plugin'),
            'type'  => Controls_Manager::COLOR,
            'scheme'=> [
                'type'  => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'color: {{VALUE}};',
            ]
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
        $size = $settings['size'];
        $heading_class = $settings['heading_class'];
        $heading_style = $settings['heading_style'];
        $h_id = $settings['h_id'];
        $h_class = $settings['h_class'];
        $title_color = $settings['title_color'];
        $subtitle_color = $settings['subtitle_color'];

        
        $id = '';
        if($h_id) {
            $id = " id='".$h_id."'";
        }

        //switch case statment for Heding class
        switch($heading_class) {
            case "content_heading" : $head_class = " class='heading-content $h_class $heading_style'"; break;
            case "heading" : $head_class = " class='heading-middle $h_class $heading_style'"; break;
            case "style-3" : $head_class = " class='heading-left $h_class $heading_style'"; break;
        }
        
        /* Subtitle color */
        if(isset($subtitle_color)&&$subtitle_color!='') {
            $subtitle_color = " style='color: $subtitle_color'";
        }

        /* Subtitle */
        if( $subtitle != '' ) {
            $subtitle = '<em class="heading-subtitle"' . $subtitle_color . '>' . $subtitle . '</em>';
        }

        //display on frontend
        if( $heading_style == 'divider-modern' && $title_color!='') {
            echo '<h'.$size.$head_class.' '.$id.' style="color:'.$title_color.'"><span>' . $subtitle . $title . '</span></h'.$size.'>';
        } elseif ($title_color!='') {
            echo '<h'.$size.$head_class.' '.$id.' style="color:'.$title_color.'"><span>' . $title . $subtitle . '</span></h'.$size.'>';
        }
    }
}