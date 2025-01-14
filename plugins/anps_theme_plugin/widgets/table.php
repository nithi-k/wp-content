<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Anps_Table extends Widget_Base
{

  public function get_name()
  {
    return 'table';
  }

  public function get_title()
  {
    return 'Anps Table';
  }

  public function get_icon()
  {
    return 'fas fa-table';
  }

  public function get_categories()
  {
    return ['anps-em'];
  }
  protected function _register_controls()
  {

    $this->start_controls_section(
      'section_table',
      [
        'label' => __('Table', 'anps_theme_plugin'),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new Repeater();


    $this->add_control(
      'tabel_heading',
      [
        'label' => __('Table heading', 'anps_theme_plugin'),
        'type' => Controls_Manager::TEXT,
        'default' => __('', 'anps_theme_plugin'),
        'description' => 'Enter table heading.',
        'label_block' => true,
      ]
    );
    $this->add_control(
      'striped',
      [
        'label' => __('Striped', 'anps_theme_plugin'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'anps_theme_plugin'),
        'label_off' => __('No', 'anps_theme_plugin'),
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );
    $this->add_control(
      'bordered',
      [
        'label' => __('Bordered', 'anps_theme_plugin'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'anps_theme_plugin'),
        'label_off' => __('No', 'anps_theme_plugin'),
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );
    $this->add_control(
      'head_style',
      [
        'label' => __('Table heading style 2', 'anps_theme_plugin'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'anps_theme_plugin'),
        'label_off' => __('No', 'anps_theme_plugin'),
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );

    $repeater->add_control(
      'table_cell',
      [
        'label' => __('Table cell', 'anps_theme_plugin'),
        'type' => Controls_Manager::TEXT,
        'placeholder' => __('Enter text for table cell.', 'anps_theme_plugin'),
        'label_block' => true,
      ]
    );
    $this->add_control(
      'tabel',
      [
        'label' => __('Tabel cell', 'anps_theme_plugin'),
        'type' => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        // 'title_field' => '{{{ class }}}',
      ]
    );


    $this->end_controls_section();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();

    //store value from control outside repeater
    $tabel_heading = $settings['tabel_heading'];
    $striped = $settings['striped'];
    $bordered = $settings['bordered'];
    $head_style = $settings['head_style'];
    $tabel = $settings['tabel'];

    $striped_c = '';
    if ($striped == 'yes') {
      $striped_c = 'table-striped';
    }

    $bordered_c = '';
    if ($bordered == 'yes') {
      $bordered_c = 'table-bordered';
    }

    $head_style_c = '';
    if ($head_style == "yes") {
      $head_style_c = 'class="bg-primary"';
    }

    echo "<div class='table-responsive'>";
    echo "<table class='table " . $striped_c . ' ' . $bordered_c . "'>";
    echo "<thead " . $head_style_c . ">";
    echo "<tr>";
    echo "<th>" . $tabel_heading . "</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($tabel as $item) {
      $tabel_cell = $item['table_cell'];
      echo "<tr>";
      echo "<td>" . $tabel_cell . "</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
  }
}
