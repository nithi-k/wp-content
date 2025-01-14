<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Anps_Team extends Widget_Base{

  public function get_name(){
    return 'team';
  }

  public function get_title(){
    return 'Anps Team';
  }

  public function get_icon(){
    return 'fas fa-user-friends';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_team',
        [
            'label' => __( 'Team', 'anps_theme_plugin' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );
    $this->add_control(
        'columns',
        [
            'label' => __( 'Number of items in column', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '4' => __('4', 'anps_theme_plugin'),
                '2' => __('2', 'anps_theme_plugin'),
                '3' => __('3', 'anps_theme_plugin'),
                '6' => __('6', 'anps_theme_plugin'),
            ],
            'default' => '4',
            'label_block' => true,
            'save_always' => true,
        ]
    );

    $this->add_control(
        'number_items',
        [
            'label' => __( 'Number of team members', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter number of team members (if you want all than enter -1)', 'anps_theme_plugin' ),
            'default' => __( '-1', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'ids',
        [
            'label' => __( 'Team member id/s', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter team member id/s. Example: 1,2,3 ', 'anps_theme_plugin' ),
            'label_block' => true,
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
        $number_items = $settings['number_items'];
        $ids = $settings['ids'];

       //team single page option
        $team_single_option = get_option('anps_team_single_page', '1');

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
            'showposts' => $number_items,
            'columns' => $columns,
            'post__in' => $array_ids,
            'orderby' => $order_by
        );

        
        $team_posts = new WP_Query( $args );

        //display on frontend
        echo "<div class='team team-col-$columns'>";
        while($team_posts->have_posts()) :
            $team_posts->the_post();
            $subtitle = get_post_meta( get_the_ID(), $key = 'anps_team_subtitle', $single = true );
            echo "<div class='member'>";
            echo "<div class='member-wrap'>";
            echo "<div class='member-image'>";
            if($team_single_option == 1) :
                echo "<a href='".get_permalink()."'>";
            endif;
            echo get_the_post_thumbnail(get_the_ID(), 'anps-team');
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
            echo "<p class='member-desc'>".get_the_excerpt()."</p>";
            echo "</div></div>";
        endwhile;
        wp_reset_postdata();
        echo "</div>";
        
    }
}