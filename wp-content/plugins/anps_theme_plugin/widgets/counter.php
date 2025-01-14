<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;


class Anps_Counter extends Widget_Base{

  public function get_name(){
    return 'counter';
  }

  public function get_title(){
    return 'Anps Counter';
  }

  public function get_icon(){
    return 'far fa-clock';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_counter',
        [
            'label' => __( 'Counter', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'text',
        [
            'label' => __( 'Text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter counter text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'max_number',
        [
            'label' => __( 'Max number', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter max numbeer', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'time',
        [
            'label' => __( 'Time', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'The total duration of the count up animation', 'anps_theme_plugin' ),
            'default' => __( '5000', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'number_color',
        [
            'label' => __('Number color', 'anps_theme_plugin'),
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
        'divider_color',
        [
            'label' => __('Divider color', 'anps_theme_plugin'),
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
        $text = $settings['text'];
        $max_number = $settings['max_number'];
        $time = $settings['time'];
        $number_color = $settings['number_color'];
        $divider_color = $settings['divider_color'];
        $title_color = $settings['title_color'];

        //Set counter
        global $counter_number;
        $counter_number++;
        
        /* Number color */
        $style = '';
        if($number_color) {
            $style .= "#anps-counter-$counter_number .title:after {background-color: $number_color;} #anps-counter-$counter_number .title span {color: $number_color;}";
        }
        if($divider_color) {
            $style .= "#anps-counter-$counter_number .title:before {background-color: $divider_color;}";
        }
        if($title_color) {
            $style .= "#anps-counter-$counter_number h4 {color: $title_color;}";
        }
        //display counter
        echo "<div class='counter-wrap' id='anps-counter-$counter_number'>
                    <h2 class='title'><span class='text-center counter-number' data-time='$time' data-to='$max_number'>0</span></h2>
                    <h4 class='text-center'>$text</h4>
                </div>";
        if($style) {
            echo"<style>$style</style>";
        }
        
        
    }
}