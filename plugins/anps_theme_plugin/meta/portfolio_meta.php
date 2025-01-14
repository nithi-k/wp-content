<?php
add_action('add_meta_boxes', 'anps_portfolio_content_add_custom_box');
add_action('save_post', 'anps_portfolio_content_save_postdata');

function anps_portfolio_content_add_custom_box() {
    add_meta_box('anps_hide_portfolio_meta', esc_html__('Project info table', 'industrial'), 'anps_hide_portolio', 'portfolio', 'side', 'core');
    add_meta_box('anps_portfolio_side_meta', esc_html__('Breadcrumbs parent page', 'industrial'), 'anps_display_portfolio_breadcrumbs_meta_box', 'portfolio', 'side', 'core');
    add_meta_box('anps_portfolio_side_meta', esc_html__('Breadcrumbs parent page', 'industrial'), 'anps_display_portfolio_breadcrumbs_meta_box', 'post', 'side', 'core');

}

function anps_hide_portolio($post) {
    $socials_value = get_post_meta($post->ID, 'anps_portfolio_table_repeater', true);
    $socials = explode('|', $socials_value);
    ?>
        <!-- Social Iconpickers -->
        <div data-anps-repeat>
            <!-- Social Icons field (hidden) -->
            <input data-anps-repeat-field type="hidden" name="anps_portfolio_table_repeater" value="<?php echo esc_attr($socials_value); ?>">

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
                            <i class="fa <?php echo esc_attr($social_icon); ?>"></i>
                            <input type="text" value="<?php echo esc_attr($social_icon); ?>">
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

function anps_display_portfolio_breadcrumbs_meta_box($post) {
    $custom_breadcrumbs = get_post_meta( $post -> ID, $key = 'custom_breadcrumbs', $single = true );
    ?>
    <select name="custom_breadcrumbs">
        <option value="0"><?php esc_html_e('*** Select ***', 'industrial'); ?></option>
        <?php
            $pages = get_pages();
            foreach ($pages as $item) :
                $selected = $custom_breadcrumbs == $item->ID; ?>
                <option value="<?php echo esc_attr($item->ID); ?>"<?php if ($selected) : ?> selected<?php endif; ?>><?php echo esc_html($item->post_title); ?></option>
                <?php
            endforeach;
        ?>
    </select>
    <?php
}

function anps_portfolio_content_save_postdata($post_id) {
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

    $table_repeater = isset($_POST['anps_portfolio_table_repeater'])
        ? sanitize_text_field($_POST['anps_portfolio_table_repeater'])
        : '';

    $portfolio_shorttext = isset($_POST['anps_portfolio_shorttext'])
        ? sanitize_text_field($_POST['anps_portfolio_shorttext'])
        : '';

    $custom_breadcrumbs = isset($_POST['custom_breadcrumbs'])
        ? sanitize_text_field($_POST['custom_breadcrumbs'])
        : '';

    update_post_meta($pid, 'anps_portfolio_table_repeater', $table_repeater);
    update_post_meta($pid, 'anps_portfolio_shorttext', $portfolio_shorttext);
    update_post_meta($pid, 'custom_breadcrumbs', $custom_breadcrumbs);
}
