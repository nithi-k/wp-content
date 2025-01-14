<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;


class Anps_Portfolio extends Widget_Base{

  public function get_name(){
    return 'portfolio';
  }

  public function get_title(){
    return 'Anps Portfolio';
  }

  public function get_icon(){
    return 'fas fa-th';
  }

  public function get_categories(){
    return ['anps-em'];
  }
  protected function _register_controls() {
    $this->start_controls_section(
        'section_portfolio_content',
        [
            'label' => __( 'Portfolio', 'anps_theme_plugin' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'per_page',
        [
            'label' => __( 'Number of portfolio posts', 'anps_theme_plugin' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter number of portfolio posts', 'anps_theme_plugin' ),
            'default' => __( '', 'anps_theme_plugin' ),
            'label_block' => true,
        ]
    );
    $this->add_control(
        'column',
        [
            'label' => __( 'Show in row', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '6' => __('6', 'anps_theme_plugin'),
                '4' => __('4', 'anps_theme_plugin'),
                '3' => __('3', 'anps_theme_plugin'),
                '2' => __('2', 'anps_theme_plugin'),
            ],
            'default' => '2',
            'label_block' => true,
            'save_always' => true,
        ]
    );
    
    //get categories name for dropdown control
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
        'filter',
        [
            'label' => __( 'filter', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                'on' => __('On', 'anps_theme_plugin'),
                'off' => __('Off', 'anps_theme_plugin'),
            ],
            'default' => 'on',
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'orderby',
        [
            'label' => __( 'Order By', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                'default' => __('Default', 'anps_theme_plugin'),
                'date' => __('Date', 'anps_theme_plugin'),
                'ID' => __('Id', 'anps_theme_plugin'),
                'title' => __('Title', 'anps_theme_plugin'),
                'name' => __('Name', 'anps_theme_plugin'),
            ],
            'default' => 'default',
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
            'default' => 'default',
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->add_control(
        'mobile_class',
        [
            'label' => __( 'Mobile view', 'anps_theme_plugin' ),
            'type' => Controls_Manager::SELECT,
            'options' =>  [
                '1' => __('1 column', 'anps_theme_plugin'),
                '2' => __('2 columns', 'anps_theme_plugin'),
            ],
            'label_block' => true,
            'save_always' => true,
        ]
    );
    $this->end_controls_section();

    $this->start_controls_section(
        'section_portfolio_style',
        [
            'label' => __( 'Style', 'anps_theme_plugin' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_control(
        'item_bg_color',
        [
            'label' => __('Item background color', 'anps_theme_plugin'),
            'type'  => Controls_Manager::COLOR,
            'scheme'=> [
                'type'  => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'color: {{VALUE}};',
            ]
        ]
    );
    $this->add_control(
        'item_text_color',
        [
            'label' => __('Item text color', 'anps_theme_plugin'),
            'type'  => Controls_Manager::COLOR,
            'scheme'=> [
                'type'  => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'color: {{VALUE}};',
            ]
        ]
    );
    $this->add_control(
        'item_title_color',
        [
            'label' => __('Item title color', 'anps_theme_plugin'),
            'type'  => Controls_Manager::COLOR,
            'scheme'=> [
                'type'  => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_2,
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'color: {{VALUE}};',
            ]
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
        $per_page = $settings['per_page'];
        $column = $settings['column'];
        $filter = $settings['filter'];
        $orderby = $settings['orderby'];
        $order = $settings['order'];
        $mobile_class = $settings['mobile_class'];
        $item_bg_color = $settings['item_bg_color'];
        $category = $settings['category'];
        $item_text_color = $settings['item_text_color'];
        $item_title_color = $settings['item_title_color'];
        // var_dump($settings);
        
        $tax_query='';
        $parent_cat = "";
        $attr = '';
        $hover_style = '';
        $hover_text_style = '';
        $hover_title_style = '';

        if($category && $category!='All') {
            $parent_cat = $category;
            $tax_query = array(
                array(
                    'taxonomy' => 'portfolio_category',
                    'field' => 'id',
                    'terms' => $category
                )
           );
        }
        // print_r($tax_query);
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
            'showposts' => $per_page,
            'tax_query' => $tax_query
        );
        $portfolio_posts = new WP_Query( $args );

        /*desktop-class*/
        $mdclass = " col-md-4";
        if($column=="2") {
            $mdclass = " col-md-6";
        } else if($column=="4") {
            $mdclass = " col-md-3";
        } else if($column=="6") {
            $mdclass = " col-md-2";
        }

        /* Mobile class */
        $m_class = " col-xs-6";
        if($mobile_class=="1") {
            $m_class = " col-xs-12";
        }

        /* Portfolio isotope filter */
        echo "";
        echo '<div class="projects">';
        if($filter=="on") {
            echo "<ul class='filter'>";
           echo  '<li><button data-filter="*" class="selected">'.esc_html__("All projects", 'anps_theme_plugin')."</button></li>";
            $filters = get_terms('portfolio_category', "orderby=none&hide_empty=true&parent=$parent_cat");
            foreach ($filters as $item) {
                echo '<li><button data-filter="' . strtolower(str_replace(" ", "-", $item->name)) . '">' . $item->name . '</button></li>';
            }
           echo  "</ul>";
        }
        /* Portfolio isotope filter enabled posts */
        echo "<div class='row projects-content'>";
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
                    $portfolio_cat .= strtolower(str_replace(" ", "-", $cat->name));
                }
            }
            
            $image_class = 'anps-portfolio';
            if(has_post_thumbnail(get_the_ID())) {
                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

                $image = '<img src="' . get_the_post_thumbnail_url(get_the_ID(), $image_class) . '" alt="' . $alt . '" />';
            } elseif(get_post_meta(get_the_ID(), $key ='gallery_images', $single = true )) {
                $exploded_images = explode(',',get_post_meta(get_the_ID(), $key ='gallery_images', $single = true ));
                $image =  wp_get_attachment_image($exploded_images[0], $image_class, null, array('srcset' => ''));
            }
            echo"<div class='projects-item ".$portfolio_cat.$mdclass.$m_class."'>";
            if($column!="6" && $column!="4") {
               echo "<div class='projects-item-wrap'>";
                if(isset($image)&&$image!="") {
                    echo $image;
                }
               echo '<div class="project-hover-bg"' . $hover_style . '></div>';
               echo '<div class="project-hover">';
               echo "<h3 class='project-title text-uppercase'" . $hover_title_style . ">".get_the_title()."</h3>";
               echo "<p" . $hover_text_style . " class='project-desc'>".get_the_excerpt()."</p>";
               echo "<a class='btn btn-md' href='".get_permalink()."'>".esc_html__('Read more', 'anps_theme_plugin')."</a>";
               echo "</div>";

               echo "</div>";
            } else {
                echo"<div class='projects-item-wrap'>";
                if(isset($image)&&$image!="") {
                    echo $image;
                }
               echo '<a href="'.get_permalink().'" class="project-hover-small">';
               echo '<i class="fa fa-link"></i>';
               echo "</a>";
               echo "</div>";
            }
           echo "</div>";
        endwhile;
        wp_reset_postdata();
        echo "</div>";
        echo "</div>";
        
    }
}