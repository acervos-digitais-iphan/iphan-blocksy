<?php

/**
 * Adiciona opções do tema para o menu Personalizar.
 */
function iphan_blocksy_options_panel($options) {

    $iphan_blocksy_extra_options = [
        'title' => 'Configurações do Iphan',
        'container' => [ 'priority' => 8 ],
        'options' => [
            'iphan_blocksy_list_section_options' => [
                'type' => 'ct-options',
                'setting' => [ 'transport' => 'postMessage' ],
                'inner-options' => [
                    'iphan_blocksy_general_border_radius' => [
                        'label' => 'Raio das bordas do tema',
                        'type' => 'ct-spacing',
                        'value' => blocksy_spacing_value(),
                        'min' => 0,
                        'responsive' => true,
                        'sync' => true,
                    ],
                    'iphan_blocksy_item_tabs_background' => [
                        'label' => 'Cor imagem de fundo das abas de itens',
                        'type' => 'ct-background',
                        'design' => 'block:right',
                        'responsive' => true,
                        'divider' => 'top',
                        'setting' => [ 'transport' => 'postMessage' ],
                        'value' => blocksy_background_default_value([
                            'backgroundColor' => [
                                'default' => [
                                    'color' => 'var(--theme-palette-color-8)'
                                ],
                            ],
                        ]),
                        'sync' => true,
                    ],
                ]
            ],
        ]
    ];

    $options['iphan_blocksy_list'] = $iphan_blocksy_extra_options;

    return $options;
}
add_filter( 'blocksy_extensions_customizer_options', 'iphan_blocksy_options_panel', 10, 1 );

/** Adiciona opções em seções específicas das opções da página do item Tainacan */
function iphan_blocksy_custom_post_types_single_options( $options, $post_type, $post_type_object ) {

	if ( defined ('TAINACAN_VERSION') ) {

        if ( method_exists( \Tainacan\Theme_Helper::get_instance(), 'is_post_type_a_collection' ) ) {
            $is_collection = \Tainacan\Theme_Helper::get_instance()->is_post_type_a_collection($post_type);
        } else {
            $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
            $is_collection = in_array($post_type, $collections_post_types);
        }

        if ( $is_collection || $post_type == 'tnc_blocksy_item'  ) {
            if (
                isset( $options['options'] ) &&
                isset( $options['options'][$post_type . '_single_section_options'] ) &&
                isset( $options['options'][$post_type . '_single_section_options']['inner-options'] )
            ) {
                foreach ( $options['options'][$post_type . '_single_section_options']['inner-options'] as $key => $option ) {
                    if ( is_array($option) ) {
                        foreach ( $option as $sub_key => $sub_option ) {
                            if ( 
                                is_array($sub_option) &&
                                isset( $sub_option[$post_type . '_single_display_items_related_to_this'] ) &&
                                isset( $sub_option[$post_type . '_single_display_items_related_to_this']['inner-options'] )
                            ) {
                                $options['options']
                                    [$post_type . '_single_section_options']
                                    ['inner-options']
                                    [$key]
                                    [$sub_key]
                                    [$post_type . '_single_display_items_related_to_this']
                                    ['inner-options']
                                    [$post_type . '_single_iphan_blocksy_items_related_to_this_position']
                                    = [
                                        'label'   => 'Posição da seção de itens relacionados a este',
                                        'type'    => 'ct-radio',
                                        'value'   => 'bottom',
                                        'view'    => 'text',
                                        'design'  => 'block',
                                        'divider' => 'top',
                                        'choices' => [
                                            'top'    => 'Abaixo da galeria',
                                            'bottom' => 'Abaixo dos metadados',
                                        ],
                                        'sync'    => true,
                                    ];

                            }
                        }
                    }
                  
                }
            }
        }
    }
    
    return $options;
}
add_filter( 'blocksy:custom_post_types:single-options', 'iphan_blocksy_custom_post_types_single_options', 10, 3 );
		