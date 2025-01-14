<header class="site-header site-header-logo-center<?php echo esc_attr(anps_is_transparent()); ?><?php echo esc_attr(anps_is_bellowmenu()); ?>">
    <div class="container">
        <div class="header-wrap clearfix row">
            
                <?php
echo "<!-- Using template-header-4.php -->";  // Change X to the file number (1, 2, 3, etc.)
error_log("Header template: template-header-4.php");
?>
            <!-- logo -->

            <!-- /logo -->
            <!-- Main menu & above navigation -->
            <?php anps_menu_logo_center(); ?>
            <!-- END Main menu and above navigation -->
        </div>
    </div><!-- /container -->
</header>
