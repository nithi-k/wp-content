<?php
add_action('add_meta_boxes', 'anps_blank_page_add_custom_box');
add_action('save_post', 'anps_blank_page_save_postdata');

function anps_blank_page_add_custom_box() {
    add_meta_box('anps_blank_page_meta', esc_html__('Blank page', 'industrial'), 'anps_display_meta_box_blank_page', 'page', 'side', 'core');
}
function anps_display_meta_box_blank_page($post) {
    $header_value = get_post_meta($post->ID, 'anps_blank_page_disable_header', true);
    $footer_value = get_post_meta($post->ID, 'anps_blank_page_disable_footer', true);
    $header_checked = checked($header_value, 'on', false);
    $footer_checked = checked($footer_value, 'on', false);
    $data = '';
    $data .= '<ul>';
    $data .= '<li>';
    $data .= '<label class="selectit">';
    $data .= "<input id='anps_blank_page_disable_header' name='anps_blank_page_disable_header' type='checkbox' $header_checked>";
    $data .= esc_html__('Disable Header', 'industrial');
    $data .= '</label>';
    $data .= '</li>';
    $data .= '<li>';
    $data .= '<label class="selectit">';
    $data .= "<input id='anps_blank_page_disable_footer' name='anps_blank_page_disable_footer' type='checkbox' $footer_checked>";
    $data .= esc_html__('Disable Footer', 'industrial');
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

function anps_blank_page_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (empty($_POST)) return;

    $pid = isset($_POST['post_ID']) ? intval(sanitize_text_field($_POST['post_ID'])) : false;
    if (!$pid) {
        if (!$post_id) return;
        $pid = $post_id;
    }

    $data_header = isset($_POST['anps_blank_page_disable_header'])
        ? sanitize_text_field($_POST['anps_blank_page_disable_header'])
        : '';

    $data_footer = isset($_POST['anps_blank_page_disable_footer'])
        ? sanitize_text_field($_POST['anps_blank_page_disable_footer'])
        : '';

    update_post_meta($pid, 'anps_blank_page_disable_header', $data_header);
    update_post_meta($pid, 'anps_blank_page_disable_footer', $data_footer);
}
