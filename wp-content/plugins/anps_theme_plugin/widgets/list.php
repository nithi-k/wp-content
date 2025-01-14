<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;

class Anps_List extends Widget_Base {

	public function get_name(){
        return 'list';
      }
    
      public function get_title(){
        return 'Anps List';
      }
    
      public function get_icon(){
        return 'fas fa-list';
      }
    
      public function get_categories(){
        return ['anps-em'];
      }
	protected function _register_controls() {

		$this->start_controls_section(
			'section_list',
			[
				'label' => __( 'List', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();

        $this->add_control(
            'class',
            [
                'label' => __( 'List icon', 'anps_theme_plugin' ),
                'type' => Controls_Manager::SELECT,
                'options' =>  [
                    'default' => __('Default', 'anps_theme_plugin'),
                    'circle-arrow' => __('Circle arrow', 'anps_theme_plugin'),
                    'triangle' => __('Triangle', 'anps_theme_plugin'),
                    'hand' => __('Hand', 'anps_theme_plugin'),
                    'square' => __('Square', 'anps_theme_plugin'),
                    'arrow' => __('Arrow', 'anps_theme_plugin'),
                    'circle' => __('Circle', 'anps_theme_plugin'),
                    'circle-check' => __('Circle check', 'anps_theme_plugin'),
                ],
                'description' => 'Select type',
                'label_block' => true,
                'save_always' => true,
            ]
        );

        $repeater->add_control(
			'content', [
				'label' => __( 'Text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::WYSIWYG,
                'placeholder' => __( 'Enter list text.', 'anps_theme_plugin' ),
                'label_block' => true,
                'separator' => 'none',
                'label_block' => 'false',
			]
        );

        $this->add_control(
			'list',
			[
				'label' => __( 'List', 'anps_theme_plugin' ),
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
        $class = $settings['class'];
        $list = $settings['list'];
        
        // print_r($content);
        foreach($list as $item){
        $content = $item['content'];
        echo "<ul class='list list-".$class."'>";
        echo "<li style='display: flex;'>".$content."</li>";
        echo "</ul>";
        }
	}
}