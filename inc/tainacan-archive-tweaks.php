<?php

/** Ajustes na página de lista de itens */
function iphan_blocksy_tainacan_item_archive_top () {

    if ( !iphan_blocksy_is_tainacan_item_archive() ) 
        return;
    
    $collection = tainacan_get_collection();
    
    if ( ! $collection )
        return;

    $collection_header_image_id = $collection->get_header_image_id();
    $collection_header_image_url = $collection_header_image_id ? wp_get_attachment_image_url( $collection_header_image_id, 'full' ) : '';

    if ( $collection_header_image_url ) {
        echo '<div class="tainacan-collection-header-image">';
        echo '<img height="400" src="' . esc_url( $collection_header_image_url ) . '" alt="' . esc_attr( $collection->get_name() ) . '">';
        echo '</div>';
    }
}
add_action('blocksy:content:top' ,'iphan_blocksy_tainacan_item_archive_top', 10, 1);