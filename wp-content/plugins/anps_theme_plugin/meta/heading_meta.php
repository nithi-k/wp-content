<?php
add_action('add_meta_boxes', 'anps_heading_add_custom_box');
add_action('save_post', 'anps_heading_save_postdata');

function anps_heading_add_custom_box() {
    $screens = array('page', 'post', 'team');
    foreach($screens as $screen) {
        if($screen=="product") {
            $anps_priority = "low";
        } else {
            $anps_priority = "high";
        }
        add_meta_box('anps_heading_meta', esc_html__('Page title and breadcrumbs', 'industrial'), 'anps_display_meta_box_heading', $screen, 'normal', $anps_priority);
    }
    add_meta_box('anps_heading_meta', esc_html__('Page title and breadcrumbs', 'industrial'), 'anps_display_meta_box_heading', 'portfolio', 'normal', 'core');
}

function anps_display_meta_box_heading( $post ) {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp_colorpicker');
    wp_enqueue_script('wp_backend_js');
    wp_enqueue_script('anps_upload');

    $value2 = get_post_meta($post->ID, 'anps_disable_heading', true);
    $value_breadcrumbs = get_post_meta($post->ID, 'anps_disable_page_breadcrumbs', true);
    $heading_value = get_post_meta($post->ID, 'anps_heading_bg', true);
    $page_heading_full = get_post_meta($post->ID, 'anps_page_heading_full', true);
    $anps_page_heading_video = get_post_meta($post->ID, 'anps_page_heading_video', true);
    $color_title = get_post_meta($post->ID, 'anps_color_title', true);
    $full_color_top_bar = get_post_meta($post->ID, 'anps_full_color_top_bar', true);
    $full_color_title = get_post_meta($post->ID, 'anps_full_color_title', true);
    $full_hover_color = get_post_meta($post->ID, 'anps_full_hover_color', true);
    $full_screen_logo = get_post_meta($post->ID, 'anps_full_screen_logo', true);
    $anps_page_sticky_logo = get_post_meta($post->ID, 'anps_page_sticky_logo', true);
    $anps_page_mobile_logo = get_post_meta($post->ID, 'anps_page_mobile_logo', true);
    $checked = '';
    if($value2=='1') {
        $checked = 'checked';
    }
    $checked_breadcrumbs = '';
    if($value_breadcrumbs=='1') {
        $checked_breadcrumbs = 'checked';
    }
    $checked_full_screen = "";
    if($page_heading_full=='on') {
        $checked_full_screen = 'checked';
    }
    ?>
    <p></p>
    <table class="page-title min300">
        <tr>
            <td><?php esc_html_e('Disable breadcrumbs', 'industrial'); ?></td>
            <td>
                <input type='checkbox' name='anps_disable_page_breadcrumbs' value='1' <?php echo esc_attr($checked_breadcrumbs); ?>/>
            </td>
        </tr>
        <tr>
            <td><?php esc_html_e('Disable heading', 'industrial'); ?></td>
            <td>
                <input class="hideall-trigger" type='checkbox' name='anps_disable_heading' value='1' <?php echo esc_attr($checked); ?>/>
            </td>
        </tr>
    </table>
    <table class="page-title hideall min300">
        <tr>
            <td>
                <label for="anps_heading_bg"><?php esc_html_e("Page heading background", 'industrial'); ?></label>
            </td>
            <td>
                <input id="anps_heading_bg" type="text" size="36" name="anps_heading_bg" value="<?php echo esc_attr($heading_value); ?>" />
                <input id="_btn" class="upload_image_button button" type="button" value="Upload" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="anps_full_screen_logo"><?php esc_html_e("Logo", 'industrial'); ?></label>
            </td>
            <td>
                <?php $images = get_children('post_type=attachment&post_mime_type=image'); ?>
                <select id="anps_full_screen_logo" name="anps_full_screen_logo">
                    <option value="0"><?php esc_html_e('Select logo', 'industrial'); ?></option>
                    <?php foreach ($images as $item) : ?>
                        <option <?php if ($item->guid == $full_screen_logo) {
                            echo 'selected="selected"';
                        } ?> value="<?php echo esc_attr($item->guid); ?>"><?php echo esc_html($item->post_title); ?></option>
                <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="anps_page_sticky_logo"><?php esc_html_e("Sticky logo", 'industrial'); ?></label>
            </td>
            <td>
                <?php $images = get_children('post_type=attachment&post_mime_type=image'); ?>
                <select id="anps_page_sticky_logo" name="anps_page_sticky_logo">
                    <option value="0"><?php esc_html_e('Select sticky logo', 'industrial'); ?></option>
                    <?php foreach ($images as $item) : ?>
                        <option <?php if ($item->guid == $anps_page_sticky_logo) {
                            echo 'selected="selected"';
                        } ?> value="<?php echo esc_attr($item->guid); ?>"><?php echo esc_html($item->post_title); ?></option>
                <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="anps_page_mobile_logo"><?php esc_html_e("Mobile logo", 'industrial'); ?></label>
            </td>
            <td>
                <?php $images = get_children('post_type=attachment&post_mime_type=image'); ?>
                <select id="anps_page_mobile_logo" name="anps_page_mobile_logo">
                    <option value="0"><?php esc_html_e('Select mobile logo', 'industrial'); ?></option>
                    <?php foreach ($images as $item) : ?>
                        <option <?php if ($item->guid == $anps_page_mobile_logo) {
                            echo 'selected="selected"';
                        } ?> value="<?php echo esc_attr($item->guid); ?>"><?php echo esc_html($item->post_title); ?></option>
                <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e("Full screen heading", 'industrial'); ?>
            </td>
            <td>
                <input class="showhide-trigger" type="checkbox" name="anps_page_heading_full" <?php echo esc_attr($checked_full_screen); ?>/>
            </td>
        </tr>
        <tr class="hideshow">
            <td>
                <label for="anps_color_title"><?php esc_html_e("Title color", 'industrial'); ?></label>
            </td>
            <td>
                <input class='color-field' type='text' id='anps_color_title' value='<?php echo esc_attr($color_title); ?>' name='anps_color_title' data-default-color='#f4f3ee' />
            </td>
        </tr>
    </table>
    <table class="page-title showhide hideall min300">
        <tr>
            <td>
                <label for="anps_page_heading_video"><?php esc_html_e('Page heading video background', 'industrial'); ?></label>
            </td>
            <td>
                <input type="text" name="anps_page_heading_video" id="anps_page_heading_video" value="<?php echo esc_attr($anps_page_heading_video); ?>">
            </td>
        </tr>
        <tr>
            <td>
                <label for="anps_full_color_top_bar"><?php esc_html_e("Top bar color", 'industrial'); ?></label>
            </td>
            <td>
                <input class='color-field' type='text' id='anps_full_color_top_bar' value='<?php echo esc_attr($full_color_top_bar); ?>' name='anps_full_color_top_bar' data-default-color='#f4f3ee' />
            </td>
        </tr>
        <tr>
            <td>
                <label for="anps_full_color_title"><?php esc_html_e("Menu and title color", 'industrial'); ?></label>
            </td>
            <td>
                <input class='color-field' type='text' id='anps_full_color_title' value='<?php echo esc_attr($full_color_title); ?>' name='anps_full_color_title' data-default-color='#f4f3ee' />
            </td>
        </tr>
        <tr>
            <td>
                <label for="anps_full_hover_color"><?php esc_html_e("Hover color", 'industrial'); ?></label>
            </td>
            <td>
                <input class='color-field' type='text' id='anps_full_hover_color' name='anps_full_hover_color' value='<?php echo esc_attr($full_hover_color); ?>' data-default-color='#f4f3ee' />
            </td>
        </tr>
    </table>
    <?php
}

function anps_heading_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (empty($_POST)) return;

    $pid = isset($_POST['post_ID']) ? intval(sanitize_text_field($_POST['post_ID'])) : false;
    if (!$pid) {
        if (!$post_id) return;
        $pid = $post_id;
    }

    $anps_disable_heading = isset($_POST['anps_disable_heading'])
        ? sanitize_text_field($_POST['anps_disable_heading'])
        : '0';
    update_post_meta($pid, 'anps_disable_heading', $anps_disable_heading);

    $anps_disable_page_breadcrumbs = isset($_POST['anps_disable_page_breadcrumbs'])
        ? sanitize_text_field($_POST['anps_disable_page_breadcrumbs'])
        : '0';
    update_post_meta($pid, 'anps_disable_page_breadcrumbs', $anps_disable_page_breadcrumbs);

    $anps_heading_bg = isset($_POST['anps_heading_bg'])
        ? sanitize_text_field($_POST['anps_heading_bg'])
        : '';
    update_post_meta($pid, 'anps_heading_bg', $anps_heading_bg);

    $anps_page_heading_full = isset($_POST['anps_page_heading_full'])
        ? sanitize_text_field($_POST['anps_page_heading_full'])
        : '';
    update_post_meta($pid, 'anps_page_heading_full', $anps_page_heading_full);

    $anps_page_heading_video = isset($_POST['anps_page_heading_video'])
        ? sanitize_text_field($_POST['anps_page_heading_video'])
        : '';
    update_post_meta($pid, 'anps_page_heading_video', $anps_page_heading_video);

    $anps_full_color_top_bar = isset($_POST['anps_full_color_top_bar'])
        ? sanitize_text_field($_POST['anps_full_color_top_bar'])
        : '';
    update_post_meta($pid, 'anps_full_color_top_bar', $anps_full_color_top_bar);

    $anps_full_color_title = isset($_POST['anps_full_color_title'])
        ? sanitize_text_field($_POST['anps_full_color_title'])
        : '';
    update_post_meta($pid, 'anps_full_color_title', $anps_full_color_title);

    $anps_color_title = isset($_POST['anps_color_title'])
        ? sanitize_text_field($_POST['anps_color_title'])
        : '';
    update_post_meta($pid, 'anps_color_title', $anps_color_title);

    $anps_full_hover_color = isset($_POST['anps_full_hover_color'])
        ? sanitize_text_field($_POST['anps_full_hover_color'])
        : '';
    update_post_meta($pid, 'anps_full_hover_color', $anps_full_hover_color);

    $anps_full_screen_logo = isset($_POST['anps_full_screen_logo'])
        ? sanitize_text_field($_POST['anps_full_screen_logo'])
        : '';
    update_post_meta($pid, 'anps_full_screen_logo', $anps_full_screen_logo);

    $anps_page_sticky_logo = isset($_POST['anps_page_sticky_logo'])
        ? sanitize_text_field($_POST['anps_page_sticky_logo'])
        : '';
    update_post_meta($pid, 'anps_page_sticky_logo', $anps_page_sticky_logo);

    $anps_page_mobile_logo = isset($_POST['anps_page_mobile_logo'])
        ? sanitize_text_field($_POST['anps_page_mobile_logo'])
        : '';
    update_post_meta($pid, 'anps_page_mobile_logo', $anps_page_mobile_logo);
}
