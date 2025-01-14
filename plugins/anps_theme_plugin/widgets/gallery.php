<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class Anps_Gallery extends Widget_Base{

  public function get_name(){
    return 'gallery';
  }

  public function get_title(){
    return 'Anps Gallery';
  }

  public function get_icon(){
    return 'far fa-images';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_gallery',
        [
            'label' => __( 'Gallery', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'gallery',
        [
            'label' => __( 'Images', 'anps_theme_plugin' ),
            'type' => Controls_Manager::GALLERY,
            'default' => [],
        ]
    );
    $this->add_control(
        'columns',
        [
            'label' => __( 'Show in row', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'default' => __( '3', 'anps_theme_plugin' ),
            'options' =>  [
                '2' => __('2', 'anps_theme_plugin'),
                '3' => __('3', 'anps_theme_plugin'),
                '4' => __('4', 'anps_theme_plugin'),
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
protected function render() {
    $settings = $this->get_settings_for_display();

        //store value from controls
        $columns = $settings['columns'];
        $gallery = $settings['gallery'];
        
        //display on frontent
        echo '<div class="gallery-simple gallery-simple--col-' . $columns . '">';
        
        /* First image */
        foreach($gallery as $image_id) {
            echo '<figure class="gallery-simple__item">';
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
            echo '<a title="' . $image_alt . '" class="gallery-simple__link" href="' . $image_id['url'] . '"><img src="'. $image_id['url'].'"></a>';
            echo '</figure>';
        }
        echo '</div>';
        
    }
}