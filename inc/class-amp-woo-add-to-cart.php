<?php
$submitClass = realpath( AMP_WOO_INC_DIR  . '/class-amp-woo-forms-submission.php' );
if ( file_exists( $submitClass ) ) {
	include_once $submitClass;
} else {
	@header( 'HTTP/1.1 500 INTERNAL ERROR' );
	exit;
}

class AMP_WOO_Form_Submit extends AMP_WOO_Form_Header {

	protected $action  = '';
	protected $formId  = 0;
	
	protected function preProcess() {

		parent::preProcess();
		if ( ! empty( $this->request['action'] ) ) {
			$this->action = $this->request['action'];
		}
		return $this;
	}

	protected function setHooks() {

		parent::setHooks();
			// add the action 
		$this->add_to_cart_action();
		return $this;
	}

	
	protected function submitForm() {
		global $woocommerce;
		$cart = $woocommerce->cart;
		$this->response['message'] = $message = WC()->session->get( 'wc_notices', array() );
		if (isset($message['error'])  ) {
			$this->response['status'] = 'error';
			if(count($message)>0){
				$message['error'] = array_unique($message['error']);
				foreach ($message['error'] as $key => $value) {
					$this->response['errors'][] = array("error_detail"=>html_entity_decode($value));
				}
			}
			$this->outputResponse()
				     ->pushResponse( 'HTTP/1.1 500 FORBIDDEN' );
		}else{
			$this->response['status'] = 'success';
			if(isset($message['success'])){
				if(is_array($message['success'])){
					$this->response['message'] = '';
					foreach ($message['success'] as $key => $value) {
						$this->response['message'] .= $value;
					}
				}
				else{
					$this->response['message']= $message['success'];
				}
			}
			$this->outputResponse()
			     ->pushResponse();
		}
		 
	}

	protected function run() {
		switch ( $this->action ) {
			case 'amp_woo_add_to_cart_submit':
				$this->submitForm();
				break;
			default:
				$this->response['status'] = 'error';
				$this->outputResponse()
				     ->pushResponse( 'HTTP/1.1 404 NOT FOUND' );
				break;
		}

		return $this;
	}

	protected function getGfVersion() {

		$version = '';
		//if ( empty( $version ) && has_class( 'GFCommon' ) ) {
			$version = GFCommon::$version;
		//}

		return $version;
	}
	public function add_to_cart_action( $url = false ) {
		global $redux_builder_amp;
		if ( empty( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) ) {
			return;
		}

		$product_id          = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );
		$was_added_to_cart   = false;
		$adding_to_cart      = wc_get_product( $product_id );

		if ( ! $adding_to_cart ) {
			return;
		}

		$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart );

		// Variable product handling
		if ( 'variable' === $add_to_cart_handler) {
			$was_added_to_cart = $this->add_to_cart_handler_variable( $product_id );

		// Grouped Products
		} elseif ( 'grouped' === $add_to_cart_handler ) {
			$was_added_to_cart = $this->add_to_cart_handler_grouped( $product_id );

		// Custom Handler
		} elseif ( has_action( 'woocommerce_add_to_cart_handler_' . esc_attr($add_to_cart_handler )) ) {
			do_action( 'woocommerce_add_to_cart_handler_' . esc_attr($add_to_cart_handler ), esc_url($url) );


		}elseif('booking' === $add_to_cart_handler){

			$was_added_to_cart = $this->add_to_cart_handler_yith_booking( $product_id );

		}		// Simple Products
		else {
			$was_added_to_cart = $this->add_to_cart_handler_simple( $product_id );
		}

		// If we added the product to the cart we can now optionally do a redirect.
		if ( $was_added_to_cart && wc_notice_count( 'error' ) === 0 ) {
			// If has custom URL redirect there
			if ( $url = apply_filters( 'woocommerce_add_to_cart_redirect', $url ) ) {
				$url = str_replace("http://", "https://", $url);
				if(isset($redux_builder_amp['ampforwp-wcp-cart-amp']) && $redux_builder_amp['ampforwp-wcp-cart-amp']==1){
					$url = user_trailingslashit(trailingslashit($url).AMPFORWP_AMP_QUERY_VAR);
				}
				$this->cors_Headers['AMP-Redirect-To'] = esc_url($url);
				$this->cors_Headers['Access-Control-Expose-Headers'] = "AMP-Redirect-To, ".esc_attr($headers['Access-Control-Expose-Headers']);
				//exit;
			} elseif ( get_option( 'woocommerce_cart_redirect_after_add' ) === 'yes' ) {
				$url = str_replace("http://", "https://", wc_get_cart_url());
				if(isset($redux_builder_amp['ampforwp-wcp-cart-amp']) && $redux_builder_amp['ampforwp-wcp-cart-amp']==1){
					$url = user_trailingslashit(trailingslashit($url).AMPFORWP_AMP_QUERY_VAR);
				}
				$this->cors_Headers['AMP-Redirect-To'] = esc_url($url);
				$this->cors_Headers['Access-Control-Expose-Headers'] = "AMP-Redirect-To, ".esc_attr($this->cors_Headers['Access-Control-Expose-Headers']);
				// exit;
			}
		}
	}
	function add_to_cart_handler_simple( $product_id ) {
		$quantity 			= empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( esc_attr($_REQUEST['quantity']) );
		$passed_validation 	= apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );


		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity,0, array() ) !== false ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
			return true;
		}
		return false;
	}

	function add_to_cart_handler_yith_booking( $product_id ) {
        if(function_exists('YITH_WCBK_Frontend')){
		 YITH_WCBK_Frontend();
	     }
		$quantity 			= empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( esc_attr($_REQUEST['quantity']) );
		$passed_validation 	= apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );


		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity,0, array() ) !== false ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
			return true;
		}
		return false;
	}


	function add_to_cart_handler_grouped( $product_id ) {
		$was_added_to_cart = false;
		$added_to_cart     = array();

		if ( ! empty( $_REQUEST['quantity'] ) && is_array( $_REQUEST['quantity'] ) ) {
			$quantity_set = false;

			foreach ( $_REQUEST['quantity'] as $item => $quantity ) {
				if ( $quantity <= 0 ) {
					continue;
				}
				$quantity_set = true;

				// Add to cart validation
				$passed_validation 	= apply_filters( 'woocommerce_add_to_cart_validation', true, $item, $quantity );

				if ( $passed_validation && WC()->cart->add_to_cart( $item, $quantity ) !== false ) {
					$was_added_to_cart = true;
					$added_to_cart[ $item ] = $quantity;
				}
			}

			if ( ! $was_added_to_cart && ! $quantity_set ) {
				wc_add_notice( esc_html__( 'Please choose the quantity of items you wish to add to your cart&hellip;', 'amp-woocommerce' ), 'error' );
			} elseif ( $was_added_to_cart ) {
				wc_add_to_cart_message( $added_to_cart );
				return true;
			}
		} elseif ( $product_id ) {
			/* Link on product archives */
			wc_add_notice( esc_html__( 'Please choose a product to add to your cart&hellip;', 'amp-woocommerce' ), 'error' );
		}
		return false;
	}

	function add_to_cart_handler_variable( $product_id ) {
		$adding_to_cart     = wc_get_product( $product_id );
		$variation_id       = empty( $_REQUEST['variation_id'] ) ? '' : absint( $_REQUEST['variation_id'] );
		$quantity           = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( esc_attr($_REQUEST['quantity']) );
		$missing_attributes = array();
		$variations         = array();
		$attributes         = $adding_to_cart->get_attributes();

		// If no variation ID is set, attempt to get a variation ID from posted attributes.
		if ( empty( $variation_id ) ) {
			$data_store   = WC_Data_Store::load( 'product' );
			$variation_id = $data_store->find_matching_product_variation( $adding_to_cart, wp_unslash( $_POST ) );
		}

		// Validate the attributes.
		try {
			if ( empty( $variation_id ) ) {
				throw new Exception( esc_html__( 'Please choose product options&hellip;', 'amp-woocommerce' ) );
			}

			$variation_data = wc_get_product_variation_attributes( $variation_id );

			foreach ( $attributes as $attribute ) {
				if ( ! $attribute['is_variation'] ) {
					continue;
				}

				$taxonomy = 'attribute_' . sanitize_title( $attribute['name'] );

				if ( isset( $_REQUEST[ $taxonomy ] ) ) {
					// Get value from post data
					if ( $attribute['is_taxonomy'] ) {
						// Don't use wc_clean as it destroys sanitized characters
						$value = sanitize_title( stripslashes( $_REQUEST[ $taxonomy ] ) );
					} else {
						$value = wc_clean( stripslashes( $_REQUEST[ $taxonomy ] ) );
					}

					// Get valid value from variation
					$valid_value = isset( $variation_data[ $taxonomy ] ) ? $variation_data[ $taxonomy ] : '';

					// Allow if valid or show error.
					if ( $valid_value === $value ) {
						$variations[ $taxonomy ] = $value;
					// If valid values are empty, this is an 'any' variation so get all possible values.
					} elseif ( '' === $valid_value && in_array( $value, $attribute->get_slugs() ) ) {
						$variations[ $taxonomy ] = $value;
					} else {
						throw new Exception( sprintf( esc_html__( 'Invalid value posted for %s', 'amp-woocommerce' ), wc_attribute_label( $attribute['name'] ) ) );
					}
				} else {
					$missing_attributes[] = wc_attribute_label( $attribute['name'] );
				}
			}
			if ( ! empty( $missing_attributes ) ) {
				throw new Exception( sprintf( _n( '%s is a required field', '%s are required fields', sizeof( $missing_attributes ), 'amp-woocommerce' ), wc_format_list_of_items( $missing_attributes ) ) );
			}
		} catch ( Exception $e ) {
			wc_add_notice( $e->getMessage(), 'error' );
			return false;
		}

		// Add to cart validation
		$passed_validation 	= apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations );

		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations ) !== false ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
			return true;
		}

		return false;
	}

}

$amp_woo_form_instantiate = new AMP_WOO_Form_Submit( $_GET, $_POST );
$amp_woo_form_instantiate->activate();