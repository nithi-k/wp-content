<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Anps_Gallery_Slider extends Widget_Base {

    public function get_name(){
        return 'gallery_slider';
    }

    public function get_title(){
        return 'Anps Gallery Slider';
    }

    public function get_icon(){
        return 'far fa-images';
    }

    public function get_categories(){
        return ['anps-em'];
    }

    protected function _register_controls(){
        $this->start_controls_section(
            'section_gallery_slider',
            [
                'label' => __( 'Gallery Slider', 'anps_theme_plugin' )
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => __( 'Images', 'anps_theme_plugin' ),
                'type' => Controls_Manager::GALLERY,
                'default' => []
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
        $gallery = $settings['gallery'];

        //display on frontend
        echo '<div class="gallery-fs">';
        /* First image */
        echo '<figure>';
        $image_src_first = $gallery[0];
        $image_alt_first = get_post_meta($gallery[0]['url'], '_wp_attachment_image_alt', true);
        echo '<img src="' . $image_src_first['url'] . '" alt="' . $image_alt_first . '">';
        echo '</figure>';

        /* If there is more than 1 image, thumbnails gallery code */
        if(count($gallery)>1) {
            echo '<div class="gallery-fs-nav">';
            echo '<button class="gallery-fs-fullscreen"><i class="fa fa-arrows-alt"></i></button>';
            echo '</div>';

            echo '<div class="gallery-fs-thumbnails gallery-fs-thumbnails-col-5 owl-carousel owl-loaded">';
            $i=0;
            foreach($gallery as $item) {
                $image_src = $item['url'];
                $image_title = get_the_title($item['id']);
                $class = '';
                if($i==0) {
                    $class = ' class="selected"';
                }

                echo "<a href='$image_src' data-caption='" . anps_get_attachment_caption($item['id']) . "' title='$image_title'$class>";
                echo "<img class='attachment-anps-gallery-thumb size-anps-gallery-thumb' src=".$image_src." sizes='(max-width: 280px) 100vw, 280px' width='280' height='158'>";
                echo '</a>';
                $i++;
            }
            echo '</div>';
        }
        echo '</div>';
    }
}
