<?php get_header(); ?>
<?php if (function_exists('anps_left_sidebar')) {
    anps_left_sidebar();
} ?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    $num_of_sidebars = 0;
    if (function_exists('anps_num_sidebars')) {
        $num_of_sidebars = anps_num_sidebars();
    }
    $class = $num_of_sidebars > 0
      ? 'page-content col-md-' . 12 - $num_of_sidebars * 3
      : 'col-md-12';
    ?>
    <div class="<?php echo esc_attr($class); ?>">
        <a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>"><?php echo wp_get_attachment_image(get_the_ID(), 'full'); ?></a>
    </div>
<?php endwhile; // end of the loop.
?>
<?php if (function_exists('anps_right_sidebar')) {
    anps_right_sidebar();
} ?>
<?php get_footer();
