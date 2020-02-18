<?php
/*
Plugin Name: AMP WooCommerce
Description: WooCommerce for AMP (Accelerated Mobile Pages). This plugin enables e-commerce store functionality with WooCommerce for AMP. AMP for Ecommerce out of the box.
Author: Mohammed Kaludi
Version: 0.4
Author URI: http://ampforwp.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


define('AMP_WOO_PLUGIN_URI', plugin_dir_url(__FILE__));
define('AMP_WOO_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('AMP_WOO_INC_DIR', dirname(__FILE__) . '/inc/'); 
 
if (! defined('AMP_WC_PLUGIN_URI') ){

// 	/* Add WooCommerce elements in the page
// 	    1. Enable WooCommerce support for AMP
// 		2. Include Files
// 		3. Add Custom Style for WooCommerce Page.
// 		4. Overriding Ampforwp Plugin Single Files.
// 	*/

// 		 // 1.
 add_action( 'amp_init', 'amp_woo_add_woocommerce_support',11);
	
//    	// 2. Including Required Files
	include_once(plugin_dir_path(__FILE__). '/inc/styles_script.php');
	include_once(plugin_dir_path(__FILE__). '/inc/amp_woo_ajax_calls.php');
	include_once(plugin_dir_path(__FILE__). '/inc/amp_woo_features.php');
	include_once(plugin_dir_path(__FILE__). '/templates/layouts/product-review.php');

//    // 3.
    add_action('pre_amp_render_post','amp_woo_add_tree_shaking',10);

//    // 4. Overriding Ampforwp Plugin Single Files.
    	add_filter( 'amp_post_template_file', 'amp_woo_custom_woocommerce_template', 11, 3 );

//    // 5.
     add_action('wp','amp_woo_main_css',10);

}


	
	// 1. Enable WooCommerce support for AMP
	function amp_woo_add_woocommerce_support() {
		// Check if the dependent plugins are activated, if not, then return.
		// As there is no use of this plugin, if parent plugins are not activated.
		if ( ! defined( 'AMPFORWP__FILE__' ) ) {  return; }

		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK | EP_PAGES | EP_ROOT );
		add_post_type_support( 'product', AMP_QUERY_VAR );
	}

   // 3. Add Custom Style for WooCommerce Page.
	function amp_woo_add_tree_shaking (){
    global $redux_builder_amp;
	add_filter('wc_get_template','amp_woo_woocommerce_template_override',10,5);
	add_filter('ampforwp_body_class','amp_woo_add_body_classes',10,2);
	add_filter('amp_content_sanitizers','amp_woo_add_woocommerce_blacklist',100);
	if( function_exists('ampforwp_tree_shaking_purify_amphtml') && isset($redux_builder_amp['ampforwp_css_tree_shaking']) && $redux_builder_amp['ampforwp_css_tree_shaking'] == 0  ){
		add_filter('ampforwp_the_content_last_filter','ampforwp_tree_shaking_purify_amphtml',11);
		}

   }
   //4. Overriding Ampforwp Plugin Single Files.
	function amp_woo_custom_woocommerce_template( $file, $type, $post ) {
		global  $redux_builder_amp;
     if ( 'single' === $type && 'product' === $post->post_type ) {
			if( class_exists( 'Ampforwp_Init' ) && ($redux_builder_amp['amp-design-selector'] == 1 || $redux_builder_amp['amp-design-selector'] == 2 || $redux_builder_amp['amp-design-selector'] == 3  )) {
					$file = dirname(__FILE__) . '/templates/layouts/single.php';
			}else {
				  $file = dirname(__FILE__) . '/templates/layouts/single.php';
			}
		}
		return $file;
	}