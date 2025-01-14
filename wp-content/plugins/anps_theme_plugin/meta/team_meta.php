<?php
add_action('add_meta_boxes', 'anps_team_content_add_custom_box');
add_action('save_post', 'anps_team_content_save_postdata');

function anps_team_content_add_custom_box() {
    add_meta_box('anps_team_social_meta', esc_html__('Social accounts', 'industrial'), 'anps_team_social_meta_box_content', 'team', 'side', 'core');
    add_meta_box('anps_breadcrumbs_sectionid', esc_html__('Team subtitle', 'industrial'), 'anps_display_team_meta_box_content', 'team');
}

function anps_team_social_meta_box_content($post) {
    $socials_value = get_post_meta($post->ID, 'anps_team_social', true);
    $socials = explode('|', $socials_value);
    ?>
        <!-- Social Iconpickers -->
        <div data-anps-repeat>
            <!-- Social Icons field (hidden) -->
            <input data-anps-repeat-field type="hidden" name="anps_team_social" value="<?php echo esc_attr($socials_value); ?>">

            <!-- Repeater items wrapper -->
            <div class="anps-repeat-items" data-anps-repeat-items>
                <?php foreach($socials as $social) : ?>
                <div class="anps-repeat-item" data-anps-repeat-item>
                    <!-- Fields -->
                    <p>

                        <?php
                            $social = explode(';', $social);
                            $social_icon = '';
                            $social_url = '';

                            if( isset($social[0]) ) {
                                 $social_icon = $social[0];
                            }

                            if( isset($social[1]) ) {
                                 $social_url = $social[1];
                            }
                        ?>
                        <div class="anps-iconpicker">
                            <i class="<?php echo esc_attr($social_icon); ?>"></i>
                            <input type="text" value="<?php echo esc_html($social_icon); ?>">
                            <button type="button"><?php esc_html_e('Select icon', 'industrial'); ?></button>
                        </div>
                    </p>
                    <p>
                        <input type="text" class="widefat" value="<?php echo esc_attr($social_url); ?>" />
                    </p>

                    <!-- Repeater buttons -->
                    <div class="anps-repeat-buttons">
                        <button class="anps-repeat-remove" type="button" data-anps-repeat-remove>-</button>
                        <button class="anps-repeat-add" type="button" data-anps-repeat-add>+</button>
                    </div>
                </div>
                <?php endforeach; ?>
             </div>
        </div>
    <?php
}

function anps_display_team_meta_box_content( $post ) {
    $value2 = get_post_meta($post->ID, 'anps_team_subtitle', true);
    echo "<input class='w-350' type='text' name='anps_team_subtitle' value='".esc_attr($value2)."'>";
}

function anps_team_content_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (empty($_POST)) return;

    $pid = isset($_POST['post_ID']) ? intval(sanitize_text_field($_POST['post_ID'])) : false;
    if (!$pid) {
        if (!$post_id) return;
        $pid = $post_id;
    }

    if (isset($_POST['post_type']) && 'team' === $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) return;
    }
    else {
        if (!current_user_can('edit_post', $post_id)) return;
    }

    $anps_team_social = isset($_POST['anps_team_social'])
        ? sanitize_text_field($_POST['anps_team_social'])
        : '';

    $anps_team_subtitle = isset($_POST['anps_team_subtitle'])
        ? sanitize_text_field($_POST['anps_team_subtitle'])
        : '';

    update_post_meta($pid, 'anps_team_social', $anps_team_social);
    update_post_meta($pid, 'anps_team_subtitle', $anps_team_subtitle);
}
