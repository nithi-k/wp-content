<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;


class Anps_Download extends Widget_Base{

  public function get_name(){
    return 'download';
  }

  public function get_title(){
    return 'Anps Download';
  }

  public function get_icon(){
    return 'fas fa-download';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_download',
        [
            'label' => __( 'Download', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'text',
        [
            'label' => __( 'Text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter content text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'icon',
            [
            'label'             => __('Content icon', 'anps_theme_plugin'),
            'type'              => Controls_Manager::ICONS,
            'default' => [
            'value'     => 'fas fa-bars',
            'library'   => 'fa-solid',
            ],
        ]
    );
    $this->add_control(
        'color',
        [
            'label' => __('Content color', 'anps_theme_plugin'),
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
        'url',
        [
            'label' => __( 'Url', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter url for button', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'target',
        [
            'label' => __( 'target', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '_self' => __('_self', 'anps_theme_plugin'),
                '_blank' => __('_blank', 'anps_theme_plugin'),
                '_parent' => __('_parent', 'anps_theme_plugin'),
                '_top' => __('_top', 'anps_theme_plugin'),
            ],
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'download_text',
        [
            'label' => __( 'Download text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter download text for button', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'btn_icon',
            [
            'label'             => __('Button icon', 'anps_theme_plugin'),
            'type'              => Controls_Manager::ICONS,
            'default' => [
            'value'     => 'fas fa-bars',
            'library'   => 'fa-solid',
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
        $text = $settings['text'];
        $color = $settings['color'];
        $url = $settings['url'];
        $target = $settings['target'];
        $btn_icon = $settings['btn_icon']['value'];
        $download_text = $settings['download_text'];
        $icon = $settings['icon']['value'];

        //validation is icon selected
        $icon_content = '';
        if($icon) {
            $icon_content = "<i class='fa $icon'></i> ";
        }
        $icon_download = '';
        if($btn_icon) {
            $icon_download = "<i class='fa $btn_icon'></i> ";
        }
        //display on frontend
        echo '<div class="download">';
        echo "<div class='download-content text-uppercase' style='color: $color'>$icon_content$text</div>";
        if($url) {
            echo "<a target='$target' href='$url' class='btn btn-md btn-dark btn-shadow'>$icon_download$download_text</a>";
        }
        echo '</div>';
        
    }
}