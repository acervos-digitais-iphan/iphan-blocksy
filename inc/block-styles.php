<?php

if ( function_exists('register_block_style') ) {
    /**
     * Registra estilos de blocos do tema
     *
     * @since 0.0.1
     *
     * @return void
     */
    function iphan_blocksy_register_block_styles() {

        register_block_style(
            'core/button',
            array(
                'name'  => 'iphan-blocksy-left-side-button',
                'label' =>  'Animação à esquerda',
                'is_default' => false,
                'inline_style' => '
                    .is-style-iphan-blocksy-left-side-button .wp-block-button__link {
                        overflow: hidden;
                        background-image: linear-gradient(to right, transparent 50%, var(--theme-button-background-hover-color) 50%);
                        background-size: 200% 100%;
                        background-position: 0 0;
                        transition: background-position 0.3s ease, background-color 0.3s ease;
                    }    
                    .is-style-iphan-blocksy-left-side-button .wp-block-button__link:hover {
                        background-position: -100% 0;
                    }
                '
            )
        );

        register_block_style(
            'core/button',
            array(
                'name'  => 'iphan-blocksy-right-side-button',
                'label' =>  'Animação à direita',
                'is_default' => false,
                'inline_style' => '
                    .is-style-iphan-blocksy-right-side-button .wp-block-button__link {
                        overflow: hidden;
                        background-image: linear-gradient(to left, var(--theme-button-background-hover-color) 50%, transparent 50%);
                        background-size: 200% 100%;
                        background-position: 0 0;
                        transition: background-position 0.3s, ease background-color 0.3s ease;
                    }    
                    .is-style-iphan-blocksy-right-side-button .wp-block-button__link:hover {
                        background-position: 100%;
                    }
                '            
            )
        );

        register_block_style(
            'core/image',
            array(
                'name'  => 'iphan-blocksy-image-captioned',
                'label' =>  'Legenda flutuante',
                'is_default' => false,
                'inline_style' => '
                    .is-style-iphan-blocksy-image-captioned {
                        position: relative;
                    }
                    .is-style-iphan-blocksy-image-captioned figcaption {
                        position: absolute;
                        bottom: 1rem;
                        left: 1rem;
                        background-color: #F6F4F34D;
                        color: black;
                        padding: 0.625rem 0.875rem;
                        margin: 0;
                        border-radius: 0px 10px 10px 0px;
                        border-left: 3px solid white;
                        font-size: 0 !important;
                        overflow: hidden;
                        display: inline-block;
                        max-height: 2.875rem;
                        min-width: 2.25rem;
                        max-width: 2.875rem;
                        transition: max-width 0.4s ease, background-color 0.6s ease;
                    }
                    .is-style-iphan-blocksy-image-captioned figcaption::before {
                        font-size: 1.25rem;
                        font-weight: bold;
                        line-height: 1.75rem;
                        content: "i";
                        color: white;
                    }
                    .is-style-iphan-blocksy-image-captioned figcaption:hover,
                    .is-style-iphan-blocksy-image-captioned figcaption:focus,
                    .is-style-iphan-blocksy-image-captioned figcaption:focus-within {
                        font-size: 1rem !important;
                        max-width: 100%;
                        background-color: #F6F4F3B3;
                    }
                    .is-style-iphan-blocksy-image-captioned figcaption:hover::before,
                    .is-style-iphan-blocksy-image-captioned figcaption:focus::before,
                    .is-style-iphan-blocksy-image-captioned figcaption:focus-within::before {
                        font-size: 0;
                    }

                '
            )
        );

        register_block_style(
            'blocksy/search',
            array(
                'name'  => 'iphan-blocksy-search',
                'label' =>  'Busca do Iphan',
                'is_default' => false,
                'inline_style' => '
                    .is-style-iphan-blocksy-search .ct-search-form[data-form-controls="inside"] {
                        background: var(--theme-form-field-background-initial-color);
                        border-radius: var(--theme-form-field-border-radius);
                        transition: background-color .12s cubic-bezier(0.455, 0.03, 0.515, 0.955);
                        --theme-form-field-padding: 0 22px;
                    }
                    .is-style-iphan-blocksy-search .ct-search-form[data-form-controls="inside"]:has(input:focus) {
                        background-color: var(--theme-form-field-background-focus-color);
                    }
                    .is-style-iphan-blocksy-search .ct-search-form[data-form-controls="inside"] .ct-search-form-controls .wp-element-button {
                        border-radius: var(--theme-form-field-border-radius);
                        background-color: var(--theme-form-field-background-focus-color);
                        --theme-icon-size: 20px;
                    }
                '
            )
        );

        register_block_style(
            'tainacan/search-bar',
            array(
                'name'  => 'stylish',
                'label' =>  'Busca Tainacan do Iphan',
                'is_default' => false,
                'inline_style' => '
                    .wp-block-tainacan-search-bar.is-style-stylish input#tainacan-search-bar-block_input {
                        background-color: var(--theme-palette-color-11) !important;
                        color: var(--theme-palette-color-8);
                    }
                    .wp-block-tainacan-search-bar.is-style-stylish .tainacan-search-container #tainacan-search-bar-block button {
                        aspect-ratio: 1/1;
                        border-radius: 100em !important;
                        background-color: var(--theme-palette-color-10);
                        margin-left: 0.275rem;
                    }
                    .wp-block-tainacan-search-bar.is-style-stylish .tainacan-search-container #tainacan-search-bar-block button:hover {
                        background-color: var(--theme-palette-color-12) !important;
                    }
                    .wp-block-tainacan-search-bar.is-style-stylish #tainacan-search-bar-block:focus input#tainacan-search-bar-block_input,
                    .wp-block-tainacan-search-bar.is-style-stylish #tainacan-search-bar-block:active input#tainacan-search-bar-block_input,
                    .wp-block-tainacan-search-bar.is-style-stylish #tainacan-search-bar-block:hover input#tainacan-search-bar-block_input {
                        background-color: var(--theme-palette-color-10);
                    }
                    .wp-block-tainacan-search-bar.is-style-stylish #tainacan-search-bar-block button .icon svg {
                        fill: var(--theme-palette-color-8) !important;
                    }
                '
            )
        );

        register_block_style(
            'tainacan/dynamic-items-list',
            array(
                'name'  => 'iphan-blocksy-colorful',
                'label' =>  'Cores do Iphan',
                'is_default' => false,
                'inline_style' => '
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid {
                        gap: 1rem !important;
                    }
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item {
                        background-color: var(--theme-palette-color-21);
                        color: var(--theme-palette-color-8);
                        box-shadow: 0 0 0 0 var(--theme-palette-color-21);
                        transition: background-color 0.2s ease, box-shadow 0.2s ease;
                    }
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item:hover,
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item:focus {
                        background-color: var(--theme-palette-color-18);
                        box-shadow: 0 0 0 3px var(--theme-palette-color-18);
                    }
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item a > .parent {
                        position: relative;
                    }
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item a > .parent::before {
                        content: "";
                        width: 16px;
                        height: 16px;
                        position: absolute;
                        transform: scaleY(1.25) rotate(245deg);
                        bottom: -4px;
                        left: calc(50% - 8px);
                        transition: background-color 0.2s ease;
                        z-index: 1;
                        border-radius: 100em;
                        background-image: conic-gradient(at 49.5% 50%, transparent 135deg, transparent 225deg, var(--theme-palette-color-22), var(--theme-palette-color-22) 135deg);
                    }
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item a:hover > .parent::before,
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item a:focus > .parent::before {
                        background-image: conic-gradient(at 49.5% 50%, transparent 135deg, transparent 225deg, var(--theme-palette-color-19), var(--theme-palette-color-19) 135deg);
                    }
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item a > .parent::after {
                        content: "";
                        position: absolute;
                        top: 0;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        width: 100%;
                        he: 1;
                        heit: ;
                        height: 100%;
                        box-shadow: 0 0 0 0 rgba(0,0,0,0.35);
                        transition: box-shadow 0.2s ease;
                    }
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item:hover a > .parent::after,
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item:focus a > .parent::after {
                        box-shadow: 0 -16px 20px 8px rgba(0,0,0,0.35) inset;
                    }
                    .wp-block-tainacan-dynamic-items-list.is-style-iphan-blocksy-colorful .items-layout-grid .item-list-item a > span {
                        padding: 0 1em;
                        color: var(--theme-palette-color-8);
                        font-weight: normal;
                    }
                '
            )
        );

    }
    add_action('init', 'iphan_blocksy_register_block_styles');
}
