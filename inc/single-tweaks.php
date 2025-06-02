<?php

/**
 * Sobrescreve o conteúdo da single de itens do Tainacan
 */
function iphan_blocksy_tainacan_single_page_content( $content ) {
		
	if ( !iphan_blocksy_is_tainacan_item_single() ) 
		return $content;
	
	ob_start();
	include( get_stylesheet_directory() . '/tainacan/iphan-tainacan-single.php' );
	$new_content = ob_get_contents();
	ob_end_clean();

	return $new_content;
}
add_filter( 'the_content', 'iphan_blocksy_tainacan_single_page_content', 12, 1);
