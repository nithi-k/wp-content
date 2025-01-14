<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Anps_Logos extends Widget_Base {

	public function get_name(){
        return 'logos';
      }
    
      public function get_title(){
        return 'Anps Logos';
      }
    
      public function get_icon(){
        return 'fas fa-eye';
      }
    
      public function get_categories(){
        return ['anps-em'];
      }
	protected function _register_controls() {

		$this->start_controls_section(
			'section_logos',
			[
				'label' => __( 'Logos', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();


        $this->add_control(
			'in_row', [
				'label' => __( 'Logos in row', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'default' => __( '6', 'anps_theme_plugin' ),
                'description' => 'Logos in one row.',
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
                'default' => 'style-1',
                'label_block' => true,
                'save_always' => true,
            ]
        );
        
        $repeater->add_control(
			'content', [
				'label' => __( 'Image url', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'default' => __( '', 'anps_theme_plugin' ),
                'description' => 'Enter image url.',
                'label_block' => true,
			]
        );
        $repeater->add_control(
            'image_u',
            [
                'label'	=> __( 'Image', 'anps_theme_plugin' ),
                'type'	=> Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => true ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
                'show_external'	=> true
            ]
        );
        $repeater->add_control(
			'url', [
				'label' => __( 'Url', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'default' => __( '', 'anps_theme_plugin' ),
                'description' => 'Logo url.',
                'label_block' => true,
			]
        );
        $repeater->add_control(
			'alt', [
				'label' => __( 'Alt', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Logo alt.', 'anps_theme_plugin' ),
                'label_block' => true,
			]
        );
        $this->add_control(
			'logos',
			[
				'label' => __( 'Logos', 'anps_theme_plugin' ),
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
        $in_row = $settings['in_row'];
        $style = $settings['style'];
        $logos = $settings['logos'];

    $data_col = "";
    $logos_class = "";

    $count_logos = count($logos);
    if ($style == 'style-2') {
        if ($count_logos > $in_row ) {
           $data_col = "data-col=" . $in_row;
           $logos_class = 'owl-carousel general style-2';
        } else {
            $logos_class = 'style-2';
        }
    } else if ($style == 'style-1' || $style == 'style-3') {
        $logos_class = "clients-col-".$in_row;
    }
    
    
    echo "<div class='logos-wrapper $style'>";
    echo "<ul class='clients ". $logos_class ."' ".$data_col.">";

    
    foreach($logos as $item) {
        $i = 0;
        $content = $item['content'];
        $image_u = $item['image_u']['url'];
        $url = $item['url'];
        $alt = $item['alt'];

        if($i%$in_row==0 && $i!=0 && $style == 'style-1') {
                echo "</ul><ul class='clients ". $logos_class ."'>";
                echo "<li class='client'><a href='".$url."' target='_blank'><img src='".$image_u."' alt='".$alt."'></a></li>";
        }
        elseif($url){
           echo "<li class='client'><a href='".$url."' target='_blank'><img src='".$image_u."' alt='".$alt."'></a></li>";
        } else{
            echo "<li class='client'><span><img src='".$image_u."' alt='".$alt."'></span></li>";
        }
    }
    echo "</ul></div>";
        
	}
}