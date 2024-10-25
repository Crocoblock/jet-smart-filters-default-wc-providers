<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Default_WC_Archive_Provider extends Jet_Smart_Filters_Provider_WooCommerce_Archive {

	protected $query_id_class_prefix = 'jsf-query--';

	protected $rendered_block = null;

	public function __construct() {
		if ( ! jet_smart_filters()->query->is_ajax_filter() ) {
			add_filter( 'woocommerce_product_query', array( $this, 'store_archive_query' ) );
			add_filter( 'woocommerce_shop_loop', array( $this, 'set_loop_props' ) );
		}
	}

	public function get_name() {
		return JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_NAME;
	}

	public function get_id() {
		return JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_ID;
	}

	public function ajax_get_content() {

		global $wp_query;
		$wp_query = new WP_Query( jet_smart_filters()->query->get_query_args() );

		// Start products loop
		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();
				// Render products
				wc_get_template_part( 'content', 'product' );
			}
		}
	}

	public function get_wrapper_selector() {
		return 'body ul.products[class*="columns"]';
	}
}
