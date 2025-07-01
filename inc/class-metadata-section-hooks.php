<?php

/**
 * Esta classe contém a lógica para adicionar um campo de ícone e de área do template para as seções de metadados 
 */
class IphanBlocksyMetadataSectionHooks {

	use Iphan_Blocksy\Singleton;

	public $icon_field = 'iphan_blocksy_metadata_section_icon';
	public $hide_label_field = 'iphan_blocksy_metadata_section_hide_label';
	public $template_area_field = 'iphan_blocksy_metadata_section_template_area';
	public $available_phosphor_icons = array();

	/**
	 * Inicializa a classe com as actions e filters necessários
	 */
	protected function init() {
		$this->available_phosphor_icons = require_once( get_stylesheet_directory() . '/inc/available-phosphor-icons.php' );
		add_action( 'tainacan-register-admin-hooks', array( $this, 'register_hook' ) );
		add_action( 'tainacan-insert-tainacan-metasection', array( $this, 'save_data' ) );
		add_filter( 'tainacan-api-response-metadata-section-meta', array( $this, 'add_meta_to_response' ), 10, 2 );
	}

	/**
	 * A função que registra o hook no formulário de seção de metadados
	 */
	function register_hook() {
		if ( function_exists( 'tainacan_register_admin_hook' ) )
			tainacan_register_admin_hook( 'metadataSection', array( $this, 'form' ) );
	}

	/**
	 * Salva os dados do formulário no banco de dados, guardando de fato os valores dos campos na seção de metadados
	 */
	function save_data( $object ) {
		if ( !function_exists( 'tainacan_get_api_postdata' ) )
			return;
		
		$post = tainacan_get_api_postdata();

		if ( $object->can_edit() && isset( $post->{$this->icon_field} ))
			update_post_meta( $object->get_id(), $this->icon_field, $post->{$this->icon_field} );
		if ( $object->can_edit() && isset( $post->{$this->template_area_field} ))
			update_post_meta( $object->get_id(), $this->template_area_field, $post->{$this->template_area_field} );
		if ( $object->can_edit() && isset( $post->{$this->hide_label_field} ))
			update_post_meta( $object->get_id(), $this->hide_label_field, $post->{$this->hide_label_field} );
	}

	/**
	 * Adiciona os novos campos à resposta da API quando consultamos seções de metadados
	 */
	function add_meta_to_response( $extra_meta, $request ) {
		$extra_meta = array(
			$this->icon_field,
			$this->template_area_field,
			$this->hide_label_field,
		);
		return $extra_meta;
	}

	/**
	 * Os campos extras que serão adicionados ao formulário de seção de metadados
	 */
	function form() {
		if ( !function_exists( 'tainacan_get_api_postdata' ) )
			return '';

		ob_start();
		?>
		<div class="tainacan-iphan-blocksy-metadata-section-icon"> 
			<div class="field tainacan-collection--section-header">
				<h4>Opções do tema Iphan Blocksy</h4>
				<hr>
			</div>
			<div class="columns">
				<div class="field column is-4">
					<label class="label">Área do modelo de página: </label>
					<div class="control">
						<span class="select is-fullwidth">
							<select name="<?php echo $this->template_area_field; ?>">
								<option value="default">Padrão (conteúdo central)</option>
								<option value="collapses">Caixas recolhíveis</option>
								<option value="sidebar">Barra lateral</option>
								<option value="tabs">Abas</option>
							</select>
						</span>
					</div>
					<p class="help">Escolha em qual área do modelo de página do item a seção aparecerá.</p>
				</div>
				<div class="field column is-4">
					<label class="label">Ícone da seção: </label>
					<div class="control has-icons-right">
						<input
								class="input"
								type="text"
								list="phosphor-icons"
								placeholder="Digite o nome sem acento ou espaço. Ex: info, seal-check, aperture, hand-coins, etc."
								name="<?php echo $this->icon_field; ?>"
								oninput="
									var icon = event.target.nextElementSibling.children[0];
									icon.className = 'ph ph-' + event.target.value;
								"
								onmousedown="
									var icon = event.target.nextElementSibling.children[0];
									icon.className = 'ph ph-' + event.target.value;
								">
						<span class="icon is-right">
							<i 
									id="iphan-blocksy-metadata-section-icon" 
									class="ph">
							</i>
						</span>
						<datalist id="phosphor-icons">
							<?php
							foreach ( IphanBlocksyPhosphorIcons::get_instance()->get_available_icons() as $icon ) {
								echo '<option value="' . $icon . '"></option>';
							}
							?>
						</datalist>
					</div>
					<p class="help">Veja os nomes dos ícones existentes <a href="https://phosphoricons.com/" target="_blank">na documentação dos Ícones Phosphor</a>.</p>
				</div>
			</div>
			<div class="columns">
				<div class="field column is-4">
					<label class="label">Rótulo da seção: </label>
					<div class="control">
						<span class="select is-fullwidth">
							<select name="<?php echo $this->hide_label_field; ?>">
								<option value="">Exibir rótulo</option>
								<option value="yes">Esconder</option>
							</select>
						</span>
					</div>
				</div>
				<div class="field column is-4"></div>
			</div>
		</div>
		<?php
        
		return ob_get_clean();
	}
}

IphanBlocksyMetadataSectionHooks::get_instance();

