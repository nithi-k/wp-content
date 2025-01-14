<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Anps_Testimonials extends Widget_Base {

	public function get_name(){
        return 'testimonials';
      }
    
      public function get_title(){
        return 'Anps Testimonials';
      }
    
      public function get_icon(){
        return 'far fa-thumbs-up';
      }
    
      public function get_categories(){
        return ['anps-em'];
      }
	protected function _register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonials', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();


        $this->add_control(
			'testimonialheading', [
				'label' => __( 'Title', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'default' => __( '', 'anps_theme_plugin' ),
                'description' => 'Enter the title.',
                'label_block' => true,
			]
        );
        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'anps_theme_plugin' ),
                'type' => Controls_Manager::SELECT,
                'options' =>  [
                    'style-1' => __('Style 1', 'anps_theme_plugin'),
                    'style-2' => __('Style 2', 'anps_theme_plugin'),
                    'style-3' => __('Style 3', 'anps_theme_plugin'),
                ],
                'default' => '',
                'label_block' => true,
                'save_always' => true,
            ]
        );
        $this->add_control(
			'random',
			[
				'label' => __( 'Random order', 'anps_theme_plugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'anps_theme_plugin' ),
				'label_off' => __( 'No', 'anps_theme_plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );
        $this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'anps_theme_plugin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'anps_theme_plugin' ),
				'label_off' => __( 'No', 'anps_theme_plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );

        $this->add_control(
			'autoplay_timeout', [
				'label' => __( 'Autoplay timeout', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '6000',
			]
        );

        $repeater->add_control(
			'content', [
				'label' => __( 'Testimonial text', 'anps_theme_plugin' ),
                'type' => Controls_Manager::TEXTAREA,
                'row' => '10',
                'label_block' => true,
                'default' => '',
			]
        );
        $repeater->add_control(
			'user_name', [
				'label' => __( 'User name', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'Enter user name',
			]
        );
        $repeater->add_control(
			'user_name_subtitle', [
				'label' => __( 'Job position', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'Enter optional job position',
			]
        );
        $repeater->add_control(
            'image_u',
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
        $repeater->add_control(
			'image', [
				'label' => __( 'User image url', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => 'Enter url',
			]
        );

        $this->add_control(
			'testimonials_r',
			[
				'label' => __( 'Testimonials', 'anps_theme_plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				// 'title_field' => '{{{ class }}}',
			]
        );
        

	    $this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        //store value from control outside repeater
        $testimonialheading = $settings['testimonialheading'];
        $style = $settings['style'];
        $autoplay = $settings['autoplay'];
        $autoplay_timeout = $settings['autoplay_timeout'];
        $random = $settings['random'];
        $testimonials_r = $settings['testimonials_r'];

        if($style == 'style-3') {
            /* Style without owl carousel */
            
            global $anps_testimonials_style;
            echo '<div class="testimonials testimonials-' . $style . '">';
            echo "<div class='testimonials-header'>";
            if($testimonialheading != '') {
                echo "<h3 class='title'>".$testimonialheading."</h3>";
            }
            echo '</div>';

            
            //display when is style 3
            echo "<ul class='testimonials-wrap clearfix'>";

            foreach($testimonials_r as $item){
                
                $content = $item['content'];
                $image = $item['image'];
                $image_u = $item['image_u']['url'];
                $user_name = $item['user_name'];
                $user_name_subtitle = $item['user_name_subtitle'];

                
                echo '<li>';
                echo '<div class="user">';
                if($image_u) {
                    echo '<div class="user-image">';
                    echo "<img class='user-photo' src='".$image_u."' alt='".$user_name."'>";
                    echo '</div>';
                }
                if($image_u == '') {
                    echo '<div class="user-image">';
                    echo "<img class='user-photo' src='".$image."' alt='".$user_name."'>";
                    echo '</div>';
                }
                echo '<div class="content">';
                echo "<h3 class='name-user'>$user_name</h3>";

		        if($user_name_subtitle) {
                	echo '<h4 class="jobtitle">'.$user_name_subtitle.'</h4>';
		        }

                echo '<p>'.$content.'</p>';
                echo '</div>';
                echo "</div>";
                echo "</li>";
                }

            echo '</ul>';
            echo '</div>';
        } else {
            /* Other testimonials styles (that use Owl carousel) */
            $attrs = '';
            if ($random) {
                $attrs .= ' data-random="random"';
            }

            if ($autoplay) {
                $attrs .= ' data-autoplay="' . $autoplay_timeout . '"';
            }

            $icon_prev_class = 'fa-angle-left';
            $icon_next_class = 'fa-angle-right';
            $owl_class = 'owl-nav';


            if($style == 'style-2') {
                $icon_prev_class = 'fa-chevron-left';
                $icon_next_class = 'fa-chevron-right';
                $owl_class = 'owl-nav-style-2';
            }
            
            global $anps_testimonials_style;

            
            //display when in style 1 or 2
            echo '<div class="testimonials testimonials-' . $style . '">';
            echo "<div class='testimonials-header'>";
            if($testimonialheading != '') {
                echo "<h3 class='title'>".$testimonialheading."</h3>";
            }
            echo '</div>';
            echo "<div class='testimonials-outer-wrap'>";
            echo '<ul class="testimonial-wrap owl-carousel owl-loaded owl-drag"' . $attrs . '>';

            //counter 
            $count = 0;
            
            foreach($testimonials_r as $item){
                
                $content = $item['content'];
                $image = $item['image'];
                $image_u = $item['image_u']['url'];
                $user_name = $item['user_name'];
                $user_name_subtitle = $item['user_name_subtitle'];

                if($anps_testimonials_style != 'style-3') {
                    $float_class = ' pull-left';
                    $row_class = ' class="clearfix row"';
                }

                echo "<div class='owl-item'>";
                echo '<li' . $row_class . '>';
                echo '<div class="user' . $float_class . '">';
                if($image_u) {
                    echo '<div class="user-image">';
                    echo "<img class='user-photo' src='".$image_u."' alt='".$user_name."'>";
                    echo '</div>';
                }
                if($image_u == '') {
                    echo '<div class="user-image">';
                    echo "<img class='user-photo' src='".$image."' alt='".$user_name."'>";
                    echo '</div>';
                }
                echo '<div class="content' . $float_class . '">';
                echo "<h3 class='name-user'>$user_name</h3>";

		        if($user_name_subtitle) {
                	echo '<h4 class="jobtitle">'.$user_name_subtitle.'</h4>';
		        }

                echo '<p>'.$content.'</p>';
                echo '</div>';
                echo "</div>";
                echo "</li>";
                echo "</div>";
                $count++;
                }
                   
                echo '</ul>';
            /* Slider left/right navigation buttons */
                if($count>1) {
                echo '<div class="' . $owl_class . '">';
                echo '<button class="owlprev"><i class="fa ' . $icon_prev_class . '"></i></button>';
                echo '<button class="owlnext"><i class="fa ' . $icon_next_class . '"></i></button>';
                echo '</div>';
            }
            /* END Slider left/right navigation buttons */
            echo '</div>';
            echo '</div>';
        }
	}
}
