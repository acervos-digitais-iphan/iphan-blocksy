<?php
/**
 * As chamadas de função neste arquivo permitem que o Blocksy
 * carregue o CSS global do tema a partir de configurações
 * adicionais do menu Personalizar.
 */
if ( function_exists('blc_call_fnc') ) {
	blc_call_fnc(['fnc' => 'blocksy_output_spacing'], [
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => ':root',
		'property' => 'iphan-blocksy-border-radius',
		'value' => blocksy_get_theme_mod(
			'iphan_blocksy_general_border_radius',
			blocksy_spacing_value()
		),
		'empty_value' => 4,
	]);
}

if ( function_exists('blocksy_output_background_css') ) {
	blocksy_output_background_css([
		'selector' => '.tainacan-item-single-page .tainacan-item-single .iphan-blocksy-metadata-section--tabs .tainacan-item-section--metadata',
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value' => blocksy_get_theme_mod(
			'iphan_blocksy_item_tabs_background',
			blocksy_background_default_value([
				'backgroundColor' => [
					'default' => [
						'color' => 'var(--theme-palette-color-8)'
					],
				],
			])
		),
		'responsive' => true,
		'forced_background_image' => true
	]);
}