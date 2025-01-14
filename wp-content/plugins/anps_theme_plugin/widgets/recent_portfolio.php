<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Anps_Recent_Portfolio extends Widget_Base{

  public function get_name(){
    return 'recent_portfolio';
  }

  public function get_title(){
    return 'Anps Recent Portfolio';
  }

  public function get_icon(){
    return 'far fa-images';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_recent_portfolio_content',
        [
            'label' => __( 'Recent Portfolio', 'anps_theme_plugin' ),
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
        'number',
        [
            'label' => __( 'Number of portfolio posts', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter number of recent portfolio posts. If you want to display all posts, leave this field empty', 'anps_theme_plugin' ),
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
        'orderby',
        [
            'label' => __( 'Order by', 'anps_theme_plugin' ),
            'type' => Controls_Manager::HIDDEN,
            'default' => 'post_date',
        ]
    );
    $this->add_control(
        'order',
        [
            'label' => __( 'View', 'anps_theme_plugin' ),
            'type' => Controls_Manager::HIDDEN,
            'default' => 'DESC',
        ]
    );
    
    //get all categories for dropdown
    $categories = anps_get_all_port_cat();
    $cat = array_slice($categories, 0, 0, true) +
    array("0" => "All") +
    array_slice($categories, 0, count($categories) - 1, true) ;

    $this->add_control(
        'category',
        [
            'label' => __( 'Portfolio categories', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  $cat,
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'hide_filter',
        [
            'label' => __( 'Hide filter', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SWITCHER,
            'true' => __( 'Show', 'your-plugin' ),
            'false' => __( 'Hide', 'your-plugin' ),
            'return_value' => 'true',
            'default' => 'true',
        ]
    );
    $this->end_controls_section();

    $this->start_controls_section(
        'section_recent_portfolio_style',
        [
            'label' => __( 'Recent Portfolio', 'anps_theme_plugin' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'title_color',
        [
            'label' => __( 'Title Color', 'anps_theme_plugin' ),
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
        'bg_color',
        [
            'label' => __( 'Background color', 'anps_theme_plugin' ),
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
        'item_bg_color',
        [
            'label' => __( 'Item background color', 'anps_theme_plugin' ),
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
        'item_text_color',
        [
            'label' => __( 'Item text color', 'anps_theme_plugin' ),
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
        'item_title_color',
        [
            'label' => __( 'Item title color', 'anps_theme_plugin' ),
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
        $recent_title = $settings['recent_title'];
        $category = $settings['category'];
        $number = $settings['number'];
        $number_in_row = $settings['number_in_row'];
        $orderby = $settings['orderby'];
        $order = $settings['order'];
        $hide_filter = $settings['hide_filter'];
        $title_color = $settings['title_color'];
        $bg_color = $settings['bg_color'];
        $item_bg_color = $settings['item_bg_color'];
        $item_text_color = $settings['item_text_color'];
        $item_title_color = $settings['item_title_color'];

        //validation
        $tax_query='';
        $attr = '';
        $hover_style = '';
        $hover_text_style = '';
        $hover_title_style = '';

        if($category && $category!='0') {
            $tax_query = array(
                array(
                    'taxonomy' => 'portfolio_category',
                    'field' => 'id',
                    'terms' => $category
                )
           );
        }
        if ($bg_color != '') {
            $attr = ' data-bg="' . $bg_color . '"';
        }

        if ($item_bg_color != '') {
            $hover_style = ' style="background-color: ' . $item_bg_color . ';"';
        }

        if ($item_text_color != '') {
            $hover_text_style = ' style="color: ' . $item_text_color . ';"';
        }

        if ($item_title_color != '') {
            $hover_title_style = ' style="color: ' . $item_title_color . ';"';
        }

        $args = array(
            'post_type' => 'portfolio',
            'orderby' => $orderby,
            'order' => $order,
            'showposts' => $number,
            'tax_query' => $tax_query
        );
        $portfolio_posts = new WP_Query( $args );

        /* 3 or 4 columns */
        $projects_class = 'col-md-4';
        if($number_in_row==4) {
            $projects_class = 'col-md-3';
        }

        //display on frontend
        echo '<div class="projects projects-recent"' . $attr . '>';
        /* Header */
        echo '<div class="projects-header clearfix">';

        /* Title */
        if($recent_title) {
            $title_style = '';

            if ($title_color != '') {
                $title_style .= ' style="color: ' . $title_color . ';"';
            }

            echo "<h2 class='title projects-title visible-lg pull-left'$title_style>$recent_title</h2>";
        }

        /* Filter */
        $filter_class = 'filter filter-dark pull-right';
        if($hide_filter == 'true') {
            $filter_class .= ' filter-hidden';
        }
        echo '<ul class="' . $filter_class . '">';
        echo '<li><button data-filter="*" class="selected">'.esc_html__('All projects', 'anps_theme_plugin').'</button></li>';
        $filters = get_terms('portfolio_category', "orderby=none&hide_empty=true");
        foreach ($filters as $item) {
            $data_filter = $item->slug;
            if (strpos($data_filter, '%') > -1) {
                $data_filter = 'cat-' . $item->term_id;
            }
            echo '<li><button data-filter="' . $data_filter . '">' . $item->name . '</button></li>';
        }
        echo '</ul>';

        echo '</div>';
        /* END Header */
        /* Content */
        echo '<div class="row projects-content">';
        while($portfolio_posts->have_posts()) :
            $portfolio_posts->the_post();
            $portfolio_cat = "";
            if (get_the_terms(get_the_ID(), 'portfolio_category')) {
                $first_item = false;
                foreach (get_the_terms(get_the_ID(), 'portfolio_category') as $cat) {
                    if($first_item) {
                        $portfolio_cat .= " ";
                    }
                    $first_item = true;

                    $new_cat = $cat->slug;
                    if (strpos($new_cat, '%') > -1) {
                        $new_cat = 'cat-' . $cat->term_id;
                    }

                    $portfolio_cat .= $new_cat;
                }
            }
            if(has_post_thumbnail(get_the_ID())) {
                $image = get_the_post_thumbnail(get_the_ID(), 'anps-portfolio');
            }
            elseif(get_post_meta(get_the_ID(), $key ='gallery_images', $single = true )) {
                $exploded_images = explode(',',get_post_meta(get_the_ID(), $key ='gallery_images', $single = true ));
                $image_url = wp_get_attachment_image_src($exploded_images[0], 'anps-portfolio');
                $image = "<img src='".$image_url[0]."' />";
            }else{
                $image = '';
            }
            echo "<div class='projects-item col-xs-6 $projects_class $portfolio_cat'>";
            echo '<div class="projects-item-wrap">';
            echo $image;
                echo '<div class="project-hover-bg"' . $hover_style . '></div>';
            echo '<div class="project-hover">';
            echo "<h3 class='project-title text-uppercase'" . $hover_title_style . ">".get_the_title()."</h3>";
            echo "<p" . $hover_text_style . ">".get_the_excerpt()."</p>";
            echo "<a class='btn btn-md' href='".get_permalink()."'>".esc_html__('Read More', 'anps_theme_plugin')."</a>";
            echo '</div>';
            echo '</div>';
            echo '</div>';
        endwhile;
        wp_reset_postdata();
        echo '</div>';
        /* END Content */
        /* Buttons left/right */
        $pagination_style = '';

        if ($title_color != '') {
            $pagination_style .= ' style="color: ' . $title_color . ';"';
        }

        echo '<div class="projects-pagination"' . $pagination_style . '>';
        echo '<button class="prev"><i class="fa fa-angle-left"></i></button>';
        echo '<button class="next"><i class="fa fa-angle-right"></i></button>';
        echo '</div>';
        /* END Buttons left/right */
        echo '</div>';
        
    }
}