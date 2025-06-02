<?php 
/**
 * Funções utilitárias do tema filho
 */
function iphan_blocksy_is_tainacan_item_single() {
    if ( method_exists( \Tainacan\Theme_Helper::get_instance(), 'is_post_type_a_collection' ) ) {
        $is_tainacan_item_single = \Tainacan\Theme_Helper::get_instance()->is_post_type_a_collection(get_post_type());
    } else {
        $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
        $is_tainacan_item_single = in_array(get_post_type(), $collections_post_types);
    }
    return $is_tainacan_item_single;
}