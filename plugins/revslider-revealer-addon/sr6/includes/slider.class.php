<?php
/* 
 * @author    ThemePunch <info@themepunch.com>
 * @link      http://www.themepunch.com/
 * @copyright 2024 ThemePunch
*/

if(!defined('ABSPATH')) exit();

include_once(RS_REVEALER_PLUGIN_PATH . 'sr6/includes/preloaders.class.php');

if(class_exists('RevSliderFunctions')) {

	class RsRevealerSliderFront extends RevSliderFunctions {
		
		private $version,
				$pluginUrl, 
				$pluginTitle;
				
		public function __construct($version, $pluginUrl, $pluginTitle, $isAdmin = false) {
			
			$this->version     = $version;
			$this->pluginUrl   = $pluginUrl;
			$this->pluginTitle = $pluginTitle;
			
			add_action('revslider_slider_init_by_data_post', array($this, 'check_addon_active'), 10, 1);
			if($isAdmin){
				//add_action('wp_enqueue_scripts', array($this, 'add_scripts'));
			}
			add_action('revslider_fe_javascript_output', array($this, 'write_init_script'), 10, 2);
			add_action('revslider_get_slider_wrapper_div', array($this, 'check_if_ajax_loaded'), 10, 2);
			add_filter('revslider_get_slider_html_addition', array($this, 'add_html_script_additions'), 10, 2);
			add_action('revslider_fe_javascript_option_output', array($this, 'write_init_options'), 10, 1);
			add_action('revslider_disable_first_trans', array($this, 'disable_first_trans'), 10, 2);

			add_action('revslider_export_html_write_footer', array($this, 'write_export_footer'), 10, 1);
			add_filter('revslider_export_html_file_inclusion', array($this, 'add_addon_files'), 10, 2);
			
		}

		public function write_export_footer($export){
			$output = $export->slider_output;
			$array = $this->add_html_script_additions(array(), $output);
			$toload = $this->get_val($array, 'toload', array());
			if(!empty($toload)){
				foreach($toload as $script){
					echo $script;
				}
			}
		}
	
		public function add_addon_files($html, $export){
			$output = $export->slider_output;
			$addOn = $this->isEnabled($output->slider);
			if(empty($addOn)) return $html;
	
			$_jsPathMin = file_exists(RS_REVEALER_PLUGIN_PATH . 'sr6/assets/js/revolution.addon.' . $this->pluginTitle . '.js') ? '' : '.min';
			if(!$export->usepcl){
				$export->zip->addFile(RS_REVEALER_PLUGIN_PATH . 'sr6/assets/js/revolution.addon.' . $this->pluginTitle . $_jsPathMin . '.js', 'js/revolution.addon.' . $this->pluginTitle . $_jsPathMin . '.js');
				$export->zip->addFile(RS_REVEALER_PLUGIN_PATH . 'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.css', 'css/revolution.addon.' . $this->pluginTitle . '.css');
				$export->zip->addFile(RS_REVEALER_PLUGIN_PATH . 'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.preloaders.css', 'css/revolution.addon.' . $this->pluginTitle . '.preloaders.css');
			}else{
				$export->pclzip->add(RS_REVEALER_PLUGIN_PATH.'sr6/assets/js/revolution.addon.' . $this->pluginTitle . $_jsPathMin . '.js', PCLZIP_OPT_REMOVE_PATH, RS_REVEALER_PLUGIN_PATH.'sr6/assets/js/', PCLZIP_OPT_ADD_PATH, 'js/');
				$export->pclzip->add(RS_REVEALER_PLUGIN_PATH.'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.css', PCLZIP_OPT_REMOVE_PATH, RS_REVEALER_PLUGIN_PATH.'sr6/assets/css/', PCLZIP_OPT_ADD_PATH, 'css/');
				$export->pclzip->add(RS_REVEALER_PLUGIN_PATH.'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.preloaders.css', PCLZIP_OPT_REMOVE_PATH, RS_REVEALER_PLUGIN_PATH.'sr6/assets/css/', PCLZIP_OPT_ADD_PATH, 'css/');
			}
	
			$html = str_replace($this->pluginUrl.'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.css', 'css/revolution.addon.' . $this->pluginTitle . '.css', $html);
			$html = str_replace($this->pluginUrl.'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.preloaders.css', 'css/revolution.addon.' . $this->pluginTitle . '.preloaders.css', $html);
			$html = str_replace($this->pluginUrl.'sr6/assets/js/revolution.addon.' . $this->pluginTitle . $_jsPathMin .'.js', $export->path_js .'revolution.addon.' . $this->pluginTitle . $_jsPathMin .'.js', $html);

			return $html;
		}
		
		/*
		* @desc slider's first trans now auto-disabled with this new filter
		* @since 2.2.1
		* @JM
		*/
		public function disable_first_trans($val, $slider) {
			$addOn = $this->isEnabled($slider);
			
			if(!empty($addOn)) {
				return false;
			}	
			return $val;
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

			return ($this->get_val($settings, array('addOns', 'revslider-' . $this->pluginTitle . '-addon', 'direction'), 'none') !== 'none') ? true : false;
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
			$base = $this->pluginUrl . 'sr6/assets/';
			$path = $base . 'js/revolution.addon.' . $this->pluginTitle . '.min.js';
			$_jsPathMin = file_exists(RS_REVEALER_PLUGIN_PATH . 'sr6/assets/js/revolution.addon.' . $this->pluginTitle . '.js') ? '' : '.min';
			
			wp_enqueue_style($handle, $base . 'css/revolution.addon.' . $this->pluginTitle . '.css', array(), $this->version);
			wp_enqueue_style($handle . '-preloaders', $base . 'css/revolution.addon.' . $this->pluginTitle . '.preloaders.css', array(), $this->version);
			wp_enqueue_script($handle, $base . 'js/revolution.addon.' . $this->pluginTitle . $_jsPathMin . '.js', array('jquery'), $this->version, true);
			
			add_filter('revslider_modify_waiting_scripts', array($this, 'add_waiting_script_slugs'), 10, 1);
		}
		
		public function add_html_script_additions($return, $output){
			if($output instanceof RevSliderSlider){
				$addOn = $this->isEnabled($output);
				if(empty($addOn)) return $return;
			}else{
				$me = $output->get_markup_export();
				if($me !== true && $output->ajax_loaded !== true) return $return;
				
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
			$_jsPathMin = file_exists(RS_REVEALER_PLUGIN_PATH . 'sr6/assets/js/revolution.addon.' . $this->pluginTitle . '.js') ? '' : '.min';
			
			$return['toload']['revealer'] = '<script'. $addition .' src="'. $this->pluginUrl . 'sr6/assets/js/revolution.addon.' . $this->pluginTitle . $_jsPathMin . '.js"></script>';
			
			return $return;
		}
		
		public function add_waiting_script_slugs($wait){
			$wait[] = 'revealer';
			return $wait;
		}
		
		public function check_if_ajax_loaded($r, $output) {
			$me = $output->get_markup_export();
			if($me !== true && $output->ajax_loaded !== true) return $r;
			
			$addOn = $this->isEnabled($output->slider);
			if(empty($addOn)) return $r;
			
			$html = '<link rel="stylesheet" href="'. $this->pluginUrl . 'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.css">'."\n";
			$html .= '<link rel="stylesheet" href="'. $this->pluginUrl . 'sr6/assets/css/revolution.addon.' . $this->pluginTitle . '.preloaders.css">'."\n";

			return $html . $r;
		}
		
		
		public function write_init_script($slider, $id) {
			
			// addon enabled
			$addOn = $this->isEnabled($slider);
			if(!empty($addOn)) {
				
				$id = $slider->get_id();
				$preloader = $this->get_val($addOn, 'spinner', array());
				$preloader = $this->get_val($preloader, 'type', 'default');
				$preloaders = RsAddOnRevealPreloaders::getPreloaders();
				
				if($preloader !== 'default' && array_key_exists($preloader, $preloaders)) {
					$preloader = $preloaders[$preloader];
					$preloader = json_encode($preloader);
				}
				else {
					$preloader = 'false';
				}

				echo "\n";
				echo "\t\t\t\t\t\t" . 'if(typeof RsRevealerAddOn !== "undefined") RsRevealerAddOn(jQuery, revapi' . $id . ', ' . $preloader . ');' . "\n";
				
			}
			
		}
		
		private function minMax($val) {
		
			$val = intval($val);
			$val = max(10, $val);
			return min(10000, $val);
		
		}
		
		public function write_init_options($slider) {
			
			// addon enabled
			$addOn = $this->isEnabled($slider);
						
			if($addOn) {
				
				$_title = $this->pluginTitle;
				$tabs = "\t\t\t\t\t\t\t\t";
				$tabsa = "\t\t\t\t\t\t\t\t\t";
				$addOn = $this->get_val($slider->get_params(), array('addOns', 'revslider-' . $_title . '-addon'));
				
				$color = $this->get_val($addOn, 'color', '#000000');
				$preloader = $this->get_val($addOn, 'spinner', array());
				$spinner = $this->get_val($preloader, 'type', 'default');
				$spinnerColor = $this->get_val($preloader, 'color', '#FFFFFF');
				$direction = $this->get_val($addOn, 'direction', 'open_horizontal');
				
				$overlay = $this->get_val($addOn, 'overlay', array());
				$overlay_enabled = $this->get_val($overlay, 'enable', false);
				$overlay_enabled = !$this->isFalse($overlay_enabled);
				
				if($overlay_enabled) $overlay_color = $this->get_val($overlay, 'color', '#000000');
				if(class_exists('RSColorpicker')) {
					
					if(strpos($direction, 'corner') === false) {
						$color = RSColorpicker::get($color);
					}
					else {
						$color = RSColorpicker::process($color, true);
						$color = strpos($color[1], 'gradient') === false ? $color[0] : json_encode($color[2]);
					}
					
					if($overlay_enabled) $overlay_color = RSColorpicker::get($overlay_color);
					if($spinner == '2') {
						$spinnerColor = RSColorpicker::processRgba($spinnerColor);
						$spinnerColor = str_replace('rgb', 'rgba', $spinnerColor);
						$spinnerColor = str_replace(')', ',', $spinnerColor);
					}
					
				}
				
				$duration = $this->get_val($addOn, 'duration', '500');
				$delay = $this->get_val($addOn, 'delay', '0');
				$overlay_duration = $this->get_val($overlay, 'duration', '500');
				$overlay_delay = $this->get_val($overlay, 'delay', '0');
				
				$duration = str_replace('ms', '', $duration);
				$delay = str_replace('ms', '', $delay);
				$overlay_duration = str_replace('ms', '', $overlay_duration);
				$overlay_delay = str_replace('ms', '', $overlay_delay);
				
				$delay = $this->minMax($delay);
				$overlay_delay = $this->minMax($overlay_delay);
				$duration = $this->minMax($duration);
				$overlay_duration = $this->minMax($overlay_duration);
				
				/*
				* @desc always override first transition
				* @since 2.2.1
				* @JM
				*/
				echo $tabs . 'fanim: {speed:300},' . "\n";
				
				echo $tabs . 'revealer: {' . "\n";
				echo $tabsa . 'direction: "' . $direction . '",' . "\n";
				echo $tabsa . "color: '" . $color . "'," . "\n";
				echo $tabsa . 'duration: "' . $duration . '",' . "\n";
				echo $tabsa . 'delay: "' . $delay . '",' . "\n";
				echo $tabsa . 'easing: "' . $this->get_val($addOn, 'easing', 'Power2.easeOut') . '",' . "\n";
				
				if($overlay_enabled) {
					echo $tabsa . 'overlay_enabled: true,' . "\n";
					echo $tabsa . 'overlay_color: "' . $overlay_color . '",' . "\n";
					echo $tabsa . 'overlay_duration: "' . $overlay_duration . '",' . "\n";
					echo $tabsa . 'overlay_delay: "' . $overlay_delay . '",' . "\n";
					echo $tabsa . 'overlay_easing: "' . $this->get_val($overlay, 'easing', 'Power2.easeOut') . '",' . "\n";
				}
				
				echo $tabsa . 'spinner: "' . $spinner . '",' . "\n";
				echo $tabsa . 'spinnerColor: "' . $spinnerColor . '",' . "\n";
				echo $tabs . '},' . "\n";
				
			}
		
		}
		
	}
}
?>