<?php
/**
 * Plugin Name: JetSmartFilters - Default WC Providers
 * Plugin URI:  #
 * Description: Add support for the standard WooCommerce product query on the product archives/catalogue page.
 * Version:     1.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-smart-filters
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

define( 'JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_ID', 'default-wc-archive' );
define( 'JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_NAME', 'Default WooCommerce Archive' );

add_action( 'jet-smart-filters/providers/register', function ( $providers_manager ) {
	$providers_manager->register_provider(
		'Jet_Smart_Filters_Default_WC_Archive_Provider',
		JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_PATH . 'includes/providers/jet_smart_filters_default_wc_archive_provider.php'
	);
} );

/**
 * Its legacy part. Initially SmartFilters worked only with Elementor.
 * Now builder support is extended and we'll rewrite this part a bit in the future.
 * Providers used this hook will continiue to work but will be added more obvious interface to add builders support
 */
add_filter( 'jet-smart-filters/blocks/allowed-providers', function ( $providers ) {
	$providers[ JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_ID ] = JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_NAME;
	return $providers;
} );
