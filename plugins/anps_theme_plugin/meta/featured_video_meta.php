<?php
add_action('add_meta_boxes', 'anps_featured_video_add_custom_box');
add_action('save_post', 'anps_featured_video_save_postdata');

function anps_featured_video_add_custom_box() {
    $screens = array('post', 'portfolio');
    foreach ($screens as $screen) {
        add_meta_box('anps_featured_video_meta', esc_html__('Featured video', 'industrial'), 'anps_display_meta_box_featured_video', $screen, 'side');
    }
}

function anps_display_meta_box_featured_video( $post ) {
    $value2 = get_post_meta($post->ID, 'anps_featured_video', true);
    echo "<input class='w-255' type='text' name='anps_featured_video' value='". esc_attr($value2) ."'>";
}

function anps_featured_video_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (empty($_POST)) return;

    $pid = isset($_POST['post_ID']) ? intval(sanitize_text_field($_POST['post_ID'])) : false;
    if (!$pid) {
        if (!$post_id) return;
        $pid = $post_id;
    }

    $anps_featured_video = isset($_POST['anps_featured_video'])
        ? sanitize_text_field($_POST['anps_featured_video'])
        : '';

    update_post_meta($pid, 'anps_featured_video', $anps_featured_video);
}
