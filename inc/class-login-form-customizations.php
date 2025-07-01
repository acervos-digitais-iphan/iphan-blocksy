<?php
/**
 * Esta classe deve ser usada quando se deseja customizar a tela de login do WordPress
 */
class IphanBlocksyLoginFormCustomizations {

    /**
     * Usa o trait Singleton para garantir que a classe seja instanciada apenas uma vez
     */

	use Iphan_Blocksy\Singleton;

    /**
     * Inicializa a classe com as actions e filters necessários
     */
    protected function init() {
        add_action( 'login_enqueue_scripts', array( $this, 'iphan_blocksy_login_form_enqueue_scripts' ) );
        add_filter( 'login_headerurl', array( $this, 'iphan_blocksy_login_form_logo_url' ) );
        add_filter( 'login_headertext', array( $this, 'iphan_blocksy_login_form_logo_url_title' ) );
    }

    /**
     * Customizações na tela de login do WordPress
     */
    function iphan_blocksy_login_form_enqueue_scripts() {
        wp_enqueue_style( 'iphan-blocksy-login-form-wp', get_stylesheet_directory_uri() . '/assets/css/login-form-wp.css' );

        if ( defined('MO_OAUTH_PLUGIN_BASENAME') )
            wp_enqueue_style( 'iphan-blocksy-login-form-govbr', get_stylesheet_directory_uri() . '/assets/css/login-form-govbr.css' );
    }


    /**
     * Customiza o logo da tela de login do WordPress
     */
    function iphan_blocksy_login_form_logo_url() {
        return home_url();
    }


    /**
     * Customiza o título do logo da tela de login do WordPress
     */
    function iphan_blocksy_login_form_logo_url_title() {
        return 'Iphan - Instituto do Patrimônio Histórico e Artístico Nacional';
    }
}

IphanBlocksyLoginFormCustomizations::get_instance();