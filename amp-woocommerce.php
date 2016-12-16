<?php
/*
Plugin Name: AMP WooCommerce
Description: WooCommerce for AMP (Accelerated Mobile Pages). This is simple plugin enables e-commerce store with WooCommerce for AMP pages.
Author: Mohammed Kaludi
Version: 0.1
Author URI: http://ampforwp.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) exit;
// Enable WooCommerce support for AMP
	function amp_woocommerce_add_woocommerce_support() {

		// Check if the dependent plugins are activated, if not, then return.
		// As there is no use of this plugin, if parent plugins are not activated.
		if ( ! defined( 'AMP__FILE__' ) ) {  return; }

		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK | EP_PAGES | EP_ROOT );
		add_post_type_support( 'product', AMP_QUERY_VAR );

	}
	add_action( 'amp_init', 'amp_woocommerce_add_woocommerce_support',11);

	add_filter( 'amp_post_template_file', 'amp_woocommerce_custom_woocommerce_template', 10, 3 );

	function amp_woocommerce_custom_woocommerce_template( $file, $type, $post ) {
		global  $redux_builder_amp;
		if ( 'single' === $type && 'product' === $post->post_type ) {

			if ( class_exists( 'Ampforwp_Init' ) && $redux_builder_amp['amp-design-selector'] == 2) {
					$file = dirname(__FILE__) . '/templates/ampforwp-wc.php';
			} else {
					$file = dirname(__FILE__) . '/templates/wc.php';
			}

		}
		return $file;
	}

/* Add WooCommerce elements in the page

	1. Add WooCommerce container
	2. Add Custom Style for WooCommerce Page
	3. Add WooCommerce gallery
	4. Add WooCommerce amp-carousel script
	5. Remove Default Post Meta from header
	6. Add WooCommerce Meta information
	7. Add Product Description
*/
	// 1. Add WooCommerce container
	// Add container for WooCommerce elements
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_container_starts',9);
	function amp_woocommerce_container_starts(){
		echo ' <div class="amp-woocommerce-container">' ;
	}

	add_action('amp_woocommerce_after_the_content','amp_woocommerce_container_ends',20);
	function amp_woocommerce_container_ends(){
		echo ' </div>' ;
	}

	// 2. Add Custom Style for WooCommerce Page
	add_action('amp_post_template_css','amp_woocommerce_custom_style');
	function amp_woocommerce_custom_style() {
		if ( function_exists( 'is_on_sale' ) ) {
			global $woocommerce;
			$amp_woocommerce_sale =	$woocommerce->product_factory->get_product()->is_on_sale();
			if ( $amp_woocommerce_sale == 1 ) { ?>
				.amp-wp-article-featured-image::before {
					content: 'Sale';
					background: #0a89c0;
					padding: 20px 15px;
					border-radius: 50%;
					color: #fff;
					position: relative;
					z-index: 1;
					left: 5%px;
					top: 30px;
				}
			<?php } ?>
				.amp-woocommerce-container amp-carousel {
					background: none;
				}
				.ampforwp-add-to-cart-button a {
					background: #0a89c0;
					color: #fff;
					padding: 10px 8px;
					text-decoration: none;
				}

			<?php
		}?>
	.amp-wp-meta.amp-woocommerce-add-cart{
				display: block;
		}
		<?php
	}

	// 3. Add WooCommerce gallery
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_add_wc_elements_gallery');

	function amp_woocommerce_add_wc_elements_gallery(){
		if ( ! function_exists( 'get_gallery_attachment_ids' ) ) {
			global $woocommerce;
				$amp_woocommerce_gallery =	$woocommerce->product_factory->get_product()->get_gallery_attachment_ids();
				if ( $amp_woocommerce_gallery ) { ?>
					<amp-carousel width="400"
					  height="300"
					  layout="responsive"
					  autoplay
					  delay="2000"
					  type="slides">
						<?php
						foreach ($amp_woocommerce_gallery as $amp_woocommerce_image) {
							$attachment_image = wp_get_attachment_image_src( $amp_woocommerce_image, $size = 'large');
							$attachment_image = $attachment_image[0];
							?>
							<amp-img src="<?php echo esc_url($attachment_image); ?>"
							    width="400"
							    height="300"
							    layout="responsive"></amp-img>
							<?php
						} ?>
					</amp-carousel>
					<?php
				}
		}
	}

	// 4. Add WooCommerce amp-carousel script only if WC galley is available
	add_action('amp_post_template_head','amp_woocommerce_add_amp_carousel_script');

	function amp_woocommerce_add_amp_carousel_script() {
		if ( ! function_exists( 'get_gallery_attachment_ids' ) ) { ?>
			 	<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
			<?php
		}
	}

	// 5. Remove Default Post Meta from header

	// removed directly for now, but will use filters

		// 	// 5.1 Remove Meta Author info
		// add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_remove_meta_author' );
		// function amp_woocommerce_remove_meta_author( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-author', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }
		// 	// 5.2 Remove Meta Time info
		// add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_remove_meta_time' );
		// function amp_woocommerce_remove_meta_time( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-time', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }
		// 	// 5.3 Remove Comments button

		// if ( 'product' === $post->post_type ) {
		// 	add_filter( 'amp_post_article_footer_meta', 'amp_woocommerce_remove_comment_button' );
		// }

		// function amp_woocommerce_remove_comment_button( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-comments-link', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }

	// 6. Add WooCommerce Meta information
	add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_add_wc_meta' );
	function amp_woocommerce_add_wc_meta( $meta_parts ) {
		$meta_parts[] = 'amp-woocommerce-meta-info';
		return $meta_parts;
	}

	add_filter( 'amp_post_template_file', 'amp_woocommerce_add_wc_meta_path', 10, 3 );
	function amp_woocommerce_add_wc_meta_path( $file, $type, $post ) {
		if ( 'amp-woocommerce-meta-info' === $type  && 'product' === $post->post_type ) {

			$file = dirname( __FILE__ ) . '/templates/amp-woocommerce-meta-info.php';

		}
		return $file;
	}

	// 7. Add Product Description
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_add_product_description', 11);

	function amp_woocommerce_add_product_description(){
		woocommerce_template_single_excerpt();
	}
