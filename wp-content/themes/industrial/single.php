<?php

get_header();

if (function_exists('anps_left_sidebar')) {
    anps_left_sidebar();
}

while (have_posts()) :
    the_post();
    $num_of_sidebars = function_exists('anps_num_sidebars') ? anps_num_sidebars() : 0;
    $class = 'col-md-' . (12 - $num_of_sidebars * 3);
    if ($num_of_sidebars > 0) {
        $class .= ' page-content';
    }
    ?>
    <div class="<?php echo esc_attr($class); ?>">
        <?php
            get_template_part('templates/content-single', get_post_format());
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        ?>
    </div>
    <?php
endwhile;

if (function_exists('anps_right_sidebar')) {
    anps_right_sidebar();
}

get_footer();
