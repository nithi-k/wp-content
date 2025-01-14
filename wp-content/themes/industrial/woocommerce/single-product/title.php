<?php

/**
 * Single Product title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

?>
<h1 itemprop="name" class="product-title title text-uppercase"><?php echo esc_html(get_the_title()); ?></h1>