<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Anps_Blog extends Widget_Base{

  public function get_name(){
    return 'blog';
  }

  public function get_title(){
    return 'Anps Blog';
  }

  public function get_icon(){
    return 'fas fa-thumbs-up';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_blog',
        [
            'label' => __( 'Blog', 'anps_theme_plugin' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );
    
    $categories = anps_get_all_post_cat();
    $cat = array_slice($categories, 0, 0, true) +
    array("0" => "All") +
    array_slice($categories, 0, count($categories) - 1, true) ;

    $this->add_control(
        'category',
        [
            'label' => __( 'Blog category', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  $cat,
            'label_block' => true,
            'save_always' => true,
        ] 
    );
    $this->add_control(
        'content',
        [
            'label' => __( 'Posts per page', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter post per page.', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'orderby',
        [
            'label' => __( 'Order By', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '' => __('Default', 'anps_theme_plugin'),
                'date' => __('Date', 'anps_theme_plugin'),
                'ID' => __('Id', 'anps_theme_plugin'),
                'title' => __('Title', 'anps_theme_plugin'),
                'name' => __('Name', 'anps_theme_plugin'),
                'author' => __('Author', 'anps_theme_plugin'),
            ],
            'default' => '',
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'order',
        [
            'label' => __( 'Order', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '' => __('Default', 'anps_theme_plugin'),
                'ASC' => __('ASC', 'anps_theme_plugin'),
                'DESC' => __('DESC', 'anps_theme_plugin'),
            ],
            'default' => '',
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'columns',
        [
            'label' => __( 'Columns', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '1' => __('1', 'anps_theme_plugin'),
                '2' => __('2', 'anps_theme_plugin'),
                '3' => __('3', 'anps_theme_plugin'),
                '4' => __('4', 'anps_theme_plugin'),
            ],
            'default' => '1',
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
        $category = $settings['category'];
        $orderby = $settings['orderby'];
        $order = $settings['order'];
        $content = $settings['content'];
        // var_dump($category);
        
        // print_r($cat);
        global $wp_rewrite;

        if(get_query_var('paged') > 1) {
            $current = get_query_var('paged');
        } elseif(get_query_var('page') > 1) {
            $current = get_query_var('page');
        } else {
            $current = 1;
        }
        $args = array(
            'posts_per_page'   => $content,
            'category_name'    => $category,
            'orderby'          => $orderby,
            'order'            => $order,
            'post_type'        => 'post',
            'post_status'      => 'publish',
            'paged'            => $current
        );

        $posts = new WP_Query( $args );

        $pagination = array(
            'base' => @esc_url(add_query_arg('page','%#%')),
            'format' => '',
            'total' => $posts->max_num_pages,
            'current' => $current,
            'show_all' => false,
            'prev_text' => '<i class="fa fa-angle-left"></i> ' . esc_html__( 'Previous ', 'anps_theme_plugin' ),
            'next_text' => esc_html__( 'Next', 'anps_theme_plugin' ) . ' <i class="fa fa-angle-right"></i>',
            'type' => 'list',
            );

        //columns 
        switch($columns) {
            case '1':
                $blog_type = 'col-md-12';
                break;
            case '2':
                $blog_type = 'col-md-6';
                break;
            case '3':
                $blog_type = 'col-md-4';
                break;
            case '4':
                $blog_type = 'col-md-3';
                break;
            default :
                $blog_type = 'col-md-12';
                break;
        }
        //display on frontend
        if($posts->have_posts()) :
            echo "<div class='row anps-blog'>";
            global $counter_blog;
            $counter_blog = 1;
            while($posts->have_posts()) :
                $posts->the_post();
                ob_start();
                get_template_part('templates/content-blog', $blog_type);
                $counter_blog++;
                echo ob_get_clean();
            endwhile;
            if( $wp_rewrite->using_permalinks() ) {
                $pagination['base'] = user_trailingslashit( trailingslashit( esc_url(remove_query_arg('s',get_pagenum_link(1)) ) ) . 'page/%#%/', 'paged');
            }
            if( !empty($wp_query->query_vars['s']) ) {
                $pagination['add_args'] = array('s'=>get_query_var('s'));
            }
            echo "</div>";
            echo paginate_links( $pagination );
            wp_reset_postdata();
        else :
            echo "<h2>".esc_html__('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'anps_theme_plugin')."</h2>";
        endif;
        
    }
}