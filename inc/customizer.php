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