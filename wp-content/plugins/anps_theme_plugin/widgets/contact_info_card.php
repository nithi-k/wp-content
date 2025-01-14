<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;

class Anps_Contact_Info_Card extends Widget_Base {

	public function get_name(){
        return 'contact_info_card';
      }
    
      public function get_title(){
        return 'Anps Contact Info Card';
      }
    
      public function get_icon(){
        return 'fas fa-mail-bulk';
      }
    
      public function get_categories(){
        return ['anps-em'];
      }
	protected function _register_controls() {

		$this->start_controls_section(
			'section_contact_info_card',
			[
				'label' => __( 'Contact Info Card', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();
        
        $this->add_control(
            'num_row',
            [
                'label' => __( 'Number in row', 'anps_theme_plugin' ),
                'type' => Controls_Manager::SELECT,
                'options' =>  [
                    '3' => __('3', 'anps_theme_plugin'),
                    '2' => __('2', 'anps_theme_plugin'),
                ],
                'default' => '3',
                'label_block' => true,
                'save_always' => true,
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
            ]
        );
        $repeater->add_control(
			'card_title', [
				'label' => __( 'Title', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter title.', 'anps_theme_plugin' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content', [
				'label' => __( 'Text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::WYSIWYG,
                'placeholder' => __( 'Enter text.', 'anps_theme_plugin' ),
				'label_block' => true,
			]
        );
        $repeater->add_control(
            'title_color',
            [
                'label' => __('Title color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#a3baca',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $repeater->add_control(
            'desc_color',
            [
                'label' => __('Description color', 'anps_theme_plugin'),
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
        $repeater->add_control(
            'background_color',
            [
                'label' => __('Background color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#215070',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
        $repeater->add_control(
            'icon_color',
            [
                'label' => __('Icon color', 'anps_theme_plugin'),
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
        $repeater->add_control(
            'icon_back_color',
            [
                'label' => __('Icon background color', 'anps_theme_plugin'),
                'type'  => Controls_Manager::COLOR,
                'scheme'=> [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#3498db',
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ]
            ]
        );
		$this->add_control(
			'contact_info_card',
			[
				'label' => __( 'Contact Info Card', 'anps_theme_plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				// 'title_field' => '{{{ content }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        //store value from control outside repeater
        $num_row = $settings['num_row'];

        if ( $settings['contact_info_card'] ) {

            //use dropdown outside repeater to define row number
            global $num_row_global;
            $num_row_global = $num_row;
			echo "<div class='contact_cards'>";
            echo "<div class='row'>";
			foreach (  $settings['contact_info_card'] as $item ) {
                global $num_row_global;
                $class_row = 'col-md-4';
                if($num_row_global == '2') {
                    $class_row = 'col-md-6';
                }
                if($item['content'] !== '') {
                    $card_text = $item['content'];
                }

                //display on frontend
                echo "<div class='$class_row'>";
                echo '<div class="card" style="background-color:' . $item['background_color'] . '; color:' . $item['icon_back_color']. '">';
                echo "<span class='icon'>";
                echo "<i class='".$item['icon']['value']."' style='color: ".$item['icon_color']."'></i>";
                echo '</span>';
                echo '<div class="content-wrap">';
                if($item['card_title'] != '') {
                    echo "<span class='item-title' style='color:".$item['title_color'].";'>".$item['card_title']."</span>";
                }
                if($card_text != '') {
                    echo "<div class='text font1' style='color:". $item['desc_color'] ."' >$card_text</div>";
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo "</div>";
            echo "</div>";
		}
		
	}
}