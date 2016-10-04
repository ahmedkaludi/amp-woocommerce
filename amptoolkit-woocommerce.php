<?php
/*
Plugin Name: WooCommerce for AMP-Toolkit
Description: An Extension of AMP-Toolkit. This is simple plugin enables WooCommerce for AMP pages.
Author: Mohammed Kaludi
Version: 1.0
Author URI: http://ampforwp.com
*/

// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) exit;

// Check if the dependent plugins are activated, if not, then return.
// As there is no use of this plugin, if parent plugins are not activated.
	if ( defined( 'AMP__FILE__' ) && defined( 'AMPFORWP_PLUGIN_DIR' ) ) {
		
	} else {  return; }

// Enable WooCommerce support for AMP
	function ampforwp_add_woocommerce_support() {

		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK | EP_PAGES | EP_ROOT );
		add_post_type_support( 'product', AMP_QUERY_VAR );

	}
	add_action( 'init', 'ampforwp_add_woocommerce_support',11);

// create new template for WooCommerce
	add_action('ampforwp_after_features_include', 'ampforwp_include_woocommerce_files');
	function ampforwp_include_woocommerce_files() {
			add_filter( 'amp_post_template_file', 'ampforwp_woocommerce_template', 10, 3 );
	}
	function ampforwp_woocommerce_template( $file, $type, $post ) {
		if ( 'single' === $type && 'product' === $post->post_type ) {
			$file = dirname(__FILE__) . '/wc.php';
		}
		return $file;
	} 
	
	// Add WooCommerce Support in the theme.
	add_action( 'pre_amp_render_post', 'ampforwp_add_woocommerce_image_action' );
	function ampforwp_add_woocommerce_image_action() {
		add_filter( 'the_content', 'ampforwp_add_woocommerce_featured_image' );	
	}

	function ampforwp_add_woocommerce_featured_image( $content ) {
			global $woocommerce;
			$get_wc_image = $woocommerce->product_factory->get_product()->get_image();
			// Just add the raw <img /> tag; our sanitizer will take care of it later.
			$image = sprintf( '<p class="ampforwp-wc-product-desc">%s</p>', $get_wc_image );
			$content = $image . $content;
			return $content;
	}


if ( ! function_exists( 'ampforwp_woocommerce_settings' ) ) {
	function ampforwp_woocommerce_settings($sections){
	    $sections[] = array(
	        'title' => __('In Content Ads', 'redux-framework-demo'),
	        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
	        'icon' => 'el el-th-large',
	        'fields' => array(	
							array(
		                'id'        =>'ampforwp-incontent-ad-1-enable',
		                'type'      => 'switch', 
		                'title'     => __('AD #1', 'redux-framework-demo'),
										'subtitle' 	=> __('Show Ad after 50% of content, or set custom lenght.','redux-framework-demo'),
		                'default'   => 0,
		                'true'      => 'Enabled',
		                'false'     => 'Disabled',
		            ),
							array(
										'id'       => 'ampforwp-incontent-ad-1',
										'type'     => 'select',
										'title'    => __('AD Size', 'redux-framework-demo'), 
										'options'  => array(
												'1' => '300x250',
												'2' => '336x280', 
												'3' => '728x90',
												'4' => '300x600',
												'5' => '320x100',
												'6' => '200x50',
												'7' => '320x50'
										),
										'default'  => '2',
										'required'	=> array('ampforwp-incontent-ad-1-enable','=','1'),
								),
								array(
										'id'        =>'ampforwp-incontent-ad-1-data-ad-client',
										'type'      => 'text',   
										'title'     => __('Data AD Client', 'redux-framework-demo'),
										'desc'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code. e.g. ca-pub-2005XXXXXXXXX342', 'redux-framework-demo'),
										'default'   => '',
										'placeholder'=> 'ca-pub-2005XXXXXXXXX342',
										'required'	=> array('ampforwp-incontent-ad-1-enable','=','1'),
								),          
								array(
										'id'        => 'ampforwp-incontent-ad-1-data-ad-slot',
										'type'      => 'text', 
										'title'     => __('Data AD Slot', 'redux-framework-demo'),
										'desc'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. e.g. 70XXXXXX12', 'redux-framework-demo'),
										'default'  => '',
										'placeholder'=> '70XXXXXX12',
										'required'	=> array('ampforwp-incontent-ad-1-enable','=','1'),
								),
								array(
		              'id'       => 'amp-content-advert-middle',
		              'type'      => 'switch', 
		              'title'    => __( 'Show Ad after 50% of content', 'redux-framework-demo' ),
		              'subtitle' => __( 'Show Ad after 50% of content', 'redux-framework-demo' ),
									'true'      => 'Enabled',
	                'false'     => 'Disabled',
		              'default'  => 1,
									'required'	=> array('ampforwp-incontent-ad-1-enable','=','1'),
							),	
							array(
		              'id'       => 'amp-content-advert',
		              'type'     => 'select',
		              'title'    => __( 'In content Ads', 'redux-framework-demo' ),
		              'subtitle' => __( 'Select after how many paragraphs your ads should show.', 'redux-framework-demo' ),
									'required'  => array('amp-content-advert-middle', '=' , 0),
		              'options'  => array( 
												'1' => '1', 
												'2'  => '2', 
												'3'  => '3', 
												'4'  => '4', 
												'5'  => '5', 
												'6'  => '6', 
												'7'  => '7', 
												'8'  => '8', 
												'9'  => '9', 
												'10'  => '10', 
									 	),
		              'default'  => '2',
							),
								// array(
								// 			'id'        =>'ampforwp-incontent-ad-2-enable',
								// 			'type'      => 'switch', 
								// 			'title'     => __('AD #2', 'redux-framework-demo'),
								// 			'subtitle' 	=> __('Show Ad after 75% of content','redux-framework-demo'),
								// 			'default'   => 0,
								// 			'true'      => 'Enabled',
								// 			'false'     => 'Disabled',
								// 	),
								// array(
								// 			'id'       => 'ampforwp-incontent-ad-2',
								// 			'type'     => 'select',
								// 			'title'    => __('AD Size', 'redux-framework-demo'),  
								// 			// Must provide key => value pairs for select options
								// 			'options'  => array(
								// 					'1' => '300x250',
								// 					'2' => '336x280', 
								// 					'3' => '728x90',
								// 					'4' => '300x600',
								// 					'5' => '320x100',
								// 					'6' => '200x50',
								// 					'7' => '320x50'
								// 			),
								// 			'default'  => '2',
								// 			'required'	=> array('ampforwp-incontent-ad-2-enable','=','1'),
								// 	),
								// 	array(
								// 			'id'        =>'ampforwp-incontent-ad-2-data-ad-client',
								// 			'type'      => 'text',   
								// 			'title'     => __('Data AD Client', 'redux-framework-demo'),
								// 			'desc'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code. e.g. ca-pub-2005XXXXXXXXX342', 'redux-framework-demo'),
								// 			'default'   => '',
								// 			'placeholder'=> 'ca-pub-2005XXXXXXXXX342',
								// 			'required'	=> array('ampforwp-incontent-ad-2-enable','=','1'),
								// 	),          
								// 	array(
								// 			'id'        => 'ampforwp-incontent-ad-2-data-ad-slot',
								// 			'type'      => 'text', 
								// 			'title'     => __('Data AD Slot', 'redux-framework-demo'),
								// 			'desc'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. e.g. 70XXXXXX12', 'redux-framework-demo'),
								// 			'default'  => '',
								// 			'placeholder'=> '70XXXXXX12',
								// 			'required'	=> array('ampforwp-incontent-ad-2-enable','=','1'),
								// 	),	
					)
	    );
	    return $sections;
	}
}

// add_filter("redux/options/redux_builder_amp/sections", 'ampforwp_woocommerce_settings');
