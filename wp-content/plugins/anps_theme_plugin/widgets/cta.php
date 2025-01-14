<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;


class Anps_Cta extends Widget_Base
{

    public function get_name()
    {
        return 'anps_call_to_action';
    }

    public function get_title()
    {
        return 'Anps Call to Action';
    }

    public function get_icon()
    {
        return 'far fa-window-restore';
    }

    public function get_categories()
    {
        return ['anps-em'];
    }
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_counter',
            [
                'label' => __('Call to Action', 'anps_theme_plugin'),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __('Text', 'anps_theme_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter content text', 'anps_theme_plugin'),
                'default' => __('', 'anps_theme_plugin'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'color',
            [
                'label' => __('Content color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'url',
            [
                'label' => __('Url', 'anps_theme_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter url for button', 'anps_theme_plugin'),
                'default' => __('', 'anps_theme_plugin'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'target',
            [
                'label' => __('Target', 'anps_theme_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => __('_self', 'anps_theme_plugin'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => __('Button text', 'anps_theme_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter text for button', 'anps_theme_plugin'),
                'default' => __('', 'anps_theme_plugin'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'btn_select',
            [
                'label' => __('Button type', 'anps_theme_plugin'),
                'type' => Controls_Manager::SELECT,
                'options' =>  [
                    'btn-normal' => __('Normal', 'anps_theme_plugin'),
                    'btn-dark' => __('Dark', 'anps_theme_plugin'),
                    'btn-light' => __('Light', 'anps_theme_plugin'),
                ],
                'label_block' => true,
                'save_always' => true,
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        //store value from controls
        $text = $settings['text'];
        $color = $settings['color'];
        $url = $settings['url'];
        $target = $settings['target'];
        $btn_text = $settings['btn_text'];
        $btn_select = $settings['btn_select'];

        //display on frontend
        echo '<div class="anps_cta">';
        echo "<div class='cta-content font1' style='color: $color'>$text</div>";
        if ($url) {
            echo "<a href='$url' target='$target' class='btn btn-lg $btn_select '>$btn_text</a>";
        }
        echo '</div>';
    }
}
