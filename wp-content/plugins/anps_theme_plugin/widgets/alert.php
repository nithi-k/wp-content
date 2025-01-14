<?php


if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Anps_Alert extends Widget_Base{

  public function get_name(){
    return 'alert';
  }

  public function get_title(){
    return 'Anps Alert';
  }

  public function get_icon(){
    return 'fas fa-exclamation-triangle';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_alert',
        [
            'label' => __( 'Alert', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'alert_title',
        [
            'label' => __( 'Text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter alert text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $this->add_control(
        
        'alert_type',
        [
            'label' => __( 'Icon', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'info',
            'options' => [
                'info' => __( 'Info', 'anps_theme_plugin' ),
                'danger' => __( 'Danger', 'anps_theme_plugin' ),
                'warning' => __( 'Warning', 'anps_theme_plugin' ),
                'success' => __( 'Success', 'anps_theme_plugin' ),
                'useful' => __('Useful', 'anps_theme_plugin'),
                'normal' => __('Normal', 'anps_theme_plugin'),
                'info-style-2' => __('Info-2', 'anps_theme_plugin'),
                'danger-style-2' => __('Danger-2', 'anps_theme_plugin'),
                'warning-style-2' => __('Warning-2', 'anps_theme_plugin'),
                'success-style-2' => __('Success-2', 'anps_theme_plugin'),
                'useful-style-2' => __('Useful-2', 'anps_theme_plugin'),
                'normal-style-2' => __('Normal-2', 'anps_theme_plugin'),
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
    // Rendering on first load
    echo '<div class="alert alert-'.$settings['alert_type'].'" role="alert">';
    echo '<span>' . $settings['alert_title'] .'</span>';
    if ( 'info' === $settings['alert_type'] || 'info-style-2' === $settings['alert_type'] ) { 
        echo '<i id="alert-icon" class="fa fa-bell" ></i>';
            }
    if ( 'danger' === $settings['alert_type'] || 'danger-style-2' === $settings['alert_type'] ) { 
        echo '<i id="alert-icon" class="fa fa-exclamation" ></i>';
            }
    if ( 'warning' === $settings['alert_type'] || 'warning-style-2' === $settings['alert_type'] ) { 
        echo '<i id="alert-icon" class="fa fa-info" ></i>';
            }
    if ( 'success' === $settings['alert_type'] || 'success-style-2' === $settings['alert_type'] ) { 
        echo '<i id="alert-icon" class="fa fa-check" ></i>';
            }
    if ( 'useful' === $settings['alert_type'] || 'useful-style-2' === $settings['alert_type'] ) { 
        echo '<i id="alert-icon" class="fa fa-lightbulb-o" ></i>';
            }
    if ( 'normal' === $settings['alert_type'] || 'normal-style-2' === $settings['alert_type'] ) { 
        echo '<i id="alert-icon" class="fa fa-hand-o-right" ></i>';
            }
    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>';        
    
}

}