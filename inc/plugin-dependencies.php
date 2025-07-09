<?php
/**
 * Usa o TGM Plugin Activation para registrar plugins obrigatórios
 * e recomendados para o tema.
 */
require_once get_stylesheet_directory() . '/vendor/class-tgm-plugin-activation.php';

/**
 * Registra os plugins necessários para este tema.
 *
 * Neste exemplo, registramos cinco plugins:
 * - um incluído com a biblioteca TGMPA
 * - dois de uma fonte externa, sendo um de uma fonte arbitrária e outro de um repositório do GitHub
 * - dois do repositório .org, onde um demonstra o uso do argumento `is_callable`
 *
 * As variáveis passadas para a função `tgmpa()` devem ser:
 * - um array de arrays de plugins;
 * - opcionalmente, um array de configuração.
 * Se você não estiver alterando nada no array de configuração, pode remover o array e a variável da chamada da função: `tgmpa( $plugins );`.
 * Nesse caso, as configurações padrão do TGMPA serão usadas.
 *
 * Esta função é vinculada ao `tgmpa_register`, que é acionado na ação `init` do WordPress com prioridade 10.
 */
function iphan_blocksy_register_required_plugins() {
    /*
     * Array de arrays de plugins. As chaves obrigatórias são name e slug.
     * Se a fonte NÃO for do repositório .org, então a chave source também é obrigatória.
     */
    $plugins = array(

        // Este é um exemplo de como incluir um plugin de um repositório do GitHub no seu tema.
        // Isso presume que o código do plugin está na raiz do repositório do GitHub
        // e não em um subdiretório ('/src') do repositório.
        array(
            'name'      => 'Links em Grupos',
            'slug'      => 'enable-linked-groups',
            'source'    => 'https://github.com/ndiego/enable-linked-groups/archive/main.zip',
        ),

        // Este é um exemplo de como incluir um plugin do Repositório de Plugins do WordPress.
        array(
            'name'      => 'Tainacan',
            'slug'      => 'tainacan',
            'required'  => false,
        ),
        array(
            'name'      => 'Integração do tema Blocksy ao Tainacan',
            'slug'      => 'tainacan-blocksy',
            'required'  => false,
        ),
        array(
            'name'      => 'Blocksy Companion',
            'slug'      => 'blocksy-companion',
            'required'  => false,
        ),
        array(
            'name'      => 'Visibilidade de Blocos',
            'slug'      => 'block-visibility',
            'required'  => false,
        ),
        array(
            'name'      => 'Animações de Blocos',
            'slug'      => 'blocks-animation',
            'required'  => false,
        ),
        array(
            'name'      => 'Bloco de Ícone',
            'slug'      => 'icon-block',
            'required'  => false,
        ),
        array(
            'name'      => 'Bloco de Carrossel',
            'slug'      => 'carousel-block',
            'required'  => false,
        )

    );

    /*
     * Array de configurações. Altere cada linha conforme necessário.
     *
     * O TGMPA começará a fornecer strings de texto localizadas em breve. Se você já tiver traduções de nossas strings padrão disponíveis, por favor, ajude-nos a melhorar o TGMPA fornecendo acesso a essas traduções ou enviando um pull-request com arquivos .po contendo as traduções.
     *
     * Apenas descomente as strings no array de configuração se você quiser personalizar as strings.
     */
    $config = array(
        'id'           => 'iphan-blocksy',         // ID único para hash de notificações para múltiplas instâncias do TGMPA.
        'default_path' => '',                      // Caminho absoluto padrão para plugins empacotados.
        'menu'         => 'tgmpa-install-plugins', // Slug do menu.
        'parent_slug'  => 'themes.php',            // Slug do menu pai.
        'capability'   => 'edit_theme_options',    // Capacidade necessária para visualizar a página de instalação de plugins, deve ser uma capacidade associada ao menu pai usado.
        'has_notices'  => true,                    // Mostrar notificações no admin ou não.
        'dismissable'  => true,                    // Se false, o usuário não pode dispensar a mensagem de aviso.
        'dismiss_msg'  => '',                      // Se 'dismissable' for false, esta mensagem será exibida no topo do aviso.
        'is_automatic' => false,                   // Ativar plugins automaticamente após a instalação ou não.
        'message'      => '<p>Esta é uma lista não extensiva de plugins recomendados pelos desenvolvedores do tema Iphan Blocksy.</p>',                      // Mensagem a ser exibida logo antes da tabela de plugins.

        
        'strings'      => array(
            'page_title'                      => 'Instalar Plugins Necessários',
            'menu_title'                      => 'Instalar Plugins',
            'installing'                      => 'Instalando Plugin: %s',
            'updating'                        => 'Atualizando Plugin: %s',
            'oops'                            => 'Algo deu errado com a API do plugin.',
            'notice_can_install_required'     => _n_noop(
                'Este tema requer o seguinte plugin: %1$s.',
                'Este tema requer os seguintes plugins: %1$s.',
                'iphan-blocksy'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'Este tema recomenda o seguinte plugin: %1$s.',
                'Este tema recomenda os seguintes plugins: %1$s.',
                'iphan-blocksy'
            ),
            'notice_ask_to_update'            => _n_noop(
                'O seguinte plugin precisa ser atualizado para sua versão mais recente para garantir a máxima compatibilidade com este tema: %1$s.',
                'Os seguintes plugins precisam ser atualizados para suas versões mais recentes para garantir a máxima compatibilidade com este tema: %1$s.',
                'iphan-blocksy'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'Há uma atualização disponível para: %1$s.',
                'Há atualizações disponíveis para os seguintes plugins: %1$s.',
                'iphan-blocksy'
            ),
            'notice_can_activate_required'    => _n_noop(
                'O seguinte plugin obrigatório está atualmente inativo: %1$s.',
                'Os seguintes plugins obrigatórios estão atualmente inativos: %1$s.',
                'iphan-blocksy'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'O seguinte plugin recomendado está atualmente inativo: %1$s.',
                'Os seguintes plugins recomendados estão atualmente inativos: %1$s.',
                'iphan-blocksy'
            ),
            'install_link'                    => _n_noop(
                'Começar a instalar o plugin',
                'Começar a instalar os plugins',
                'iphan-blocksy'
            ),
            'update_link' 					  => _n_noop(
                'Começar a atualizar o plugin',
                'Começar a atualizar os plugins',
                'iphan-blocksy'
            ),
            'activate_link'                   => _n_noop(
                'Começar a ativar o plugin',
                'Começar a ativar os plugins',
                'iphan-blocksy'
            ),
            'return'                          => 'Retornar ao Instalador de Plugins Necessários',
            'plugin_activated'                => 'Plugin ativado com sucesso.',
            'activated_successfully'          => 'O seguinte plugin foi ativado com sucesso:',
            'plugin_already_active'           => 'Nenhuma ação tomada. O plugin %1$s já estava ativo.',
            'plugin_needs_higher_version'     => 'Plugin não ativado. Uma versão mais recente de %s é necessária para este tema. Por favor, atualize o plugin.',
            'complete'                        => 'Todos os plugins foram instalados e ativados com sucesso. %1$s',
            'dismiss'                         => 'Dispensar este aviso',
            'notice_cannot_install_activate'  => 'Há um ou mais plugins obrigatórios ou recomendados para instalar, atualizar ou ativar.',
            'contact_admin'                   => 'Por favor, entre em contato com o administrador deste site para obter ajuda.',

            'nag_type'                        => '', // Determina o tipo de aviso no admin - pode ser apenas uma das classes típicas de aviso do WP, como 'updated', 'update-nag', 'notice-warning', 'notice-info' ou 'error'. Algumas podem não funcionar como esperado em versões mais antigas do WP.
        ),
        
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'iphan_blocksy_register_required_plugins' );
