<?php

/**
 * Enfileira os scripts e estilos do tema filho e tema pai
 */
function iphan_blocksy_enqueue_scripts () {
	$parent_theme_version = wp_get_theme( 'blocksy' )->get( 'Version' );
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), $parent_theme_version );

	$child_theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'iphan-blocksy-style', get_stylesheet_uri(), array( 'parent-style' ), $child_theme_version );

	// Enfileira os estilos e scripts da pagina de item único do Tainacan
	if ( iphan_blocksy_is_tainacan_item_single() ) {
		wp_enqueue_style( 'iphan-tainacan-single-style', get_stylesheet_directory_uri() . '/assets/css/iphan-tainacan-single.css', array(), $child_theme_version );
		//wp_enqueue_script( 'iphan-tainacan-single-script', get_stylesheet_directory_uri() . '/assets/js/iphan-tainacan-single.js', array(), $child_theme_version, true );
	}

	// Enfileira os estilos e scripts da pagina de lista de itens do Tainacan
	if ( iphan_blocksy_is_tainacan_item_archive() ) {
		wp_enqueue_style( 'iphan-tainacan-archive-style', get_stylesheet_directory_uri() . '/assets/css/iphan-tainacan-archive.css', array(), $child_theme_version );
		//wp_enqueue_script( 'iphan-tainacan-archive-script', get_stylesheet_directory_uri() . '/assets/js/iphan-tainacan-archive.js', array(), $child_theme_version, true );
	}

	// Enfileira a fonte de ícones Phosphor
	wp_enqueue_style( 'phosphor-icons', 'https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.min.css' );

	// Estilos e scripts para o modal de login do Blocksy com o plugin de login único do Gov.br
	if ( defined('MO_OAUTH_PLUGIN_BASENAME') ) 
        wp_enqueue_style( 'iphan-blocksy-login-form-govbr', get_stylesheet_directory_uri() . '/assets/css/login-form-govbr.css', array(), $child_theme_version );
    
	// Enfileira fonte de ícones do Tainacan. No plugin de compatibilidade entre Tainacan e o tema, 
	// essas fontes são opcionais, mas como usamos em carrosséis queremos forçar este uso.
	wp_enqueue_style( 'tainacan-icons' );
};
add_action( 'wp_enqueue_scripts', 'iphan_blocksy_enqueue_scripts' );

/** 
 * Registra estilo do lado admin
 */
function iphan_blocksy_admin_enqueue_styles() {
	$child_theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'iphan-blocksy-admin-style', get_stylesheet_directory_uri() . '/assets/css/admin.css', array(), $child_theme_version );
	wp_enqueue_style( 'phosphor-icons', 'https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.min.css' );
}
add_action( 'admin_enqueue_scripts', 'iphan_blocksy_admin_enqueue_styles' );

/**
 * Chama as funções que farão o enqueue de css global do
 * Blocksy a partir de configurações extras to menu Personalizar
 */
add_action('blocksy:global-dynamic-css:enqueue:inline', function ($args) {
	blocksy_theme_get_dynamic_styles(array_merge([
		'path' =>  get_theme_file_path('/inc/global.php'),
		'chunk' => 'global',
		'forced_call' => true
	], $args));
}, 10, 1);