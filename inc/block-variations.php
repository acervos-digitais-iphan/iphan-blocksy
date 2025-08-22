<?php

/**
 * Registra variações de blocos para facilitar a pré-configuração de alguns blocos
 */
function iphan_blocksy_register_block_variations( $variations, $block_type ) {

    // Cria variações apenas para os seguintes blocos
    if (
        'core/image' !== $block_type->name &&
        'core/button' !== $block_type->name &&
        'blocksy/search' !== $block_type->name &&
        'tainacan/searchbar' !== $block_type->name 
    ) {
        return $variations;
    }

    if ( 'core/button' === $block_type->name ) {

        $variations[] = array(
            'name'        => 'left-side-button',
            'title'       => 'Botão animado à esquerda',
            'description' => 'Botão com animação à esquerda ao passar o mouse em cima do Iphan',
            'keywords'    => array( 'botão', 'iphan' ),
            'scope'       => array( 'inserter', 'block', 'transform' ),
            'isDefault'   => false,
            'isActive'    => array( 'className', 'style' ),
            'attributes'  => array(
                'className' => 'is-style-iphan-blocksy-left-side-button',
                'style' => array(
                    'border' => array(
                        'left' => array(
                            'color' => 'var(--theme-button-background-hover-color)',
                            'width' => '3px',
                            'style' => 'solid'
                        )
                    ),
                    'typography' => array(
                        'fontWeight' => 600
                    )
                )
            )
        );

        $variations[] = array(
            'name'        => 'right-side-button',
            'title'       => 'Botão animado à direita',
            'description' => 'Botão com animação à direita ao passar o mouse em cima do Iphan',
            'keywords'    => array( 'botão', 'iphan' ),
            'scope'       => array( 'inserter', 'block', 'transform' ),
            'isDefault'   => false,
            'isActive'    => array( 'className', 'style' ),
            'attributes'  => array(
                'className' => 'is-style-iphan-blocksy-right-side-button',
                'style' => array(
                    'border' => array(
                        'right' => array(
                            'color' => 'var(--theme-button-background-hover-color)',
                            'width' => '3px',
                            'style' => 'solid'
                        )
                    ),
                    'typography' => array(
                        'fontWeight' => 600
                    )
                )
            )
        );

    }

    if ( 'core/image' === $block_type->name ) {

        $variations[] = array(
            'name'        => 'image-captioned',
            'title'       => 'Imagem com legenda',
            'description' => 'Imagem com a legenda escondida em um ícone de informação para o Iphan',
            'keywords'    => array( 'imagem', 'legenda', 'iphan' ),
            'scope'       => array( 'inserter', 'block', 'transform' ),
            'isDefault'   => false,
            'isActive'    => array( 'className' ),
            'attributes'  => array(
                'className' => 'is-style-iphan-blocksy-image-captioned',
                'caption' => 'Legenda da imagem'
            )
        );

    }

    if ( 'blocksy/search' === $block_type->name ) {

        $variations[] = array(
            'name'        => 'search-bar',
            'title'       => 'Barra de pesquisa do Iphan',
            'description' => 'Barra de pesquisa personalizada do Iphan',
            'keywords'    => array( 'pesquisa', 'iphan' ),
            'scope'       => array( 'inserter', 'block', 'transform' ),
            'isDefault'   => true,
            'isActive'    => array( 'className' ),
            'attributes'  => array(
                'className' => 'is-style-iphan-blocksy-search',
                'style' => array(
                    'backgroundColor' => 'var(--theme-palette-color-29, #ede9e1)',
                    'color' => 'var(--theme-palette-color-6,#bcb1a2)',
                    'border' => array(
                        'radius' => '2.5em',
                    )
                ),
                'inputFontColor' => 'palette-color-8',
                'inputFontColorFocus' => 'palette-color-8',
                'inputIconColor' => 'palette-color-8',
                'inputIconColorFocus' => 'palette-color-8',
                'inputBorderColor' => 'palette-color-11',
                'inputBorderColorFocus' => 'palette-color-12',
                'inputBackgroundColor' => 'palette-color-11',
                'inputBackgroundColorFocus' => 'palette-color-9'
            )
        );

    }

    return $variations;
}
add_filter( 'get_block_type_variations', 'iphan_blocksy_register_block_variations', 10, 2 );