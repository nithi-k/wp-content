<?php
function anps_language_dropdown() {
    // Get the current language from URL or default to 'en'
    $current_lang = isset($_GET['lang']) ? sanitize_text_field($_GET['lang']) : 'en';

    // Define your language options with flags
    $languages = [
        'en' => ['name' => 'English', 'flag' => get_template_directory_uri() . '/anps-framework/assets/flags/en.png'],
        'th' => ['name' => 'ภาษาไทย', 'flag' => get_template_directory_uri() . '/anps-framework/assets/flags/th.png'],
        // Add more languages here if needed
    ];

    // Check if the current language exists in the list, fallback to English if not
    $current_language = $languages[$current_lang] ?? $languages['en'];

    ob_start(); // Start output buffering
    ?>

    <li class="menu-item menu-lang-dropdown">
        <a href="#" class="current-lang">
            <img src="<?php echo esc_url($current_language['flag']); ?>" alt="" style="width: 16px; height: 12px; margin-right: 5px;">
            <?php echo esc_html($current_language['name']); ?>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="sub-menu">
            <?php foreach ($languages as $key => $lang) : ?>
                <?php if ($key === $current_lang) continue; // Skip the current language ?>
                <li>
                    <a href="<?php echo esc_url(add_query_arg('lang', $key)); ?>">
                        <img src="<?php echo esc_url($lang['flag']); ?>" alt="" style="width: 16px; height: 12px; margin-right: 5px;">
                        <?php echo esc_html($lang['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </li>

    <?php
    return ob_get_clean(); // Return the buffered content
}
