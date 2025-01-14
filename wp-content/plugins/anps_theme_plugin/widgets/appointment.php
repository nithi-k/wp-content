<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

class Anps_Appointment extends Widget_Base{

  public function get_name(){
    return 'appointment';
  }

  public function get_title(){
    return 'Anps Appointment';
  }

  public function get_icon(){
    return 'far fa-calendar-alt';
  }

  public function get_categories(){
    return ['anps-em'];
  }
 
  protected function _register_controls() {
    $this->start_controls_section(
        'section_appointment',
        [
            'label' => __( 'Appointment', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'appointment_image',
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
        'appointment_location',
        [
            'label' => __( 'Location', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $this->add_control(
        'appointment_title',
        [
            'label' => __( 'Title', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $this->add_control(
        'appointment_text',
        [
            'label' => __( 'Text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
        ]
    );
    //store value from array 
    $arr = anps_get_all_cf7_forms();
    //flip value from array
    $fliped = array_flip($arr);
    
    $this->add_control(
        'appointment_dropdown',
        [
            'label' => __( 'Contact Form', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  $fliped,
            'label_block' => true,
            'save_always' => true,
        ]
    );
    
}

protected function render() {
    $ctrl = $this->get_active_settings();
    $settings = $this->get_settings_for_display();
    $image = $settings['appointment_image']['url'];
    $location = $settings['appointment_location'];
    $title = $settings['appointment_title'];
    $text = $settings['appointment_text'];
    $dropdown = $ctrl['appointment_dropdown'];
    
        echo '<div class="appointment">';
           
            /* Left side */
            echo '<div class="appointment-content">';
                echo '<div class="appointment-media">';
                echo '<img src="'.$image.'" class="attachment-full size-full">';
                
                if($location!='') {
                    echo do_shortcode("[google_maps zoom='14' map_type='ROADMAP' height='300' scroll='true'][google_maps_item marker_center='' pin='' location='".$location."'][/google_maps_item][/google_maps]");
                }
                echo '</div>';
                echo '<div class="text-center"><h4 class="title appointment-title">' . $title . '</h4></div>';
                echo '<p class="appointment-text">' . $text . '</p>';
            echo '</div>';

            /* Right side */
            echo '<div class="appointment-form">';
                echo do_shortcode("[contact-form-7 id='$dropdown']");
            echo '</div>';
        echo '</div>';

    }   
}