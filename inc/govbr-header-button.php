<?php

/**
 * Este arquivo contém a classe que insere o botão com links do gov.br no cabeçalho
 */

/**
 * Registra uma nova localização de menu para que os links institucionais possam ser 
 * gerenciados através do painel de menus do WordPress
 */
function iphan_blocksy_register_nav_menus() {
    register_nav_menus(array(
        'iphan_blocksy_govbr_menu' => 'Links Oficiais do Gov.br',
    ));
}
add_action('after_setup_theme', 'iphan_blocksy_register_nav_menus');

/**
 * Adiciona o HTML com o botão e seus links
 */
function iphan_blocksy_govbr_header_button() {

    // Obtém os links institucionais a partir de um menu do WordPress
    $menu_name = 'iphan_blocksy_govbr_menu';
    $locations = get_nav_menu_locations();
    $menu_id = isset($locations[$menu_name]) ? $locations[$menu_name] : null;

    $institutional_links = array();

    // Se não houver menu, não exibe nada
    if ( !$menu_id )
        return; 

    $menu_items = wp_get_nav_menu_items($menu_id);

    if ( $menu_items ) {
        foreach ( $menu_items as $menu_item ) {
            $institutional_links[] = array(
                'title' => $menu_item->title,
                'url' => $menu_item->url
            );
        }
    }

    ?>
    <div 
            class="iphan-blocksy-govbr-institutional"
            role="region"
            aria-label="Links institucionais do governo">
        <button 
                class="iphan-blocksy-govbr-button" 
                aria-expanded="false" 
                aria-haspopup="true" 
                aria-controls="iphan-blocksy-govbr-dropdown"
                id="iphan-blocksy-govbr-trigger">
            <img 
                    src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo_texto.svg' ); ?>" 
                    alt="Logo do Iphan" 
                    class="iphan-blocksy-govbr-logo" />
            <span class="screen-reader-text">IPHAN</span>
        </button>
        
        <div 
                class="iphan-blocksy-govbr-dropdown" 
                id="iphan-blocksy-govbr-dropdown" 
                role="menu" 
                aria-labelledby="iphan-blocksy-govbr-trigger">
            <img 
                    src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo_govbr.webp' ); ?>" 
                    alt="Logo do Iphan" 
                    class="iphan-blocksy-govbr-logo-govbr" />
            <ul class="iphan-blocksy-govbr-links" role="none">
                <?php foreach ($institutional_links as $link): ?>
                <li>
                    <a 
                            href="<?php echo esc_url($link['url']); ?>" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            role="menuitem">
                        <?php echo esc_html($link['title']); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php

}
add_action( 'blocksy:header:before', 'iphan_blocksy_govbr_header_button' );

/**
 * Adiciona o botão ao menu offcanvas no final do cabeçalho móvel
 */
function iphan_blocksy_govbr_header_mobile_menu(){

     // Obtém os links institucionais a partir de um menu do WordPress
    $menu_name = 'iphan_blocksy_govbr_menu';
    $locations = get_nav_menu_locations();
    $menu_id = isset($locations[$menu_name]) ? $locations[$menu_name] : null;

    $institutional_links = array();

    // Se não houver menu, não exibe nada
    if ( !$menu_id )
        return; 

    $menu_items = wp_get_nav_menu_items($menu_id);

    if ( $menu_items ) {
        foreach ( $menu_items as $menu_item ) {
            $institutional_links[] = array(
                'title' => $menu_item->title,
                'url' => $menu_item->url
            );
        }
    }

    ?>
    <nav 
            class="mobile-menu menu-container has-submenu"
            data-id="mobile-menu">
        <hr>    
        <img 
                src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo_govbr.webp' ); ?>" 
                alt="Logo do Iphan" 
                class="iphan-blocksy-govbr-logo-govbr" />
        <ul>
            <?php foreach ($institutional_links as $link): ?>
            <li class="menu-item">
                <a 
                        href="<?php echo esc_url($link['url']); ?>" 
                        class="ct-menu-link"
                        target="_blank" 
                        style="font-weight: normal"
                        rel="noopener noreferrer">
                    <?php echo esc_html($link['title']); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php
}
add_action('blocksy:header:offcanvas:mobile:bottom', 'iphan_blocksy_govbr_header_mobile_menu' );

/**
 * Adiciona os estilos CSS do botão e do dropdown do Gov.br
 */
function iphan_blocksy_govbr_header_button_styles() {
    ?>
    <style>
    .iphan-blocksy-govbr-institutional {
        position: fixed;
        top: var(--wp-admin--admin-bar--height, 0px);
        left: 0px;
        z-index: 9999;
    }

    .iphan-blocksy-govbr-button {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--theme-palette-color-8);
        border: none;
        padding: 8px 12px;
        border-radius: 0 100em 100em 0;
        cursor: pointer;
        text-decoration: none;
        min-height: var(--header-height);
        min-width: calc( var(--header-height, 90px) + 60px );
        transition: background-color 0.2s ease, min-width 0.2s ease, min-height var(--header-sticky-animation-speed, 0.2s) cubic-bezier(0.455, 0.03, 0.515, 0.955);
    }
    [data-header*="sticky:shrink"] .iphan-blocksy-govbr-button {
        min-height: calc(var(--sticky-shrink) * var(--header-height, 90px) / 100);
    }
    .iphan-blocksy-govbr-button-placeholder {
        min-width: calc( var(--header-height, 90px) + 60px );
        opacity: 0;
    }

    .iphan-blocksy-govbr-institutional:hover .iphan-blocksy-govbr-button,
    .iphan-blocksy-govbr-institutional:focus .iphan-blocksy-govbr-button,
    .iphan-blocksy-govbr-institutional:focus-within .iphan-blocksy-govbr-button,
    .iphan-blocksy-govbr-institutional:hover .iphan-blocksy-govbr-button-placeholder,
    .iphan-blocksy-govbr-institutional:focus .iphan-blocksy-govbr-button-placeholder,
    .iphan-blocksy-govbr-institutional:focus-within .iphan-blocksy-govbr-button-placeholder {
        background: var(--theme-palette-color-7);
        min-width: calc( var(--header-height, 90px) + 190px );
    }

    .iphan-blocksy-govbr-button:focus {
        outline: 2px solid var(--theme-palette-color-2);
        outline-offset: 2px;
    }

    .iphan-blocksy-govbr-logo {
        height: 22px;
        flex-shrink: 0;
    }

    .iphan-blocksy-govbr-dropdown {
        position: absolute;
        top: 100%;
        right: auto;
        left: 0;
        background-color: var(--theme-palette-color-28);
        border-radius: 0 0 8px 0;
        padding: 0.75rem;
        min-width: calc( var(--header-height, 90px) + 150px );
        opacity: 0;
        visibility: hidden;
        transform: translateX(-40px);
        transition: opacity 0.2s ease, visibility 0.2s ease, transform 0.2s ease;
        z-index: 10000;
    }

    .iphan-blocksy-govbr-institutional:hover .iphan-blocksy-govbr-dropdown,
    .iphan-blocksy-govbr-institutional:focus-within .iphan-blocksy-govbr-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateX(0px);
    }

    .iphan-blocksy-govbr-logo-govbr {
        padding: 12px calc(12px * 1.5);
        width: 128px;
    }
    .iphan-blocksy-govbr-links {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .iphan-blocksy-govbr-links li {
        margin: 0;
        padding: 0;
    }

    .iphan-blocksy-govbr-links a {
        display: flex;
        align-items: center;
        padding: 12px calc(12px * 1.5);
        text-decoration: none;
        color: var(--theme-text-color);
    }

    .iphan-blocksy-govbr-links a:hover,
    .iphan-blocksy-govbr-links a:focus {
        color: var(--theme-link-hover-color);
    }

    .iphan-blocksy-govbr-links a:focus {
        outline: 2px solid var(--theme-palette-color-2);
        outline-offset: -2px;
    }

    /* Responsividade */
    @media (max-width: 1000px) {
        .iphan-blocksy-govbr-button {
            min-width: 110px;
            display: none;
            visibility: hidden;
        }
        .iphan-blocksy-govbr-logo-govbr { 
            padding-inline: 0;
        }
    }
    @media screen and (max-width: 600px) {
        .iphan-blocksy-govbr-button,
        .iphan-blocksy-govbr-button-placeholder {
            min-width: 80px;
        }
        .iphan-blocksy-govbr-logo {
            height: 18px;
        }
    }
    

    /* Melhorias de acessibilidade */
    @media (prefers-reduced-motion: reduce) {
        .iphan-blocksy-govbr-button,
        .iphan-blocksy-govbr-dropdown,
        .iphan-blocksy-govbr-links a {
            transition: none;
        }
    }

    /* Alto contraste */
    @media (prefers-contrast: high) {
        .iphan-blocksy-govbr-button {
            border: 2px solid white;
        }
        
        .iphan-blocksy-govbr-dropdown {
            border: 2px solid #333;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'iphan_blocksy_govbr_header_button_styles');

/**
 * Adiciona JavaScript mínimo para acessibilidade
 */
function iphan_blocksy_govbr_header_button_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const trigger = document.getElementById('iphan-blocksy-govbr-trigger');
        const dropdown = document.getElementById('iphan-blocksy-govbr-dropdown');
        
        if (!trigger || !dropdown) return;
        
        // Gerencia estados ARIA
        function toggleDropdown(show) {
            trigger.setAttribute('aria-expanded', show ? 'true' : 'false');
        }
        
        // Hover events
        trigger.parentElement.addEventListener('mouseenter', () => toggleDropdown(true));
        trigger.parentElement.addEventListener('mouseleave', () => toggleDropdown(false));
        
        // Keyboard navigation
        trigger.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
                toggleDropdown(!isExpanded);
            }
            
            if (e.key === 'Escape') {
                toggleDropdown(false);
                trigger.focus();
            }
        });
        
        // Focus management
        dropdown.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                toggleDropdown(false);
                trigger.focus();
            }
        });
        
        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!trigger.parentElement.contains(e.target)) {
                toggleDropdown(false);
            }
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'iphan_blocksy_govbr_header_button_script');
