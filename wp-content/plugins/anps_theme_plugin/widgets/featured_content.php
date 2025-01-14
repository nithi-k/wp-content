<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;


class Anps_Featured_Content extends Widget_Base{

  public function get_name(){
    return 'featured_content';
  }

  public function get_title(){
    return 'Anps Featured Content';
  }

  public function get_icon(){
    return 'fas fa-bullhorn';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_featured_content',
        [
            'label' => __( 'Featured Content', 'anps_theme_plugin' ),
        ]
    );

    $this->add_control(
        'title',
        [
            'label' => __( 'Title', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter content text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'image',
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
        'video',
        [
            'label' => __( 'Video', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter content text', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'lightbox',
        [
            'label' => __( 'Open in Lightbox', 'anps_theme_plugin' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'your-plugin' ),
            'label_off' => __( 'Off', 'your-plugin' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    $this->add_control(
        'content',
        [
            'label' => __( 'Content', 'anps_theme_plugin' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'placeholder' => __( 'Enter content of shortcode', 'anps_theme_plugin' ),
        ]
    );
    $this->add_control(
        'link',
        [
            'label' => __( 'Link', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'target',
        [
            'label' => __( 'Link Target', 'anps_theme_plugin' ),
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
    $this->add_control(
        'custom_icon',
        [
            'label'			=> __( 'Custom Icon', 'anps_theme_plugin' ),
			'type'			=> Controls_Manager::MEDIA,
            'dynamic'       => [ 'active' => true ],
			'default'		=> [
				'url'	=> Utils::get_placeholder_image_src()
			],
			'show_external'	=> true
        ]
    );
    $this->add_control(
        'custom_icon_hover',
        [
            'label'			=> __( 'Custom Icon (hover)', 'anps_theme_plugin' ),
			'type'			=> Controls_Manager::MEDIA,
            'dynamic'       => [ 'active' => true ],
			'default'		=> [
				'url'	=> Utils::get_placeholder_image_src()
			],
			'show_external'	=> true
        ]
    );
    $this->add_control(
        'btn_text',
        [
            'label' => __( 'Button text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter url for button', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'position_above',
        [
            'label' => __( 'Position image above? (use below slider)', 'anps_theme_plugin' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'your-plugin' ),
            'label_off' => __( 'Off', 'your-plugin' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );
    $this->add_control(
        'exposed_content',
        [
            'label' => __( 'Exposed content', 'anps_theme_plugin' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'your-plugin' ),
            'label_off' => __( 'Off', 'your-plugin' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );
    $this->add_control(
        'btn_style',
        [
            'label' => __( 'Style', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '' => __('Default', 'anps_theme_plugin'),
                'simple-style' => __('Simple', 'anps_theme_plugin'),
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
        $title = $settings['title'];
        $image = $settings['image']['url'];
        $video = $settings['video'];
        $lightbox = $settings['lightbox'];
        $content = $settings['content'];
        $link = $settings['link'];
        $target = $settings['target'];
        $icon = $settings['icon']['value'];
        $custom_icon = $settings['custom_icon']['url'];
        $btn_text = $settings['btn_text'];
        $custom_icon_hover = $settings['custom_icon_hover']['url'];
        $position_above = $settings['position_above'];
        $exposed_content = $settings['exposed_content'];
        $btn_style = $settings['btn_style'];

        if($image) {
            echo wp_get_attachment_image_src($image, 'anps-featured');
            
        }

        $has_icon = '';
        if($icon) {
            // $icon = "<i class='$icon'></i>";
            $has_icon = ' featured-has-icon';
        }

        if($custom_icon) {
            if($custom_icon_hover) {
                echo wp_get_attachment_image($custom_icon_hover, 'full', false, array('class' => 'featured-custom-icon-hover'));
            }

            $icon =  '<div class="featured-custom-icon"><img src="' . wp_get_attachment_image($custom_icon, 'full') . $custom_icon_hover . '"></div>';

            $has_icon = ' featured-has-icon';
        }

        $img_class = 'relative';
        $push_top_class = '';
        if($position_above!="") {
            $push_top_class = ' featured-push-top';
        }

        /* Media type */
        $media_class = '';
        if($video!="" && $lightbox!="") {
            $media_class = ' featured-video';
        } elseif($video=='' && $lightbox!="") {
            $media_class = ' featured-image';
        }

        $style_class = "";
        if($btn_style!="") {
            $style_class = ' '.$btn_style;
        }

        /* Larger content */
        $large_class = '';
        if($exposed_content!='') {
            $large_class = ' featured-large';
        }

        $has_link = '';
        if($link!="") {
            $has_link = ' featured-has-link';
        }

        $has_content = '';
        if($content!='') {
            $has_content = ' featured-has-content';
        }

        /* Get image from vimeo or youtube if there is no other image */
        if($video!="" && $image=='') {
            if(strpos($video,'vimeo') !== false) {
                $video_id = explode('/', $video);
                $thumbnail = wp_remote_get( 'https://vimeo.com/api/v2/video/'.$video_id[3].'.json' );
                if ($thumbnail) {
                    $body = json_decode($thumbnail['body']);
                    $image = $body[0]->thumbnail_large;
                }
            } else {
                $video_explode = explode('v=', $video);
                $image = "https://img.youtube.com/vi/$video_explode[1]/maxresdefault.jpg";
            }
        }

        echo "<div class='featured$media_class$large_class$push_top_class$has_link$has_icon$has_content$style_class'>";
        echo"<div class='featured-header'>";

        if($link!="") {
            echo"<a target='$target' href='$link'><img alt='$title' src='$image'/></a>";
        } else {
            echo"<img alt='$title' src='$image'/>";
        }

        echo"</div>";
        echo"<div class='featured-content'>";

        if($link!="") {
            echo"<h3 class='featured-title text-uppercase'><a target='$target' href='$link'><i class='".$icon."'></i>$title</a></h3>";
        } else {
            echo"<h3 class='featured-title text-uppercase'><i class='".$icon."'></i>$title</h3>";
        }

        if($content!="") {
        echo"<p class='featured-desc'>$content</p>";
        }
        if($link!="") {
            echo"<a class='btn btn-md btn-minimal' target='$target' href='$link'>$btn_text</a>";
        }
        if($lightbox!="") {
            if($video=='' && $image!='') {
                echo"<a href='$image' class='featured-lightbox-link'><i class='fa fa-image'></i>";
            } elseif($video!="") {
                if(strpos($video,'vimeo') !== false) {
                    $video_type = 'vimeo';
                } else {
                    $video_type = 'youtube';
                }
                echo"<a data-rel='$video_type' href='$video' class='featured-lightbox-link'><svg><use xlink:href='#featured-video-dark'></use></svg>";
            }
            echo'</a>';
        }
        echo"</div>";
        echo"</div>";
        
    }
}