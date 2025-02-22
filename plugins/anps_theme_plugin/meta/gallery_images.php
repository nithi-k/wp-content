<?php

class Gallery_images {
    function __construct() {
        add_action( 'add_meta_boxes', array(&$this,'image_meta' ));
        add_action('save_post', array(&$this,'gallery_save_postdata'));
    }
    /* Post/Page image gallery */
    function gallery_images_box() {
        global $post;
        ?>
        <div id="product_images_container">
            <ul class="product_images">
                <?php
                    if ( metadata_exists( 'post', $post->ID, 'gallery_images' ) ) {
                        $product_image_gallery = get_post_meta( $post->ID, 'gallery_images', true );
                    } else {
                        // Backwards compat
                        $attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_exclude_image&meta_value=0' );
                        $attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
                        $product_image_gallery = implode( ',', $attachment_ids );
                    }

                    $attachments = array_filter( explode( ',', $product_image_gallery ) );

                    if ( $attachments )
                        foreach ( $attachments as $attachment_id ) {
                            echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
                                ' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
                                <ul class="actions">
                                    <li><a href="#" class="delete" title="' . esc_html__( 'Delete image', 'industrial' ) . '">' . esc_html__( 'Delete', 'industrial' ) . '</a></li>
                                </ul>
                            </li>';
                        }
                ?>
            </ul>

            <input type="hidden" id="product_image_gallery" name="product_image_gallery" value="<?php echo esc_attr( $product_image_gallery ); ?>" />

        </div>
        <p class="add_product_images hide-if-no-js">
            <a href="#"><?php esc_html_e( 'Add gallery images', 'industrial' ); ?></a>
        </p>
        <script>
            jQuery(function ($) {
                // Uploading files
                var product_gallery_frame;
                var $image_gallery_ids = $('#product_image_gallery');
                var $product_images = $('#product_images_container ul.product_images');

                $('.add_product_images').on( 'click', 'a', function( event ) {

                    var $el = $(this);
                    var attachment_ids = $image_gallery_ids.val();

                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if ( product_gallery_frame ) {
                        product_gallery_frame.open();
                        return;
                    }

                    // Create the media frame.
                    product_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                        // Set the title of the modal.
                        title: '<?php esc_html_e( 'Add Images to Gallery', 'industrial' ); ?>',
                        button: {
                            text: '<?php esc_html_e( 'Add to gallery', 'industrial' ); ?>',
                        },
                        multiple: true
                    });

                    // When an image is selected, run a callback.
                    product_gallery_frame.on( 'select', function() {

                        var selection = product_gallery_frame.state().get('selection');

                        selection.each( function( attachment ) {

                            attachment = attachment.toJSON();

                            if ( attachment.id ) {
                                attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                                $product_images.append('\
                                    <li class="image" data-attachment_id="' + attachment.id + '"">\
                                        <img src="' + attachment.url + '" />\
                                        <ul class="actions">\
                                            <li><a href="#" class="delete" title="<?php esc_html_e( 'Delete image', 'industrial' ); ?>"><?php esc_html_e( 'Delete', 'industrial' ); ?></a></li>\
                                        </ul>\
                                    </li>');
                            }

                        } );

                        $image_gallery_ids.val( attachment_ids );
                    });

                    // Finally, open the modal.
                    product_gallery_frame.open();
                });

                // Image ordering
                $product_images.sortable({
                    items: 'li.image',
                    cursor: 'move',
                    scrollSensitivity:40,
                    forcePlaceholderSize: true,
                    forceHelperSize: false,
                    helper: 'clone',
                    opacity: 0.65,
                    placeholder: 'wc-metabox-sortable-placeholder',
                    start:function(event,ui){
                        ui.item.css('background-color','#f6f6f6');
                    },
                    stop:function(event,ui){
                        ui.item.removeAttr('style');
                    },
                    update: function(event, ui) {
                        var attachment_ids = '';

                        $('#product_images_container ul li.image').css('cursor','default').each(function() {
                            var attachment_id = $(this).attr( 'data-attachment_id' );
                            attachment_ids = attachment_ids + attachment_id + ',';
                        });

                        $image_gallery_ids.val( attachment_ids );
                    }
                });

                // Remove images
                $('#product_images_container').on( 'click', 'a.delete', function() {

                    $(this).closest('li.image').remove();

                    var attachment_ids = '';

                    $('#product_images_container ul li.image').css('cursor','default').each(function() {
                        if(attachment_ids !== '') {
                            attachment_ids += ',';
                        }

                        attachment_ids += $(this).attr('data-attachment_id');
                    });

                    $image_gallery_ids.val( attachment_ids );

                    return false;
                } );

            });
        </script>
        <?php
    }

    function image_meta() {
        // post & page
        $page = array("post", "portfolio");
        foreach($page as $item) {
            add_meta_box( 'gallery_images', esc_html__( 'Gallery images', 'industrial' ), array(&$this,'gallery_images_box'), $item,'side');
        }
    }

    function gallery_save_postdata($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (empty($_POST)) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $pid = isset($_POST['post_ID']) ? intval(sanitize_text_field($_POST['post_ID'])) : false;
        if (!$pid) {
            if (!$post_id) return;
            $pid = $post_id;
        }

        $product_image_gallery = isset($_POST['product_image_gallery'])
            ? sanitize_text_field($_POST['product_image_gallery'])
            : '';

        update_post_meta($pid, 'gallery_images', $product_image_gallery);
    }
}
new Gallery_images();
