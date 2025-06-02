<?php

/**
 * Esta classe contém a lógica para adicionar um campo de ícone e de área do template para as seções de metadados 
 */
class IphanBlocksyPhosphorIcons {

	use Iphan_Blocksy\Singleton;
    private $available_icons = array();

    /**
	 * Inicializa a classe com as actions e filters necessários
	 */
	protected function init() {
        add_action( 'enqueue_block_editor_assets', array( $this, 'iphan_blocksy_register_custom_icons') );
        $this->available_icons = require_once( get_stylesheet_directory() . '/inc/available-phosphor-icons.php' );
    }

    /**
     * Lista de ícones disponíveis no Phosphor Icons
     */
    function get_available_icons() {
        return $this->available_icons;
    }

    /**
     * Registra o script que adiciona os ícones personalizados do Phosphor Icons no editor de blocos
     * usando um filtro do plugin The Icon Block
     */
    function iphan_blocksy_register_custom_icons() {
        wp_enqueue_script(
            'iphan-blocksy-register-custom-icons',
            get_theme_file_uri( '/assets/js/register-custom-icons.js' ),
            array( 'wp-i18n', 'wp-hooks', 'wp-dom' ),
            wp_get_theme()->get( 'Version' ),
            true // Importante, o filtro não deve ser chamado muito cedo.
        );
    }
}

IphanBlocksyPhosphorIcons::get_instance();