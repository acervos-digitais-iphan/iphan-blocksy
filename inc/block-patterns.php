<?php

/**
 * Registra categorias dos padrões de blocos e blocos reutilizáveis
 */
function iphan_blocksy_register_block_patterns() {

    /**
     * Cria categoria de padrões de blocos 'Iphan'
     */
    if ( function_exists( 'register_block_pattern_category' ) ) {
        register_block_pattern_category(
            'iphan-blocksy',
            array( 'label' => 'Iphan' )
        );
    }
    
    /**
     * Registra blocos reutilizáveis
     */
    iphan_blocksy_create_reusable_blocks( 'Linha 1 de rodapé do Iphan', 'rodape-1', '<!-- wp:pattern {"slug":"iphan-blocksy/rodape-1"} /-->');
    iphan_blocksy_create_reusable_blocks( 'Linha 2 de rodapé do Iphan', 'rodape-2', '<!-- wp:pattern {"slug":"iphan-blocksy/rodape-2"} /-->');
    iphan_blocksy_create_reusable_blocks( 'Linha 3 de rodapé do Iphan', 'rodape-3', '<!-- wp:pattern {"slug":"iphan-blocksy/rodape-3"} /-->');
}
add_action( 'init', 'iphan_blocksy_register_block_patterns' );

/**
 * Função auxiliar para criar blocos reutilizáveis
 */
function iphan_blocksy_create_reusable_blocks($title, $slug, $content) {

    // Verifica se já existe para evitar duplicação
    $existing_block = get_posts( array(
        'name'        => $slug,
        'post_type'   => 'wp_block',
        'numberposts' => 1,
    ) );
        
    if ( $existing_block ) {
        return; // Já existe, nada a fazer
    }

    wp_insert_post( array(
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'wp_block',
    ) );
}
