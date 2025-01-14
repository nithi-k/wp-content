<?php if (!defined('ABSPATH')) {
    die();
} ?>
<?php get_header(); ?>

<?php if (function_exists('anps_left_sidebar')) {
    anps_left_sidebar();
} ?>
<?php
$num_of_sidebars = 0;
if (function_exists('anps_num_sidebars')) {
    $num_of_sidebars .= anps_num_sidebars();
}
$class = '';

if (isset($num_of_sidebars) && $num_of_sidebars > 0) {
    $class = 'page-content';
}
?>
<div class="<?php echo esc_attr($class); ?> col-md-<?php echo 12 - esc_attr($num_of_sidebars) * 3; ?>">
    <div class="row anps-blog">
        <?php $bloglayout = get_option('anps_blog_columns', 'col-md-12'); ?>
        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('templates/content-blog', $bloglayout); ?>

        <?php endwhile; // end of the loop. 
        ?>
    </div>
    <?php
    // Previous/next page navigation.
    the_posts_pagination(array(
        'prev_text' => '<i class="fa fa-angle-left"></i> ' . esc_html__('Previous ', 'industrial'),
        'next_text' => esc_html__('Next', 'industrial') . ' <i class="fa fa-angle-right"></i>',
    ));

    if (isset($num_of_sidebars) && $num_of_sidebars > 3) {
        wp_link_pages();
    }
    ?>
</div>
<?php if (function_exists('anps_right_sidebar')) {
    anps_right_sidebar();
} ?>

<?php get_footer();
