<?php
add_action('add_meta_boxes', 'anps_header_options_add_custom_box');
add_action('save_post', 'anps_header_options_save_postdata');

function anps_header_options_add_custom_box() {
    add_meta_box('anps_header_options_meta', esc_html__('Header options', 'industrial'), 'anps_display_meta_box_header_options', 'page', 'side', 'core');
    add_meta_box('anps_spacing_options_meta', esc_html__('Spacing options', 'industrial'), 'anps_display_meta_box_spacing_options', 'page', 'side', 'core');
}
/* Topa bar, above nav menu */
function anps_display_meta_box_header_options($post) {
    $top_bar = get_post_meta($post->ID, 'anps_header_options_top_bar', true);
    $above_menu = get_post_meta($post->ID, 'anps_header_options_above_menu', true);
    $select_array = array(esc_html__('Default', 'industrial'), esc_html__('Off', 'industrial'), esc_html__('On', 'industrial'));
    $data = '';
    $data .= '<div class="inside">';
    $data .= '<p>';
    $data .= '<label for="anps_header_options_top_bar">';
    $data .= '<strong>'.esc_html__('Top bar', 'industrial').'</strong>';
    $data .= '</label>';
    $data .= '</p>';
    $data .= '<p>';
    $data .= '<select name="anps_header_options_top_bar" id="anps_header_options_top_bar">';
    foreach ($select_array as $key => $item) {
        $selected = $key == $top_bar ? ' selected' : '';
        $data .= "<option value='{$key}'{$selected}>{$item}</option>";
    }
    $data .= '</select>';
    $data .= '</p>';
    $data .= '<p>';
    $data .= '<label class="selectit">';
    $data .= '<strong>'.esc_html__('Above menu', 'industrial').'</strong>';
    $data .= '</label>';
    $data .= '</p>';
    $data .= '<p>';
    $data .= '<select name="anps_header_options_above_menu">';
    foreach ($select_array as $key => $item) {
        $selected2 = $key == $above_menu ? ' selected' : '';
        $data .= "<option value='{$key}'{$selected2}>{$item}</option>";
    }
    $data .= '</select>';
    $data .= '</p>';
    $data .= '</div>';
    echo wp_kses($data, array(
        'div' => array(
            'class' => array()
        ),
        'p' => array(),
        'label' => array(
            'for' => array()
        ),
        'strong' => array(),
        'select' => array(
            'name' => array(),
            'id' => array()
        ),
        'option' => array(
            'value' => array(),
            'selected' => array()
        )
    ));
}
/* Header/footer margin */
function anps_display_meta_box_spacing_options($post) {
    $header_value = get_post_meta($post->ID, 'anps_header_options_header_margin', true);
    $footer_value = get_post_meta($post->ID, 'anps_header_options_footer_margin', true);
    $header_margin_checked = checked($header_value, 'on', false);
    $footer_margin_checked = checked($footer_value, 'on', false);
    $data = '';
    $data .= '<ul>';
    $data .= '<li>';
    $data .= '<label class="selectit">';
    $data .= "<input id='anps_header_options_header_margin' name='anps_header_options_header_margin' type='checkbox' $header_margin_checked>";
    $data .= esc_html__('Remove Header Margin', 'industrial');
    $data .= '</label>';
    $data .= '</li>';
    $data .= '<li>';
    $data .= '<label class="selectit">';
    $data .= "<input id='anps_header_options_footer_margin' name='anps_header_options_footer_margin' type='checkbox' $footer_margin_checked>";
    $data .= esc_html__('Remove Footer Margin', 'industrial');
    $data .= '</label>';
    $data .= '</li>';
    $data .= '</ul>';
    echo wp_kses($data, array(
        'ul' => array(),
        'li' => array(),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id' => array(),
            'name' => array(),
            'type' => array(),
            'checked' => array(),
        )
    ));
}
function anps_header_options_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (empty($_POST)) return;

    $pid = isset($_POST['post_ID']) ? intval(sanitize_text_field($_POST['post_ID'])) : false;
    if (!$pid) {
        if (!$post_id) return;
        $pid = $post_id;
    }

    $header_margin = isset($_POST['anps_header_options_header_margin'])
        ? sanitize_text_field($_POST['anps_header_options_header_margin'])
        : '';
    $footer_margin = isset($_POST['anps_header_options_footer_margin'])
        ? sanitize_text_field($_POST['anps_header_options_footer_margin'])
        : '';
    $top_bar = isset($_POST['anps_header_options_top_bar'])
        ? sanitize_text_field($_POST['anps_header_options_top_bar'])
        : '';
    $above_menu = isset($_POST['anps_header_options_above_menu'])
        ? sanitize_text_field($_POST['anps_header_options_above_menu'])
        : '';

    update_post_meta($pid, 'anps_header_options_header_margin', $header_margin);
    update_post_meta($pid, 'anps_header_options_footer_margin', $footer_margin);
    update_post_meta($pid, 'anps_header_options_top_bar', $top_bar);
    update_post_meta($pid, 'anps_header_options_above_menu', $above_menu);
}
