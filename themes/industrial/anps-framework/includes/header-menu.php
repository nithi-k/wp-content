<?php
if (!function_exists('anps_get_menu')) {
    function anps_custom_menu_button($button_text = 'Click Me', $button_link = '#', $button_class = 'btn-menu-custom') {
        return 'hi';
    }
    
    function anps_get_menu()
    {
        ?>
        <div class="mobile-wrap">
            <button class="burger"><span class="burger-top"></span><span class="burger-middle"></span><span class="burger-bottom"></span></button>
            <?php
            echo "<anps_get_menu custom>";
            /* Include mobile search (check if it is enabled for mobile) */
            if (get_option('anps_global_search_icon_mobile', '1') == '1') {
                anps_mobile_search();
            }
            /* END Include mobile search */

            //above nav bar
            $above_nav_bar_global = get_option('anps_global_above_nav_bar', '1');
            $above_nav_bar_site = get_post_meta(get_queried_object_id(), $key = 'anps_header_options_above_menu', $single = true);
            /*
             * 1) chcek if above nav global is on AND page above nav is default
             * 2) check if page above nav is on
             * 3) check if above nav global is on AND page above nav is empty
             */
            if ((isset($above_nav_bar_site) && $above_nav_bar_site == '0' && $above_nav_bar_global == '1') || (isset($above_nav_bar_site) && $above_nav_bar_site == '2') || (isset($above_nav_bar_site) && $above_nav_bar_site == '' && $above_nav_bar_global == '1')) {
                $above_nav_bar = '1';
            } else {
                $above_nav_bar = '0';
            }
            /*
             * above navigation sidebar have to be enabled (theme options -> header options)
             * above-navigation-bar sidebars must be enabled
             * menu style has to be different than style2
             */
            if (($above_nav_bar == '1') && is_active_sidebar('above-navigation-bar') && get_option('anps_home_classic_menu_type', 'top') != 'style2') : ?>
                <!-- Above nav sidebar -->
                <div class="above-nav-bar">
                    <?php dynamic_sidebar('above-navigation-bar'); ?>
                </div>
            <?php endif;
            $locations = get_theme_mod('nav_menu_locations');

            /* Check if menu is selected */
            $walker = '';
            $menu = '';
            $locations = get_theme_mod('nav_menu_locations');

            if ($locations && isset($locations['primary'])) {
                $menu = $locations['primary'];
                if ((isset($_GET['page']) && $_GET['page'] == 'one-page')) {
                    $menu = 21;
                }
                if (get_option('anps_global_menu_walker', '1') == '1') {
                    $walker = new anps_menu_walker();
                }
            }


            if (!empty(wp_get_nav_menu_items($menu)) && count(wp_get_nav_menu_items($menu)) === 0) {
                echo '<div class="menu-notice">' . esc_html__('No menu items added. Add them under Appearance - Menus.', 'industrial') . '</div>';
            } else if ($menu === '') {
                echo '<div class="menu-notice">' . esc_html__('Primary menu not selected. Go to Appearance - Menus and select a menu.', 'industrial') . '</div>';
            } else {
                wp_nav_menu(array(
                    'container' => false,
                    'menu_class' => 'main-menu',
                    'menu_id' => 'main-menu',
                    'echo' => true,
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'items_wrap' => _anps_search_menu_option(),
                    'link_after' => '',
                    'depth' => 0,
                    'walker' => $walker,
                    'menu' => $menu
                ));
            }
            ?>
        </div>
        <button class="burger pull-right"><span class="burger-top"></span><span class="burger-middle"></span><span class="burger-bottom"></span></button>
    <?php
    }
}
?>