<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Anps_Timeline extends Widget_Base {

	public function get_name(){
        return 'timeline';
      }
    
      public function get_title(){
        return 'Anps Timeline';
      }
    
      public function get_icon(){
        return 'far fa-hourglass';
      }
    
      public function get_categories(){
        return ['anps-em'];
      }
	protected function _register_controls() {

		$this->start_controls_section(
			'section_timeline',
			[
				'label' => __( 'Timeline', 'anps_theme_plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
			'year', [
				'label' => __( 'Year', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter year.', 'anps_theme_plugin' ),
                'label_block' => true,
                'default' => '2020'
			]
        );
        $repeater->add_control(
			'title', [
				'label' => __( 'Title', 'anps_theme_plugin' ),
				'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter title.', 'anps_theme_plugin' ),
                'label_block' => true,
			]
        );
        $repeater->add_control(
			'content', [
				'label' => __( 'Content', 'anps_theme_plugin' ),
                'type' => Controls_Manager::TEXTAREA,
                'row'=> '5',
                'placeholder' => __( 'Enter text for table cell.', 'anps_theme_plugin' ),
                'label_block' => true,
			]
        );
        $this->add_control(
			'timeline',
			[
				'label' => __( 'Timeline', 'anps_theme_plugin' ),
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
        $timeline = $settings['timeline'];
        
        echo "<div class='timeline'>";
        foreach($timeline as $item){
            $year = $item['year'];
            $title = $item['title'];
            $content = $item['content'];


             echo '<div class="timeline-item">';
             echo '<div class="timeline-year">' . $year . '</div>';
              echo '<div class="timeline-content">';
                 echo '<h3 class="timeline-title">' . $title . '</h3>';
                 echo '<div class="timeline-text">' . $content . '</div>';
             echo '</div>';
             echo '</div>';
        }
        echo "</div>";
	}
}