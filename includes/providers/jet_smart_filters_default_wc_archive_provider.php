<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Default_WC_Archive_Provider extends Jet_Smart_Filters_Provider_WooCommerce_Archive {

	protected $query_id_class_prefix = 'jsf-query--';

	protected $rendered_block = null;

	public function __construct() {
		parent::__construct();
	}

	public function get_name() {
		return JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_NAME;
	}

	public function get_id() {
		return JET_SMART_FILTERS_DEFAULT_WC_ARCHIVE_PROVIDER_ID;
	}

	public function ajax_get_content() {
		$args = jet_smart_filters()->query->get_query_args();

		if ( ! empty( $args ) ) {
			// Apply the filters to WooCommerce products query
			add_action( 'woocommerce_product_query', function ( $query ) use ( $args ) {
				$query->set( 'meta_query', $args['meta_query'] );
			});

			// Start products loop
			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();
					// Render products
					wc_get_template_part( 'content', 'product' );
				}
			}
		}
	}

	public function apply_filters_in_request() {
		parent::apply_filters_in_request();
	}

	public function get_wrapper_selector() {
		return 'body ul.products[class*="columns"]';
	}
}
