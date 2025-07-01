<?php

/**
 * Esta classe contém a lógica para adicionar estilos para certos tipos de metadados
 */
class IphanBlocksyMetadatumHooks {

	use Iphan_Blocksy\Singleton;

	public $icon_field = 'iphan_blocksy_metadatum_icon';
	public $hide_label_field = 'iphan_blocksy_metadatum_hide_label';
	public $style_field = 'iphan_blocksy_metadatum_value_style';

	/**
	 * Inicializa a classe com as actions e filters necessários
	 */
	protected function init() {
		add_action( 'tainacan-register-admin-hooks', array( $this, 'register_hook' ) );
		add_action( 'tainacan-insert-tainacan-metadatum', array( $this, 'save_data' ) );
		add_filter( 'tainacan-api-response-metadatum-meta', array( $this, 'add_meta_to_response' ), 10, 2 );
	}

	/**
	 * A função que registra o hook no formulário de seção de metadados
	 */
	function register_hook() {
		if ( function_exists( 'tainacan_register_admin_hook' ) ) {
			tainacan_register_admin_hook( 'metadatum', array( $this, 'form' ) );
			tainacan_register_admin_hook( 'metadatum', array( $this, 'form_relationship' ), 'end-left', [ 'attribute' => 'metadata_type', 'value' => 'Tainacan\Metadata_Types\Relationship' ] );
			tainacan_register_admin_hook( 'metadatum', array( $this, 'form_taxonomy' ), 'end-left', [ 'attribute' => 'metadata_type', 'value' => 'Tainacan\Metadata_Types\Taxonomy' ] );
		}
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
		if ( $object->can_edit() && isset( $post->{$this->hide_label_field} ))
			update_post_meta( $object->get_id(), $this->hide_label_field, $post->{$this->hide_label_field} );
		if ( $object->can_edit() && isset( $post->{$this->style_field} ))
			update_post_meta( $object->get_id(), $this->style_field, $post->{$this->style_field} );
	}

	/**
	 * Adiciona os novos campos à resposta da API quando consultamos seções de metadados
	 */
	function add_meta_to_response( $extra_meta, $request ) {
		$extra_meta = array(
			$this->icon_field,
			$this->hide_label_field,
			$this->style_field,
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
		<div class="tainacan-iphan-blocksy-metadatum-icon"> 
			<div class="field tainacan-collection--section-header">
				<h4>Opções do tema Iphan Blocksy</h4>
				<hr>
			</div>
			<div class="columns">
				<div class="field column is-4">
					<label class="label">Rótulo do metadado: </label>
					<div class="control">
						<span class="select is-fullwidth">
							<select name="<?php echo $this->hide_label_field; ?>">
								<option value="">Exibir rótulo</option>
								<option value="yes">Esconder</option>
							</select>
						</span>
					</div>
				</div>
				<div class="field column is-7">
					<label class="label">Ícone do metadado: </label>
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
									id="iphan-blocksy-metadatum-icon" 
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
		</div>
		<?php
        
		return ob_get_clean();
	}
	function form_relationship() {
		if ( !function_exists( 'tainacan_get_api_postdata' ) )
			return '';

		ob_start();
		?>
		<div class="tainacan-iphan-blocksy-metadatum-icon"> 
			<div class="columns">
				<div class="field column is-4">
					<label class="label">Estilo dos valores do metadado: </label>
					<div class="control">
						<span class="select is-fullwidth">
							<select name="<?php echo $this->style_field; ?>">
								<option value="default">Padrão (link)</option>
								<option value="buttons">Botões</option>
								<option value="tags">Tags</option>
							</select>
						</span>
					</div>
				</div>
			</div>
		</div>
		<?php
        
		return ob_get_clean();
	}
	function form_taxonomy() {
		if ( !function_exists( 'tainacan_get_api_postdata' ) )
			return '';

		ob_start();
		?>
		<div class="tainacan-iphan-blocksy-metadatum-icon"> 
			<div class="columns">
				<div class="field column is-4">
					<label class="label">Estilo dos valores do metadado: </label>
					<div class="control">
						<span class="select is-fullwidth">
							<select name="<?php echo $this->style_field; ?>">
								<option value="default">Padrão (link)</option>
								<option value="buttons">Botões</option>
								<option value="tags">Tags</option>
							</select>
						</span>
					</div>
				</div>
			</div>
		</div>
		<?php
        
		return ob_get_clean();
	}
}

IphanBlocksyMetadatumHooks::get_instance();

