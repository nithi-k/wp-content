<?php
/* include all shortcodes from config file */
function anps_include_all_shortcodes($file) {
    $config_url = get_template_directory() . '/config/config_shortcodes.json';
    if(file_exists($config_url)) {
        $config_data = file_get_contents($config_url); 
        $shortcodes = json_decode($config_data);    
        foreach($shortcodes as $item) {
            $dir = plugin_dir_path( __FILE__ ).'shortcodes/'.$item;
            if(file_exists($dir.'/'.$file.'.php')) {
                include_once $dir.'/'.$file.'.php';
            }
        } 
    } else {
        $dir = plugin_dir_path( __FILE__ ).'shortcodes';  
        $results = scandir($dir);
        foreach($results as $item) {
            if ($item === '.' or $item === '..') { continue; }
            if (is_dir($dir . '/' . $item) && file_exists($dir.'/'.$item.'/'.$file.'.php')) {
                include_once $dir.'/'.$item.'/'.$file.'.php';
            }
        }
    }
}
/* get all cf7 forms */
function anps_get_all_cf7_forms() {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
    $contact_form_array = array();
    if($cf7) {
        foreach($cf7 as $cform) {
            $contact_form_array[$cform->post_title] = $cform->ID;
        }
    } else {
        $contact_form_array[esc_html__('No contact forms found', 'js_composer') ] = 0;
    }
    return $contact_form_array;
}
/* Blog categories new parameter */
function anps_blog_categories_settings_field($settings, $value) {
    $blog_data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    $blog_data .= '<option class="0" value="0">'.esc_html__("All", 'anps_theme_plugin').'</option>';
    foreach(get_categories() as $val) {
        $selected = '';
        if ($value!=='' && $val->slug == $value) {
             $selected = ' selected';
        }
        $blog_data .= '<option class="'.$val->slug.'" value="'.$val->slug.'"'.$selected.'>'.$val->name.'</option>';
    }
    $blog_data .= '</select>';
    return $blog_data;
}
/* Portfolio categories new parameter */
function anps_portfolio_categories_settings_field($settings, $value) {
    $categories = get_terms('portfolio_category');
    $data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    $data .= '<option class="0" value="0">'.esc_html__("All", 'anps_theme_plugin').'</option>';
    foreach($categories as $val) {
        $selected = '';
        if ($value!=='' && $val->term_id == $value) {
             $selected = ' selected';
        }
        $data .= '<option class="'.$val->term_id.'" value="'.$val->term_id.'"'.$selected.'>'.$val->name.'</option>';
    }
    $data .= '</select>';
    return $data;
}
/* All pages new parameter */
function anps_all_pages_settings_field($settings, $value) {
    $data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    foreach(get_pages() as $val) {
        $selected = '';
        if ($value!=='' && $val->ID == $value) {
             $selected = ' selected';
        }
        $data .= '<option class="'.$val->ID.'" value="'.$val->ID.'"'.$selected.'>'.$val->post_title.'</option>';
    }
    $data .= '</select>';
    return $data;
}

function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'anps-em',
		[
			'title' => __( 'anps-shortcodes', 'anps_theme_plugin' ),
			'icon' => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

function anps_get_all_port_cat() {
    //get portfolio categories name for dropdown control
    $categories = array();
    $category_list_items = get_terms('portfolio_category');
    
    foreach($category_list_items as $category_list_item){
        if(! empty($category_list_item->slug) ){
            
            $categories[$category_list_item->term_id] = $category_list_item->name;
            
        }
    }
    return $categories;
}
function anps_get_all_post_cat() {
    //get portfolio categories name for dropdown control
    $categories = array();
    $category_list_items = get_categories('blog_category'); 
    
    foreach($category_list_items as $category_list_item){
        if(! empty($category_list_item->slug) ){
            $categories[$category_list_item->name] = $category_list_item->name;
            
        }
    }
    return $categories;
}
