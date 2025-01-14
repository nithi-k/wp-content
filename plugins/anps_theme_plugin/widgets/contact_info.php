<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Anps_Contact_Info extends Widget_Base {

	public function get_name(){
        return 'contact_info';
      }
    
      public function get_title(){
        return 'Anps Contact Info';
      }
    
      public function get_icon(){
        return 'fas fa-mail-bulk';
      }
    
      public function get_categories(){
        return ['anps-em'];
      }
	protected function _register_controls() {

		$this->start_controls_section(
			'section_contact_info',
			[
				'label' => __( 'Contact Info', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'content', [
				'label' => __( 'Text', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter text.', 'anps_theme_plugin' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'url', [
				'label' => __( 'Url', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter url.', 'anps_theme_plugin' ),
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
            ]
        );

		$this->add_control(
			'contact_info',
			[
				'label' => __( 'Contact Info', 'anps_theme_plugin' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				// 'title_field' => '{{{ content }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['contact_info'] ) {
			echo "<table class='info-table'>";
            echo "<tbody>";
			foreach (  $settings['contact_info'] as $item ) {
			echo "<tr class='info-table-row'>";
            echo "<th class='info-table-icon'><i class='fa ".$item['icon']['value']."'></i></th>";
            echo "<td class='info-table-content'>";
            if($item['url']) {
                echo "<strong><a href='".$item['url']."'>";
            }
            echo $item['content'];
            if($item['url']) {
                echo "</a></strong>";
            }
            echo "</td>";
            echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
		}
		
	}
}