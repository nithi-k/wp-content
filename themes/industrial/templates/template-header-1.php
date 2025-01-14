<header class="site-header<?php echo esc_attr(anps_is_transparent()); ?><?php echo esc_attr(anps_is_bellowmenu()); ?><?php echo esc_attr(anps_menu_is_centered()); ?>">
    <div class="container">
        <div class="header-wrap clearfix row">
            <!-- Logo Section -->
            <div class="logo pull-left">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                    echo wp_kses(anps_logo(), array(
                        'span' => array('class' => array(), 'style' => array()),
                        'img' => array('class' => array(), 'src' => array(), 'style' => array(), 'alt' => array())
                    ));
                    ?>
                </a>
            </div>

            <!-- Main Navigation -->
            <nav class="site-navigation pull-right">
                <?php anps_get_menu(); ?>
            </nav>
        </div>
    </div>
</header>
