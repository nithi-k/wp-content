<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class Anps_Recent_Blog extends Widget_Base{

  public function get_name(){
    return 'recent_blog';
  }

  public function get_title(){
    return 'Anps Recent Blog';
  }

  public function get_icon(){
    return 'far fa-window-restore';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_recent_blog',
        [
            'label' => __( 'Recent Blog', 'anps_theme_plugin' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'recent_title',
        [
            'label' => __( 'Title', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter title', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'style',
        [
            'label' => __( 'Style', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                'default' => __('Default', 'anps_theme_plugin'),
                'minimal-light' => __('Minimal light', 'anps_theme_plugin'),
                'minimal-dark' => __('Minimal dark', 'anps_theme_plugin'),
            ],
            'default' => 'default',
            'label_block' => true,
            'save_always' => true,
        ]
    );
        
        $this->add_control(
            'number',
            [
                'label' => __( 'Number of blog posts', 'anps_theme_plugin' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter number of recent blog posts', 'anps_theme_plugin' ),
                'default' => __( '', 'anps_theme_plugin' ),
                'label_block' => true,
            ]
        );
    $this->add_control(
        'number_in_row',
        [
            'label' => __( 'Number in row', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '3' => __('3', 'anps_theme_plugin'),
                '4' => __('4', 'anps_theme_plugin'),
            ],
            'default' => '3',
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'slider',
        [
            'label' => __( 'Slider', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '1' => __('Enable', 'anps_theme_plugin'),
                '0' => __('Disable', 'anps_theme_plugin'),
            ],
            'default' => '0',
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'content_length',
        [
            'label' => __( 'Content length', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Content length (default 130)', 'anps_theme_plugin' ),
            'label_block' => true,
            'default' => __( '130', 'anps_theme_plugin' ),
        ]
    );
    $this->add_control(
        'cat_ids',
        [
            'label' => __( 'Category id/s', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter category id/s. Example: 1,2,3', 'anps_theme_plugin' ),
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
        $recent_title = $settings['recent_title'];
        $style = $settings['style'];
        $number = $settings['number'];
        $number_in_row = $settings['number_in_row'];
        $slider = $settings['slider'];
        $content_length = $settings['content_length'];
        $cat_ids = $settings['cat_ids'];


        //validation
        $recent_new_class = 'recent-news';

        if( $style == 'minimal-light' ) {
            $recent_new_class .= ' recent-news-light';
        }

        $args = array(
            'posts_per_page'   => $number,
            'cat'              => $cat_ids,
            'orderby'          => "date",
            'order'            => "DESC",
            'post_type'        => 'post',
            'post_status'      => 'publish',
        );
        $posts = new WP_Query( $args );

        if($posts->post_count <= intval($number_in_row)) {
            $slider = 0;
        }

        if($slider=='1') {
            if($number_in_row=='4') {
                $owl_att = "class='$recent_new_class recent-news-$style' data-owlcolumns='4'";
            } else {
                $owl_att = "class='$recent_new_class' data-owlcolumns='3'";
            }
        } else {
            $owl_att = "class='$recent_new_class row'";
            if($number_in_row=='4') {
                $columns_class = 'col-md-3';
            } else {
                $columns_class = 'col-md-4';
            }
        }


     

     $icon_prev_class = 'fa-angle-left';
     $icon_next_class = 'fa-angle-right';
     $owl_class = 'owl-nav';

     if($style == 'minimal-dark' || $style == 'minimal-light') {
         $icon_prev_class = 'fa-chevron-left';
         $icon_next_class = 'fa-chevron-right';
         $owl_class = 'owl-nav-style-2';
     }

     //display on frontend
     if($posts->have_posts()) :
        echo "<div $owl_att>";
        if($style == 'default' || $recent_title != '') {
            if($slider=='1') :
                echo '<div class="row">';
            endif;
            echo '<div class="col-md-12">';
            if($recent_title != '') {
                echo "<h2 class='title'>$recent_title</h2>";
            }
            echo '</div>';
        }
        if($slider=='1') :
            if($style == 'default' || $recent_title != '') {
                echo '</div>';
            }
            if($style == 'minimal-dark' || $style == 'minimal-light') {
                echo "<div class='owl-wrap'>";
            }
            echo "<div class='owl-carousel'>";
        endif;
        while($posts->have_posts()) :
            $posts->the_post();
            if($slider=='0') :
                echo "<div class='$columns_class'>";
            endif;

            if($style == 'minimal-dark' || $style == 'minimal-light') {
                echo "<article class='post-minimal post-$style'>";
                if(get_the_post_thumbnail(get_the_ID())!="") {
                    echo "<header>";
                    echo get_the_post_thumbnail(get_the_ID(), 'anps-portfolio');
                    echo "</header>";
                }
                echo '<div class="post-minimal-wrap">';
                echo "<a href='".get_permalink()."'><h3 class='post-minimal-title'>".get_the_title()."</h3></a>";
                echo '<ul class="post-minimal-meta">';
                echo "<li><i class='fa fa-calendar'></i><time datetime='".get_the_time('Y-m-d h:s')."'>".get_the_date()."</time></li>";
                echo '</ul>';
                echo '</div>';
                echo "</article>";
            } else {
                echo "<article class='post'>";
                if(get_the_post_thumbnail(get_the_ID())!="") {
                    echo "<header>";
                    echo get_the_post_thumbnail(get_the_ID(), 'anps-portfolio');
                    echo "</header>";
                }
                echo "<a href='".get_permalink()."'><h3 class='post-title'>".get_the_title()."</h3></a>";
                echo '<ul class="post-meta">';
                echo "<li><i class='fa fa-calendar'></i><time datetime='".get_the_time('Y-m-d h:s')."'>".get_the_date()."</time></li>";
                echo "<li><i class='fa fa-commenting-o'></i>".get_comments_number()." ".esc_html__("comments", 'anps_theme_plugin')."</li>";
                echo '</ul>';
                echo '<div class="post-content">';
                echo "<div>".apply_filters('the_excerpt', mb_substr(get_the_excerpt(), 0, $content_length))."</div>";
                echo "<a href='".get_permalink()."' class='btn btn-md btn-gradient btn-shadow'>".esc_html__('Read More', 'anps_theme_plugin')."</a>";
                echo '</div>';
                echo "</article>";
            }
            if($slider=='0') :
                echo '</div>';
            endif;
        endwhile;
        if($slider=='1') :
            echo "</div>";
            echo "<div class='$owl_class text-right'>";
            echo "<button class='owlprev'><i class='fa $icon_prev_class'></i></button>";
            echo "<button class='owlnext'><i class='fa $icon_next_class'></i></button>";
            if($style == 'minimal-dark' || $style == 'minimal-light') {
                echo '</div>';
            }
            echo "</div>";
        endif;
        echo "</div>";
     endif;
     wp_reset_postdata();
        
    }
}