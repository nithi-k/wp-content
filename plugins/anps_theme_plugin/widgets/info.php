<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;

class Anps_Info extends Widget_Base {

	public function get_name(){
        return 'info';
      }
    
      public function get_title(){
        return 'Anps Info';
      }
    
      public function get_icon(){
        return 'far fa-newspaper';
      }
    
      public function get_categories(){
        return ['anps-em'];
      }
	protected function _register_controls() {

		$this->start_controls_section(
			'section_info_em',
			[
				'label' => __( 'Info', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        

        $this->add_control(
            'heading_color',
            [
                'label' => __('Heading color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => __('Text color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'primary_color',
            [
                'label' => __('Primary color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'divider_color',
            [
                'label' => __('Divider color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
            'hover_color',
            [
                'label' => __('Hover color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
			'section_r_icon_text',
			[
				'label' => __( 'Icon with text', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );
        $r_icon_with_text = new Repeater();
        

        //repeater icon with text
        $r_icon_with_text->add_control(
			'heading', [
				'label' => __( 'Heading', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter heading.', 'anps_theme_plugin' ),
				'label_block' => true,
			]
        );
        $r_icon_with_text->add_control(
			'content',
			[
				'label' => __( 'Text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
				'placeholder' => __( 'Enter text', 'anps_theme_plugin' ),
			]
        );
        $r_icon_with_text->add_control(
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
        $r_icon_with_text->add_control(
			'icon_text', [
				'label' => __( 'Icon text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter icon text (eg. phone number).', 'anps_theme_plugin' ),
				'label_block' => true,
			]
        );
        $this->add_control(
			'info_icon_with_text',
			[
				'label' => __( 'Icon with text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $r_icon_with_text->get_controls(),
				'title_field' => '{{{ heading }}}',
			]
        );
        $this->end_controls_section();
        $this->start_controls_section(
			'section_r_icon',
			[
				'label' => __( 'Icon', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );
        $r_icon = new Repeater();
        
        //repeater icon
        $r_icon->add_control(
			'heading', [
				'label' => __( 'Heading', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter heading', 'anps_theme_plugin' ),
				'label_block' => true,
			]
        );
        $r_icon->add_control(
			'content',
			[
				'label' => __( 'Text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
				'placeholder' => __( 'Enter text', 'anps_theme_plugin' ),
			]
        );
        $r_icon->add_control(
            'icon1',
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
        $r_icon->add_control(
            'icon2',
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
        $r_icon->add_control(
            'icon3',
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
        $r_icon->add_control(
            'icon4',
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
        $r_icon->add_control(
            'icon5',
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
        $this->add_control(
			'info_icon',
			[
				'label' => __( 'Icon', 'anps_theme_plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $r_icon->get_controls(),
				// 'title_field' => '{{{ content }}}',
			]
        );
        $this->end_controls_section();
        $this->start_controls_section(
			'section_r_button',
			[
				'label' => __( 'Button', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );
        $r_button = new Repeater();
        //repeater button
        $r_button->add_control(
			'heading', [
				'label' => __( 'Heading', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter heading', 'anps_theme_plugin' ),
				'label_block' => true,
			]
        );
        $r_button->add_control(
			'content',
			[
				'label' => __( 'Text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
				'placeholder' => __( 'Enter text', 'anps_theme_plugin' ),
			]
        );
        $r_button->add_control(
            'icon_b',
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
        $r_button->add_control(
			'button_text', [
				'label' => __( 'Button_text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter button text', 'anps_theme_plugin' ),
				'label_block' => true,
			]
        );
        $r_button->add_control(
			'url', [
				'label' => __( 'Url', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter button url', 'anps_theme_plugin' ),
				'label_block' => true,
			]
        );
        $r_button->add_control(
			'target', [
				'label' => __( 'Target', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter target', 'anps_theme_plugin' ),
                'default' => '_self',
				'label_block' => true,
			]
        );
        $r_button->add_control(
            'button_text_color',
            [
                'label' => __('Button text color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $r_button->add_control(
            'button_text_hover_color',
            [
                'label' => __('Button text hover color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
      
        $this->add_control(
			'info_button',
			[
				'label' => __( 'Button', 'anps_theme_plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $r_button->get_controls(),
				// 'title_field' => '{{{ content }}}',
			]
        );
        $this->end_controls_section();

	$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        //store value from control outside repeater
        $heading_color = $settings['heading_color'];
        $divider_color = $settings['divider_color'];
        $text_color = $settings['text_color'];
        $primary_color = $settings['primary_color'];
        $hover_color = $settings['hover_color'];
        $info_icon_with_text = $settings['info_icon_with_text'];
        $info_icon = $settings['info_icon'];
        $info_button = $settings['info_button'];
        $content = [$info_icon_with_text, $info_icon, $info_button];
             

        global $anps_divider_color, $anps_heading_color, $anps_text_color, $anps_primary_color, $anps_hover_color;
        $anps_divider_color = $divider_color;
        $anps_heading_color = $heading_color;
        $anps_text_color = $text_color;
        $anps_primary_color = $primary_color;
        $anps_hover_color = $hover_color;

        

        $style = '';

        if($divider_color) {
            $style = " style='border-color:$divider_color;'";
        }

        echo "<div class='anps-info clearfix anps-info-col-3'$style>";

        /** Foreach loop for display icons with text on frontend */
        foreach($info_icon_with_text as $item){
        
        $divider_style = '';
        $heading_style = '';
        $text_style = '';
        $it_style = '';
        $icon_with_text = $item['icon']['value'];
        $text = $item['icon_text'];
            
        if($anps_divider_color) {
            $divider_style = " style='background-color:$anps_divider_color;'";
        }

        if($anps_heading_color) {
            $heading_style = " style='color:$anps_heading_color;'";
        }

        if($anps_text_color) {
            $text_style = " style='color:$anps_text_color;'";
        }

        if($anps_text_color) {
            $text_style = " style='color:$anps_text_color;'";
        }

        if($anps_primary_color) {
            $it_style = " style='color:$anps_primary_color;'";
        }


        echo '<div class="anps-info-element anps-info-icon-text">';
        echo "<h3 class='anps-info-title'$heading_style>".$item['heading']."</h3>";
        echo "<p class='anps-info-text'$text_style>".$item['content']."</p>";
        echo "<div class='anps-info-it-wrap'$it_style>".'<i class = "fa '.$icon_with_text.'"></i>'.$text."</div>";
        echo "<div class='anps-info-divider'$divider_style></div>";
        echo '</div>';

        
        }

        /** Foreach loop for display icons on frontend */
        foreach($info_icon as $item){
        
            $divider_style = '';
            $heading_style = '';
            $text_style = '';
            $icons_style = '';
            $icon1 = $item['icon1']['value'];
            $icon2 = $item['icon2']['value'];
            $icon3 = $item['icon3']['value'];
            $icon4 = $item['icon4']['value'];
            $icon5 = $item['icon5']['value'];

    
            if($anps_divider_color) {
                $divider_style = " style='background-color:$anps_divider_color;'";
            }
    
            if($anps_heading_color) {
                $heading_style = " style='color:$anps_heading_color;'";
            }
    
            if($anps_text_color) {
                $text_style = " style='color:$anps_text_color;'";
            }
    
            if($anps_text_color) {
                $text_style = " style='color:$anps_text_color;'";
            }
    
            if($anps_primary_color) {
                $icons_style = " style='color:$anps_primary_color;'";
            }
    
            $icons = '';
            for($i=1; $i<=5; $i++) {
                $name = "icon$i";
                $temp_icon = $$name;
    
                if($temp_icon) {
                    $icons .= "<i class='fa $temp_icon'></i> ";
                }
            }
            // print_r($icons);
    
            echo'<div class="anps-info-element anps-info-icon">';
            echo"<h3 class='anps-info-title'$heading_style>".$item['heading']."</h3>";
            echo"<p class='anps-info-text'$text_style>".$item['content']."</p>";
    
            if($icons != '') {
                echo"<div class='anps-info-icons-wrap'$icons_style>$icons</div>";
            }
    
            echo"<div class='anps-info-divider'$divider_style></div>";
            echo'</div>';
            }
        /** Foreach loop for display button on frontend */
        foreach($info_button as $item){
        $heading = $item['heading'];
        $icon = $item['icon_b']['value'];
        $button_text = $item['button_text'];
        $url = $item['url'];
        $target = $item['target'];
        $button_text_color = $item['button_text_color'];
        $button_text_hover_color = $item['button_text_hover_color'];
        $content = $item['content'];

        $return = '';
        $divider_style = '';
        $heading_style = '';
        $text_style = '';
        $button_bg = '';
        $button_hover = '';

        if($anps_divider_color) {
            $divider_style = " style='background-color:$anps_divider_color;'";
        }

        if($anps_heading_color) {
            $heading_style = " style='color:$anps_heading_color;'";
        }

        if($anps_text_color) {
            $text_style = " style='color:$anps_text_color;'";
        }

        if($anps_text_color) {
            $text_style = " style='color:$anps_text_color;'";
        }

        if($anps_primary_color) {
            $button_bg = $anps_primary_color;
        }

        if($anps_hover_color) {
            $button_hover = $anps_hover_color;
        }

        echo '<div class="anps-info-element anps-info-button">';
        echo "<h3 class='anps-info-title'$heading_style>$heading</h3>";
        echo "<p class='anps-info-text'$text_style>$content</p>";
        echo do_shortcode('[button background_hover="' . $button_hover . '" background="' . $button_bg . '" size="md" icon="' . $icon . '" color="' . $button_text_color . '" color_hover="' . $button_text_hover_color . '" link="' . $url . '" target="' . $target . '"]' . $button_text . '[/button]');
        echo "<div class='anps-info-divider'$divider_style></div>";
        echo '</div>';

        }
        echo '<div class="anps-info-shadow">
        </div>
        </div>';
        
        
       
	}
}