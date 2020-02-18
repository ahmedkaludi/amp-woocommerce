<?php

/* Add WooCommerce elements in the page

	1. Overriding Woocommerce Templates.
	2. Adding Woocommece Blackist for forms.
	3. Adding Classes in Body Tag.
	4. Creating Product Json.
    5. Unregister Theme widgets in amp product pages
    6. Current Active theme data.
    7. Modify Content before the page loads.
    8. Hex Code Sanitization.
*/

//1. Overriding Woocommerce Templates
function amp_woo_woocommerce_template_override($template, $template_name, $args, $template_path, $default_path){

 if ( (function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint()) 
	|| (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) ) {

	 	if($template_name == 'single-product/add-to-cart/simple.php'){
	        $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/add-to-cart/simple.php';
	 	}
	 	if($template_name == 'single-product/add-to-cart/variable.php'){
            $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/add-to-cart/variable.php';
	 	}
	 	if($template_name == 'single-product/add-to-cart/variation-add-to-cart-button.php'){
	        $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/add-to-cart/variation-add-to-cart-button.php';
	 	}

	 	if($template_name == 'single-product/add-to-cart/external.php'){
	        $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/add-to-cart/external.php';
	 	}
	 	if($template_name == 'single-product/add-to-cart/grouped.php'){
	        $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/add-to-cart/grouped.php';
	 	}

	    if($template_name == 'single-product/tabs/tabs.php'){
		        $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/tabs/tabs.php';
		 	}
		 	 
	 	if($template_name == 'single-product/tabs/description.php'){
		        $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/tabs/description.php';
		 	}

 		if($template_name == 'single-product/short-description.php'){
        $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/tabs/short-description.php';
 	      }
	 	 if($template_name == 'single-product/tabs/additional_information.php'){
	        $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/tabs/additional_information.php';
	 	}	
		if($template_name == 'single-product/product-image.php'){
		  $template = AMP_WOO_PLUGIN_PATH.'templates/single-product/product-image.php';
		}
		if($template_name == 'cart/cart.php'){
    	  $template = AMP_WOO_PLUGIN_PATH.'templates/cart/cart.php';
		}
		if($template_name == 'cart/shipping-calculator.php'){
    	  $template = AMP_WOO_PLUGIN_PATH.'templates/cart/shipping-calculator.php';
		}
    }
	return $template;
} 

// 2. Adding Woocommece Blackist for forms
function amp_woo_add_woocommerce_blacklist($data){

	require_once AMP_WOO_INC_DIR .'/class-amp-woo-blacklist.php';
		unset($data['AMP_Blacklist_Sanitizer']);
		unset($data['AMPFORWP_Blacklist_Sanitizer']);
	if(isset($data['AMP_Review_Form_Blacklist'])){
	 	unset($data['AMP_Review_Form_Blacklist']);
    }
	
	$data[ 'AMP_WOO_Blacklist' ] = array();
	 
	return $data;
} 
// 3. Adding Classes in Body Tag
function amp_woo_add_body_classes($classes, $class){
 $classes[] ="woocommerce"; 
 $classes[] = "woocommerce-page";

 return $classes;
}
// 4. Creating Product Json
 function amp_woo_product_json_generator($retunType="") {  
        global $woocommerce;
        global $product;
		$images 		= array();
		$image_gallery  = array();
		
			$product_id_some = $woocommerce->product_factory->get_product();
			$addtoCartText = $product_id_some->add_to_cart_text();
			if ($product_id_some->get_type()=='variable' ) {
				$addtoCartText = 'Add to cart';
			}
			if ($product_id_some->get_type()=='simple' ) {
				$addtoCartText = 'Add to cart';
			}
		$product_details = array(
							'id'=>$product_id_some->get_id(),
							'name'=>$product_id_some->get_name(),
							'parmalink'=>$product_id_some->get_permalink(),
							'is_on_sale'=>$product_id_some->is_on_sale(),
							'slug'=>$product_id_some->get_slug(),
							'status'=>$product_id_some->get_status(),
							'featured'=>$product_id_some->get_featured(),
							'catalog_visibility'=>$product_id_some->get_catalog_visibility(),
							'description'=>$product_id_some->get_description(),
							'sku'=>$product_id_some->get_sku(),
							'currency'=> get_woocommerce_currency_symbol() ,
							'price'=> wc_get_price_to_display($product_id_some, array( 'price' => $product_id_some->get_price() )), //$product_id_some->get_price() ,
							'regular_price'=>$product_id_some->get_price(),
							'sale_price'=>$product_id_some->get_price(),
							'date_on_sale_from'=>$product_id_some->get_date_on_sale_from(),
							'date_on_sale_to'=>$product_id_some->get_date_on_sale_to(),
							'total_sales'=>$product_id_some->get_total_sales(),
							'manage_stock'=>$product_id_some->get_manage_stock(),
							'stock_quantity'=>$product_id_some->get_stock_quantity(),
							'stock_status'=>$product_id_some->get_stock_status(),
							'backorders'=>$product_id_some->get_backorders(),
							'weight'=>$product_id_some->get_weight(),
							'length'=>$product_id_some->get_length(),
							'width'=>$product_id_some->get_width(),
							'height'=>$product_id_some->get_height(),
							'product_type'=>$product_id_some->get_type(),
							'rating'=>$product_id_some->get_average_rating(),
							'categories'=> wc_get_product_category_list($product_id_some->get_id()),
							'currency_sym'=> html_entity_decode(get_woocommerce_currency_symbol()),
							'add_cart_text'=> $addtoCartText,
							'add_cart_url'=>$product_id_some->add_to_cart_url(),
							'cart_url'=>$cart_url = user_trailingslashit(trailingslashit(wc_get_cart_url())),
							);
			 if(substr($product_details['cart_url'] , -1) !== '/'){
			 $product_details['cart_url'] = $product_details['cart_url'].'/';
		     }
			$product_identy          = $woocommerce->product_factory->get_product()->get_id();
			$add_to_cart_text_new    = $woocommerce->product_factory->get_product()->add_to_cart_text();

			//Get Product image
			$imageLinks[0]    = get_post_thumbnail_id($product_identy);
			$imagesrc = wp_get_attachment_image_src($imageLinks[0],'full');
			$imagesrc = $imagesrc;
			
			$product_url_new        = trailingslashit(get_permalink( $product_id_some ));
			$attributes = array();
			$regular_prices  = array();
			$sale_prices   = array();
    	
	    	$image_gal = $woocommerce->product_factory->get_product()->get_gallery_image_ids();

			$gal_url = array();
			$big_img_url = array();
			foreach ($image_gal as $key => $value) {
				$gal_url[] = wp_get_attachment_image_src(esc_attr($value),'thumbnail');
				$big_img_url[] = wp_get_attachment_image_src(esc_attr($value),'full');
			}
			$gallery_src = array();
			foreach ($gal_url as $key) {
				$gallery_src[] =  $key;
			}
			$big_img_src = array();
			foreach ($big_img_url as $key) {
				$big_img_src[] =  $key;
			}
			array_unshift($gallery_src, $imagesrc);
			array_unshift($big_img_src, $imagesrc);

				$gallery_src = $gallery_src;
				$big_img_src = $big_img_src;
		
		    if($product_id_some->get_type() === "simple"){
			$attributes = array();
		    }  

		
		   $details = array(
		        'product'=>$product_details,
		        'id'=>$product_identy,
		   		'regular_price'=> $regular_prices,
		   		'sale_price'=>$sale_prices,

		   		'product_image'=>$imagesrc[0],
		   		'image'=>$images,
		   		'bigImage'=>$big_img_src,
		   		'gallery'=>$gallery_src,
		   		'selectedImage'=>0,
		   		'selectedqty'=>1,
		   		'minqty'=>1,
		   		'maxqty'=>$product_id_some->get_stock_quantity()
		   		);
			if(empty($details['maxqty'])){
			  	$details['maxqty'] = 0;
			  }

			if($retunType=="array"){
				$json_detail =  $details;			
			}else{
				unset($details['product']['description']);
				unset($details['product']['categories']);
				$json_detail =  wp_json_encode($details );  // XXS OK
			}
	    return $json_detail;
 }

 // 5. Unregister Theme widgets in amp product pages
  add_action( 'widgets_init', 'amp_woo_unregister_widgets', 20 );

  function amp_woo_unregister_widgets(){
  	global $redux_builder_amp;
   if ( function_exists('amp_active_theme_data')) {
   $active_theme = amp_active_theme_data('theme_name'); 
		}
   $siteUrl = filter_input(INPUT_SERVER, 'REQUEST_URI');
   $amp_end_query  = explode('/', $siteUrl);
   $count = count($amp_end_query)-1;
   if( (function_exists('unregister_sidebar')) && ((isset($redux_builder_amp['ampforwp-amp-takeover']) && $redux_builder_amp['ampforwp-amp-takeover'] == true) ||  (in_array('amp', $amp_end_query) || in_array('?amp=1', $amp_end_query) ||  in_array('?amp', $amp_end_query) || strpos($amp_end_query[$count], '&amp=1') !== false ))){
        unregister_sidebar( 'sidebar-1' );
        unregister_sidebar( 'product-sidebar' );
        unregister_sidebar( 'astra-woo-single-sidebar' );
	    unregister_sidebar( 'astra-woo-shop-sidebar' );
        }
	}

// 6. Current Active theme data.
function amp_woo_active_theme_data($data=""){

	$theme   	= wp_get_theme( get_template() );
	$version 	= $theme->get( 'Version' );
	$theme_uri 	= get_stylesheet_directory_uri();
	$theme_name = $theme->get( 'Name' );
	$parent 	= '';
	
	if(method_exists(wp_get_theme(), 'parent')){
		$parent = wp_get_theme()->parent();
	}

	if(!empty($parent) && method_exists($parent, 'get')){
		$theme_name = wp_get_theme()->parent()->get( 'Name' );
		$is_child = 'active';
	}else{
		$is_child = 'not_active';
	}

   switch ($data) {
   	case 'theme_name':
   		$data = $theme_name;
   		break;
   	
   	case 'theme_uri':
   		$data = $theme_uri;
   		break;
   	
   	case 'is_child':
   		$data = $is_child;
   		break;
   }

   if ( empty($data) ) {
   		$data  = array(
   			'theme_name' 	=> esc_html($theme_name) , 
   	        'theme_uri' 	=> esc_url($theme_uri), 
   	        'is_child' 		=> esc_html($is_child)
       	);
   }
   return $data;
}
// 7. Modify Content before the page loads 
add_filter('ampforwp_the_content_last_filter', 'amp_woo_content_modify');

function amp_woo_content_modify($content_buffer){
	$content_buffer = preg_replace('/data-openbrack/', '[' , $content_buffer);
	$content_buffer = preg_replace('/closebrack/', ']' , $content_buffer);
 return $content_buffer;
}

// 8. Hex Code Sanitization
function amp_woo_sanitize_color($color) {
	if (function_exists('ampforwp_sanitize_color')){
		$color = ampforwp_sanitize_color($color);
	} else {
		$color = sanitize_hex_color($color);
	}
	return $color;
}