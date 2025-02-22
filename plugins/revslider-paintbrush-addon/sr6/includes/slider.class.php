<?php
/* 
 * @author    ThemePunch <info@themepunch.com>
 * @link      http://www.themepunch.com/
 * @copyright 2024 ThemePunch
*/

if(!defined('ABSPATH')) exit();

class RsPaintBrushSliderFront extends RevSliderFunctions {
	
	private $version,
			$pluginUrl, 
			$pluginTitle;
			
	public function __construct($version, $pluginUrl, $pluginTitle, $isAdmin = false) {
		$this->version     = $version;
		$this->pluginUrl   = $pluginUrl;
		$this->pluginTitle = $pluginTitle;
		
		add_action('revslider_slider_init_by_data_post', array($this, 'check_addon_active'), 10, 1); //load always, for previews in backend
		if($isAdmin){
			//add_action('admin_footer', array($this, 'write_footer_scripts'));
		}
		add_action('revslider_fe_javascript_output', array($this, 'write_init_script'), 10, 2);
		add_action('revslider_get_slider_wrapper_div', array($this, 'check_if_ajax_loaded'), 10, 2);
		add_filter('revslider_get_slider_html_addition', array($this, 'add_html_script_additions'), 10, 2);
		
		/*add_filter('script_loader_tag', array($this, 'add_attribute'), 10, 2);*/
	}
	
	// HANDLE ALL TRUE/FALSE
	private function isFalse($val) {
		if(empty($val)) return true;
		if($val === true || $val === 'on' || $val === 1 || $val === '1' || $val === 'true') return false;
		
		return true;
	}
	
	private function isEnabled($slider){
		$settings = $slider->get_params();
		$enabled = $this->get_val($settings, array('addOns', 'revslider-' . $this->pluginTitle . '-addon', 'enable'), false);
		
		if(!$this->isFalse($enabled)) return true;
		
		// check static
		$static_slide = $slider->get_static_slide();
		if($static_slide instanceof RevSliderSlide){
			$params = $static_slide->get_params();
			if($this->get_val($params, array('addOns', 'revslider-' . $this->pluginTitle . '-addon', 'enable'), false) === true) return true;
		}
		
		$slides = $slider->get_slides();
		if(empty($slides)) return false;

		foreach($slides ?? [] as $slide){
			if($this->get_val($slide, array('params', 'addOns', 'revslider-' . $this->pluginTitle . '-addon', 'enable'), false) === true) return true;
		}
		
		return false;
	}
	
	public function check_addon_active($record) {
		if(empty($record)) return $record;
		// addon enabled
		$addOn = $this->isEnabled($record);
		if(empty($addOn)) return $record;
		
		$this->add_scripts();
		remove_action('revslider_slider_init_by_data_post', array($this, 'check_addon_active'), 10);
		
		return $record;
	}
	
	public function add_scripts() {
		$handle = 'rs-' . $this->pluginTitle . '-front';
		$base   = $this->pluginUrl . 'sr6/assets/';
		$_jsPathMin = file_exists(RS_PAINTBRUSH_PLUGIN_PATH . 'sr6/assets/js/revolution.addon.' . $this->pluginTitle . '.js') ? '' : '.min';

		wp_enqueue_style($handle, $base . 'css/revolution.addon.' . $this->pluginTitle . '.css', array(), $this->version);
		wp_enqueue_script($handle, $base . 'js/revolution.addon.' . $this->pluginTitle . $_jsPathMin . '.js', array('jquery'), $this->version, true);
		
		add_filter('revslider_modify_waiting_scripts', array($this, 'add_waiting_script_slugs'), 10, 1);
	}
	
	public function add_html_script_additions($return, $output){
		if($output instanceof RevSliderSlider){
			$addOn = $this->isEnabled($output);
			if(empty($addOn)) return $return;
		}else{
			if($output->ajax_loaded !== true) return $return;
			
			$addOn = $this->isEnabled($output->slider);
			if(empty($addOn)) return $return;
		}
		
		$waiting = array();
		$waiting = $this->add_waiting_script_slugs($waiting);
		if(!empty($waiting)){
			if(!isset($return['waiting'])) $return['waiting'] = array();
			foreach($waiting as $wait){
				$return['waiting'][] = $wait;
			}
		}
		
		$global = $output->get_global_settings();
		$addition = ($output->_truefalse($output->get_val($global, array('script', 'defer'), false)) === true) ? ' async="" defer=""' : '';
		$_jsPathMin = file_exists(RS_PAINTBRUSH_PLUGIN_PATH . 'sr6/assets/js/revolution.addon.' . $this->pluginTitle . '.js') ? '' : '.min';

		$return['toload']['paintbrush'] = '<script'. $addition .' src="'. $this->pluginUrl . 'sr6/assets/js/revolution.addon.' . $this->pluginTitle . $_jsPathMin . '.js"></script>';
		
		return $return;
	}
	
	public function add_waiting_script_slugs($wait){
		$wait[] = 'paintbrush';
		return $wait;
	}
	
	public function check_if_ajax_loaded($r, $output) {
		if($output->ajax_loaded !== true) return $r;
		
		$addOn = $this->isEnabled($output->slider);
		if(empty($addOn)) return $r;
		
		$html = '<link rel="stylesheet" href="'. $this->pluginUrl . 'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.css">'."\n";
		
		return $html . $r;
	}

	public function write_init_script($slider, $id) {
		if(empty($slider)) return false;
		
		$settings = $slider->get_params();
		if(empty($settings)) return false;
		
		$addOns = $this->get_val($settings, 'addOns', false);
		if(empty($addOns)) return false;
		
		$addOn = $this->get_val($addOns, 'revslider-' . $this->pluginTitle . '-addon', false);
		if(empty($addOn)) return false;
		
		// addon enabled
		$enabled = $this->isEnabled($slider);
		if(empty($enabled)) return;
		
		$slides = $slider->get_slides();
		$mobile = wp_is_mobile();
		$enabled = false;
		
		// check to see if at least one individual slide is enabled
		foreach($slides as $slide) {
			if(!$mobile) {
				$enabled = true;
				break;
			}
			else {
				
				$disabled = $this->get_val($addOn, array('mobile', 'disable'), false);
				if(empty($disabled)) {
					$enabled = true;
					break;
				}
				
			}
		}
		
		if(!empty($enabled)) {
	
			$id = $slider->get_id();
			
			echo "\n";
			echo '						if(typeof RevSliderPaintBrush !== "undefined") RevSliderPaintBrush(tpj, revapi' . $id . ');';
			
		}
		
	}
	
}
?>