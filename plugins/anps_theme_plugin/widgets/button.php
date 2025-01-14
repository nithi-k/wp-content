<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;


class Anps_Button extends Widget_Base{

  public function get_name(){
    return 'button';
  }

  public function get_title(){
    return 'Anps Button';
  }

  public function get_icon(){
    return 'fas fa-mouse-pointer';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_button',
        [
            'label' => __( 'Button', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'text',
        [
            'label' => __( 'Text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter button text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
            // 'dynamic' => [
            //     'active' => true,
            // ],
        ]
    );

    $this->add_control(
        
        'link',
        [
            'label' => __( 'Link', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter button link', 'anps_theme_plugin' ),
            'default' => '#',
            // 'dynamic' => [
            //     'active' => true,
            // ],
        ]
    );
    
    $this->add_control(
        
        'target',
        [
            'label' => __( 'Target', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter button target', 'anps_theme_plugin' ),
            'default' => '_self',
            // 'dynamic' => [
            //     'active' => true,
            // ],
        ]
    );

    $this->add_control(
        
        'size',
        [
            'label' => __( 'Size', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'small' => __( 'Small', 'anps_theme_plugin'),
                'medium' => __( 'Medium', 'anps_theme_plugin'),
                'large' => __( 'Large', 'anps_theme_plugin'),
            ],
            // 'dynamic' => [
            //     'active' => true,
            // ],
        ]
    );

    $this->add_control(
        
        'style_button',
        [
            'label' => __( 'Style', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'btn-normal' => __( 'Normal button', 'anps_theme_plugin'),
                'btn-gradient btn-shadow' => __( 'Button with gradient', 'anps_theme_plugin'),
                'btn-dark btn-shadow' => __( 'Dark button', 'anps_theme_plugin'),
                'btn-light' => __( 'Light button', 'anps_theme_plugin'),
                'btn-minimal' => __( 'Minimal button', 'anps_theme_plugin'),
            ],
            // 'dynamic' => [
            //     'active' => true,
            // ],
        ]
    );

    $this->add_control(
        
        'color',
            [
                'label' => __('Text Color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'description' => __('Select text color', 'anps_theme_plugin'),
                'selectors'         => [
                    '{{WRAPPER}}'   => 'color: {{VALUE}};',
                ]
            ]);

    $this->add_control(
        
        'background',
            [
                'label' => __('Background color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                 'scheme'=> [
                     'type'  => Scheme_Color::get_type(),
                     'value' => Scheme_Color::COLOR_2,
                 ],
                 'description' => __('Select button background color', 'anps_theme_plugin'),
                 'selectors'         => [
                      '{{WRAPPER}}'   => 'color: {{VALUE}};',
                  ]
              ]);

     $this->add_control(
              
        'color_hover',
        [
              'label' => __('Text Hover Color', 'anps_theme_plugin'),
              'type'  => Controls_Manager::COLOR,
               'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                     '{{WRAPPER}}'   => 'color: {{VALUE}};',
                 ]
             ]);
    $this->add_control(
        
      'background_hover',
          [
              'label' => __('Background Hover Color', 'anps_theme_plugin'),
              'type'  => Controls_Manager::COLOR,
               'scheme'=> [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_2,
               ],
               'selectors'         => [
                    '{{WRAPPER}}'   => 'color: {{VALUE}};',
                ]
            ]);

    $this->add_control(
        'icon',
        [
        'label'             => __('Icon', 'anps_theme_plugin'),
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

            
            $text = $settings['text'];
            $link = $settings['link'];
            $target = $settings['target'];
            $size = $settings['size'];
            $style_button = $settings['style_button'];
            $color = $settings['color'];
            $background = $settings['background'];
            $color_hover = $settings['color_hover'];
            $background_hover = $settings['background_hover'];
            $icon = $settings['icon']['value'];

    
            //style button 
            $style_attr = "";
            if($color && $color!="#fff") {
                $style_attr = "color:$color";
            }
            if($background && $style_button!='btn-minimal') {
                $style_attr = "background-color:$background";
            }
            
            //switch size
            switch($size) {
                case 'large': $size = ' btn-lg'; break;
                case 'medium': $size = ' btn-md'; break;
                case 'small': $size = ' btn-sm'; break;
            }

            //icon display
            $icon_class = "";
            if($icon) {
                $icon_class = "<i class='fa $icon'></i> ";
            }
    
            //custom id
            $anps_button_counter = 0;
            $style_id = "button-id-$anps_button_counter";
            $anps_button_counter++;

            // print_r($icon);
            
            if(!$link) {
                echo '<button id='.$style_id.' class="btn '.$style_button.' '.$size.'" style='.$style_attr.'>'.$icon_class.$text.'</button>';
            } else {
                echo '<a id='.$style_id.' target='.$target.' href='.$link.' class="btn '.$style_button.' '.$size.'" style='.$style_attr.'>'.$icon_class.$text.'</a>';
            }

            /* Hover background and hover color */
            if($color_hover || $background_hover) {
                echo '<style>';
                echo "#$style_id:hover{";
                if($color_hover) {
                   echo "color: $color_hover !important;";
                }
                if($background_hover && $style_button!='btn-minimal') {
                   echo "background-color: $background_hover !important;";
                }
                echo '}';
                echo '</style>';
            }      
    
    }
}