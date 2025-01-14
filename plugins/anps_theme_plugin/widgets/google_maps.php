<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Utils;

class Anps_Google_Maps extends Widget_Base
{

    public function get_name()
    {
        return 'google_maps';
    }

    public function get_title()
    {
        return 'Anps Google Maps';
    }

    public function get_icon()
    {
        return 'fas fa-map-marker-alt';
    }

    public function get_categories()
    {
        return ['anps-em'];
    }
    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_contact_info_card',
            [
                'label' => __('Contact Info Card', 'anps_theme_plugin'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $this->add_control(
            'zoom',
            [
                'label' => __('Zoom', 'anps_theme_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter zoom', 'anps_theme_plugin'),
                'default' => '15',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'map_type',
            [
                'label' => __('Map Type', 'anps_theme_plugin'),
                'type' => Controls_Manager::SELECT,
                'options' =>  [
                    'ROADMAP' => __('Road map', 'anps_theme_plugin'),
                    'SATELLITE' => __('Satellite', 'anps_theme_plugin'),
                    'HYBRID' => __('Hybrid', 'anps_theme_plugin'),
                    'TERRAIN' => __('Terrain', 'anps_theme_plugin'),
                ],
                'default' => 'ROADMAP',
                'label_block' => true,
                'save_always' => true,
            ]
        );
        $this->add_control(
            'height',
            [
                'label' => __('Height', 'anps_theme_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter height in px', 'anps_theme_plugin'),
                'default' => '550',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'scroll',
            [
                'label' => __('Disable scrolling', 'anps_theme_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'true' => __('Yes', 'anps_theme_plugin'),
                'false' => __('No', 'anps_theme_plugin'),
                'description' => __('Disable scrolling and dragging (mobile)', 'anps_theme_plugin'),
                'return_value' => 'true',
                'default' => 'false',
            ]
        );
        $this->add_control(
            'style',
            [
                'label' => __('Style', 'anps_theme_plugin'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'placeholder' => __('Custom styles', 'anps_theme_plugin'),
            ]
        );

        // CONTROLS FOR ITEM 
        $repeater->add_control(
            'location',
            [
                'label' => __('Location', 'anps_theme_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Enter address.', 'anps_theme_plugin'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'marker_center',
            [
                'label' => __('Show marker at center', 'anps_theme_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'true' => __('Yes', 'anps_theme_plugin'),
                'false' => __('No', 'anps_theme_plugin'),
                'return_value' => 'true',
                'default' => 'true',
            ]
        );
        $repeater->add_control(
            'pin',
            [
                'label'            => __('Pin', 'anps_theme_plugin'),
                'type'            => Controls_Manager::MEDIA,
                'dynamic'       => ['active' => true],
                'default'        => [
                    'url'    => Utils::get_placeholder_image_src()
                ],
                'show_external'    => true,
                'description' => __('Select or upload pin icon', 'anps_theme_plugin'),
            ]
        );
        $repeater->add_control(
            'content',
            [
                'label' => __('Info', 'anps_theme_plugin'),
                'type' => Controls_Manager::WYSIWYG,
                'placeholder' => __('Enter text.', 'anps_theme_plugin'),
                'label_block' => true,
                'description' => __('Enter info about location', 'anps_theme_plugin'),
            ]
        );

        $this->add_control(
            'google_maps',
            [
                'label' => __('Google Maps', 'anps_theme_plugin'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                // 'title_field' => '{{{ content }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        //store value from control outside repeater
        $gm = $settings['google_maps'];
        $google_maps = $gm[0];
        $style = $settings['style'];
        $scroll = $settings['scroll'];
        $map_type = $settings['map_type'];
        $height = $settings['height'];
        $zoom = $settings['zoom'];
        $location = $google_maps['location'];
        $marker_center = $google_maps['marker_center'];
        $content = $google_maps['content'];
        $pin = $google_maps['pin']['url'];


        if ($google_maps) {

            //use dropdown outside repeater to define row number
            $google_maps_counter = 0;
            global $google_maps_counter;
            $google_maps_counter++;
            if (isset($style) && $style != '') {
                $style = str_replace('``', '"', $style);
                $style = str_replace('`{`', '[', $style);
                $style = str_replace('`}`', ']', $style);
                $style = str_replace('`', '', $style);
                $style = str_replace('<br />', '', $style);
            } else {
                $style = '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]';
            }
            $scroll_option = "true";
            if ($scroll == true) {
                $scroll_option = "false";
            }
            wp_enqueue_script('gmap3_link');
            wp_enqueue_script('gmap3');
            foreach ($google_maps as $item) {
                $item = preg_replace('/[\n\r]+/', "", $item);
                $item = str_replace('"', '\"', $item);
                if (isset($pin) && $pin != "") {
                    $pin_icon = wp_get_attachment_image_src($pin, 'full');
                    // $pin_icon = $pin_icon[0];
                } else {
                    $pin_icon = get_template_directory_uri() . "/images/marker.png";
                }

                $results = '{ "address": "' . $location . '",  "center": "' . $marker_center . '", "data": "' . $content . '", "options": { "icon": "' . $pin_icon . '" } }|';
            }
            echo "<div data-styles='{$style}' class='map' id='map$google_maps_counter' style='height: {$height}px;' data-type='$map_type' data-zoom='$zoom' data-scroll='{$scroll_option}' data-markers='" . do_shortcode($results) . "'></div>";
            // echo "<div>";
            // print_r($results);
            // echo "</div>";

        }
    }
}
