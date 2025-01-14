<?php

function anps_content_add_custom_box() {
    add_meta_box('anps_breadcrumbs_sectionid', esc_html__('Side Content', 'industrial'), 'anps_display_meta_box_content', 'portfolio');
}

function anps_display_meta_box_content($post) {
    $value2 = get_post_meta($post->ID, 'portfolio_side_content', true);
    wp_editor($value2, 'content-id', array('textarea_name' => 'portfolio_side_content', 'media_buttons' => false, 'teeny' => true));
}

function anps_content_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (empty($_POST)) return;

    $pid = isset($_POST['post_ID']) ? intval(sanitize_text_field($_POST['post_ID'])) : false;
    if (!$pid) {
        if (!$post_id) return;
        $pid = $post_id;
    }

    if (isset($_POST['post_type']) && 'portfolio' === $_POST['post_type']) {
        if (!current_user_can('edit_page', $pid)) return;
    }
    else {
        if (!current_user_can('edit_post', $pid)) return;
    }

    $portfolio_side_content = isset($_POST['portfolio_side_content'])
        ? sanitize_text_field($_POST['portfolio_side_content'])
        : '';
    update_post_meta($pid, 'portfolio_side_content', $portfolio_side_content);
}
