<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');
/* Save form */
if(isset($_GET['save_fonts'])) {
    $anps_style->anps_save_fonts();
}
/* get all fonts */
$fonts = $anps_style->all_fonts();
?>

<form action="themes.php?page=theme_options&sub_page=typography&save_fonts" method="post">

    <div class="content-inner">
        <div class="row" id="anps_predefined_colors">
            <div class="col-md-12">
                <h3><i class="fa fa-text-height"></i><?php esc_html_e('Font Family', 'industrial'); ?></h3>
                <h4><?php esc_html_e('Custom font styles', 'industrial'); ?></h4>
            </div>

            <!-- Font type 1 -->
            <div class="col-md-4 col-sm-6">
                <label for="font_type_1"><?php esc_html_e('Font type 1', 'industrial'); ?></label>
                <select name="font_type_1" id="font_type_1">
                <?php foreach ($fonts as $name => $value) : ?>
                    <optgroup label="<?php echo esc_attr($name); ?>">
                    <?php foreach ($value as $font) :
                        $selected = $font['value'] === get_option('font_type_1', 'Montserrat'); ?>
                        <option
                            value="<?php echo esc_attr("{$font['value']}|{$name}"); ?>"
                            <?php if ($selected) : ?>selected<?php endif; ?>
                        ><?php echo esc_attr($font['name']); ?></option>
                    <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
                </select>
            </div>

            <!-- Font type 2 -->
            <div class="col-md-4 col-sm-6">
                <label for="font_type_2"><?php esc_html_e('Font type 2', 'industrial'); ?></label>
                <select name="font_type_2" id="font_type_2">
                <?php foreach ($fonts as $name => $value) : ?>
                    <optgroup label="<?php echo esc_attr($name); ?>">
                    <?php foreach ($value as $font) :
                        $selected = $font['value'] === get_option('font_type_2', 'PT+Sans'); ?>
                        <option
                            value="<?php echo esc_attr("{$font['value']}|{$name}"); ?>"
                            <?php if ($selected) : ?>selected<?php endif; ?>
                        ><?php echo esc_attr($font['name']); ?></option>
                    <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
                </select>
            </div>

            <!-- Navigation font type -->
            <div class="col-md-4 col-sm-6">
                <label for="font_type_navigation"><?php esc_html_e('Navigation font type', 'industrial'); ?></label>
                <select name="font_type_navigation" id="font_type_navigation">
                <?php foreach ($fonts as $name => $value) : ?>
                    <optgroup label="<?php echo esc_attr($name); ?>">
                    <?php foreach ($value as $font) :
                        $selected = $font['value'] === get_option('font_type_navigation', 'Montserrat'); ?>
                        <option
                            value="<?php echo esc_attr("{$font['value']}|{$name}"); ?>"
                            <?php if ($selected) : ?>selected<?php endif; ?>
                        ><?php echo esc_attr($font['name']); ?></option>
                    <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Font sizes -->
        <h3><i class="fa fa-text-height"></i><?php esc_html_e('Font Size', 'industrial'); ?></h3>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_body_font_size', '14', esc_html__('Body font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_menu_font_size', '13', esc_html__('Menu font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_submenu_font_size', '12', esc_html__('Submenu font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_top_bar_font_size', '12', esc_html__('Top bar font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_h1_font_size', '31', esc_html__('Content heading 1 font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_h2_font_size', '24', esc_html__('Content heading 2 font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_h3_font_size', '21', esc_html__('Content heading 3 font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_h4_font_size', '18', esc_html__('Content heading 4 font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_h5_font_size', '16', esc_html__('Content heading 5 font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_page_heading_h1_font_size', '36', esc_html__('Page heading 1 font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_blog_heading_h1_font_size', '36', esc_html__('Single blog page heading 1 font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_footer_font_size', '14', esc_html__('Footer font size', 'industrial'), 'px'); ?>
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $anps_style->anps_create_number_option('anps_c_footer_font_size', '14', esc_html__('Copyright footer font size', 'industrial'), 'px'); ?>
            </div>
        </div>
    </div>

    <!-- Save form -->
    <?php $anps_style->anps_save_button(); ?>
</form>
