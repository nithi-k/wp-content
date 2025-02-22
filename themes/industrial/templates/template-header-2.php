<!-- VERTICAL MENU HEADER TYPE -->
<header class="site-header vertical">
    
        <?php
echo "<!-- Using template-header-2.php -->";  // Change X to the file number (1, 2, 3, etc.)
error_log("Header template: template-header-2.php");
?>
    <div class="container">
        <div class="header-wrap clearfix">
            <!-- logo -->
            <div class="logo relative">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        echo wp_kses(anps_logo(), array(
                            'span' => array(
                                'class' => array(),
                                'style' => array(),
                            ),
                            'img' => array(
                                'class' => array(),
                                'src' => array(),
                                'style' => array(),
                                'alt' => array(),
                            )
                        ));
                    ?>
                </a>
            </div>
            <!-- /logo -->
            <!-- Main menu & above nabigation -->
            <nav class="site-navigation">
                <?php anps_get_menu(); ?>
            </nav>
            <!-- END Main menu and above navigation -->
        </div>
    </div>
</header>
