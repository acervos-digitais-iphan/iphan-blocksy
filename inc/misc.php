<?php

/**
 * Adiciona suporte a SVG no WordPress
 *
 * @param array $file_types Tipos de arquivo permitidos
 * @return array Tipos de arquivo permitidos com SVG adicionado
 */
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

/**
 * Remove widgets desnecessárias do painel do WordPress
 *
 * @return void
 */
function remove_dashboard_widgets() {
    remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'themeisle', 'dashboard', 'normal' );
    remove_meta_box( 'themeisle', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );