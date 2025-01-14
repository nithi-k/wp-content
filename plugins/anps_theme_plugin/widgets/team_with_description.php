<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Anps_TWD extends Widget_Base{

  public function get_name(){
    return 'team_with_description';
  }

  public function get_title(){
    return 'Anps Team With Description';
  }

  public function get_icon(){
    return 'fas fa-user-friends';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_twd',
        [
            'label' => __( 'Team With Description', 'anps_theme_plugin' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );
    $this->add_control(
        'ids',
        [
            'label' => __( 'Team member id/s', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter team member id/s. Example: 1,2,3 up to 3 members', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'content_title',
        [
            'label' => __( 'Title', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter content title', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'content',
        [
            'label' => __( 'Text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::WYSIWYG,
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );

    $this->add_control(
        'button_text',
        [
            'label' => __( 'Button text', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter button text', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'button_url',
        [
            'label' => __( 'Button url', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter url for button ', 'anps_theme_plugin' ),
            'default' => __( '#', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'target',
        [
            'label' => __( 'Target', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '_self', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'title_color',
        [
            'label' => __( 'Title color', 'anps_theme_plugin' ),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .title' => 'color: {{VALUE}}',
            ],
        ]
    );
    $this->add_control(
        'desc_color',
        [
            'label' => __( 'Description color', 'anps_theme_plugin' ),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .title' => 'color: {{VALUE}}',
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
        $ids = $settings['ids'];
        $content_title = $settings['content_title'];
        $content = $settings['content'];
        $button_text = $settings['button_text'];
        $button_url = $settings['button_url'];
        $target = $settings['target'];
        $title_color = $settings['title_color'];
        $desc_color = $settings['desc_color'];

       //team single page option
       $team_single_option = get_option('anps_team_single_page', '1');

       /* Colors */
       if($title_color != '') {
           $title_color = " style='color: $title_color;'";
       }

       if($desc_color != '') {
           $desc_color = " style='color: $desc_color;'";
       }

       /* Select team by member id */
       $array_ids = '';
       $order_by = 'date';
       if($ids) {
           $array_ids = explode(',', $ids);
           $array_ids = array_map('trim', $array_ids);
           $order_by = 'post__in';
       }

       $args = array(
           'post_type' => 'team',
           'post__in' => $array_ids,
           'posts_per_page' => '3',
           'orderby' => $order_by
       );

       $team_posts = new WP_Query( $args );

       //display on frontend
       echo '<div class="team-desc team-desc-size-' . count($team_posts->posts) . '">';
       echo '<div class="team-desc-main">';
       echo "<div class='team'>";
       while($team_posts->have_posts()):
           $team_posts->the_post();
           $subtitle = get_post_meta( get_the_ID(), $key = 'anps_team_subtitle', $single = true );
           echo "<div class='member'>";
           echo "<div class='member-wrap'>";
           echo "<div class='member-image'>";
           if($team_single_option == 1) :
               echo "<a href='".get_permalink()."'>";
           endif;
           echo get_the_post_thumbnail(get_the_ID(), 'anps-team-desc');
           if($team_single_option == 1) :
               echo '</a>';
           endif;
           echo "</div>";
           if($team_single_option == 1) :
               echo "<a href='".get_permalink()."'>";
           endif;
           echo "<h3 class='member-name'>".get_the_title()."</h3>";
           if($team_single_option == 1) :
               echo '</a>';
           endif;
           if( $subtitle != '' ) {
               echo "<span class='member-title'>".$subtitle."</span>";
           }
           echo "</div></div>";
       endwhile;
       wp_reset_postdata();
       echo "</div>";
       echo "</div>";
       echo '<div class="team-desc-side">';
       if( $content_title != '' ) {
           echo "<h3 class='team-desc-title'$title_color>$content_title</h3>";
       }
       if( $content != '' ) {
           echo "<div class='team-desc-description'$desc_color>$content</div>";
       }
       if( $button_text != '' ) {
           echo "<a href='$button_url' target='$target' class='btn team-desc-btn'>$button_text</a>";
       }
       echo "</div>";
       echo "</div>";
        
    }
}