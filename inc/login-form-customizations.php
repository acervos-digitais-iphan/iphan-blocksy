<?php

/**
 * Customizações na tela de login do WordPress
 */
function iphan_blocksy_login_form_enqueue_scripts() {
    wp_enqueue_style( 'iphan-blocksy-login-form-wp', get_stylesheet_directory_uri() . '/assets/css/login-form-wp.css' );

    if ( defined('MO_OAUTH_PLUGIN_BASENAME') )
        wp_enqueue_style( 'iphan-blocksy-login-form-govbr', get_stylesheet_directory_uri() . '/assets/css/login-form-govbr.css' );
}
add_action( 'login_enqueue_scripts', 'iphan_blocksy_login_form_enqueue_scripts' );

/**
 * Customiza o logo da tela de login do WordPress
 */
function iphan_blocksy_login_form_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'iphan_blocksy_login_form_logo_url' );

/**
 * Customiza o título do logo da tela de login do WordPress
 */
function iphan_blocksy_login_form_logo_url_title() {
    return 'Iphan - Instituto do Patrimônio Histórico e Artístico Nacional';
}
add_filter( 'login_headertext', 'iphan_blocksy_login_form_logo_url_title' );