<?php
$meta = get_post_meta(get_the_ID());
?>

<?php
while (have_posts()) : the_post(); ?>
    <?php if (function_exists('anps_left_sidebar')) {
        anps_left_sidebar();
    } ?>

    <?php anps_the_content(); ?>

    <?php if (function_exists('anps_right_sidebar')) {
        anps_right_sidebar();
    } ?>
<?php endwhile; // end of the loop. 