<?php

/**
 * Função auxiliar para obter ID de bloco por slug
 */
function iphan_blocksy_get_block_id_by_slug( $slug ) {
    $block = get_posts( array(
        'name'        => $slug,
        'post_type'   => 'wp_block',
        'numberposts' => 1,
    ) );

    return $block ? $block[0]->ID : null;
}

/**
 * Sobrescreve a função do tema pai que cria o rodapé para usar um Padrão de Blocos
 */
function iphan_blocksy_render_footer_widgets_from_block_pattern ($index) {
    if ( $index === 'ct-footer-sidebar-1' )
        echo do_blocks( '<!-- wp:block {"ref":' . iphan_blocksy_get_block_id_by_slug( 'rodape-1' ) . '} /-->' );
    else if ( $index === 'ct-footer-sidebar-2' )
        echo do_blocks( '<!-- wp:block {"ref":' . iphan_blocksy_get_block_id_by_slug( 'rodape-2' ) . '} /-->' );
    else if ( $index === 'ct-footer-sidebar-3' )
        echo do_blocks( '<!-- wp:block {"ref":' . iphan_blocksy_get_block_id_by_slug( 'rodape-3' ) . '} /-->' );
    
}
add_action( 'dynamic_sidebar_before', 'iphan_blocksy_render_footer_widgets_from_block_pattern' );