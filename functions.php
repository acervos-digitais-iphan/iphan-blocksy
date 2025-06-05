<?php

if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}

require_once get_stylesheet_directory() . '/inc/plugin-dependencies.php';
require_once get_stylesheet_directory() . '/inc/singleton.php';
require_once get_stylesheet_directory() . '/inc/utils.php';
require_once get_stylesheet_directory() . '/inc/enqueues.php';
require_once get_stylesheet_directory() . '/inc/phosphor-icons.php';
require_once get_stylesheet_directory() . '/inc/block-styles.php';
require_once get_stylesheet_directory() . '/inc/block-variations.php';
require_once get_stylesheet_directory() . '/inc/block-patterns.php';
require_once get_stylesheet_directory() . '/inc/customizer.php';
require_once get_stylesheet_directory() . '/inc/metadata-section-hooks.php';
require_once get_stylesheet_directory() . '/inc/metadatum-hooks.php';
require_once get_stylesheet_directory() . '/inc/tainacan-single-tweaks.php';
require_once get_stylesheet_directory() . '/inc/tainacan-archive-tweaks.php';
require_once get_stylesheet_directory() . '/inc/login-form-customizations.php';
require_once get_stylesheet_directory() . '/inc/misc.php';
require_once get_stylesheet_directory() . '/inc/footer-blocks.php';
require_once get_stylesheet_directory() . '/inc/govbr-header-button.php';
