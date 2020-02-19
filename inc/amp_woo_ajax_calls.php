<?php 
// 1. Add to cart Ajax
add_action('wp_ajax_amp_woo_add_to_cart_submit','amp_woo_add_to_cart_submit');
add_action('wp_ajax_nopriv_amp_woo_add_to_cart_submit','amp_woo_add_to_cart_submit');

if(isset($_GET['ampsubmit']) && esc_attr($_GET['ampsubmit']) ==1){
	add_action('plugins_loaded','amp_woo_remove_add_to_cart');
	function amp_woo_remove_add_to_cart(){
		remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );	
	}
}

function amp_woo_add_to_cart_submit(){
	if( !wp_verify_nonce($_POST['wc_shop_wpnonce'],'wc_shop_wpnonce') && ((!strpos($_SERVER['HTTP_ORIGIN'], 'cdn.ampproject.org')) && (!strpos($_SERVER['HTTP_ORIGIN'], 'amp.cloudflare.com')) && (!strpos($_SERVER['HTTP_REFERER'], 'google.com/amp/s/')) ) ){
		header('HTTP/1.1 500 FORBIDDEN');
		echo wp_json_encode( 'Sorry, your nonce did not verify.' );
		die;
	}
	else{
		 if( !isset($_POST['ampforwp_wc_membership'])){

			require_once AMP_WOO_INC_DIR .'class-amp-woo-add-to-cart.php';

		 }
	}
	header("access-control-allow-credentials:true");
    header("access-control-allow-headers:Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token");
    header("Access-Control-Allow-Origin:".esc_attr($_SERVER['HTTP_ORIGIN']));
    $siteUrl = parse_url(
			get_site_url()
		);
    $source_origin = $siteUrl['scheme'] . '://' . $siteUrl['host'];
    header("AMP-Access-Control-Allow-Source-Origin:".esc_url($source_origin));
    header("access-control-expose-headers:AMP-Access-Control-Allow-Source-Origin");
    header("Content-Type:application/json");
	if(is_plugin_active('woocommerce-memberships/woocommerce-memberships.php')){
		$redirect_url = user_trailingslashit(trailingslashit(wc_get_cart_url()));
		header("AMP-Redirect-To: ".esc_url($redirect_url));
       	header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");   
	}
    wp_die();
}

// 2. Cart & Coupon code Ajax.
add_action('wp_ajax_amp_woo_cart_coupon_operation','amp_woo_cart_coupon_operation');
add_action('wp_ajax_nopriv_amp_woo_cart_coupon_operation','amp_woo_cart_coupon_operation');

function amp_woo_cart_coupon_operation(){

	if(!wp_verify_nonce(sanitize_key($_POST['wc_cart_wpnonce']),'wc_cart_wpnonce') ){
		header('HTTP/1.1 500 FORBIDDEN');
		header("access-control-allow-credentials:true");
	    header("access-control-allow-headers:Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token");
	    header("Access-Control-Allow-Origin:".esc_attr($_SERVER['HTTP_ORIGIN']));
	    $siteUrl = parse_url(
				get_site_url()
			);
	     $source_origin = $siteUrl['scheme'] . '://' . $siteUrl['host'];
	    header("AMP-Access-Control-Allow-Source-Origin:".esc_url($source_origin));
	    header("access-control-expose-headers:AMP-Access-Control-Allow-Source-Origin");
	    header("Content-Type:application/json");
		echo wp_json_encode( 'Security-check.' );
    	wp_die();
	}
	else{
		switch ($_POST['option_perform']) {
			case 'apply_coupon':
				$coupon_code = sanitize_text_field($_POST['coupon_code']);
				WC()->cart->apply_coupon( sanitize_text_field( $_POST['coupon_code'] ) );
				break;
			case 'remove_coupon':
				WC()->cart->remove_coupon( wc_clean( esc_attr($_POST['remove_coupon'] ) ) );
				break;
			default:
				# code...
				break;
		}
		// Recalc our totals
		WC()->cart->calculate_totals();
		$siteUrl = parse_url(
				get_site_url()
			);
	 	$source_origin = esc_attr($siteUrl['scheme']) . '://' . esc_attr($siteUrl['host']);
		header('AMP-Access-Control-Allow-Source-Origin: '.esc_url($source_origin));
		$url =  wc_get_cart_url();
		$url = user_trailingslashit(trailingslashit($url).AMPFORWP_AMP_QUERY_VAR);
		$url = str_replace('http:', 'https:', $url);
		header("AMP-Redirect-To: ".esc_url($url));		
		header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin"); 
		echo json_encode(array('successmsg'=>'Cart Updated'));
		exit;
	}
}