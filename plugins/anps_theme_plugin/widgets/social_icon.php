<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Anps_Social_Icon extends Widget_Base {

	public function get_name(){
        return 'social_icon';
      }
    
      public function get_title(){
        return 'Anps Social Icon';
      }
    
      public function get_icon(){
        return 'fas fa-coffee';
      }
    
      public function get_categories(){
        return ['anps-em'];
      }
	protected function _register_controls() {

		$this->start_controls_section(
			'section_social_icon',
			[
				'label' => __( 'Social Icon', 'anps_theme_plugin' ),
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
                    '' => __('Default', 'anps_theme_plugin'),
                    'minimal' => __('Minimal', 'anps_theme_plugin'),
                    'border' => __('Border', 'anps_theme_plugin'),
                ],
                'description' => 'Select style',
                'label_block' => true,
                'save_always' => true,
            ]
        );

        $repeater->add_control(
			'url', [
				'label' => __( 'Url', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'default' => __( '#', 'anps_theme_plugin' ),
                'description' => 'Enter url.',
                'label_block' => true,
			]
        );
        $repeater->add_control(
            'icon',
                [
                'label'   => __('Icon', 'anps_theme_plugin'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                'value'   => 'fas fa-bars',
                'library' => 'fa-solid',
                ],
                'description' => 'Select icon from library'
            ]
        );
        $repeater->add_control(
			'target', [
				'label' => __( 'Target', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter list text.', 'anps_theme_plugin' ),
                'label_block' => true,
                'default' => '_blank',
			]
        );

        $this->add_control(
			'social',
			[
				'label' => __( 'Social Icon', 'anps_theme_plugin' ),
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
        $social = $settings['social'];
        
        // print_r($content);
        foreach($social as $item){
        
        $url = $item['url'];
        $target = $item['target'];
        $icon = $item['icon']['value'];
        $class_s = 'social';


        if($class=='minimal') {
            $class_s = 'social social-minimal';
        } elseif($class=='border') {
            $class_s = 'social social-border';
        }


        echo "<ul class='".$class_s."'>";
        echo "<li><a href='".esc_url($url)."' target='".$target."'><i class='fa ".$icon."'></i></a></li>";
        echo "</ul>";
        }
	}
}